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
            $userAppCheck = UserApp::byVersion($app->data(false)->version)->ownedBy($userID)->first();

            if($userAppCheck){
                if($userAppCheck->application->app_name == $app->app_name) {
               //     continue;
                }

                $appData = ApplicationData::where('application_id', $userAppCheck->application_id)->where('version', '>', $userAppCheck->version)->get();
                if($appData){
                    foreach ($appData as $finalApp){
                        $result = $finalApp->application->byVersion($userAppCheck->application_id, $finalApp->version)->first();
                        $applicationList[] = $result;
                    }
                }
            }else{
                if(empty($applicationList[$app->app_name])) {
                    $applicationList[] = $app;
                }
            }
        }


        return $applicationList;
    }

    public static function buySoftware(User $user, $softwareID, $version){
        $modQuery = Application::where('id', $softwareID)->first();
        $handler = new ModuleHandler();
        $software = $handler->getApplication($softwareID, $user->userID, true, $version);

        if($user->economy->getBalance() >= $software->price){
            $user->economy->removeMoney($software->price);

            if($handler->userOwnsApp($softwareID, $user->userID) == false) {
                if($modQuery->app_name == $software->name){
                    $oldApp = UserApp::ownedBy($user->userID)->where('application_id')->first();
                    $oldApp->delete();
                }

                $newApp = new UserApp();
                $newApp->fill([
                    'user_id' => $user->userID,
                    'application_id' => $software->moduleID,
                    'installed' => 0
                ]);

                $newApp->save();

                return true;
            }
        }

        return false;
    }
}
