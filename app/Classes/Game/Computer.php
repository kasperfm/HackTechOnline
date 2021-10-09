<?php

/**
 * App\Classes\Game\Computer
 *
 * @package HackTech Online
 * @author Kasper F. Mikkelsen
 * @copyright 2019
 * @version 1.0
 * @access public
 */

namespace App\Classes\Game;

use App\Models\Port;
use App\Models\Host;
use Illuminate\Support\Facades\Auth;

class Computer {
    public $ipAddress = null;
    public $ownerID = 0;
    public $hostID = 0;
    public $online = true;
    public $ports = array();

    public $hardware = array(
        "net" => null,
        "cpu" => null,
        "ram" => null,
        "hdd" => null
    );

    public function getOpenPorts(){
        $allPorts = Port::attachedTo($this->hostID)->active()->get();

        $this->ports = array();
        foreach($allPorts as $port){
            $this->ports[] = new Service($port->service_id, $this->ipAddress, $port->open_port);
        }
    }

    public function addService($serviceID, $port){
        $portQuery = Port::attachedTo($this->hostID)->withService($serviceID)->first();
        if(!empty($portQuery)){
            $portQuery->active = 1;
            $portQuery->open_port = $port;
            $portQuery->save();
        }else{
            $newPort = new Port();
            $newPort->host_id = $this->hostID;
            $newPort->service_id = $serviceID;
            $newPort->open_port = $port;
            $newPort->active = 1;
            $newPort->save();
        }

        $this->getOpenPorts();
    }

    public function getService($port){
        if($this->getOnlineState() == true){    
            foreach ($this->ports as $service) {
                if($service->portNumber == $port){
                    return $service;
                }
            }
        }

        return false;
    }

    public function setHardwarePart($machineType, $hwID){
        $part = new Hardware($hwID, $machineType);

        switch($part->partType){
            case 0:
                $this->hardware['net'] = $part;
                break;

            case 1:
                $this->hardware['cpu'] = $part;
                break;

            case 2:
                $this->hardware['ram'] = $part;
                break;

            case 3:
                $this->hardware['hdd'] = $part;
                break;

            default:
                return false;
        }

        return true;
    }

    public function getIPAddress(){
        if($this->hostID != 0){
            $host = Host::where('id', $this->hostID)->firstOrFail();
            return $host->game_ip;
        }

        return null;
    }
    
    public function getOnlineState(){
        if($this->hostID != 0){
            $query = Host::where('id', $this->hostID)->first();
            return boolval($query->online_state);
        }

        return false;
    }

    public function setOnlineState($newState){
        $host = Host::where('id', $this->hostID)->first();

        $host->online_state = (int)$newState;
        $host->save();

        $this->online = $newState;

        activity('system')
            ->performedOn($host)
            ->causedBy(Auth::user() ? Auth::user() : null)
            ->withProperties([
                'host_id' => $this->hostID,
                'ip' => $host->game_ip,
                'state' => (int)$newState
            ])
            ->log('Changed machine online state');
    }
}
