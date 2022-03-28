<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountMarkdownMail extends Mailable
{
    use Queueable, SerializesModels;

    public $url = '';

    public $data = [];
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $name, $surname, $subject, $content)
    {
        $the_user = auth()->user();
        $user_id = auth()->user()->id;

        $this->data['email'] = $email;
        $this->data['name'] = $name;
        $this->data['surname'] = $surname;
        $this->data['subject'] = $subject;
        $this->data['content'] = $content;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return  $this->from($this->data['email'])
                    ->subject($this->data['subject'])
                    ->markdown('emails.markdown-account');
    }
}
