<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Classes\Game\ModuleHandler;

class ModuleController extends Controller
{
    private $module;

    public function loadModule(Request $request){
        $postData = $request->all();
        if(!empty($postData)){
            $moduleHandler = new ModuleHandler();
            $response = array();
            $response['answer'] = true;

            $this->module = $moduleHandler->getApplication($request->modname);

            if(!empty($this->module)) {
                $response['answer'] = true;
                $response['view'] = $this->module->returnHTML();
                $response['width'] = $this->module->size['width'];
                $response['height'] = $this->module->size['height'];
                $response['title'] = $this->module->title;
            }

            return json_encode($response);
        }
    }

    public function unloadModule(Request $request){

    }
}