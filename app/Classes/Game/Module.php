<?php

namespace App\Classes\Game;

use app\Classes\Game\Requirements;

class Module
{
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

    public function returnHTML(){
        $view = view('modules.' . $this->name . '.index');
        return $view->render();
    }
}