<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Classes\Game\Handlers\UserHandler;

class EconomyController extends Controller
{
    public function getCredits(){
        $response = array();
        $response['answer'] = false;

        if(Auth::check()) {
            $response['answer'] = true;

            $balance = UserHandler::getUser(Auth::user()->id)->economy->getBalance();
            $response['credits'] = $balance;
        }

        return json_encode($response);
    }
}
