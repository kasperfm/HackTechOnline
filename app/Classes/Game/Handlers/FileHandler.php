<?php

namespace App\Classes\Game\Handlers;

use App\Classes\Game\File;
use App\Events\MissionEvent;
use App\Models\File as FileModel;
use App\Models\FileData as FileDataModel;


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
                $newFile->owner_id = $userID;
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
     * Upload a local gateway file to a remote server.
     * @param $fileID
     * @param $userID
     * @param $destinationServerID
     * @param string $destinationPath
     * @param bool $createNewFile
     * @return FileModel|bool
     */
    public static function uploadFile($fileID, $userID, $destinationServerID, $destinationPath = '', $createNewFile = false)
    {
        $file = self::getFile($fileID, $userID);
        $user = UserHandler::getUser($userID);
        $destination = new \App\Classes\Game\Server($destinationServerID);

        if($file && $user && $destination) {
            if (self::fileExists($fileID, $destinationServerID) == false) {
                if ($createNewFile) {
                    $newFileData = new FileDataModel();
                    $newFileData->filename = $destinationPath . $file->getFilenameOnly();
                    $newFileData->content = $file->content;
                    $newFileData->filesize = $file->size;
                    $newFileData->filetype = $file->filetype;
                    $newFileData->encrypted = 0;
                    $newFileData->password = null;
                    $newFileData->save();
                }

                $newFile = new FileModel();
                $newFile->file_id = !empty($newFileData) ? $newFileData->id : $fileID;
                $newFile->owner_id = 0;
                $newFile->encrypted = intval($file->encrypted);
                $newFile->placement = 'server';
                $newFile->host = $destinationServerID;
                $newFile->save();

                $uploadedFile = self::getFile($newFile->file_id);

                activity('filetransfer')
                    ->performedOn($newFile)
                    ->withProperties([
                        'from_gateway' => $user->gateway->hostID,
                        'to_host' => $destinationServerID
                    ])
                    ->causedBy($user->model)
                    ->log('Uploaded file: ' . $uploadedFile->filename);

                $server = new \App\Classes\Game\Server($destinationServerID);
                event(new MissionEvent('upload', $uploadedFile->filename . ' ' . $server->hostname));
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
