<?php

/**
 * App\Classes\Game\Computer
 *
 * @package HackTech Online
 * @author Kasper F. Mikkelsen
 * @copyright 2017
 * @version 1.0
 * @access public
 */

namespace App\Classes\Game;

use App\Models\Port;
use App\Models\Host;

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
            $this->ports[] = new Service($port->service_id, $port->open_port, $this->ipAddress);
        }
    }

    public function addService($serviceID, $port){
        $portQuery = Port::attachedTo($this->hostID)->withService($serviceID)->first();
        //$checkQuery = $GLOBALS["DB"]->select("ports", array(), array("fk_host_id" => $this->hostID, "fk_service_id" => $serviceID))->result();
        if(!empty($portQuery)){
            $portQuery->active = 1;
            $portQuery->open_port = $port;
            $portQuery->save();
 //           $GLOBALS["DB"]->update("ports", array("open_port" => (int)$port, "active" => 1), array("fk_host_id" => $this->hostID, "fk_service_id" => $serviceID));
        }else{
            $newPort = new Port();
            $newPort->host_id = $this->hostID;
            $newPort->service_id = $serviceID;
            $newPort->open_port = $port;
            $newPort->active = 1;
            $newPort->save();
            //$GLOBALS["DB"]->insert("ports", array("fk_host_id" => $this->hostID, "fk_service_id" => $serviceID, "open_port" => $port, "active" => 1));
        }

        $this->GetOpenPorts();
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

    public function SetHardwarePart($machineType, $hwID){
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
    
    public function getOnlineState(){
        if($this->hostID != 0){
            $query = Host::where('id', $this->hostID)->first();
            return boolval($query->online_state);
        }
    }

    public function setOnlineState($newState){
        $host = Host::where('id', $this->hostID)->first();

        $host->online_state = (int)$newState;
        $host->save();
        $this->online = $newState;
    }
}
