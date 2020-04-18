<?php

/**
 * App\Classes\Game\Mission
 *
 * @package HackTech Online
 * @author Kasper F. Mikkelsen
 * @copyright 2019
 * @version 1.0
 * @access public
 */

namespace App\Classes\Game;

use App\Classes\Game\Types\RewardItemTypes;
use App\Events\HandleApp;
use App\Models\Mission as MissionModel;
use App\Models\User as UserModel;
use App\Models\MissionData;
use App\Models\UserMission;
use App\Classes\Game\Handlers\MissionHandler;
use App\Classes\Game\Handlers\CorpHandler;

class Mission
{
    public $missionID;
    public $title;
    public $description;
    public $completeMessage;
    public $completed = false;
    public $rewardTrust;
    public $rewardCredits;
    public $rewardItem;
    public $corporation;

    public $model;
    private $user;

    public function __construct(MissionModel $mission, User $user)
    {
        $this->model = $mission;
        if($user){
            $this->user = $user;

            $userMission = UserMission::where('user_id', $user->userID)->first();
            if($userMission){
                $this->completed = boolval($userMission->done);
            }
        }

        $this->missionID = $mission->id;
        $this->title = $mission->title;
        $this->description = $mission->description;
        $this->completeMessage = $mission->complete_message;
        $this->rewardTrust = $mission->reward_trust;
        $this->rewardCredits = $mission->reward_credits;
        $this->rewardItem = $mission->reward_item_id;
        $this->corporation = CorpHandler::getCorporation($mission->corporation->id);
    }

    public function accept()
    {
        if($this->user && !MissionHandler::getCurrentMission($this->user->userID)){
            $mission = UserMission::firstOrCreate([
                'user_id' => $this->user->userID,
                'mission_id' => $this->missionID,
                'done' => 0
            ]);

            $this->model->callAdvancedClass('accept');

            activity('game')
                ->performedOn($mission)
                ->withProperties(['mission_id' => $mission->mission_id])
                ->causedBy($this->user->model)
                ->log('Contract accepted');

            return true;
        }

        return false;
    }

    public function complete()
    {
        if($this->user){
            $userMission = UserMission::where('user_id', $this->user->userID)->where('done', 0)->first();
            if($userMission){            
                $userMission->done = 1;
                $userMission->save();

                $this->completed = true;

                $corp = CorpHandler::getCorporation($userMission->mission->corporation->id);

                activity('game')
                    ->performedOn($userMission)
                    ->withProperties(['mission_id' => $userMission->mission_id])
                    ->causedBy($this->user->model)
                    ->log('Contract completed');

                $this->model->callAdvancedClass('complete');

                $corp->addTrust($this->user->userID, $this->model->reward_trust);
                $this->user->economy->addMoney($this->model->reward_credits);

                if($this->rewardItem){
                    $item = new Reward($this->rewardItem);
                    if($item->isDropped()){
                        $item->rewardPlayerWithItem($this->user->userID);

                        if($item->typeID == RewardItemTypes::Application) {
                            event(new HandleApp('MySoftware', 'refresh'));
                        }
                    }
                }

                event(new HandleApp('MissionCenter', 'refresh'));

                return true;
            }
        }

        return false;
    }

    public function abort()
    {
        if($this->user){
            $mission = UserMission::where('user_id', $this->user->userID)->where('done', 0)->first();
            $this->model->callAdvancedClass('abort');
            activity('game')->performedOn($mission)->withProperties(['mission_id' => $mission->mission_id])->causedBy($this->user->model)->log('Contract cancelled');
            $mission->delete();

            return true;
        }

        return false;
    }

    public function checkObjective($actionType, $actionValue)
    {
        return MissionHandler::checkObjective($this->user->userID, $actionType, $actionValue);
    }

    public function getEvents()
    {
        $events = MissionData::where('mission_id', $this->missionID)->orderBy('id')->get();
        return $events;
    }
}
