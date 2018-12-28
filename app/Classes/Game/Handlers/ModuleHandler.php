<?php

namespace App\Classes\Game\Handlers;

use App\Classes\Game\Modules;
use App\Models\Application;
use App\Models\UserApp;
use App\Models\ApplicationData;

class ModuleHandler
{
    public function getApplication($lookup, $userID, $force = false, $version = 0){
        $app = null;

        if(is_numeric($lookup)){
            if($version > 0){
                $app = Application::byVersion($lookup, $version)->first();
            }else{
                $app = Application::where('id', $lookup)->first();
            }
        }else{
            $appLookup = Application::where('app_name', $lookup)->first();

            if($appLookup) {
                if ($version > 0) {
                    $app = Application::byVersion($appLookup->id, $version)->first();
                } else {
                    $app = Application::where('id', $appLookup->id)->first();
                }
            }
        }

        if($app){
            if($app->group->name != "system" && $app->group->name != "demo" && $force == false){
                $owned = UserApp::where('application_id', $app->id)->ownedBy($userID)->installed()->get();
                if(empty($owned)){
                    return null;
                }
            }

            $class = '\App\Classes\Game\Modules\\' . ucfirst($app->group->name) . '\\' . ucfirst($app->app_name) . '\\' . $app->app_name;
            if(class_exists($class)){
                $module = new $class($app);
                $module->setup();
                return $module;
            }else{
                return null;
            }
        }
    }

    public function userOwnsApp($appID, $userID)
    {
        $appCheck = UserApp::ownedBy($userID)->where('application_id', $appID)->first();
        if($appCheck){
            return true;
        }else{
            return false;
        }
    }

    public function call($name, $userID, $action, $params, $type = 'ajax'){
        $app = Application::where('app_name', $name)->first();
        if($app->isEmpty == false) {
            if($app->group->name != "system" && $app->group->name != "demo"){
                $owned = UserApp::where('application_id', $app->id)->ownedBy($userID)->installed()->get();
                if(empty($owned)){
                    return null;
                }
            }

            $class = '\App\Classes\Game\Modules\\' . ucfirst($app->group->name) . '\\' . $name . '\\' . $name;
            if(class_exists($class)){
                $module = new $class($app);
                $response = $module->{$type . $action}($params);
                return $response;
            }
        }

        return null;
    }

    public function getInstalledApps($userID){
        $apps = UserApp::with('app')->ownedBy($userID)->installed()->get();
        return $apps;
    }

    public function getOwnedApps($userID){
        $apps = UserApp::ownedBy($userID)->get();
        $result = array();

        foreach ($apps as $app){
            $software = UserApp::ownedBy($userID)->currentVersionOf($app->application_id)->first();
            $entry['id'] = $software->application_id;
            $entry['name'] = $software->data->application->app_name;
            $entry['installed'] = $software->installed;
            $entry['version'] = $software->data->version;
            $entry['hdd_req'] = $software->data->hdd_req;
            $result[] = $entry;
        }

        return $result;
    }
}