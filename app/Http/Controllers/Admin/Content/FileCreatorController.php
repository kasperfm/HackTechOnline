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
        return view(backpack_view('custom.content_file_new'), []);
    }

    public function store(Request $request)
    {
        // TODO STUFF
        return back()->with('success', 'Server submitted. Thank you!');
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
