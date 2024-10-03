<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

Broadcast::channel('todos.{userId}', function ($user, $userId) {
    Log::info($user);
    Log::info($userId);
    //return (int) $user->id === (int) $userId;
    return true;
});
