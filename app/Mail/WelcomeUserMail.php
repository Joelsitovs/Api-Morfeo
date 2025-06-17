<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeUserMail extends Mailable
{

    use Queueable, SerializesModels;

    public $user; // el usuario al que se le enviará el mail

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('¡Bienvenido!')
            ->view('emails.welcome_user');

    }


    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
