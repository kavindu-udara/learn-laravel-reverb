<?php

use App\Events\Example;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.room.{roomId}', function (User $user, $roomId) {
    // return (int) $user->id === (int) $id;

    if (!$user->canAccessRoom($roomId)) {
        return false;
    }

    return true;
});

Broadcast::channel('users.{id}', function (User $user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('room.{roomId}', function (User $user, $roomId) {
    return $user->only('id', 'name');
});

Broadcast::channel('orders.{orderId}', function (User $user, $orderId) {
    if ($user->id !== Order::findOrNew($orderId)->user_id) {
        return false;
    }
    return true;
});

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel('chat', function () {
    //
});
