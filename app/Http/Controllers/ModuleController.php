<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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
        $response = array();
        $response['answer'] = false;
        $response['cpu'] = 0;
        $response['ram'] = 0;
        $response['hdd'] = 0;

        if(Auth::check()){
            $user = User::find(Auth::id())->first();
            $gwCpu = $user->gateway->cpu->value;
            $gwRam = $user->gateway->ram->value;
            $gwHdd = $user->gateway->hdd->value;

            $currentCpuUsage = $request->session()->get('cpuUsage');
            $currentRamUsage = $request->session()->get('ramUsage');

            $response['cpu'] = $this->percentage($currentCpuUsage, $gwCpu, 0);
            $response['ram'] = $this->percentage($currentRamUsage, $gwRam, 0);
            $response['hdd'] = $this->percentage($gwHdd - ($gwHdd / 2), $gwHdd, 0); // TEST DATA

            $response['answer'] = true;
        }

        return json_encode($response);
    }

    private function percentage($val1, $val2, $precision){
        $res = round( ($val1 / $val2) * 100, $precision );
        return $res;
    }
}
