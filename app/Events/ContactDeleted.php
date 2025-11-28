<?php

namespace App\Events;

use App\Models\Contact;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;

class ContactDeleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $contactId;
    public $userId;

    public function __construct(Contact $contact)
    {
        $this->contactId = $contact->id;
        $this->userId = $contact->user_id;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('contacts.' . $this->userId);
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->contactId,
        ];
    }
}
