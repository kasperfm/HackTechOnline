<?php

    function admLogin($request){
        $response['answer'] = false;

        if(!empty($request['username']) && !empty($request['password'])){
            if($request['username'] == "gottfried-adm" && $request['password'] == "gg7320vb38f"){
                session_start();
                $_SESSION['ingame_www']['admin.germail.com_authed'] = true;
                $response['answer'] = true;
            }
        }

        die(json_encode($response));
    }

    function admDownload($request){
        $response['answer'] = false;

        $server = \App\Classes\Game\Handlers\ServerHandler::getServer('germail.com');
        $file = \App\Classes\Game\Handlers\FileHandler::findFileOnServer('omnimail.conf', $server->hostID);

        if($file){
            if(\App\Classes\Game\Handlers\FileHandler::downloadFile($file->data->id, \Illuminate\Support\Facades\Auth::id())) {
                $response['filename'] = $file->data->filename;
                $response['answer'] = true;
            }
        }

        die(json_encode($response));
    }