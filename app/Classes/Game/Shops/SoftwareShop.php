<?php

/**
 * App\Classes\Game\Shops\SoftwareShop
 *
 * @package HackTech Online
 * @author Kasper F. Mikkelsen
 * @copyright 2017
 * @version 1.0
 * @access public
 */

namespace App\Classes\Game\Shops;

use App\Classes\Game\Handlers\ModuleHandler;
use App\Classes\Game\User;
use App\Models\Application;
use App\Models\ApplicationData;
use App\Classes\Game\Module;
use App\Models\UserApp;

class SoftwareShop
{
    public static function getMarketApps($userID){
        $marketApps = Application::onMarket()->get();
        $applicationList = array();

        foreach($marketApps as $app) {
            $userAppCheck = UserApp::ownedBy($userID)->where('application_id', $app->id)->first();
            if($userAppCheck){
                $appData = ApplicationData::where('application_id', $userAppCheck->application_id)->where('version', '>', $userAppCheck->data->version)->first();
                if($appData){
                    $result = $appData->application->byVersion($userAppCheck->application_id, $appData->version)->first();
                    $applicationList[] = $result;
                }
            }else{
                $appData = ApplicationData::where('application_id', $app->id)->where('version', '=', $app->data->version)->first();
                $result = $appData->application->byVersion($app->id, $appData->version)->first();
                $applicationList[] = $result;
            }
        }

        return $applicationList;
    }

    public static function buySoftware(User $user, $softwareID, $version){
        $modQuery = Application::where('id', $softwareID)->first();
        $handler = new ModuleHandler();
        $newSoftware = $handler->getApplication($softwareID, $user->userID, true, $version);

        if($user->economy->getBalance() >= $newSoftware->price){
            $ownerCheck = UserApp::ownedBy($user->userID)->where('application_id', $softwareID)->first();
            if($ownerCheck) {
                if (strcmp(strtolower($modQuery->app_name), strtolower($newSoftware->name)) == 0) {
                    $oldApp = UserApp::ownedBy($user->userID)->where('application_id', $newSoftware->moduleID)->first();
                    $oldApp->delete();
                }
            }

            $newApp = new UserApp();
            $newApp->fill([
                'user_id' => $user->userID,
                'application_id' => $newSoftware->moduleID,
                'installed' => 0,
                'application_datas_id' => $newSoftware->appModel->variant_id
            ]);

            $newApp->save();

            activity('gateway')
                ->performedOn($newApp)
                ->withProperties([
                    'software_id' => $newApp->application_id,
                    'software_version' => $newSoftware->version
                ])
                ->causedBy($user->model)
                ->log('Bought software ' . $newSoftware->title);

            $user->economy->removeMoney($newSoftware->price);

            return true;

        }

        return false;
    }
}
