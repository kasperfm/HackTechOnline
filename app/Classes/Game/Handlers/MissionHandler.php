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

    public static function cancelCurrentMission($userID)
    {
        $mission = UserMission::where('user_id', $userID)->where('done', 0)->first();
        $mission->delete();
    }

    public static function completeMission($userID)
    {
        $mission = UserMission::where('user_id', $userID)->where('done', 0)->first();
        $mission->done = 1;
        $mission->save();
    }

    public static function getCurrentMission($userID)
    {
        $mission = UserMission::where('user_id', $userID)->where('done', 0)->first();
        if($mission){
            return $mission->mission;
        }

        return null;
    }

    public static function checkObjective($userID, $actionType, $actionValue)
    {
        $currentMission = self::getCurrntMission($userID);
        if($currentMission){
            $corp = $currentMission->corporation;
            $user = UserHandler::getUser($userID);
            if($currentMission->type == $actionType && $currentMission->objective == $actionValue){
                $corp->addTrust($userID, $currentMission->reward_trust);
                $user->economy->addMoney($currentMission->reward_credits);

                return true;
			}
        }

        return false;
    }
}
