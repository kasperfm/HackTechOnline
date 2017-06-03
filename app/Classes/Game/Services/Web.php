<?php

namespace App\Classes\Game\Services;

use Illuminate\Support\Facades\View;

class Web {
    private $hostIpAddress;
    private $wwwDirectory;

    public function __construct($ip){
        $this->hostIpAddress = $ip;
        $filePathIP = str_replace(".", "_", $ip);
        $this->wwwDirectory = 'hosts/' . $filePathIP . '/web/';
    }

    public function handle($input = null){
        if(empty($input)){
            return $this->getFile('index.page');
        }else{
            return $this->getFile($input);
        }
    }

    private function getFile($file){
        if ($file == "index.page"){
            $filepath = $this->wwwDirectory . "www";
        } else {
            $filepath = $this->wwwDirectory . urlencode($file);
        }

        if (View::exists($filepath)) {
            return view($filepath)->render();
        } else {
            return false;
        }
    }
}