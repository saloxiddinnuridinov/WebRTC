<?php

// app/Events/VideoChatOffer.php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VideoChatOffer
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $callerId;
    public $calleeId;
    public $offer;

    public function __construct($callerId, $calleeId, $offer)
    {
        $this->callerId = $callerId;
        $this->calleeId = $calleeId;
        $this->offer = $offer;
    }

    public function broadcastOn()
    {
        return 'video-chat.' . $this->calleeId;
    }
}

