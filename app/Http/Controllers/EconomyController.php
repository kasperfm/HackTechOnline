<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class EconomyController extends Controller
{

    public function getCredits(){
        $response = array();
        $response['answer'] = false;

        if(Auth::check()) {
            $response['answer'] = true;

            //TODO: Get the real amount from economy table.
            $response['credits'] = 13370;
        }

        return json_encode($response);
    }
}
