<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AsteriskQueueCallerJoin implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('asterisk.queues');
    }

    public function broadcastAs()
    {
        return 'QueueCallerJoin';
    }

    public function broadcastWith()
    {
        return [
            'queue' => $this->data['queue'] ?? null,
            'caller' => $this->data['calleridnum'] ?? null,
            'position' => $this->data['position'] ?? null,
            'count' => $this->data['count'] ?? null,
            'raw' => $this->data,
        ];
    }
}
