<?php

namespace App\Classes\Game;

use App\Models\User as Model;

class User
{
    public $userID;
    public $model;
    public $economy;

    public function __construct(Model $user){
        $this->userID = $user->id;
        $this->model = $user;
        $this->economy = new Economy($user);
    }
}