<?php

namespace App\Classes\Game\Handlers;

use App\Models\Server;
use App\Models\Host;

use App\Classes\Helpers\NetworkHelper;

class ServerHandler
{
    public static function newServer($ownerID, $rootPassword){
        $newServer = new Server();
        $serverData = array(
            'user_id'   => $ownerID,
            'host_id'   => 0,
            'cpu_id'    => 2,
            'ram_id'    => 3,
            'hdd_id'    => 4,
            'inet_id'   => 1,
            'root_password' => !empty($rootPassword) ? bcrypt($rootPassword) : null
        );

        $newServer->fill($serverData);
        $newServer->save();

        $newHost = new Host();
        $newHost->online_state = 1;
        $newHost->game_ip = NetworkHelper::generateIP();
        $newHost->host_type = 1;
        $newHost->machine_id = $newServer->id;
        $newHost->save();

        $newServer->host_id = $newHost->id;
        $newServer->save();

        return $newServer;
    }
}
