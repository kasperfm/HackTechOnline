<?php

namespace App\Classes\Game;

use App\Models\User as Model;

class User
{
    public $userID;
    public $username;
    public $model;
    public $economy;
    public $gateway;
    public $mailbox;
    public $bugreporter;

    public function __construct(Model $user){
        $this->userID = $user->id;
        $this->username = $user->username;
        $this->model = $user;
        $this->economy = new Economy($user);
        $this->gateway = new Gateway($user->id);
        $this->mailbox = new Mailbox($user);
        $this->bugreporter = new BugReport($user);
    }
}