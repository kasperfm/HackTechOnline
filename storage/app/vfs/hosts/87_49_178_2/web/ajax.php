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