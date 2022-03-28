<?php

namespace App\Mail;

use App\Models\Request;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SbeeMarkdownMail extends Mailable
{
    use Queueable, SerializesModels;

    public $url = '';

    public $data = [];
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $name, $surname, $user_id, $url)
    {
        $the_user = auth()->user();
        $user_id = auth()->user()->id;

        $this->data['email'] = $email;
        $this->data['name'] = $name;
        $this->data['surname'] = $surname;
        $this->data['user_id'] = $user_id;
        $this->url = $url;

        $req = Request::whereRaw("user_id = $user_id")->orderByDesc('created_at')->limit(1)->get();

        foreach($req as $r){
            $this->url = 'http://127.0.0.1:8000/user/requests/'.$r->id;
        }

    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->data['email'])
                    ->subject("Nouvelle demande")
                    ->markdown('emails.sbee-markdown');
    }
}
