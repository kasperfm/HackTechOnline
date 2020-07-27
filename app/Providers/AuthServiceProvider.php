<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Models\Invite;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use GuzzleHttp\Client;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('valid_invite', function($attribute, $value, $parameters, $validator) {
            if(!empty($value) && $this->validateInviteKey($value)){
                return true;
            }
            return false;
        });

        Validator::extend('recaptcha', function($attribute, $value, $parameters, $validator) {
            if(!empty($value) && $this->validateRecaptcha($value)){
                return true;
            }
            return false;
        });

        Validator::extend('preinvite_email', function($attribute, $value, $parameters, $validator) {
            if(!empty($value) && in_array($value, config('invites.emails'))){
                return true;
            }
            return false;
        });

        $this->registerPolicies();

        /* define a admin user role */
        Gate::define('isAdmin', function(User $user) {
            return $user->hasRole('admin');
        });

        /* define a manager user role */
        Gate::define('isCreator', function($user) {
            return $user->hasRole('creator');
        });
    }

    private function validateInviteKey($inviteKey)
    {
        if(Invite::where('key', $inviteKey)->available()->first()){
            return true;
        }else{
            return false;
        }
    }

    private function validateRecaptcha($recaptcha)
    {
        $client = new Client([
            'base_uri' => 'https://google.com/recaptcha/api/',
            'timeout' => 5.0
            ]);

        $response = $client->request('POST', 'siteverify', [
            'query' => [
                'secret' => config('app.recaptcha_secret'),
                'response' => $recaptcha
            ]
        ]);

        $answer = json_decode($response->getBody());

        if($response->getStatusCode() == "200" || $response->getStatusCode() == 200){
            if($answer->success == true){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}
