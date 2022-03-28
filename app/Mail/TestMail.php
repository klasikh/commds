<?php

namespace App\Mail;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $name, $surname, $url)
    {
        $this->data['email'] = $email;
        $this->data['name'] = $name;
        $this->data['surname'] = $surname;
        $this->data['url'] = $url;
    }

    public function backReq()
    {
        return route('messages.index');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $the_user = auth()->user();

        return $this->from($this->data['email'])
                    ->subject('Nouvelle demande')
                    ->view('messages.index');
                    // ->attachFromStorage('images/digicom_logo.png');
 
    }
}
