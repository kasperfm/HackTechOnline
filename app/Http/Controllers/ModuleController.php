<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Classes\Game\ModuleHandler;

class ModuleController extends Controller
{
    private $module;

    public function loadModule(Request $request){
        if(!$request->isEmpty){
            $moduleHandler = new ModuleHandler();
            $response = array();
            $response['answer'] = false;

            $this->module = $moduleHandler->getApplication($request->modname);

            if(!empty($this->module)) {
                if($this->module->requirements->validateRequirements($request)) {
                    $response['answer'] = true;
                    $response['view'] = $this->module->returnHTML();
                    $response['width'] = $this->module->size['width'];
                    $response['height'] = $this->module->size['height'];
                    $response['title'] = $this->module->title;
                }
            }

            return json_encode($response);
        }
    }

    public function unloadModule(Request $request){
        $response = array();
        $response['answer'] = false;

        if(!$request->isEmpty){
            $moduleHandler = new ModuleHandler();
            $this->module = $moduleHandler->getApplication($request->modname);

            $response['answer'] = true;
            $request->session()->pull('runningApps', $request->modname);
            $request->session()->put('cpuUsage', $request->session()->get('cpuUsage') - $this->module->appModel->data->cpu_req);
            $request->session()->put('ramUsage', $request->session()->get('ramUsage') - $this->module->appModel->data->ram_req);

        }

        return json_encode($response);
    }

    public function getResources(Request $request){

    }

    private function percentage($val1, $val2, $precision){
        $res = round( ($val1 / $val2) * 100, $precision );
        return $res;
    }

}