<?php

namespace App\Classes\Game\Handlers;

use App\Classes\Game\User;
use App\Classes\Game\Corporation;
use App\Classes\Game\Mission;
use App\Models\UserMission;
use App\Models\Mission as MissionModel;

class MissionHandler
{
    public static function getAvailableMissions($userID, $corpID)
    {
        $userTrust = UserHandler::getUser($userID)->getCorpTrust($corpID);
        $missionList = array();

        $missions = MissionModel::where('corp_id', $corpID)
            ->where('minimum_trust', $userTrust)
            ->where('hidden', 0)
            ->whereNotIn('id', function($query) use ($userID){
                $query->select('mission_id')->from('user_missions')->where('user_id', $userID)->get();
            })
            ->get();

        foreach ($missions as $m){
            $userMission = UserMission::where('user_id', $userID)->where('mission_id', $m->id)->where('done', 1)->first();
            if(!$userMission){
                if($m->chain_parent == 0) {
                    $missionList[] = $m;
                }
            }

            $parentCheck = UserMission::where('user_id', $userID)->where('mission_id', $m->chain_parent)->where('done', 1)->first();
            if($parentCheck) {
                $missionList[] = $m;
            }
        }

        return $missionList;
    }
}
