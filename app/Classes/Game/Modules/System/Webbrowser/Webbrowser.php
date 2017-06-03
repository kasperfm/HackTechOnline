<?php

namespace App\Classes\Game\Modules\System\Webbrowser;

use App\Classes\Game\Module;
use App\Classes\Game\Handlers\ServerHandler;
use Illuminate\Http\Request;

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
            $explodedAddress = explode('/', $address);
            $server = ServerHandler::getServer($explodedAddress[0]);

            if(!empty($server)){
                $service = $server->getService(80);
                if(!empty($service) && $server->getOnlineState() == true){
                    $response['webcontent'] = $service->getHandler()->handle(isset($explodedAddress[1]) ? $explodedAddress[1] : null);
                    $response['answer'] = true;
                }
            }
        }

        return $response;
    }
}