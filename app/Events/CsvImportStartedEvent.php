<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Log;

class CsvImportStartedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct($count)
    {
        $this->message = "We're importing " . $count . " balance entries.  Sit tight.";
    }

    public function broadcastOn()
    {
        return new Channel('messageChannel');
    }

    public function broadcastAs()
    {
        return 'messageStartEvent';
    }
}
