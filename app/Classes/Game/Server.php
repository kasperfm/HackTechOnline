<?php

/**
 * App\Classes\Game\Server
 *
 * @package HackTech Online
 * @author Kasper F. Mikkelsen
 * @copyright 2019
 * @version 1.0
 * @access public
 */

namespace App\Classes\Game;

use App\Classes\Game\Handlers\ServerHandler;
use App\Classes\Game\Types\HardwareTypes;
use App\Models\Server as Model;

class Server extends Computer {
    public $hostname;

    /**
     * Server constructor.
     * @param int $hostID
     */
    public function __construct($hostID = 0) {
        if(!empty($hostID)){
            $this->hostID = $hostID;
            $this->getServer();
        }
    }

    /**
     * Return the server object.
     * @return bool
     */
    private function getServer(){
        if($this->hostID != 0){
            $this->model = Model::where('host_id', $this->hostID)->first();

            if(!empty($this->model)){
                $this->hostID = $this->model->host_id;

                $this->setHardwarePart(HardwareTypes::Server, $this->model->cpu->id);
                $this->setHardwarePart(HardwareTypes::Server, $this->model->ram->id);
                $this->setHardwarePart(HardwareTypes::Server, $this->model->hdd->id);
                $this->setHardwarePart(HardwareTypes::Server, $this->model->inet->id);


                $this->ipAddress = $this->getIPAddress();
                $this->online = (bool)$this->getOnlineState();
                $this->hostname = ServerHandler::IPToHostname($this->ipAddress);
                $this->getOpenPorts();
                return true;
            }
        }

        return false;
    }

    public function setRootPassword($newPassword){
        if($this->hostID != 0 && !empty($newPassword)){
            $this->model->root_password = bcrypt($newPassword);
            $this->model->save();

            return true;
        }else{
            return false;
        }
    }

    public function checkRootPassword($password){
        if($this->hostID != 0 && !empty($password)){
            $validation = Model::where('host_id', $this->hostID)->where('root_password', bcrypt($password))->first();
            if(!empty($validation)){
                return true;
            }
        }

        return false;
    }

    public function saveHardware(){
        $this->model->cpu_id = $this->hardware['cpu']->hardwareID;
        $this->model->ram_id = $this->hardware['ram']->hardwareID;
        $this->model->hdd_id = $this->hardware['hdd']->hardwareID;
        $this->model->inet_id = $this->hardware['net']->hardwareID;
        $this->model->save();
    }
}
