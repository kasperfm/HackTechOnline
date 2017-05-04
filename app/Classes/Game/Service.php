<?php

namespace App\Classes\Game;

use App\Models\Service as Model;
use App\Models\Port;

class Service {
    public $portNumber = 0;
    public $ipAddress = null;
    public $serviceName = null;
    public $serviceDescription = null;
    private $handler = null;
    private $serviceID = 0;

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

        $this->SetHandler();
    }

    public function GetHandler(){
        if(!empty($this->handler)){
            return $this->handler;
        }else{
            return false;
        }
    }

    public function SetHandler(){
        $class = 'App\Classes\Game\Services\\'. $this->serviceName;
        $result = new $class($this->ipAddress);

        $this->handler = $result;
    }

    /*public function Remove(){
        $server = App\NetHandler::getInstance()->GetServer($this->ipAddress, false);
        if(!empty($server)){
            $GLOBALS["DB"]->update("ports", array("active" => 0), array("fk_host_id" => $server->hostID, "fk_service_id" => $this->serviceID));

            return true;
        }

        return false;
    }
    */

}
