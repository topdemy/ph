<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Contact;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('contacts.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});

Broadcast::channel('voip.events', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});
