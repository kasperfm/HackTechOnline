<?php

namespace App\Classes\Game\Modules\System\SoftwareMarket;

use App\Classes\Game\Handlers\ModuleHandler;
use App\Classes\Game\Module;
use App\Classes\Game\Shops\SoftwareShop;
use App\Classes\Game\Handlers\UserHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoftwareMarket extends Module
{
    public function setup(){
        $this->name = "softwaremarket";
        $this->title = "Software Market";

        $this->size = array(
            "width"     => 455,
            "height"    => 600
        );
    }

    public function returnHTML()
    {
        $softwareList = SoftwareShop::getMarketApps(Auth::id());
        $cssPath = '/modules/css/';
        $jsPath = '/modules/js/';

        $view = view('Modules::System.SoftwareMarket.Views.index', compact('cssPath', 'jsPath', 'softwareList'));

        return $view->render();
    }

    public function ajaxOverview(Request $request)
    {
        $result = array(
            'answer' => true,
            'view' => $this->returnHTML()
        );

        return $result;
    }

    public function ajaxBuy(Request $request)
    {
        $user = UserHandler::getUser(Auth::id());
        $buyResult = SoftwareShop::buySoftware($user, $request->appId, $request->appVersion);

        $result = array(
            'answer' => true,
            'purchase' => $buyResult
        );

        return $result;
    }

    public function ajaxItem(Request $request)
    {
        $moduleHandler = new ModuleHandler();
        $software = $moduleHandler->getApplication($request->appName, Auth::id(), false, $request->appVersion);
        $renderedView = view('Modules::System.SoftwareMarket.Views.item', compact('software'))->render();

        $result = array(
            'answer' => true,
            'view' => $renderedView
        );

        return $result;
    }
}