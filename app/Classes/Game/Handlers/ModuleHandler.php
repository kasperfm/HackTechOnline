<?php

namespace App\Classes\Game\Handlers;

use App\Classes\Game\Module;
use App\Classes\Game\Modules;
use App\Models\Application;
use App\Models\UserApp;
use App\Models\ApplicationData;

class ModuleHandler
{
    /**
     * Static function to return a new self instance.
     * @return ModuleHandler
     */
    public static function make()
    {
        return new ModuleHandler();
    }

    /**
     * Get an application module.
     * @param $lookup
     * @param $userID
     * @param bool $force
     * @param int $version
     * @return Module|null
     */
    public function getApplication($lookup, $userID, $force = false, $version = 0){
        $app = null;

        if(is_numeric($lookup) || is_float($lookup)){
            if($version > 0){
                $app = Application::byVersion($lookup, $version)->first();
            }else{
                $app = Application::where('id', $lookup)->first();
            }
        }else{
            $appLookup = Application::where('app_name', $lookup)->first();

            if($appLookup) {
                if ($version > 0) {
                    //$app = Application::byVersion($lookup, $version)->first(); // Old stuff
                    $app = Application::findSpecificVersion($appLookup->id, $version)->first();
                } else {
                    $app = Application::where('id', $appLookup->id)->first();
                }
            }
        }

        if($app){
            $appGroup = $app->group;

            if($appGroup->name != "system" && $appGroup->name != "demo" && $force == false){
                $owned = UserApp::where('application_id', $app->id)->ownedBy($userID)->installed()->get();
                if(empty($owned)){
                    return null;
                }
            }

            $class = '\App\Classes\Game\Modules\\' . ucfirst($appGroup->name) . '\\' . ucfirst($app->app_name) . '\\' . $app->app_name;
            if(class_exists($class)){
                $module = new $class($app);
                $module->setup();
                return $module;
            }else{
                return null;
            }
        }
    }

    /**
     * Check if an user own the app.
     * @param $appID
     * @param $userID
     * @return bool
     */
    public function userOwnsApp($appID, $userID)
    {
        $appCheck = UserApp::ownedBy($userID)->where('application_id', $appID)->first();
        if($appCheck){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Call an internal function from a module.
     * @param $name
     * @param $userID
     * @param $action
     * @param $params
     * @param string $type
     * @return null|mixed
     */
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

    /**
     * Get a list of installed apps.
     * @param $userID
     * @return mixed|UserApp
     */
    public function getInstalledApps($userID){
        $apps = UserApp::with('app')->ownedBy($userID)->installed()->get();
        return $apps;
    }

    /**
     * Get all apps the user owns.
     * @param $userID
     * @return array
     */
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