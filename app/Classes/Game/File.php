<?php

/**
 * App\Classes\Game\File
 *
 * @package HackTech Online
 * @author Kasper F. Mikkelsen
 * @copyright 2019
 * @version 1.0
 * @access public
 */

namespace App\Classes\Game;

use App\Models\User;
use App\Models\File as FileModel;

class File
{
    public $fileID;
    public $filetype;
    public $filename;
    public $content;
    public $size;
    public $encrypted;
    public $password;
    public $hostID;

    public $placement;
    public $encryptState;

    private $owner;

    public function __construct($fileID, $user = null){
        $this->fileID = $fileID;
        $this->owner = $user;

        $file = FileModel::where('id', $fileID)->first();
        if($file){
            $this->filetype = $file->data->filetype;
            $this->filename = $file->data->filename;
            $this->content = $file->data->content;
            $this->size = $file->data->filesize;
            $this->password = $file->data->password;
            $this->encrypted = boolval($file->data->encrypted);
            $this->encryptState = boolval($file->encrypted);
            $this->placement = $file->placement;
            $this->hostID = $file->host;
        }else{
            // File not found. Create new object.
            return null;
        }
    }

    public function isEncrypted(){
        return $this->encryptState;
    }

    public function onGateway(){
        if($this->placement == 'gw'){
            return true;
        }

        return false;
    }

    public function onServer(){
        if($this->placement == 'server'){
            return true;
        }

        return false;
    }

    private function hasOwner(){
        if($this->owner){
            return true;
        }

        return false;
    }

    public function delete(){
        if($this->hasOwner()) {
            FileModel::where('id', $this->fileID)->where('owner', $this->owner)->delete();

            return true;
        }

        return false;
    }

    public function decrypt($password){
        if($this->encrypted || $this->isEncrypted()){
            if($password == $this->password){
                $modelInstance = FileModel::where('id', $this->fileID)->first();
                $modelInstance->encrypted = 0;
                $modelInstance->save();

                $this->encryptState = false;
                $this->encrypted = false;
                $this->password = $password;

                return true;
            }
        }

        return false;
    }

    public function forceEncrypt($password){
        if($this->isEncrypted() == false) {
            $modelInstance = FileModel::where('id', $this->fileID)->first();
            $modelInstance->encrypted = 1;
            $modelInstance->data->password = $password;
            $modelInstance->data->save();
            $modelInstance->save();

            $this->encryptState = true;
            $this->encrypted = true;
            $this->password = $password;

            return true;
        }

        return false;
    }
}