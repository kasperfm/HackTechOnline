<?php

namespace App\Classes\Game\Modules\System\MyGateway;

use App\Classes\Game\Module;
use App\Classes\Game\Handlers\UserHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classes\Game\Shops\GatewayShop;

class MyGateway extends Module
{
    public function setup()
    {
        $this->name = "mygateway";
        $this->title = "My Gateway";

        $this->size = array(
            "width"     => 525,
            "height"    => 510
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

        $view = view('modules.mygateway.index', compact('cssPath', 'jsPath', 'currentCPU', 'currentHDD', 'currentNET', 'currentRAM'));
        return $view->render();
    }

    public function ajaxOverview(Request $request){
        $result = array(
            'answer' => true,
            'view' => $this->returnHTML()
        );

        return $result;
    }

    public function ajaxItem(Request $request)
    {
        $user = UserHandler::getUser(Auth::id());
        $myGateway = $user->gateway;
        $currentPart = $myGateway->hardware[$request->partType];
        $upgradeList = GatewayShop::getPartList($user, $currentPart->partType);
        $partType = $request->partType;
        $renderedView = view('modules.mygateway.item', compact('currentPart', 'partType', 'upgradeList'))->render();

        $result = array(
            'answer' => true,
            'view' => $renderedView
        );

        return $result;
    }

    public function ajaxBuy(Request $request)
    {
        $user = UserHandler::getUser(Auth::id());
        $buyResult = GatewayShop::buyGatewayPart($user, $request->hardwareid);

        $result = array(
            'answer' => true,
            'purchase' => $buyResult
        );

        return $result;
    }
}