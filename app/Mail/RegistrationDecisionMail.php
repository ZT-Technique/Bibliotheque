<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationDecisionMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public bool $approved;
    public ?string $reason;

    public function __construct(User $user, bool $approved, ?string $reason = null)
    {
        $this->user = $user;
        $this->approved = $approved;
        $this->reason = $reason;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->approved
                ? 'Votre compte a été approuvé - Bibliothèque INOHA'
                : 'Mise à jour de votre demande de compte - Bibliothèque INOHA',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.registration-decision',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
