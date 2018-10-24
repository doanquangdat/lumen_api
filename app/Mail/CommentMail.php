<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $infoComment;
     /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($infoComment)
    {
        $this->infoComment = $infoComment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail notification of comment reply')->view('admin.comment.blog-tour-comment');
    }
}