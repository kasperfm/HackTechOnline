<?php

namespace App\Classes\Game\Modules\Tools\IpRenewer;

use App\Classes\Game\Module;
use App\Classes\Game\Handlers\UserHandler;
use App\Events\MissionEvent;
use Illuminate\Http\Request;

class IpRenewer extends Module
{
    public function setup()
    {
        $this->name = "iprenewer";
        $this->title = "IP Renewer";
        $this->group = "tools";
        $this->description = "Renew your gateway's IP address.";

        $this->size = array(
            "width" => 330,
            "height" => 240
        );
    }

    public function ajaxRenew(Request $request)
    {
        $ipChangeTimeout = 180;
        $response = array();
        $response['answer'] = false;

        if(UserHandler::player()->gateway->renewIPAddress($ipChangeTimeout)){
            event(new MissionEvent('renewip', null));
            $response['answer'] = true;
        }

        return $response;
    }
}