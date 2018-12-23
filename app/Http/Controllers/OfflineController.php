<?php

namespace App\Http\Controllers;

use App\Classes\Game\Handlers\UserHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Classes\Game\Handlers\ModuleHandler;

class OfflineController extends Controller
{
    public function index()
    {
        return view('offline');
    }
}
