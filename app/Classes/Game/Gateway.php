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
use App\Events\HandleApp;
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

    private function getModel()
    {
        return Model::where('user_id', $this->ownerID)->firstOrFail();
    }

    private function getUserGateway(){
        if($this->ownerID != 0){
            $model = $this->getModel();

            if(!empty($model)){
                $this->hostID = $model->host_id;

                $this->setHardwarePart(HardwareTypes::Gateway, $model->cpu->id);
                $this->setHardwarePart(HardwareTypes::Gateway, $model->ram->id);
                $this->setHardwarePart(HardwareTypes::Gateway, $model->hdd->id);
                $this->setHardwarePart(HardwareTypes::Gateway, $model->inet->id);

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
        $model = $this->getModel();
        $model->cpu_id = $this->hardware['cpu']->hardwareID;
        $model->ram_id = $this->hardware['ram']->hardwareID;
        $model->hdd_id = $this->hardware['hdd']->hardwareID;
        $model->inet_id = $this->hardware['net']->hardwareID;
        $model->save();
        return $model;
    }

    public function installApplication($appID){
        $application = UserApp::where('user_id', $this->ownerID)->where('application_id', $appID)->first();

        if($this->enoughFreeDiskSpace($application->data->hdd_req)){
            $application->installed = 1;
            $application->save();

            activity('gateway')
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

        event(new HandleApp($application->app->app_name, 'close'));

        activity('gateway')
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

            currentPlayer()->gateway->ipAddress = $host->game_ip;

            activity('gateway')
                ->causedBy($this->ownerID)
                ->performedOn($host)
                ->log('Renewed gateway IP (' . $host->game_ip . ')');
        }

        return $change;
    }
}
