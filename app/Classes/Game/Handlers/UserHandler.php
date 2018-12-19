<?php

namespace App\Classes\Game\Handlers;

use App\Models\User as Model;
use App\Classes\Game\User;

class UserHandler
{
    public static function getUser($userID)
    {
        if(session()->exists('player') && session()->get('player')->userID == $userID){
            return session()->get('player');
        }

        $model = Model::where('id', $userID)->first();
        if(!empty($model)){
            return new User($model);
        }else{
            return null;
        }
    }

    public static function player()
    {
        return session()->get('player');
    }
}