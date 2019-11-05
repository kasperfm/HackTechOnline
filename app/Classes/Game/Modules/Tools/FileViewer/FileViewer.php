<?php

namespace App\Classes\Game\Modules\Tools\FileViewer;

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

        $localfiles = FileHandler::listFiles($user->gateway->hostID);
        $return = array();

        if(!empty($localfiles)){
            $tree = $this->buildFileTree();

            foreach($localfiles as $file){
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

                if($file->isEncrypted()){
                    $response['encrypted'] = true;
                }else{
                    $response['content'] = $file->content;
                    $response['filetype'] = $file->filetype;
                    $response['encrypted'] = false;
                }
            }else{
                $response['result'] = false;
            }
        }

        return $response;
    }
}
