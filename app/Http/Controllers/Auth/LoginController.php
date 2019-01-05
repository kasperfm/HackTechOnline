<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserLogin;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     */
    protected function redirectTo()
    {
        $this->logUserLogin(Auth::user(), $_SERVER['REMOTE_ADDR']);
        return '/game';
    }

    private function logUserLogin($user, $ipAddress){
        $userLoginEntry = new UserLogin();
        $userLoginEntry->user_id = $user->id;
        $userLoginEntry->last_date = date("Y-m-d H:i:s", time());
        $userLoginEntry->last_ip = $ipAddress;
        $userLoginEntry->save();

        activity('auth')
            ->causedBy($user)
            ->log(Auth::user()->username . ' logged in');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        if ( ! User::where('email', $request->email)->first() ) {
            return redirect()->back()
                ->withInput($request->only($this->username()))
                ->withErrors([
                    $this->username() => "Invalid email",
                ]);
        }

        if ( ! User::where('email', $request->email)->where('password', bcrypt($request->password))->first() ) {
            return redirect()->back()
                ->withInput($request->only($this->username()))
                ->withErrors([
                    'password' => "Wrong password",
                ]);
        }

    }
}
