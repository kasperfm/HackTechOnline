<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Services\SocialAuthService;

class SocialAuthController extends Controller
{
    public function redirect()
    {
        if (!config('services.facebook.enabled', false)) {
            return null;
        }

        return Socialite::driver('facebook')->redirect();
    }

    public function callback(SocialAuthService $service)
    {
        if (!config('services.facebook.enabled', false)) {
            return null;
        }

        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());

        if(!$user){
            abort(404);
        }

        auth()->login($user);

        return redirect()->to('/game');
    }

    public function showInviteRegisterForm()
    {
        return view('auth.socialauth');
    }

    public function register(Request $request)
    {
        if(!$request->has('invite')) {
            abort(404, 'Invite key not found !');
        }

        \Session::put('invite_key', $request->get('invite'));


        return $this->redirect();
    }
}