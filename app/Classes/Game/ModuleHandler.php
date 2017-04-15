<?php

namespace App\Classes\Game;

use App\Classes\Game\Modules;
use App\Models\Application;
use App\Models\UserApp;
use App\Models\ApplicationData;


class ModuleHandler
{
    public function getApplication($name){
        $app = Application::where('app_name', $name)->first();

        if($app->isEmpty == false){
            $class = '\App\Classes\Game\Modules\\' . $app->group->name . '\\' . $name . '\\' . $name;

            $module = new $class($app);
            $module->setup();
            return $module;
        }
    }

    public function getInstalledApps($userID){
        $apps = UserApp::ownedBy($userID)->installed()->get();

        return $apps;
    }
}