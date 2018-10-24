<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InfomationBlogMail extends Mailable
{
    use Queueable, SerializesModels;

    public $infoBlog;
     /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($infoBlog)
    {
        $this->infoBlog = $infoBlog;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.blog.info-blog');
    }
}
