<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Classes\Game\ModuleHandler;

class GameController extends Controller
{
    use AuthenticatesUsers;

    public function __construct(){
        $this->middleware('authed');
    }

    public function login(Request $request){
        return view('auth.login');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function game(Request $request){
        $runningApps = array();
        $request->session()->put('runningApps', $runningApps);
        $request->session()->put('cpuUsage', 0);
        $request->session()->put('ramUsage', 0);

        $moduleHandler = new ModuleHandler();
        $installedApps = $moduleHandler->getInstalledApps(Auth::id());

        return view('index', compact(['installedApps']));
    }

    public function index(Request $request){
        if(Auth::check()) {
            return $this->game($request);
        }else{
            return $this->login($request);
        }
    }
}
