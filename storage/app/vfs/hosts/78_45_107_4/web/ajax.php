<?php

use App\Events\MissionEvent;

function submit($request){
    $response['answer'] = false;

    if(!empty($request['token']) && !empty($request['password'])){
        if($request['token'] == 'shrooms4ever' && $request['password'] == '34hYp19kfmd'){
            event(new MissionEvent('submit', null));
            $response['answer'] = true;
        }
    }

    die(json_encode($response));
}