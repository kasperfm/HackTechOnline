<?php

namespace App\Services;

use App\Models\User;
use App\Models\SocialLogin;
use App\Models\UserLogin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAuthService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = SocialLogin::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            $userLoginEntry = new UserLogin();
            $userLoginEntry->user_id = $account->user->id;
            $userLoginEntry->last_date = date("Y-m-d H:i:s", time());
            $userLoginEntry->last_ip = request()->ip();
            $userLoginEntry->save();

            activity('auth')
                ->causedBy($account->user)
                ->log($account->user->username . ' logged in using Facebook');

            return $account->user;
        } else {

            $account = new SocialLogin([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'username' => $providerUser->getName(),
                    'password' => md5(rand(1, 9999)),
                    'verified' => 1,
                    'email_verified_at' => Carbon::now(),
                    'userlevel' => config('hacktech.default_user_type'),
                    'verification_token' => null
                ]);

                $user->fillUserProfile($user->id);
                $user->createNewGateway($user->id);
                $user->createNewBankAccount($user->id);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
}