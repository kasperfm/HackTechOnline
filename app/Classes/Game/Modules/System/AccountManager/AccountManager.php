<?php

namespace App\Classes\Game\Modules\System\AccountManager;

use App\Classes\Game\Handlers\UserHandler;
use App\Classes\Game\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountManager extends Module
{
    public function setup(){
        $this->name = "AccountManager";
        $this->title = "Manage Your Game Account";

        $this->size = array(
            "width"     => 720,
            "height"    => 405
        );
    }

    public function ajaxDeleteaccount(Request $request)
    {
        $user = UserHandler::getUser(Auth::id());

        if($user && $request->has('accept') && $request->has('password')) {
            if(Auth::validate([
                'email' => auth()->user()->email,
                'password' => $request->get('password')
                ])
            ) {
                $user->deleteUserData(true);
                session()->flush();

                return ['result' => true];
            }
        }

        return ['result' => false];
    }
}
