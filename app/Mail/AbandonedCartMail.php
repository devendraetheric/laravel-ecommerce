<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AbandonedCartMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userData;

    public function __construct(User $userData)
    {
        $this->userData = $userData;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'You left items in your cart',
            replyTo: $this->userData['email'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'front.abandoned_cart',
            with: [
                'userData' => $this->userData,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
