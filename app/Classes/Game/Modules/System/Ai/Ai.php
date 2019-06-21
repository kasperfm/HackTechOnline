<?php

namespace App\Classes\Game\Modules\System\Ai;

use App\Classes\Game\Module;

class Ai extends Module
{
    public function setup(){
        $this->name = "Ai";
        $this->title = "AI";

        $this->size = array(
            "width"     => 255,
            "height"    => 460
        );
    }
}