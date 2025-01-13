<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormReply extends Mailable
{
    use Queueable, SerializesModels;
    public $userName;
    public $replyMessage;
    public $userEmail;
    public $adminEmail;

    /**
     * Create a new message instance.
     */
    public function __construct($userName, $userEmail, $replyMessage, $adminEmail)
    {
        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->replyMessage = $replyMessage;
        $this->adminEmail = $adminEmail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact Form Reply from Admin',
            from: $this->adminEmail,
            to: [$this->userEmail, env('MAIL_TO_ADDRESS')],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact_form_reply',
            with: [
                'userName' => $this->userName,
                'replyMessage' => $this->replyMessage,
            ],
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
