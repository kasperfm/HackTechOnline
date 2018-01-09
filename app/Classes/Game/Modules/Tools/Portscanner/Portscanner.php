<?php

namespace App\Classes\Game\Modules\Tools\Portscanner;

use App\Classes\Game\Module;
use App\Classes\Game\Handlers\ServerHandler;
use Illuminate\Http\Request;

class Portscanner extends Module
{
    public function setup()
    {
        $this->name = "portscanner";
        $this->title = "Portscanner";
        $this->group = "tools";
        $this->description = "Scan target systems for open ports.";

        $this->size = array(
            "width" => 420,
            "height" => 400
        );
    }

    public function getOpenPorts($target)
    {
        $server = ServerHandler::getServer($target);
        if(!$server){
            return null;
        }

        return $server->ports;
    }

    public function ajaxScan(Request $request)
    {
        $response = array();
        $response['answer'] = false;
        $response['scanresults'] = false;
        $address = $request->get('address');

        if(!empty($address)) {
            $server = ServerHandler::getServer($address);
            if($server){
                $response['answer'] = true;

                $ports = $server->ports;
                $portResults = array();

                if (!empty($ports)) {
                    foreach ($ports as $port) {
                        $entry['port'] = $port->portNumber;
                        $entry['name'] = $port->serviceName;

                        $portResults[] = $entry;
                    }

                    $response['scanresults'] = $portResults;
                }
            }
        }

        return $response;
    }

    /*
    public function returnHTML()
    {
        $version = $this->version;
        $cssPath = '/modules/css/';
        $jsPath = '/modules/js/';

        $view = view('modules.tools.portscanner.views.index', compact('cssPath', 'jsPath', 'version'));

        return $view->render();
    }
    */
}