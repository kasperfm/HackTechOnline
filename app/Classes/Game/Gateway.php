<?php

/**
 * App\Classes\Game\Gateway
 *
 * @package HackTech Online
 * @author Kasper F. Mikkelsen
 * @copyright 2019
 * @version 1.0
 * @access public
 */

namespace App\Classes\Game;

use App\Classes\Game\Types\HardwareTypes;
use App\Classes\Helpers\NetworkHelper;
use App\Models\Host;
use App\Models\UserApp;
use App\Models\Gateway as Model;
use Carbon\Carbon;

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
        $allOwnedApps = UserApp::with('data')->ownedBy($this->ownerID)->installed()->get();

        $installedAppsUsage = 0;
        foreach($allOwnedApps as $application){
            $installedAppsUsage += $application->data->hdd_req;
        }

        return $installedAppsUsage;
    }

    private function enoughFreeDiskSpace($neededSpace){
        $totalSpace = $this->hardware['hdd']->hardwareData['value'];

        $allOwnedApps = UserApp::with('data')->ownedBy($this->ownerID)->installed()->get();

        $installedAppsUsage = 0;
        foreach($allOwnedApps as $application){
            $installedAppsUsage += $application->data->hdd_req;
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
        return $this->model;
    }

    public function installApplication($appID){
        $application = UserApp::where('user_id', $this->ownerID)->where('application_id', $appID)->first();

        if($this->enoughFreeDiskSpace($application->data->hdd_req)){
            $application->installed = 1;
            $application->save();

            activity('game')
                ->withProperties(['application_id' => $appID])
                ->causedBy($this->ownerID)
                ->performedOn($application)
                ->log('App ' . $application->app->app_name . ' installed');
        }
    }

    public function uninstallApplication($appID){
        $application = UserApp::where('user_id', $this->ownerID)->where('application_id', $appID)->first();
        $application->installed = 0;
        $application->save();

        activity('game')
            ->withProperties(['application_id' => $appID])
            ->causedBy($this->ownerID)
            ->performedOn($application)
            ->log('App ' . $application->app->app_name . ' removed');
    }

    public function renewIPAddress($timeoutCheckInMinutes = 180){
        $change = false;
        $host = Host::where('id', $this->hostID)->first();

        if(!$host){
            return false;
        }

        if(!$host->ip_changed_at){
            $change = true;
        }else{
            if(Carbon::now() > $host->ip_changed_at->addMinute($timeoutCheckInMinutes)){
                $change = true;
            }
        }

        if($change){
            $host->game_ip = NetworkHelper::generateIP();
            $host->ip_changed_at = Carbon::now();
            $host->save();

            activity('game')
                ->causedBy($this->ownerID)
                ->performedOn($host)
                ->log('Renewed gateway IP (' . $host->game_ip . ')');
        }

        return $change;
    }
}
