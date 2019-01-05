<?php

namespace App\Http\Controllers;

use App\Classes\Game\Handlers\UserHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Classes\Game\Handlers\ModuleHandler;

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
        activity('auth')->causedBy(Auth::user())->log(Auth::user()->username . ' logged out');

        Auth::logout();
        session()->flush();
        return redirect('/');
    }

    public function game(Request $request){
        $runningApps = array();
        $request->session()->put('runningApps', $runningApps);
        $request->session()->put('cpuUsage', 0);
        $request->session()->put('ramUsage', 0);
        $request->session()->put('hddUsage', 0);

        $moduleHandler = new ModuleHandler();
        $installedApps = $moduleHandler->getInstalledApps(Auth::id());

        if(!session()->exists('player') && Auth::check()) {
            session()->put('player', UserHandler::getUser(Auth::id()));
        }

        return view('index', ['installedApps' => $installedApps]);
    }

    public function index(Request $request){
        if(Auth::check()) {
            return $this->game($request);
        }else{
            return $this->login($request);
        }
    }

    public function ingameWebAjax(Request $request, $ip, $call){
        require storage_path('app/vfs/hosts/' . $ip . '/web/ajax.php');

        $call($request->all());
    }
}
