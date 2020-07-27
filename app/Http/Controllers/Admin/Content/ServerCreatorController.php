<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ServerCreatorController extends Controller
{
    protected $data = [];

    public function __construct()
    {
        $this->middleware(backpack_middleware());
    }

    public function index()
    {
        $services = Service::get();
        return view(backpack_view('custom.content_server_new'), ['services' => $services]);
    }

    public function store(Request $request)
    {
        $requestArray = $request->all();
        array_shift($requestArray['services']);
        array_shift($requestArray['ports']);

        $resultArray = array();
        $resultArray['ip'] = $request->get('ip');
        $resultArray['domain'] = $request->get('domain', null);
        $resultArray['rootpassword'] = $request->get('rootpassword');
        $resultArray['owner'] = $request->get('owner', 0);
        $resultArray['services'] = array();

        for ($x = 0; $x <= count($requestArray['services']) - 1; $x++) {
            $serviceItem = array();
            $serviceItem['type'] = (int)$requestArray['services'][$x];
            $serviceItem['port'] = (int)$requestArray['ports'][$x];

            array_push($resultArray['services'], $serviceItem);
        }

        file_put_contents(storage_path('app/seederdata/servers/new/') . backpack_user()->id . '-' . md5(time()) . '.json', json_encode($resultArray));

        return back()->with('success', 'Server submitted. Thank you!');
    }

    public function ajaxGetDefaultServicePort(Request $request)
    {
        $service = Service::findOrFail($request->get('service'));

        return response()->json($service->default_port);
    }

    /**
     * Get the guard to be used for account manipulation.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return backpack_auth();
    }
}
