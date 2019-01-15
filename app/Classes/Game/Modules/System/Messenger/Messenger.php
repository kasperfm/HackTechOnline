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
        $chatBackendPort = config('hacktech.messenger.port');
        $username = Auth::user()->username;
        $cssPath = '/modules/css/';
        $jsPath = '/modules/js/';

        $view = view('Modules::System.Messenger.Views.index',
            [
                'chatBackendPort' => $chatBackendPort,
                'username' => $username,
                'cssPath' => $cssPath,
                'jsPath' => $jsPath
            ]
        );

        return $view->render();
    }
}