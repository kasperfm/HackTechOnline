<?php

namespace App\Classes\Game\Modules\Tools\FileViewer;

use App\Classes\Game\Handlers\ServerHandler;
use App\Classes\Game\Module;
use App\Classes\Game\Handlers\UserHandler;
use App\Classes\Game\Handlers\FileHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function foo\func;

class FileViewer extends Module
{
    public function setup()
    {
        $this->name = "FileViewer";
        $this->title = "File Viewer";
        $this->group = "tools";
        $this->description = "Browse and view files.";

        $this->size = array(
            "width" => 625,
            "height" => 600
        );
    }

    public function getList(Request $request)
    {
        $user = UserHandler::getUser(Auth::id());
        if(!$user){
            return null;
        }

        if ($this->version >= 1.1) {
            $hostID = $request->get('hostID', 0) == 0 ? $user->gateway->hostID : $request->get('hostID');

            if ($hostID != $user->gateway->hostID || $hostID == 0) {
                $server = ServerHandler::getServerByID($hostID);
                if (!$server) {
                    return response()->json(array());
                }

                if ($server->isPasswordProtected() && !$server->checkRootPassword($request->get('hostPassword'))) {
                    return response()->json(array());
                }
            }
        } else {
            $hostID = $user->gateway->hostID;
        }

        $files = FileHandler::listFiles($hostID);
        $return = array();

        if(!empty($files)){
            $tree = $this->buildFileTree();

            foreach($files as $file){
                $filepathStructure = explode('/', $file->filename);

                $newDir = array_map( function ($k, $v) use($file, $filepathStructure){
                    return array(
                        'id' => last($filepathStructure),
                        'parent' => count($filepathStructure) > 1 ? $filepathStructure[count($filepathStructure) -2] : '#',
                        'text' => last($filepathStructure),
                        'fid' => $file->fileID,
                        'icon' => 'jstree-file'
                    );
                }, array_keys($tree), $tree)[0];

                if($newDir && !in_array($newDir, $return)){
                    $return[] = $newDir;
                }

                array_pop($filepathStructure);

                foreach ($filepathStructure as $folder){
                    $item = array(
                        'id' => $folder,
                        'parent' => count($filepathStructure) > 1 && $folder != $filepathStructure[count($filepathStructure) -2] ? $filepathStructure[count($filepathStructure) -2] : '#',
                        'text' => $folder,

                    );

                    if(!in_array($item, $return)) {
                        $return[] = $item;
                    }
                }
            }
        }

        return response()->json($return);
    }

    private function parseTree($input) {
        $result = array();

        foreach ($input as $path) {
            $prev = &$result;

            $s = strtok($path, '/');

            while (($next = strtok('/')) !== false) {
                if (!isset($prev[$s])) {
                    $prev[$s] = array();
                }

                $prev = &$prev[$s];
                $s = $next;
            }
            $prev[] = $s;

            unset($prev);
        }
        return $result;
    }


    private function buildFileTree()
    {
        $localfiles = FileHandler::listFiles(currentPlayer()->gateway->hostID);
        $fileTree = array();

        foreach ($localfiles as $file){
            $fileTree[] = $file->filename;
        }
        return $this->parseTree($fileTree);
    }

    public function ajaxOpen(Request $request)
    {
        $response['result'] = false;
        $response['encrypted'] = true;

        if(Auth::check() && !empty($request->get('fid'))){
            $file = FileHandler::getFile($request->get('fid'), Auth::id());

            if(!empty($file)){
                $response['result'] = true;

                if($file->filetype == 'bin') {
                    $response['content'] = 'ERROR: UNABLE TO PARSE BINARY FILE!';
                    $response['filetype'] = 'bin';
                    $response['encrypted'] = false;
                } else {
                    if ($file->isEncrypted()) {
                        $response['encrypted'] = true;
                    } else {
                        $response['content'] = $file->content;
                        $response['filetype'] = $file->filetype;
                        $response['encrypted'] = false;
                    }
                }
            }else{
                $response['result'] = false;
            }
        }

        return $response;
    }

    public function ajaxConnectToRemoteServer(Request $request)
    {
        $response['result'] = false;
        $response['message'] = 'Error connecting to the remote host!';
        $response['password_protected'] = false;
        $response['host'] = 0;

        if (Auth::check() && !empty($request->get('host'))) {
            $remote = ServerHandler::getServer($request->get('host'));
            if (!$remote) {
                return $response;
            }

            $service = $remote->getService($request->get('port', 21));
            if (empty($service) || !$remote->getOnlineState()) {
                return $response;
            }

            if ($remote->isPasswordProtected()){// && !$remote->checkRootPassword($request->get('password'))) {
                $response['message'] = 'Access Denied: Password protected server!';
                $response['password_protected'] = true;
                $response['host'] = $remote->hostID;
            } else {
                $response['message'] = '';
                $response['host'] = $remote->hostID;
                $response['result'] = true;
            }
        }

        return $response;
    }

    public function ajaxDownloadFile(Request $request)
    {
        $response['result'] = false;

        if (Auth::check() && !empty($request->get('fid'))) {
            $file = FileHandler::getFile($request->get('fid'));
            if (!$file) {
                return $response;
            }

            $server = ServerHandler::getServerByID($file->hostID);
            if (!$server) {
                return $response;
            }

            $service = $server->getService(21);
            if (empty($service) || !$server->getOnlineState()) {
                return $response;
            }

            $handleInputArray = [
                'fileId' => $file->fileID,
                'action' => 'get',
                'password' => $request->get('server_password')
            ];

            $response['result'] = $service->getHandler()->handle($handleInputArray);
        }

        return $response;
    }
}
