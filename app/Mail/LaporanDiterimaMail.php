<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LaporanDiterimaMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Kode tracking laporan
     *
     * @var string
     */
    public $kodeTracking;

    /**
     * Create a new message instance.
     *
     * @param string $kodeTracking
     */
    public function __construct($kodeTracking)
    {
        $this->kodeTracking = $kodeTracking;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Laporan Anda Telah Diterima - SIMPANDU',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.laporan-diterima',
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

    /**
     * Build the message (Legacy method for compatibility).
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Laporan Anda Telah Diterima - SIMPANDU')
                    ->view('emails.laporan-diterima');
    }
}
