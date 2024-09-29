<?php

namespace App\Jobs;

use App\Models\Todo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SendTodoNotification implements ShouldQueue
{
    use Queueable;
    // The Queueable trait provides several useful methods and properties for queue jobs:
    // 1. It adds a delay() method to postpone the execution of a job.
    // 2. It provides the onQueue() method to specify which queue the job should be sent to.
    // 3. It includes the onConnection() method to determine the queue connection for the job.
    // 4. It offers the middleware() method to define middleware for the job.
    // 5. It handles serialization of the job, ensuring it can be properly queued and retrieved.
    // By using this trait, we make our SendTodoNotification job queueable and gain access to
    // these queue-specific features, allowing for more flexible job processing.

    public $todo;
    public $action;

    /**
     * Create a new job instance.
     */
    public function __construct(Todo $todo, $action)
    {
        $this->todo = $todo;
        $this->action = $action;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("Todo [{$this->todo->title}] has been {$this->action}.");
    }
}
