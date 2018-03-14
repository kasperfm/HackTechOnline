<?php

namespace App\Http\Controllers;

use App\Classes\Game\Handlers\ServerHandler;
use App\Classes\Game\Mission;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classes\Game\Handlers\MissionHandler;

class MissionController extends Controller
{
    public function getDynamicJS(Request $request)
    {
        $mission = MissionHandler::getCurrentMission(Auth::id());

        if(!$mission){
            return response('function execEvent(event, param){}', 200, ["content-type: application/x-javascript"]);
        }

        $response = 'function execEvent(event, param){switch(event){';
        foreach($mission->getEvents() as $item){
            $response .= $this->generateEvent($item->event_type, $this->encodeData($item->event_param), $item->event_action);
        }
        $response .= ' default: break; }}';

        return response($response, 200, ["content-type: application/x-javascript"]);
    }

    public function checkMissionEvent(Request $request)
    {
        $action = $request->get('action');
        $value = $request->get('value');
        $token = $request->get('token');

        $missionCompleted = false;
        $missionParam = null;
        $jsonResponse = array(
            'completed' => false,
            'title' => null,
            'message' => null
        );

        if($token == MissionHandler::generateActionToken(Auth::id(), $action, $value)){
            $currentMission = MissionHandler::getCurrentMission(Auth::id());

            switch ($action){
                case 'get':
                    // Download file
                    $splitValue = explode(' ', $value);
                    $missionParam = "get ".$splitValue[0]." from " . ServerHandler::IPToHostname($splitValue[1]);
                    // $missionCompleted = true;
                    // $jsonResponse['title'] = "Download completed!";
                    break;

                case 'renewip':
                    // Renew IP
                    // $missionCompleted = true;
                    // $jsonResponse['title'] = "Gateway IP has been changed !";
                    break;

                case 'submit':
                    // Submit data to website
                    // $missionCompleted = true;
                    // $jsonResponse['title'] = "Thank you for your submission.";
                    break;

                default:
                    break;
            }

            if($missionCompleted && $currentMission->checkObjective($action, $missionParam)) {
                $jsonResponse['message'] = $currentMission->completeMessage;
                $jsonResponse['completed'] = true;
            }
        }

        return response()->json($jsonResponse);
    }

    private function generateEvent($evType, $evParam, $evAction)
    {
        $result = "case '".$evType."':
			if(param == unescape('".$evParam."')){
				".$evAction.";
			}
		break;";

        return $result;
    }

    private function encodeData($input)
    {
        $temp = '';
        $length = strlen($input);

        for($i = 0; $i < $length; $i++) {
            $temp .= '%' . bin2hex($input[$i]);
        }

        return $temp;
    }
}
