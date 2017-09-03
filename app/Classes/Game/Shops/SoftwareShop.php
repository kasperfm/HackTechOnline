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
            if(!empty($userAppCheck)){
                if($userAppCheck->application->data->version >= $app->data->version) {
                    continue;
                }
            }

            $applicationList[] = $app;
        }

        return $applicationList;
    }

    public static function buySoftware(User $user, $softwareID){
        $modQuery = Application::where('id', $softwareID)->first();
        $handler = new ModuleHandler();
        $software = $handler->getApplication($modQuery->app_name, $user->userID, true);

        if($user->economy->getBalance() >= $software->price){
            $user->economy->removeMoney($software->price);

            if($handler->userOwnsApp($softwareID, $user->userID) == false) {
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
