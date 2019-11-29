<?php

namespace App\Classes\Game\Services;

use App\Classes\Game\File;
use App\Classes\Game\Handlers\FileHandler;
use App\Classes\Game\Handlers\ServerHandler;
use Illuminate\Support\Facades\Auth;

class FTP {
    private $hostIpAddress;
    private $host;
    private $providedPassword;

    public function __construct($ip){
        $this->hostIpAddress = $ip;
    }

    public function handle($input = null){
        $this->host = ServerHandler::getServer($this->hostIpAddress);

        if (is_array($input) && FileHandler::fileExists($input['fileId'], $this->host->hostID)) {
            $this->providedPassword = $input['password'] ?? null;
            $file = FileHandler::getFile($input['fileId']);

            switch ($input['action']) {
                case 'get':
                    if ($this->downloadToGateway($file, Auth::id())){
                        return true;
                    }
                    break;

                case 'put':
                    // TODO: Upload file code goes here.
                    return true;
                    break;
            }
        }

        return false;
    }

    private function downloadToGateway(File $file, $gatewayOwner) {
        if ($this->host->isPasswordProtected()) {
            if ($this->host->checkRootPassword($this->providedPassword)){
                return FileHandler::downloadFile($file->fileID, $gatewayOwner);
            }

            return false;
        }else{
            return FileHandler::downloadFile($file->fileID, $gatewayOwner);
        }
    }
}