<?php

/**
 * App\Classes\Game\Mission
 *
 * @package HackTech Online
 * @author Kasper F. Mikkelsen
 * @copyright 2018
 * @version 1.0
 * @access public
 */

namespace App\Classes\Game;

use App\Models\Mission as MissionModel;
use App\Models\User as UserModel;
use App\Models\MissionData;
use App\Models\UserMission;
use App\Classes\Game\Handlers\MissionHandler;
use App\Classes\Game\Handlers\CorpHandler;

class Mission
{
    private $model;
    private $user;

    public function __construct(MissionModel $mission, User $user)
    {
        $this->model = $mission;
        if($user){
            $this->user = $user;
        }
    }

    public function complete()
    {
        if($this->user){
            $userMission = UserMission::where('user_id', $this->user->userID)->where('done', 0)->first();
            if($userMission){            
                $userMission->done = 1;
                $userMission->save();

                $corp = CorpHandler::getCorporation($userMission->mission->corporation->id);
                $corp->addTrust($this->user->userID, $this->model->reward_trust);
                $this->user->economy->addMoney($this->model->reward_credits);

                return true;
            }
        }

        return false;
    }

    public function abort()
    {
        if($this->user){
            $mission = UserMission::where('user_id', $this->user->userID)->where('done', 0)->first();
            $mission->delete();

            return true;
        }

        return false;
    }

    public function checkObjective($actionType, $actionValue)
    {
        return MissionHandler::checkObjective($this->user->userID, $actionType, $actionValue);
    }
}
