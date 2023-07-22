<?php

// app/Events/VideoChatICECandidate.php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VideoChatICECandidate
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $callerId;
    public $calleeId;
    public $candidate;

    public function __construct($callerId, $calleeId, $candidate)
    {
        $this->callerId = $callerId;
        $this->calleeId = $calleeId;
        $this->candidate = $candidate;
    }

    public function broadcastOn()
    {
        return 'video-chat.' . $this->calleeId;
    }
}
