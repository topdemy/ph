<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Contact; 

class ContactCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $contact;
    public $userId;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
        $this->userId = $contact->user_id;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('contacts.' . $this->userId);
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->contact->id,
            'first_name' => $this->contact->first_name,
            'last_name' => $this->contact->last_name,
            'phone' => $this->contact->phone,
            'email' => $this->contact->email,
        ];
    }
}