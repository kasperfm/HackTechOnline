<?php

namespace App\Classes\Game\Modules\Tools\Portscanner;

use App\Classes\Game\Module;
use App\Classes\Game\Handlers\ServerHandler;
use Illuminate\Http\Request;

class Portscanner extends Module
{
    public function setup()
    {
        $this->name = "portscanner";
        $this->title = "Portscanner";
        $this->description = "Scan your target system for open ports.";

        $this->size = array(
            "width" => 420,
            "height" => 400
        );
    }
}