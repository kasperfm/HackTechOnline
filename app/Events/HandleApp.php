<?php

namespace App\Events;

use App\Classes\Game\Handlers\ModuleHandler;
use App\Classes\Game\Handlers\UserHandler;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

//event(new HandleApp('MissionCenter', 'refresh'));

class HandleApp implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $applicationName;
    public $moduleName;
    public $method;
    public $methodData;

    /**
     * Create a new event instance.
     *
     * @param string $app
     * @param string $method
     * @return void
     */
    public function __construct($app, $method)
    {
        $this->applicationName = $app;
        $this->method = $method;

        $moduleHandler = new ModuleHandler();
        $application = $moduleHandler->getApplication($this->applicationName, UserHandler::player()->userID);

        if($application) {
            $this->moduleName = $application->name;
            if($method == 'refresh'){
                $this->methodData = $application->returnHTML();
            }
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('handleapp' . md5(Auth::id()));
    }
}
