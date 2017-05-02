<?php

namespace App\Classes\Helpers;

use App\Models\Host;

class NetworkHelper
{
    public static function generateIP(){
        $randomIP = long2ip( mt_rand(0, 65537) * mt_rand(0, 65535) );
        $hostLookup = Host::where('game_ip', $randomIP)->first();

        if(empty($hostLookup)){
            return $randomIP;
        }else{
            self::generateIP();
        }
    }

    public static function isValidIP($ip){
        $ip = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
        if ($ip !== false){
            return true;
        }else{
            return false;
        }
    }
}