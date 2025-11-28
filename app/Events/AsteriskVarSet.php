<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AsteriskVarSet implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $data;

    /**
     * Create a new event instance.
     */
    public function __construct(array $eventData)
    {
        $this->data = $eventData;
    }

    /**
     * Broadcast on public channel
     */
    public function broadcastOn(): Channel
    {
        return new Channel('asterisk.events');
    }

    /**
     * Event name sent to frontend
     */
    public function broadcastAs(): string
    {
        return 'AsteriskVarSet';
    }
}
