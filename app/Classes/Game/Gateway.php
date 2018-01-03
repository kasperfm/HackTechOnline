<?php

/**
 * App\Classes\Game\Gateway
 *
 * @package HackTech Online
 * @author Kasper F. Mikkelsen
 * @copyright 2017
 * @version 1.0
 * @access public
 */

namespace App\Classes\Game;

use App\Classes\Game\Types\HardwareTypes;
use App\Models\UserApp;
use App\Models\Gateway as Model;

class Gateway extends Computer {
    public function __construct($ownerID = 0) {
        if(!empty($ownerID)){
            $this->ownerID = $ownerID;
            $this->getUserGateway();
        }
    }

    private function getUserGateway(){
        if($this->ownerID != 0){
            $this->model = Model::where('user_id', $this->ownerID)->first();

            if(!empty($this->model)){
                $this->hostID = $this->model->host_id;

                $this->setHardwarePart(HardwareTypes::Gateway, $this->model->cpu->id);
                $this->setHardwarePart(HardwareTypes::Gateway, $this->model->ram->id);
                $this->setHardwarePart(HardwareTypes::Gateway, $this->model->hdd->id);
                $this->setHardwarePart(HardwareTypes::Gateway, $this->model->inet->id);

                $this->ipAddress = $this->getIPAddress();
                $this->online = (bool)$this->getOnlineState();
                return true;
            }
        }

        return false;
    }

    public function usedDiskSpace(){
        $allOwnedApps = UserApp::ownedBy($this->ownerID)->installed()->get();

        $installedAppsUsage = 0;
        foreach($allOwnedApps as $app){
            $installedAppsUsage += $app->data->hdd_req;
        }

        return $installedAppsUsage;
    }

    private function enoughFreeDiskSpace($neededSpace){
        $totalSpace = $this->hardware['hdd']->hardwareData['value'] * 1024;

        $allOwnedApps = UserApp::ownedBy($this->ownerID)->installed()->get();

        $installedAppsUsage = 0;
        foreach($allOwnedApps as $app){
            $installedAppsUsage += $app->data->hdd_req;
        }

        if($totalSpace >= ($installedAppsUsage + $neededSpace)){
            return true;
        }else{
            return false;
        }
    }

    public function saveHardware(){
        $this->model->cpu_id = $this->hardware['cpu']->hardwareID;
        $this->model->ram_id = $this->hardware['ram']->hardwareID;
        $this->model->hdd_id = $this->hardware['hdd']->hardwareID;
        $this->model->inet_id = $this->hardware['net']->hardwareID;
        $this->model->save();
    }

    public function installApplication($appID){
        $application = UserApp::where('user_id', $this->ownerID)->where('application_id', $appID)->first();

        if($this->enoughFreeDiskSpace($application->data->hdd_req)){
            $application->installed = 1;
            $application->save();
        }
    }

    public function uninstallApplication($appID){
        $application = UserApp::where('user_id', $this->ownerID)->where('application_id', $appID)->first();
        $application->installed = 0;
        $application->save();
    }
}
