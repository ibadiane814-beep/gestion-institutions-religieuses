<?php
namespace App\Mail;
use App\Models\Mariage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MariageConfirmation extends Mailable
{
    use Queueable, SerializesModels;
    public function __construct(public Mariage $mariage) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: '✅ Confirmation de votre demande de mariage');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.mariage-confirmation');
    }
}