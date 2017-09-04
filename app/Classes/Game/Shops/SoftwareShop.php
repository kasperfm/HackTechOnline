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
                if($userAppCheck->application->app_name == $app->app_name) {
                    continue;
                }

                if ($userAppCheck->application->data->version >= $app->data->version) {
                    continue;
                }
            }

            if(empty($applicationList[$app->app_name])) {
                $applicationList[$app->app_name] = $app;
            }
        }


        return $applicationList;
    }

    public static function buySoftware(User $user, $softwareID){
        $modQuery = Application::where('id', $softwareID)->first();
        $handler = new ModuleHandler();
        $software = $handler->getApplication($softwareID, $user->userID, true);

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
