<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $infoContact;
     /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($infoContact)
    {
        $this->infoContact = $infoContact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.contact.mail-contact');
    }
}