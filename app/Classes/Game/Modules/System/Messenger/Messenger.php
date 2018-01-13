<?php

namespace App\Classes\Game\Modules\System\Messenger;

use App\Classes\Game\Module;
use App\Models\User;

class Messenger extends Module
{
    public function setup(){
        $this->name = "messenger";
        $this->title = "Messenger";

        $this->size = array(
            "width"     => 545,
            "height"    => 500
        );
    }

    public function returnHTML()
    {
        $view = view('modules.system.messenger.views.index', []);

        return $view->render();
    }
}