<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('receiver.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
