<?php

namespace App\Classes\Game\Modules\System\SoftwareMarket;

use App\Classes\Game\Module;

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
}