<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;

class CsvImportFinishedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;

    public $jobParent;

    public function __construct($jobParent)
    {
        $this->jobParent = $jobParent;
    }

    public function broadcastOn()
    {
        return new Channel('messageChannel');
    }

    public function broadcastAs()
    {
        return 'messageFinishEvent';
    }
}
