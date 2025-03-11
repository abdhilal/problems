<?php

// use Illuminate\Support\Facades\Broadcast;

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('notify.{user_id}', function ($user, $user_id) {
    return (int) $user->id === (int) $user_id;
});

