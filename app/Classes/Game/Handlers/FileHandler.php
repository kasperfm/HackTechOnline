<?php

namespace App\Classes\Game\Handlers;

use App\Classes\Game\File;
use App\Events\MissionEvent;
use App\Models\File as FileModel;


class FileHandler
{
    /**
     * Get a file object.
     * @param $fileID
     * @param null $userID
     * @return File
     */
    public static function getFile($fileID, $userID = null)
    {
        $file = new File($fileID, $userID);
        return $file;
    }

    /**
     * Get a file on the specified gateway.
     * @param $filename
     * @param $host
     * @return File|null
     */
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

    /**
     * Get a file on the specified server.
     * @param $filename
     * @param $host
     * @return File|null
     */
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

    /**
     * Download a file to the specified user's gateway.
     * @param $fileID
     * @param $userID
     * @return FileModel|bool
     */
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

                activity('filetransfer')
                    ->performedOn($newFile)
                    ->withProperties([
                        'from_host' => $file->hostID,
                        'to_gateway' => $user->gateway->hostID
                    ])
                    ->causedBy($user->model)
                    ->log('Downloaded file: ' . $file->filename);

                $server = new \App\Classes\Game\Server($file->hostID);
                event(new MissionEvent('get', $file->filename . ' ' . $server->hostname));
                return $newFile;
            }
        }

        return false;
    }

    /**
     * Check if a file exists.
     * @param $fileID
     * @param $hostID
     * @return bool
     */
    public static function fileExists($fileID, $hostID)
    {
        $file = FileModel::where('file_id', $fileID)->where('host', $hostID)->first();
        if($file){
            return true;
        }

        return false;
    }

    /**
     * List all files on a host.
     * @param $host
     * @return array|null
     */
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
