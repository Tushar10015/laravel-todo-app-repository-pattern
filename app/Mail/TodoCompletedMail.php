<?php

namespace App\Mail;

use App\Models\Todo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TodoCompletedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $todo;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Todo $todo
     * @return void
     */
    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    /*  public function build()
    {
        return $this->subject('Todo Completed: ' . $this->todo->title)
            ->view('emails.todo-completed');
    } */

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Todo Completed Mail: ' . $this->todo->title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.todo-completed',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
