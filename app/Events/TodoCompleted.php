<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Todo;
use Illuminate\Support\Facades\Log;

class TodoCompleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $todo;
    /**
     * Create a new event instance.
     */
    public function __construct(Todo $todo)
    {
        Log::info('Todo completed event constructor');
        $this->todo = $todo;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
