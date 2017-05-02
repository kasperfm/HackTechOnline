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
            $this->model = Model::where('user_id', $this->ownerID)->get();

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

    public function saveHardware(){
        $this->model->cpu_id = $this->hardware['cpu']->hardwareID;
        $this->model->ram_id = $this->hardware['ram']->hardwareID;
        $this->model->hdd_id = $this->hardware['hdd']->hardwareID;
        $this->model->inet_id = $this->hardware['net']->hardwareID;
        $this->model->save();
    }
}
