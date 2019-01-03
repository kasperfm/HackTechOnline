<?php

namespace App\Http\Controllers;

use App\Classes\Game\Handlers\UserHandler;
use App\Classes\Game\Types\HardwareTypes;
use App\Models\Application;
use App\Models\UserApp;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Classes\Game\Handlers\ModuleHandler;

class ModuleController extends Controller
{
    private $module;

    public function loadModule(Request $request){
        if($request){
            $moduleHandler = new ModuleHandler();
            $response = array();
            $response['answer'] = false;

            $appLookup = Application::where('app_name', $request->modname)->first();
            if($appLookup) {
                $userApp = UserApp::ownedBy(Auth::id())->currentVersionOf($appLookup->id)->first();
                if($userApp) {
                    $this->module = $moduleHandler->getApplication($request->modname, Auth::id(), false, $userApp->version);
                }else{
                    $this->module = $moduleHandler->getApplication($request->modname, Auth::id(), true);
                }

                if (!empty($this->module)) {
                    if ($this->module->requirements->validateRequirements($request)) {
                        $response['answer'] = true;
                        $response['view'] = $this->module->returnHTML();
                        $response['width'] = $this->module->size['width'];
                        $response['height'] = $this->module->size['height'];
                        $response['title'] = $this->module->title;
                    }
                }
            }

            return response()->json($response);
        }
    }

    public function unloadModule(Request $request){
        $response = array();
        $response['answer'] = false;

        if(!$request->isEmpty){
            $moduleHandler = new ModuleHandler();
            $this->module = $moduleHandler->getApplication($request->modname, Auth::id());

            $response['answer'] = true;
            $request->session()->pull('runningApps', $request->modname);
            $request->session()->put('cpuUsage', $request->session()->get('cpuUsage') - $this->module->appModel->data->cpu_req);
            $request->session()->put('ramUsage', $request->session()->get('ramUsage') - $this->module->appModel->data->ram_req);
        }

        return response()->json($response);
    }

    public function callAjax(Request $request, $moduleName, $action){
        $moduleHandler = new ModuleHandler();
        $response = $moduleHandler->call($moduleName, Auth::id(), $action, $request, 'ajax');

        return response()->json($response);
    }

    public function callGet(Request $request, $moduleName, $action){
        $moduleHandler = new ModuleHandler();
        $response = $moduleHandler->call($moduleName, Auth::id(), $action, $request, 'get');

        return $response;
    }

    public function getResources(Request $request){
        $response = array();
        $response['answer'] = false;
        $response['cpu'] = 0;
        $response['ram'] = 0;
        $response['hdd'] = 0;

        if(Auth::check()){
            $user = User::with(['gateway'])->where('id', Auth::id())->first();
            $gatewayHardware = $user->gateway->hardware()->get();

            $gwCpu = $gatewayHardware->where('type', HardwareTypes::CPU)->first();
            $gwRam = $gatewayHardware->where('type', HardwareTypes::RAM)->first();
            $gwHdd = $gatewayHardware->where('type', HardwareTypes::Harddrive)->first();

            $userObj = UserHandler::player();

            $currentCpuUsage = $request->session()->get('cpuUsage');
            $currentRamUsage = $request->session()->get('ramUsage');
            $currentHDDUsage = $userObj->gateway->usedDiskSpace();

            $response['cpu'] = $this->percentage($currentCpuUsage, $gwCpu->value, 0);
            $response['ram'] = $this->percentage($currentRamUsage, $gwRam->value, 0);
            $response['hdd'] = $this->percentage($currentHDDUsage, $gwHdd->value, 0);

            $response['answer'] = true;
        }

        return response()->json($response);
    }

    public function getInstalledApps(Request $request){
        $response = array();
        $response['answer'] = false;

        if(Auth::check()){
            $moduleHandler = new ModuleHandler();
            $content = "";

            $appList = $moduleHandler->getInstalledApps(Auth::id());

            if(!empty($appList)){
                foreach($appList as $app){
                    $content .= '<li rel="'.strtolower($app->application()->app_name).'" class="exec">'.\App\Classes\Helpers\StringHelper::camelCaseToWords($app->application()->app_name).'</li>';
                }
            }

            $response['content'] = $content;
            $response['answer'] = true;
        }

        return response()->json($response);
    }

    private function percentage($val1, $val2, $precision){
        if($val1 == 0 || $val2 == 0){
            return 0;
        }

        $res = round( ($val1 * 100) / $val2, $precision );
        return $res;
    }
}
