<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActionbackMarkdownMail extends Mailable
{
    use Queueable, SerializesModels;

    public $url = '';

    public $data = [];
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $subject, $content, $url)
    {
        $the_user = auth()->user();
        $user_id = auth()->user()->id;

        $this->data['email'] = $email;
        $this->data['subject'] = $subject;
        $this->data['content'] = $content;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->data['email'])
                    ->subject($this->data['subject'])
                    ->markdown('emails.actionback-markdown');
    }
}
