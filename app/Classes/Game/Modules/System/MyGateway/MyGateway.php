<?php

namespace App\Classes\Game\Modules\System\MyGateway;

use App\Classes\Game\Module;
use App\Classes\Game\Handlers\UserHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyGateway extends Module
{
    public function setup()
    {
        $this->name = "mygateway";
        $this->title = "My Gateway";

        $this->size = array(
            "width"     => 400,
            "height"    => 530
        );
    }

    public function returnHTML()
    {
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

    public function ajaxItem(Request $request)
    {

        $myGateway = UserHandler::getUser(Auth::id())->gateway;
        $currentPart = $myGateway->hardware[$request->partType];
        $partType = $request->partType;
        $renderedView = view('modules.' . $this->name . '.item', compact('currentPart', 'partType'))->render();

        return response()->json([
            'answer' => true,
            'view' => $renderedView
        ]);
    }
}