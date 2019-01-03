<?php

namespace App\Listeners;

use App\Events\MissionEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Classes\Game\Handlers\ServerHandler;
use App\Classes\Game\Handlers\MissionHandler;
use Illuminate\Support\Facades\Auth;

class MissionEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MissionEvent  $event
     * @return mixed
     */
    public function handle(MissionEvent $event)
    {
        return $this->checkMissionEvent($event);
    }

    private function checkMissionEvent(MissionEvent $event)
    {
        $action = $event->action;
        $value = $event->parameters;

        $missionCompleted = false;
        $missionParam = null;
        $notification = array(
            'title' => null,
            'message' => null
        );

        $currentMission = MissionHandler::getCurrentMission(Auth::id());

        if($currentMission) {
            //if($token == MissionHandler::generateActionToken(Auth::id(), $action, $value)){
            switch ($action) {
                case 'test':
                    if ($value == "kasper") {
                        $notification['title'] = "Kasper er gud!";
                        $missionCompleted = true;
                    }
                    break;

                case 'visit':
                    $missionParam = $value;
                    $notification['title'] = 'Website visited';
                    // Visit website
                    break;

                case 'get':
                    // Download file
                    $splitValue = explode(' ', $value);
                    $missionParam = "get " . $splitValue[0] . " from " . ServerHandler::hostnameToIP($splitValue[1]);

                    // $missionCompleted = true;
                    //$jsonResponse['title'] = "Download completed!";
                    break;

                case 'renewip':
                    // Renew IP
                    //$missionCompleted = true;
                    $jsonResponse['title'] = "Gateway IP has been changed !";
                    break;

                case 'submit':
                    // Submit data to website
                    //$missionCompleted = true;
                    $jsonResponse['title'] = "Thank you for your submission.";
                    break;

                default:
                    break;
            }

            if ($missionCompleted || $currentMission->checkObjective($action, $missionParam)) {
                broadcast(new \App\Events\Notification($notification['title'], $currentMission->completeMessage));

                return true;
            }
        }

        return false;
        //}
    }
}
