<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    public $clientName;
    public $clientPhone;
    public $clientMessage;

    /**
     * Create a new message instance.
     */
    public function __construct($clientMessage, $clientName, $clientPhone)
    {
        //
        $this->clientMessage = $clientMessage;
        $this->clientName = $clientName;
        $this->clientPhone = $clientPhone;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'StellarLink nueva solicitud',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.contact',
            with: [
                'clientMessage' => $this->clientMessage,
                'clientName' => $this->clientName,
                'clientPhone' => $this->clientPhone
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
