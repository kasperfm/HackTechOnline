<?php

namespace App\Classes\Game\Missions;

class AdvancedMissionBase
{
    public $user;

    public function __construct()
    {
        $this->user = currentPlayer();
    }
}
