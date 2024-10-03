<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    public function register()
    {
        //Log::info('BroadcastServiceProvider register method called');
    }

    public function boot()
    {
        //Log::info('BroadcastServiceProvider boot method called');
        Broadcast::routes(); // ['middleware' => ['auth','web']]

        require base_path('routes/channels.php');
    }
}
