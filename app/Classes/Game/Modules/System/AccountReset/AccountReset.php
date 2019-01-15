<?php

namespace App\Classes\Game\Modules\System\AccountReset;

use App\Classes\Game\Handlers\UserHandler;
use App\Classes\Game\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountReset extends Module
{
    public function setup(){
        $this->name = "accountreset";
        $this->title = "Reset Account";

        $this->size = array(
            "width"     => 500,
            "height"    => 380
        );
    }

    public function ajaxSubmit(Request $request)
    {
        $user = UserHandler::getUser(Auth::id());

        if($request->has('accept')) {
            $user->resetAccount();
        }
    }
}
