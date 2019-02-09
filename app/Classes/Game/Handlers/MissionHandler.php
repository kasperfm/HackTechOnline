<?php

namespace App\Classes\Game\Handlers;

use App\Classes\Game\User;
use App\Classes\Game\Corporation;
use App\Classes\Game\Mission;
use App\Models\UserMission;
use App\Models\Mission as MissionModel;

class MissionHandler
{
    /**
     * Return a mission object.
     * @param $id
     * @param null $userID
     * @return Mission
     */
    public static function getMission($id, $userID = null)
    {
        $mission = MissionModel::where('id', $id)->first();
        if(empty($mission)){
            return null;
        }
        $user = UserHandler::getUser($userID);
        $missionObj = new Mission($mission, $user);

        return $missionObj;
    }

    /**
     * Get all available missions from a corp for the given user.
     * @param $userID
     * @param $corpID
     * @return array
     */
    public static function getAvailableMissions($userID, $corpID)
    {
        $userTrust = UserHandler::getUser($userID)->getCorpTrust($corpID);
        $missionList = array();

        $missions = MissionModel::where('corp_id', $corpID)
            ->where('minimum_trust', '<=', !is_null($userTrust) ? $userTrust : 0)
            ->where('hidden', 0)
            ->whereNotIn('id', function($query) use ($userID){
                $query->select('mission_id')->from('user_missions')->where('user_id', $userID)->whereNull('deleted_at')->get();
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

    /**
     * Get current mission for the user.
     * @param $userID
     * @return Mission|null
     */
    public static function getCurrentMission($userID)
    {
        $mission = UserMission::where('user_id', $userID)->where('done', 0)->first();

        if($mission){
            return self::getMission($mission->mission_id, $userID);
        }

        return null;
    }

    /**
     * Check objective for a mission.
     * @param $userID
     * @param $actionType
     * @param $actionValue
     * @return bool
     */
    public static function checkObjective($userID, $actionType, $actionValue)
    {
        $currentMission = self::getCurrentMission($userID);
        if($currentMission){
            if($currentMission->model->type == $actionType && $currentMission->model->objective == $actionValue){
                return $currentMission->complete();
			}
        }

        return false;
    }

    /**
     * UNUSED FUNCTION!
     * @param $userID
     * @param $action
     * @param $value
     * @return string
     */
    public static function generateActionToken($userID, $action, $value)
    {
        return sha1("y0u" . $userID . "cant" . $value . "touch" . $action . "th!s");
    }
}
