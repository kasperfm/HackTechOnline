<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Validator;
use App\Models\Invite;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        $this->registerPolicies();

        //
    }

    private function validateInviteKey($inviteKey)
    {
        if(Invite::where('key', $inviteKey)->available()->first()){
            return true;
        }else{
            return false;
        }
    }
}
