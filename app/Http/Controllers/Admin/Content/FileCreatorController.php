<?php

namespace App\Http\Controllers\Admin\Content;

use App\Classes\Helpers\NetworkHelper;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FileCreatorController extends Controller
{
    protected $data = [];

    public function __construct()
    {
        $this->middleware(backpack_middleware());
    }

    public function index()
    {
        return view(backpack_view('custom.content_file_new'));
    }

    public function store(Request $request)
    {
        $resultArray = array();
        $resultArray['host'] = $request->get('host');
        $resultArray['filename'] = strtolower($request->get('filename'));
        $resultArray['filetype'] = $request->get('type');
        $resultArray['password'] = $request->get('password', null);
        $resultArray['encrypted'] = !empty($request->get('password', null));
        $resultArray['filesize'] = (int)$request->get('filesize', 1);
        $resultArray['content'] = $request->get('content', '');

        file_put_contents(storage_path('app/seederdata/files/new/') . backpack_user()->id . '-' . md5(time()) . '.json', json_encode($resultArray));

        return back()->with('success', 'File submitted. Thank you!');
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
