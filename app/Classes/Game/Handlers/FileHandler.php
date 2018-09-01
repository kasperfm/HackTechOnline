<?php

namespace App\Classes\Game\Handlers;

use App\Classes\Game\File;
use App\Events\MissionEvent;
use App\Models\File as FileModel;


class FileHandler
{
    public static function getFile($fileID, $userID = null)
    {
        $file = new File($fileID, $userID);
        return $file;
    }

    public static function findFileOnGateway($filename, $host)
    {
        $files = FileModel::where('placement', 'gw')->where('host', $host)->get();
        foreach ($files as $file) {
            if($file->data->filename == $filename){
                return $file;
            }
        }

        return null;
    }

    public static function findFileOnServer($filename, $host)
    {
        $files = FileModel::where('placement', 'server')->where('host', $host)->get();
        foreach ($files as $file) {
            if($file->data->filename == $filename){
                return $file;
            }
        }

        return null;
    }

    public static function downloadFile($fileID, $userID)
    {
        $file = self::getFile($fileID, $userID);
        $user = UserHandler::getUser($userID);
        if($file && $user) {
            if (self::fileExists($fileID, $user->gateway->hostID) == false) {
                $newFile = new FileModel();
                $newFile->file_id = $fileID;
                $newFile->owner = $userID;
                $newFile->encrypted = intval($file->encrypted);
                $newFile->placement = 'gw';
                $newFile->host = $user->gateway->hostID;
                $newFile->save();

                $server = new \App\Classes\Game\Server($file->hostID);
                event(new MissionEvent('get', $file->filename . ' ' . $server->hostname));
                return $newFile;
            }
        }

        return false;
    }

    public static function fileExists($fileID, $hostID)
    {
        $file = FileModel::where('file_id', $fileID)->where('host', $hostID)->first();
        if($file){
            return true;
        }

        return false;
    }

    public static function listFiles($host)
    {
        $files = FileModel::where('host', $host)->get();
        if($files->count() == 0) {
            return null;
        }

        $list = array();

        foreach ($files as $file) {
            $thisFile = self::getFile($file->id);

            array_push($list, $thisFile);
        }

        return $list;
    }
}
