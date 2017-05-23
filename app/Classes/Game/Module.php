<?php

namespace App\Classes\Game;

use App\Models\Application;
use Illuminate\View\View;

class Module
{
    public $appModel;

    public $moduleID;
    public $name;
    public $title = "Unknown application";
    public $description;
    public $group;
    public $version;
    public $price;

    public $requirements;

    public $size = array(
        "width"     => 250,
        "height"    => 250
    );

    public function __construct(Application $application){
        $this->appModel = $application;

        $this->requirements = new Requirements(
            $this->appModel->app_name,
            $this->appModel->data->cpu_req,
            $this->appModel->data->ram_req,
            $this->appModel->data->hdd_req
        );
    }

    public function returnHTML(){
        $cssPath = '/modules/css/';
        $jsPath = '/modules/js/';

        $view = view('modules.' . $this->name . '.index', compact('cssPath', 'jsPath'));
        return $view->render();
    }
}