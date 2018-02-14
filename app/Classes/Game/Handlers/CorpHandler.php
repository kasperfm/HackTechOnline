<?php

namespace App\Classes\Game\Handlers;

use App\Classes\Game\User;
use App\Classes\Game\Corporation;
use App\Models\Corporation as CorpModel;

class CorpHandler
{
    public static function getCorporation($corpID)
    {
        $corpModel = CorpModel::where('id', $corpID)->first();

        if(!$corpModel){
            return null;
        }

        $corp = new Corporation($corpModel);
        return $corp;
    }

    public static function createCorporation($name, $description, $owner = null)
    {
        $newCorp = new CorpModel();
        $newCorp->name = $name;
        $newCorp->description = $description;
        $newCorp->status = 1;
        if($owner){
            $newCorp->owner_user_id = $owner;
            $newCorp->status = 2;
        }
        $newCorp->save();

        return $newCorp;
    }
}
