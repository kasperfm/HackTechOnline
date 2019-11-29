<?php

namespace App\Classes\Game\Handlers;

use App\Models\Server;
use App\Models\Host;
use App\Models\Hostname;

use App\Classes\Helpers\NetworkHelper;

class ServerHandler
{
    /**
     * Create a new server.
     * @param $ownerID
     * @param $rootPassword
     * @param null $ipAddress
     * @return Server|null
     */
    public static function newServer($ownerID, $rootPassword, $ipAddress = null)
    {
        if($ipAddress) {
            $ipCheck = Host::where('game_ip', $ipAddress)->first();
            if($ipCheck){
                return null;
            }
        }

        $newServer = new Server();
        $serverData = array(
            'user_id'   => $ownerID,
            'host_id'   => 0,
            'cpu_id'    => 2,
            'ram_id'    => 3,
            'hdd_id'    => 4,
            'inet_id'   => 1,
            'root_password' => !empty($rootPassword) ? sha1($rootPassword) : null
        );

        $newServer->fill($serverData);
        $newServer->save();

        $newHost = new Host();
        $newHost->online_state = 1;
        $newHost->game_ip = !empty($ipAddress) ? $ipAddress : NetworkHelper::generateIP();
        $newHost->host_type = 1;
        $newHost->machine_id = $newServer->id;
        $newHost->save();

        $newServer->host_id = $newHost->id;
        $newServer->save();

        return $newServer;
    }

    /**
     * Convert a hostname to an IP address.
     * @param $hostname
     * @return string|null
     */
    public static function hostnameToIP($hostname)
    {
        $hostname = Hostname::where('hostname', $hostname)->first();

        if(!empty($hostname)){
            return $hostname->host->game_ip;
        }

        return null;
    }

    /**
     * Convert an IP address to a hostname.
     * @param $ip
     * @return string|null
     */
    public static function IPToHostname($ip)
    {
        $host = Host::where('game_ip', $ip)->where('host_type', 1)->first();
        if($host) {
            $hostname = Hostname::where('host_id', $host->machine_id)->first();
            if($hostname){
                return $hostname->hostname;
            }
        }

        return null;
    }

    /**
     * Find a server from an IP address or hostname.
     * @param $lookup
     * @return \App\Classes\Game\Server|null
     */
    public static function getServer($lookup)
    {
        if(!empty($lookup)){
            $target = null;

            if(NetworkHelper::isValidIP($lookup)){
                $target = $lookup;
            }else{
                $target = self::hostnameToIP($lookup);
            }

            if(!empty($target)){
                $host = Host::where('game_ip', $target)->server()->first();
                if(!empty($host)){
                    return new \App\Classes\Game\Server($host->id);
                }else {
                    return null;
                }
            }
        }
    }

    /**
     * Find a server from the internal ID.
     * @param $hostID
     * @return \App\Classes\Game\Server|null
     */
    public static function getServerByID($hostID)
    {
        if(!empty($hostID)){
            $host = Host::where('id', $hostID)->server()->first();
            if(!empty($host)){
                return new \App\Classes\Game\Server($host->id);
            }
        }

        return null;
    }
}
