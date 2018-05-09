<?php
    function terminal($request){
        if (isset($request['command']) && \Illuminate\Support\Facades\Auth::check()) {
            switch ($request['command']){
                case 'help':
                    echo 'List of public available commands:' . PHP_EOL;
                    echo '----------------------------------' . PHP_EOL;
                    echo 'help               = Show this message.' . PHP_EOL;
                    echo 'ls                 = Show contents of the current server directory.' . PHP_EOL;
                    echo 'download FILE      = Download a file to your machine.' . PHP_EOL;
                    echo 'whoami             = Show the current logged in user.' . PHP_EOL;
                    echo 'sysinfo            = Get info about the server.' . PHP_EOL;
                    break;

                case 'ls':
                case 'dir':
                    echo 'Contents of directory: /srv/pub' . PHP_EOL;
                    echo '-> blue_pill.bin' . PHP_EOL;
                    echo '-> red_pill.bin' . PHP_EOL;
                    echo '-> readme.txt' . PHP_EOL;
                    break;

                case 'download blue_pill.bin':
                    echo 'Error: Download of "blue_pill.bin" failed!';
                    break;

                case 'download readme.txt':
                    echo 'Error: "readme.txt" is an empty file!';
                    break;

                case 'download red_pill.bin':
                    $server = App\Classes\Game\Handlers\ServerHandler::getServer('31.113.213.227');
                    $file = App\Classes\Game\Handlers\FileHandler::findFileOnServer('red_pill.bin', $server->hostID);
                    if($file){
                        App\Classes\Game\Handlers\FileHandler::downloadFile($file->data->id, \Illuminate\Support\Facades\Auth::id());
                        echo 'The file "red_pill.bin" was downloaded with success!';
                    }else{
                        echo 'INTERNAL GAME ERROR: Please report this bug to the game admin!';
                    }

                    break;

                case 'whoami':
                    echo 'Logged in as user: www-public';
                    break;

                case 'sysinfo':
                    echo 'Hostname      psybytes.org' . PHP_EOL;
                    echo 'IP address    31.113.213.227' . PHP_EOL;
                    echo 'Server OS     MatrixOS 4.2' . PHP_EOL;
                    echo 'CPU Model     PollyTris 380 (2.5 GHz)' . PHP_EOL;
                    echo 'Memory        K2 memory (2 x 4096 MB)';
                    break;

                default:
                    echo 'Unknown command or filename...';
                    break;
            }
        }
    }

