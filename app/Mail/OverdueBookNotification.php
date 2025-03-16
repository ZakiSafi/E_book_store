<?php

namespace App\Mail;

use App\Models\BorrowedBook;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OverdueBookNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $borrowedBook;
    /**
     * Create a new message instance.
     */
    public function __construct( BorrowedBook $borrowedBook)
    {
        $this->borrowedBook = $borrowedBook;
    }

    public function build(){
        return $this->subject('Overdue Book Notification')
        ->view('emails.overdue_book_notification')
        ->with([
            'borrowedBook' => $this->borrowedBook
        ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Overdue Book Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

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
