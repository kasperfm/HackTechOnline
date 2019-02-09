<?php

namespace App\Classes\Game\Services;

class Database {
    private $hostIpAddress;

    public function __construct($ip){
        $this->hostIpAddress = $ip;
    }

    public function handle($input = null){

    }
}