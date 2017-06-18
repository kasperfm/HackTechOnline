<?php

/**
 * App\Classes\Game\Hardware
 *
 * @package HackTech Online
 * @author Kasper F. Mikkelsen
 * @copyright 2017
 * @version 1.0
 * @access public
 */

namespace App\Classes\Game;

use App\Classes\Game\Types\HardwareTypes;
use App\Models\GatewayHardware;
use App\Models\ServerHardware;

class Hardware {
    public $hardwareID = 0;
    public $machineType = 1; // 1: Server, 2: Gateway
    public $partType = -1;
    public $valueType = null;

    public $hardwareData = array(
        "id"            => 0,
        "targetMachine" => null,
        "type"          => 0,
        "name"          => null,
        "price"         => 0,
        "value"         => 0
    );

    public function __construct($partID, $machineType) {
        $this->hardwareID = (int)$partID;
        $this->targetMachine = (int)$machineType;

        $newData = $this->getPart($partID, $machineType);
        if(!empty($newData)){
            $this->partType = $newData["type"];
            $this->hardwareData = $newData;
        }
    }

    private function getPart($partID, $machineType){
        switch($machineType){
            case 1:
                $hardware = ServerHardware::where('id', $partID)->first();
                break;

            case 2:
                $hardware = GatewayHardware::where('id', $partID)->first();
                break;

            default:
                return false;
        }

        if(!empty($hardware)){
            $hwData = array();

            $hwData["id"]            = (int)$hardware->id;
            $hwData["targetMachine"] = HardwareTypes::$machines[$machineType];
            $hwData["type"]          = (int)$hardware->type;
            $hwData["name"]          = $hardware->part_name;
            $hwData["price"]         = (int)$hardware->price;
            $hwData["value"]         = (int)$hardware->value;

            $this->valueType = HardwareTypes::$values[(int)$hardware->type];

            return $hwData;
        }

        return false;
    }

    public function getHardwareTypeString(){
        if($this->partType < 0 || $this->partType > 3){
            return "Unknown";
        }else{
            return HardwareTypes::$types[$this->partType];
        }
    }
}

