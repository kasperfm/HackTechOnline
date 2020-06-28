<?php

/**
 * App\Classes\Game\Service
 *
 * @package HackTech Online
 * @author Kasper F. Mikkelsen
 * @copyright 2019
 * @version 1.0
 * @access public
 */

namespace App\Classes\Game;

use App\Models\Service as Model;
use App\Models\Port;
use App\Classes\Game\Handlers\ServerHandler;

class Service {
    public $portNumber = 0;
    public $ipAddress = null;
    public $serviceName = null;
    public $serviceDescription = null;
    public $serviceID = 0;
    private $handler = null;

    public function __construct($id, $port = 0, $ip){
        $service = Model::where('id', $id)->first();

        if(empty($service)){
            return false;
        }

        if($port != 0){
            $this->portNumber = (int)$port;
        }else{
            $this->portNumber = $service->default_port;
        }

        $this->ipAddress = $ip;
        $this->serviceID = (int)$id;
        $this->serviceName = $service->name;
        $this->serviceDescription = $service->description;

        $this->setHandler();
    }

    public function getHandler(){
        if(!empty($this->handler)){
            return $this->handler;
        }else{
            return false;
        }
    }

    private function setHandler(){
        $class = 'App\Classes\Game\Services\\'. $this->serviceName;
        $result = new $class($this->ipAddress);

        $this->handler = $result;
    }

    public function remove(){
        $server = ServerHandler::getServer($this->ipAddress);
        if(!empty($server)){
            $port = Port::attachedTo($server->hostID)->withService($this->serviceID)->first();
            if(!empty($port)){
                $port->active = 0;
                $port->save();

                return true;
            }
        }

        return false;
    }


}
