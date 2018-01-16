<?php

namespace App\Classes\Game\Modules\System\Messenger;

use App\Classes\Game\Handlers\UserHandler;
use App\Classes\Game\Module;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Messenger extends Module
{
    public function setup(){
        $this->name = "messenger";
        $this->title = "Messenger";

        $this->size = array(
            "width"     => 550,
            "height"    => 450
        );
    }

    public function returnHTML()
    {
        $username = UserHandler::getUser(Auth::id())->model->username;
        $cssPath = '/modules/css/';
        $jsPath = '/modules/js/';
        $view = view('modules.system.messenger.views.index',
            [
                'username' => $username,
                'cssPath' => $cssPath,
                'jsPath' => $jsPath
            ]
        );

        return $view->render();
    }
}