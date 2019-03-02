<?php

namespace App\Listeners;

use App\Classes\Game\Handlers\ModuleHandler;
use App\Classes\Game\Handlers\UserHandler;
use App\Events\HandleApp;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class AppHandleListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(HandleApp $event)
    {

    }
}
