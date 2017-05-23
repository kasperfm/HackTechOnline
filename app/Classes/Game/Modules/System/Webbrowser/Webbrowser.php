<?php

namespace App\Classes\Game\Modules\System\Webbrowser;

use App\Classes\Game\Module;

class Webbrowser extends Module
{
    public function setup(){
        $this->name = "webbrowser";
        $this->title = "Webbrowser";

        $this->size = array(
            "width"     => 660,
            "height"    => 600
        );
    }
}