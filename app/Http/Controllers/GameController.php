<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class GameController extends Controller
{
    use AuthenticatesUsers;

    public function __construct(){
        $this->middleware('auth');
    }

    public function login(){
        if(Auth::check() || Auth::viaRemember()) {
            return view('index');
        }else{
            return view('auth.login');
        }

    }

    public function logout(){
        Auth::logout();

        return redirect('/');
    }

    public function index(){
        if(Auth::check()) {
            return view('index');
        }else{
            return redirect('/');
        }
    }
}
