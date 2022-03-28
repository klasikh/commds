<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CmMarkdownMail extends Mailable
{
    use Queueable, SerializesModels;

    public $url = '';

    public $data = [];
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $backPoint, $file_path)
    {  
        $the_user = auth()->user();
        $user_id = auth()->user()->id;
        $this->data['email'] = $email;
        $this->data['backPoint'] = $backPoint;
        $this->data['file_path'] = $file_path;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = auth()->user();
        return $this->from($this->data['email'])
                    ->subject("Compte rendu du niveau du stock")
                    ->attachFromStorage('public/'.$this->data['file_path'])
                    ->markdown('emails.cm-markdown');
    }
}
