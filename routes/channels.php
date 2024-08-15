<?php

use App\Events\Example;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.room.{roomId}', function (User $user, $roomId) {
    // return (int) $user->id === (int) $id;

    if(!$user->canAccessRoom($roomId)){
        return false;
    }

    return true;

});

Broadcast::channel('users.{id}', function (USer $user, $id) {
    return (int) $user->id === (int) $id;
});

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel('chat', function(){
    //
});