<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param array{name: string, email: string, service: ?string, message: string} $data
     */
    public function __construct(public array $data)
    {
    }

    public function build(): self
    {
        $subject = 'Nouvelle demande — '.($this->data['service'] ?: 'Site SID-TECH');

        return $this
            ->subject($subject)
            ->replyTo($this->data['email'], $this->data['name'])
            ->view('emails.contact');
    }
}
