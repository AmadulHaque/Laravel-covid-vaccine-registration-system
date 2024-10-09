<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VaccineEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $center;
    public $scheduledDate;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $center
     * @param $scheduledDate
     */
    public function __construct($user, $center, $scheduledDate)
    {
        $this->user = $user;
        $this->center = $center;
        $this->scheduledDate = $scheduledDate;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your COVID Vaccine Appointment Reminder',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.vaccine_reminder',  // Blade view file
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
