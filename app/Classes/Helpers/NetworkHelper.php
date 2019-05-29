<?php

namespace App\Classes\Helpers;

use App\Models\Host;

class NetworkHelper
{
    /**
     * Generate a new unused IP address.
     * @return string
     */
    public static function generateIP(){
        $randomIP = long2ip( mt_rand(0, 65537) * mt_rand(0, 65535) );
        $hostLookup = Host::where('game_ip', $randomIP)->first();

        if(empty($hostLookup) && !strpos($hostLookup, '0', 0)){
            return $randomIP;
        }else{
            self::generateIP();
        }
    }

    /**
     * Check if a string is a valid IP address.
     * @param $ip
     * @return bool
     */
    public static function isValidIP($ip){
        $ip = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
        if ($ip !== false){
            return true;
        }else{
            return false;
        }
    }
}