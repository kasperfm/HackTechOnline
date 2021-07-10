<?php

namespace App\Http\Controllers\Admin\Content;

use App\Classes\Helpers\NetworkHelper;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MissionCreatorController extends Controller
{
    protected $data = [];

    public function __construct()
    {
        $this->middleware(backpack_middleware());
    }

    public function index()
    {
        return view(backpack_view('custom.content_mission_new'));
    }

    public function store(Request $request)
    {
        $resultArray = array();

        // Fill the array.....

        file_put_contents(storage_path('app/seederdata/missions/new/') . backpack_user()->id . '-' . md5(time()) . '.json', json_encode($resultArray));

        return back()->with('success', 'Mission submitted. Thank you!');
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
