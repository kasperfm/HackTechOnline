<?php

namespace App\Classes\Game\Services;

class Web {
    private $hostIpAddress;
    private $wwwDirectory;

    public function __construct($ip){
        $this->hostIpAddress = $ip;
        $dirHash = md5($ip . '-hto_www');
        $this->wwwDirectory = '/vfs/http/' . $dirHash . '/';
    }

    public function Handle($input = "index.page"){
        return $this->GetFile($input);
    }

    private function GetFile($file){
        /*
        if($file == "index.page"){
            $filepath = $this->wwwDirectory . "www.php";
        }else{
            $filepath = $this->wwwDirectory . urlencode($file);
        }

        if(file_exists(BASE_DIR . $filepath)){
            return $filepath;
        }else{
            return false;
        }
        */

        return false;
    }
}