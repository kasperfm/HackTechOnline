<?php

namespace App\Classes\Game\Modules\Tools\LogReader;

use App\Classes\Game\Module;
use App\Classes\Game\Handlers\UserHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class LogReader extends Module
{
    public function setup()
    {
        $this->name = "LogReader";
        $this->title = "Log Reader";
        $this->group = "tools";
        $this->description = "A tool for reading log files.";

        $this->size = array(
            "width" => 578,
            "height" => 500
        );
    }

    public function ajaxList(Request $request)
    {
        $allowedLogTypes = [
            'gateway',
            'filetransfer'
        ];

        $logs = null;

        if(in_array($request->get('logtype'), $allowedLogTypes)){
            $logs = Activity::where('log_name', $request->get('logtype'))->where('causer_id', Auth::id())->orderBy('id', 'desc')->limit(10)->get();
        }

        $renderedView = view('Modules::Tools.LogReader.Views.loglist', [
            'logs' => $logs
        ])->render();

        return array(
            'answer' => true,
            'view' => $renderedView
        );
    }
}
