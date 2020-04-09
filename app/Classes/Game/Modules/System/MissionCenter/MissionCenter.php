<?php

namespace App\Classes\Game\Modules\System\MissionCenter;

use App\Classes\Game\Handlers\MissionHandler;
use App\Classes\Game\Handlers\CorpHandler;
use App\Classes\Game\Handlers\UserHandler;
use App\Classes\Game\Mission;
use App\Classes\Game\Module;
use App\Classes\Game\Reward;
use App\Models\Corporation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MissionCenter extends Module
{
    public function setup(){
        $this->name = "MissionCenter";
        $this->title = "Contracts";

        $this->size = array(
            "width"     => 550,
            "height"    => 550
        );
    }

    public function returnHTML()
    {
        $cssPath = '/modules/css/';
        $jsPath = '/modules/js/';

        $corporations = Corporation::whereNull('owner_user_id')->orderBy('name')->get();
        $currentMission = MissionHandler::getCurrentMission(Auth::id());

        $view = view('Modules::System.MissionCenter.Views.index',
            [
                'cssPath' => $cssPath,
                'jsPath' => $jsPath,
                'corporations' => $corporations,
                'currentMission' => $currentMission
            ]
        );

        return $view->render();
    }

    public function ajaxAcceptMission(Request $request)
    {
        $mission = MissionHandler::getMission($request->missionId, Auth::id());
        if(empty($mission)){
            return null;
        }

        $response['result'] = $mission->accept();
        $response['title'] = $mission->title;

        return $response;
    }

    public function ajaxAbortMission(Request $request)
    {
        $mission = MissionHandler::getCurrentMission(Auth::id());
        if(!$mission){
            return null;
        }

        return $mission->abort();
    }

    public function ajaxGetCorporationInfo(Request $request)
    {
        if(empty($request->corpId)){
            return null;
        }

        $corporation = CorpHandler::getCorporation($request->corpId);
        if(!empty($corporation)){
            $data['name'] = $corporation->name;
            $data['description'] = $corporation->description;

            return $data;
        }
    }

    public function ajaxGetMissionList(Request $request)
    {
        $response['result'] = false;

        if(empty($request->get('corpId'))){
            return $response;
        }

        $availableMissions = MissionHandler::getAvailableMissions(Auth::id(), $request->get('corpId'));

        if(count($availableMissions) > 0) {
            $missionList = array();
            foreach ($availableMissions as $mission) {
                $item['id'] = $mission->id;
                $item['title'] = $mission->title;

                $missionList[] = $item;
            }

            $response['missions'] = $missionList;
            $response['result'] = true;
        }

        return $response;
    }

    public function ajaxGetMissionInfo(Request $request)
    {
        if(empty($request->missionId)){
           return null;
        }

        $mission = MissionHandler::getCurrentMission(Auth::id());
        $response['current'] = true;

        if(!$mission){
            $mission = MissionHandler::getMission($request->missionId, Auth::id());
            $response['current'] = false;
        }

        $rewardItem = null;

        if($mission->rewardItem){
            $rewardItem = new Reward($mission->rewardItem);
        }

        $response['title'] = $mission->title;
        $response['description'] = $mission->description;
        $response['reward_trust'] = $mission->rewardTrust;
        $response['reward_credits'] = $mission->rewardCredits;
        $response['reward_item'] =  $rewardItem ? [
            'type' => $rewardItem->type,
            'name' => $rewardItem->title,
            'dropchance' => $rewardItem->dropChance
        ] : null;
        $response['corp_name'] = $mission->corporation->name;

        return $response;
    }
}