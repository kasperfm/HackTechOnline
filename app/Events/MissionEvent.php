<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MissionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $action;
    public $parameters;

    /**
     * Create a new event instance.
     *
     * @param string $action
     * @param string $parameters
     * @return void
     */
    public function __construct($action, $parameters)
    {
        $this->action = $action;
        $this->parameters = $parameters;
    }


}
