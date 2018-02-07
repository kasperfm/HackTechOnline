<?php

namespace App\Classes\Game\Handlers;

use App\Classes\Game\User;
use App\Classes\Game\Corporation;
use App\Models\Corporation as Model;

class CorpHandler
{
    public function getCorporation($corpID){
        $corp = Corporation::where('id', $corpID)->first();

        if(!$corp){
            return null;
        }

        return $corp;
    }
}
