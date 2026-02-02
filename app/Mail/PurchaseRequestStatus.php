<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Purchase;

class PurchaseRequestStatus extends Mailable
{
    use Queueable, SerializesModels;

    public $purchaseRequest;
    public $status;

    /**
     * Create a new message instance.
     */
    public function __construct(Purchase $purchaseRequest, $status)
    {
        $this->purchaseRequest = $purchaseRequest;
        $this->status = $status;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Purchase Request Status Update'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.purchaseRequestStatus', // Update to the correct view path
            with: [
                'purchaseRequest' => $this->purchaseRequest,
                'status' => ucfirst($this->status),
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
