<?php

namespace App\Classes\Game\Modules\System\About;

use App\Classes\Game\Module;

class About extends Module
{
    public function setup(){
        $this->name = "About";
        $this->title = "About";

        $this->size = array(
            "width"     => 445,
            "height"    => 140
        );
    }
}