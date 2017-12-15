<?php

namespace App\Classes\Game;

use App\Models\Application;
use App\Models\UserApp;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class Module
{
    public $appModel;

    public $moduleID;
    public $name;
    public $title = "Unknown application";
    public $description = "No description";
    public $group = 'system';
    public $version;
    public $price;

    public $requirements;

    public $size = array(
        "width"     => 250,
        "height"    => 250
    );

    public function __construct(Application $application){
        $this->appModel = $application;
        $this->moduleID = $application->id;
        $this->group = $application->group->name;

        if($this->group != 'demo' && $this->group != 'system'){
            $data = UserApp::ownedBy(Auth::id())->where('application_id', $this->moduleID)->first()->data;
        }else{
            $data = $application->getData(false);
        }

        $this->price = $data->price;
        $this->version = $data->version;

        $this->requirements = new Requirements(
            $this->appModel->app_name,
            $data->cpu_req,
            $data->ram_req,
            $data->hdd_req
        );
    }

    public function returnHTML(){
        $cssPath = '/modules/css/';
        $jsPath = '/modules/js/';

        $view = view('modules.' . $this->group . '.' . $this->name . '.views.index', compact('cssPath', 'jsPath'));
        return $view->render();
    }
}