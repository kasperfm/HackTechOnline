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

                    /*foreach ($appData as $finalApp){
                        $result = $finalApp->application->byVersion($userAppCheck->application_id, $finalApp->version)->first();
                        $applicationList[] = $result;
                    }*/
                }
            }else{
                //if(empty($applicationList[$app->app_name])) {
                $appData = ApplicationData::where('application_id', $app->id)->where('version', '=', $app->data->version)->first();
                $result = $appData->application->byVersion($app->id, $appData->version)->first();
                    $applicationList[] = $result;
                //}
            }
        }

        return $applicationList;
    }

    public static function buySoftware(User $user, $softwareID, $version, $variantID){
        $modQuery = Application::where('id', $softwareID)->first();
        $handler = new ModuleHandler();
        $software = $handler->getApplication($softwareID, $user->userID, true, $version);

        if($user->economy->getBalance() >= $software->price){
            $user->economy->removeMoney($software->price);

            $ownerCheck = UserApp::ownedBy($user->userID)->where('application_id', $softwareID)->first();
            if($ownerCheck) {
                if (strcmp(strtolower($modQuery->app_name), strtolower($software->name)) == 0) {
                    $oldApp = UserApp::ownedBy($user->userID)->where('application_id', $software->moduleID)->first();
                    $oldApp->delete();
                }
            }



            $newApp = new UserApp();
            $newApp->fill([
                'user_id' => $user->userID,
                'application_id' => $software->moduleID,
                'installed' => 0,
                'application_datas_id' => $variantID
            ]);

            $newApp->save();

            return true;

        }

        return false;
    }
}
