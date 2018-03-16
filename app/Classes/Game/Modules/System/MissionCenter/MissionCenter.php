<?php

namespace App\Classes\Game\Modules\System\MissionCenter;

use App\Classes\Game\Handlers\UserHandler;
use App\Classes\Game\Module;
use App\Models\Corporation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MissionCenter extends Module
{
    public function setup(){
        $this->name = "missioncenter";
        $this->title = "MissionCenter";

        $this->size = array(
            "width"     => 550,
            "height"    => 550
        );
    }

    public function returnHTML()
    {
        $cssPath = '/modules/css/';
        $jsPath = '/modules/js/';

        $corporations = Corporation::whereNull('owner_user_id')->orderBy('name')->get();

        $view = view('Modules::System.MissionCenter.Views.index',
            [
                'cssPath' => $cssPath,
                'jsPath' => $jsPath,
                'corporations' => $corporations
            ]
        );

        return $view->render();
    }
}