<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;

Broadcast::channel('receiver.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.online', function (User $user) {
    // Retornamos os dados que queremos que fiquem visíveis no canal
    return ['id' => $user->id, 'name' => $user->name];
});
