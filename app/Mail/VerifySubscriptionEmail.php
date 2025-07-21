<?php

namespace App\Mail;

use App\Models\MailList;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeEncrypted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifySubscriptionEmail extends Mailable implements ShouldQueue,ShouldBeEncrypted
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $subscriber;
    public function __construct(MailList $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verify Newsletter Subscription Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.verify-subscription-email',
            with: ['verificationUrl' => url('/verify-subscription/' . $this->subscriber->verification_token)]
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
