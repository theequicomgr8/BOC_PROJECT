<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BocMail extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->details['pdf'] != '') {
            return $this->subject('Acknowledgement Print Application')->attachData($this->details['pdf'], 'invoice.pdf')
                ->view('emails.bocMail');
        } else {
            return $this->subject('Acknowledgement Print Application')->view('emails.bocMail');
        }
    }
}
