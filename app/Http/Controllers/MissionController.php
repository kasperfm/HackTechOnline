<?php

namespace App\Http\Controllers;

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
