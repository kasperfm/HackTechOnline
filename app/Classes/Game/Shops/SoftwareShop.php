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

use App\Classes\Game\Gateway;
use App\Classes\Game\User;
use App\Models\Application;
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
}
