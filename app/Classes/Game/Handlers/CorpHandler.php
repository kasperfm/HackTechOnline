<?php

namespace App\Classes\Game\Handlers;

use App\Classes\Game\User;
use App\Classes\Game\Corporation;
use App\Models\Mission;
use App\Models\Corporation as CorpModel;

class CorpHandler
{
    /**
     * Get a corporation object by ID.
     * @param $corpID
     * @return Corporation|null
     */
    public static function getCorporation($corpID)
    {
        if(!$corpID){
            return null;
        }

        $corpModel = CorpModel::where('id', $corpID)->first();

        if(!$corpModel){
            return null;
        }

        $corp = new Corporation($corpModel);
        return $corp;
    }

    /**
     * Create a new corporation.
     * @param $name
     * @param $description
     * @param null $owner
     * @return CorpModel
     */
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

    /**
     * Get a corporation object by corp name.
     * @param $corpName
     * @return Corporation|null
     */
    public static function getCorporationByName($corpName)
    {
        if(!$corpName){
            return null;
        }

        $corpModel = CorpModel::where('name', $corpName)->first();

        if(!$corpModel){
            return null;
        }

        $corp = new Corporation($corpModel);
        return $corp;
    }
}
