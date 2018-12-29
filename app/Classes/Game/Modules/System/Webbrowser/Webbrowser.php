<?php

namespace App\Classes\Game\Modules\System\Webbrowser;

use App\Classes\Game\Module;
use App\Classes\Game\Handlers\ServerHandler;
use Illuminate\Http\Request;
use App\Events\MissionEvent;

class Webbrowser extends Module
{
    public function setup()
    {
        $this->name = "webbrowser";
        $this->title = "Webbrowser";

        $this->size = array(
            "width"     => 660,
            "height"    => 600
        );
    }

    public function ajaxNavigate(Request $request)
    {
        $response = array();
        $response['answer'] = false;
        $address = $request->get('address');

        if(!empty($address)){
            // Clean address.
            $address = str_replace('http://', '', $address);
            $address = str_replace('https://', '', $address);
            $address = str_replace('www.', '', $address);

            $explodedAddress = explode('/', $address);
            $server = ServerHandler::getServer($explodedAddress[0]);

            if(!empty($server)){
                $service = $server->getService(80);
                if(!empty($service) && $server->getOnlineState() == true){
                    event(new MissionEvent('visit', $server->hostname));

                    $response['webcontent'] = $service->getHandler()->handle(isset($explodedAddress[1]) ? $explodedAddress[1] : null);
                    $response['answer'] = true;
                }
            }
        }

        return $response;
    }
}