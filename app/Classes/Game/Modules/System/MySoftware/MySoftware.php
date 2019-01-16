<?php

namespace App\Classes\Game\Modules\System\MySoftware;

use App\Classes\Game\Module;
use App\Classes\Game\Handlers\UserHandler;
use App\Classes\Game\Handlers\ModuleHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MySoftware extends Module
{
    public function setup()
    {
        $this->name = "MySoftware";
        $this->title = "My Software";

        $this->size = array(
            "width"     => 450,
            "height"    => 500
        );
    }

    public function returnHTML()
    {
        $cssPath = '/modules/css/';
        $jsPath = '/modules/js/';

        $moduleHandler = new ModuleHandler();

        $softwareList = $moduleHandler->getOwnedApps(Auth::id());

        $view = view('Modules::System.MySoftware.Views.index', compact('cssPath', 'jsPath', 'softwareList'));
        return $view->render();
    }

    public function ajaxRefresh(Request $request){
        return $this->returnHTML();
    }

    public function ajaxInstall(Request $request)
    {
        $gateway = UserHandler::getUser(Auth::id())->gateway;
        $moduleHandler = new ModuleHandler();
        $installResult = false;

        if($moduleHandler->userOwnsApp($request->get('softwareId'), Auth::id())){
            $gateway->installApplication($request->get('softwareId'));
            $installResult = true;
        }

        $result = array(
            'answer' => $installResult
        );

        return $result;
    }

    public function ajaxRemove(Request $request)
    {
        $gateway = UserHandler::getUser(Auth::id())->gateway;
        $moduleHandler = new ModuleHandler();
        $installResult = false;

        if($moduleHandler->userOwnsApp($request->get('softwareId'), Auth::id())){
            $gateway->uninstallApplication($request->get('softwareId'));
            $installResult = true;
        }

        $result = array(
            'answer' => $installResult
        );

        return $result;
    }
}
