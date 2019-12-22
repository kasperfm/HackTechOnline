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

    private function getModel()
    {
        return Model::where('host_id', $this->hostID)->firstOrFail();
    }

    /**
     * Return the server object.
     * @return bool
     */
    private function getServer(){
        if($this->hostID != 0){
            $model = $this->getModel();

            if(!empty($model)){
                $this->hostID = $model->host_id;

                $this->setHardwarePart(HardwareTypes::Server, $model->cpu->id);
                $this->setHardwarePart(HardwareTypes::Server, $model->ram->id);
                $this->setHardwarePart(HardwareTypes::Server, $model->hdd->id);
                $this->setHardwarePart(HardwareTypes::Server, $model->inet->id);

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
            $model = $this->getModel();
            $model->root_password = sha1($newPassword);
            $model->save();

            return true;
        }else{
            return false;
        }
    }

    public function checkRootPassword($password){
        if($this->hostID != 0 && !empty($password)){
            $validation = Model::where('host_id', $this->hostID)->where('root_password', sha1($password))->first();
            if($validation){
                return true;
            }
        }

        return false;
    }

    public function isPasswordProtected() {
        if($this->hostID != 0){
            $validation = Model::where('host_id', $this->hostID)->whereNotNull('root_password')->first();
            if($validation){
                return true;
            }
        }

        return false;
    }

    public function saveHardware(){
        $model = $this->getModel();
        $model->cpu_id = $this->hardware['cpu']->hardwareID;
        $model->ram_id = $this->hardware['ram']->hardwareID;
        $model->hdd_id = $this->hardware['hdd']->hardwareID;
        $model->inet_id = $this->hardware['net']->hardwareID;
        $model->save();
    }
}
