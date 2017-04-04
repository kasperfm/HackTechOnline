<?php

namespace App\Classes\Game;

use app\Classes\Game\Requirements;

class Module
{
    public $moduleID;
    public $name;
    public $title;
    public $description;
    public $group;
    public $version;
    public $price;

    public $requirements;

    public $size = array(
        "width"     => 250,
        "height"    => 250
    );
}