<?php

// app/Events/CallEnded.php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CallEnded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $callerId;
    public $roomId;

    public function __construct($callerId, $roomId)
    {
        $this->callerId = $callerId;
        $this->roomId = $roomId;
    }

    public function broadcastOn()
    {
        return 'video-chat.' . $this->roomId;
    }
}
