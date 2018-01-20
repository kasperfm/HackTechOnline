<?php

namespace App\Classes\Game\Modules\System\Mailbox;

use App\Classes\Game\Handlers\UserHandler;
use App\Classes\Game\Mailbox as UserMailbox;
use App\Models\Message;
use App\Classes\Game\Module;
use Illuminate\Support\Facades\Auth;

class Messenger extends Module
{
    public function setup(){
        $this->name = "mailbox";
        $this->title = "Mailbox";

        $this->size = array(
            "width"     => 600,
            "height"    => 520
        );
    }

    public function returnHTML()
    {
        $username = UserHandler::getUser(Auth::id())->model->username;
        $cssPath = '/modules/css/';
        $jsPath = '/modules/js/';
        $view = view('modules.system.mailbox.views.index',
            [
                'username' => $username,
                'cssPath' => $cssPath,
                'jsPath' => $jsPath
            ]
        );

        return $view->render();
    }
}