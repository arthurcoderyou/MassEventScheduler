<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MassAdminNotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $mass;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $mass)
    {
        $this->user = $user;
        $this->mass = $mass;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->user->send_subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        //Updated into this making an external file for the design of the mail
        return new Content(
            markdown: 'emails.mass_admin_notify_mail',
            with: [
                'user' => $this->user, //pass the user value on the blade layout for the data to be user, other data can be passed here
                'mass' => $this->mass,
            ]
        );
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
