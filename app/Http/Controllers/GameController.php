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
        if(Auth::check()) {
            redirect('/login');
        }else{
            return view('auth.login');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function index(Request $request){
        if(Auth::check() || Auth::viaRemember()) {
            $runningApps = array();
            $request->session()->put('runningApps', $runningApps);
            $request->session()->put('cpuUsage', 0);
            $request->session()->put('ramUsage', 0);

            return view('index');
        }else{
            return redirect('/login');
        }
    }
}
