<?php

namespace App\Listeners;

use App\Events\TodoCompleted;
use App\Mail\TodoCompletedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendTodoCompletedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TodoCompleted $event): void
    {
        Log::info('Sending todo completed notification');
        // Example: Send an email notification
        Mail::to($event->todo->user->email)->send(new TodoCompletedMail($event->todo));

        // Alternatively, you could log the event, send a message, etc.
        Log::info('Todo completed: ' . $event->todo->title);
    }
}
