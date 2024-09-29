<?php

namespace App\Providers;

use App\Events\TodoCompleted;
use App\Listeners\SendTodoCompletedNotification;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TodoCompleted::class, SendTodoCompletedNotification::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
