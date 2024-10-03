<?php

namespace App\Events;

use App\Models\Todo;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class TodoNotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $todo;
    public $action;

    /**
     * Create a new event instance.
     *
     * @param Todo $todo
     * @param string $action
     */
    public function __construct(Todo $todo, string $action)
    {
        $this->todo = $todo;
        $this->action = $action;
        Log::info("TodoNotificationBroadcastEvent constructor called" . $this->todo->user_id);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array|Channel|PrivateChannel|PresenceChannel
     */
    public function broadcastOn()
    {
        Log::info("Broadcast to user: " . $this->todo->user_id);
        return new PrivateChannel('todos.' . $this->todo->user_id); // Broadcast to a private channel for the user
    }

    public function broadcastWith()
    {
        Log::info("Broadcastwith to user: " . $this->todo->user_id);
        return [
            'message' => 'Your Todo item "' . $this->todo->title . '" has been ' . $this->action . '.',
            'todo_id' => $this->todo->id,
            'todo_title' => $this->todo->title,
        ];
    }
}
