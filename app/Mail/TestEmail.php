<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use SerializesModels;

    public $details;

    // Constructor to pass data to the view
    public function __construct($details)
    {
        $this->details = $details;
    }

    // Build the email
    public function build()
    {
        return $this->subject($this->details['subject'])
            ->view('emails.test')
            ->with('body', $this->details['body']);
    }
}
