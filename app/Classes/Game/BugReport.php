<?php

namespace App\Classes\Game;

use App\Models\Bug;
use App\Models\BugCategory;
use App\Models\User;

class BugReport
{
    public $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    
}
