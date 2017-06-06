<?php

namespace App\Classes\Game\Modules\System\MyGateway;

use App\Classes\Game\Module;
use App\Classes\Game\Handlers\UserHandler;
use Illuminate\Support\Facades\Auth;

class MyGateway extends Module
{
    public function setup(){
        $this->name = "mygateway";
        $this->title = "My Gateway";

        $this->size = array(
            "width"     => 400,
            "height"    => 530
        );
    }

    public function returnHTML(){
        $myGateway = UserHandler::getUser(Auth::id())->model->gateway()->first();
        $cssPath = '/modules/css/';
        $jsPath = '/modules/js/';
        $currentCPU = $myGateway->cpu()->first();
        $currentRAM = $myGateway->ram()->first();
        $currentHDD = $myGateway->hdd()->first();
        $currentNET = $myGateway->inet()->first();

        $view = view('modules.' . $this->name . '.index', compact('cssPath', 'jsPath', 'currentCPU', 'currentHDD', 'currentNET', 'currentRAM'));
        return $view->render();
    }
}