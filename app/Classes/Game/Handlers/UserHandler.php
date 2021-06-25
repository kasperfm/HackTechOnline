<?php

namespace App\Classes\Game\Handlers;

use App\Models\User as Model;
use App\Classes\Game\User;

class UserHandler
{
    /**
     * @param $userID
     * @param $forceRefresh
     * @return User|null
     */
    public static function getUser($userID, $forceRefresh = false)
    {
        if(session()->exists('player') && session()->get('player')->userID == $userID && $forceRefresh == false){
            return session()->get('player');
        }

        $model = Model::where('id', $userID)->first();
        if(!empty($model)){
            return new User($model);
        }

        return null;
    }

    /**
     * @return User
     */
    public static function player()
    {
        if(!session()->exists('player')) {
            return null;
        }

        return session()->get('player');
    }
}