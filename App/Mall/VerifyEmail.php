<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $mailContent;

    public function __construct($userName, $mailContent)
    {
        $this->userName = $userName;
        $this->mailContent = $mailContent;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thông báo từ Blog Mỹ Phẩm',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.verify',
            with: [
                'name' => $this->userName,
                'content' => $this->mailContent
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}