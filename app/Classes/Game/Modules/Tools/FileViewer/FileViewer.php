<?php

namespace App\Classes\Game\Modules\Tools\FileViewer;

use App\Classes\Game\Module;
use App\Classes\Game\Handlers\UserHandler;
use App\Classes\Game\Handlers\FileHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileViewer extends Module
{
    public function setup()
    {
        $this->name = "fileviewer";
        $this->title = "File Viewer";
        $this->group = "tools";
        $this->description = "View the contents of a file.";

        $this->size = array(
            "width" => 530,
            "height" => 600
        );
    }

    public function ajaxList(Request $request)
    {
        $dir = '/';
        if(!empty($request->get('dir'))){
            $dir = $request->get('dir');
            if($dir[0] == '/'){
                $dir = '.'.$dir.'/';
            }
        }

//      $dirs[]  = array('type'=>'dir','dir'=>'.//','file'=>'home');
        $user = UserHandler::getUser(Auth::id());
        if(!$user){
            return null;
        }
        $localfiles = FileHandler::listFiles($user->gateway->hostID);

        $return = array();
        if(!empty($localfiles)){
            foreach($localfiles as $file){
                $return[] = array('type'=>'file', 'dir'=>$dir, 'file'=>$file->filename, 'ext'=>$file->filetype, 'fileid'=>$file->fileID);
            }
        }

        return $return;
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
