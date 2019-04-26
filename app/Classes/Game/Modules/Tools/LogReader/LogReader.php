<?php

namespace App\Classes\Game\Modules\Tools\LogReader;

use App\Classes\Game\Module;
use App\Classes\Game\Handlers\UserHandler;
use Illuminate\Http\Request;

class LogReader extends Module
{
    public function setup()
    {
        $this->name = "LogReader";
        $this->title = "Log Reader";
        $this->group = "tools";
        $this->description = "A tool for reading log files.";

        $this->size = array(
            "width" => 578,
            "height" => 500
        );
    }


}
