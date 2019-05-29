<?php

namespace App\Classes\Game\Modules\System\CorpStatus;

use App\Classes\Game\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CorpStatus extends Module
{
    public function setup(){
        $this->name = "CorpStatus";
        $this->title = "Corporation Status";

        $this->size = array(
            "width"     => 450,
            "height"    => 400
        );
    }

}
