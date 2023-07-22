<?php

// app/Events/VideoChatAnswer.php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VideoChatAnswer
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $callerId;
    public $calleeId;
    public $answer;

    public function __construct($callerId, $calleeId, $answer)
    {
        $this->callerId = $callerId;
        $this->calleeId = $calleeId;
        $this->answer = $answer;
    }

    public function broadcastOn()
    {
        return 'video-chat.' . $this->callerId;
    }
}
