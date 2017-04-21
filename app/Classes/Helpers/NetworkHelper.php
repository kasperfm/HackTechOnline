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
}