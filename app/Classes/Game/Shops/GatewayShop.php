<?php

/**
 * App\Classes\Game\Shops\GatewayShop
 *
 * @package HackTech Online
 * @author Kasper F. Mikkelsen
 * @copyright 2017
 * @version 1.0
 * @access public
 */

namespace App\Classes\Game\Shops;

use App\Classes\Game\Gateway;
use App\Classes\Game\Hardware;
use App\Classes\Game\Types\HardwareTypes;
use App\Classes\Game\User;
use App\Models\GatewayHardware;

class GatewayShop {

    public static function buyGatewayPart(User $user, $partID){
        $gateway = $user->gateway;
        $hardware = new Hardware($partID, HardwareTypes::Gateway);

        if($user->economy->getBalance() >= $hardware->hardwareData['price']){
            $user->economy->removeMoney($hardware->hardwareData['price']);
            $gateway->setHardwarePart(HardwareTypes::Gateway, $partID);
            $gatewayModel = $gateway->saveHardware();

            activity('gateway')
                ->performedOn($gatewayModel)
                ->withProperties([
                    'hardware_id' => $hardware->hardwareID,
                    'hardware_type' => $hardware->getHardwareTypeString()
                ])
                ->causedBy($user->model)
                ->log('Upgraded gateway hardware');

            return true;
        }else{
            return false;
        }
    }

    public static function getPartList(User $user, $type){
        $machine = $user->gateway;

        $hwArray = array_values($machine->hardware);
        $currentHW = $hwArray[(int)$type];
        $dbResults = GatewayHardware::where('type', (int)$type)->where('id', '>', $currentHW->hardwareID)->get();

        if(!empty($dbResults)){
            $result = array();
            foreach($dbResults as $entity){
                $hardware = new Hardware($entity['id'], HardwareTypes::Gateway);

                if($hardware->hardwareData['price'] != 0){
                    $item['id'] = $hardware->hardwareID;
                    $item['price'] = $hardware->hardwareData['price'];
                    $item['value'] = $hardware->hardwareData['value'];
                    $item['name'] = $hardware->hardwareData['name'];
                    $item['valueType'] = $hardware->valueType;

                    $result[] = $item;
                }
            }

            return $result;
        }

        return false; // This should never happen...
    }
}