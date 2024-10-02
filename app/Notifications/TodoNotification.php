<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TodoNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $todo;
    protected $action;

    /**
     * Create a new notification instance.
     *
     * @param $todo
     * @param string $action
     */
    public function __construct($todo, string $action)
    {
        $this->todo = $todo;
        $this->action = $action;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database']; // You can add more channels like 'broadcast' if needed
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Todo Notification')
            ->line('Your Todo item "' . $this->todo->title . '" has been ' . $this->action . '.')
            ->action('View Todo', url('/todos/' . $this->todo->id))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'todo_id' => $this->todo->id,
            'todo_title' => $this->todo->title,
            'action' => $this->action,
            'message' => 'Your Todo item "' . $this->todo->title . '" has been ' . $this->action . '.',
        ];
    }
}
