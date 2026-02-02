<?php

namespace App\Mail;

use App\Models\BotRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BotQuoteMail extends Mailable
{
    use Queueable, SerializesModels;

    public BotRequest $botRequest;

    /**
     * Create a new message instance.
     */
    public function __construct(BotRequest $botRequest)
    {
        $this->botRequest = $botRequest;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Custom Bot Quote – PipLab'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.bot_quote',
            with: [
                'botRequest' => $this->botRequest,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
