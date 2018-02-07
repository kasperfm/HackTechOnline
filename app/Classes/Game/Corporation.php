<?php

namespace App\Classes\Game;

use App\Models\Corporation as Model;
use App\Models\User;

class Corporation
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

}
