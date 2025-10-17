<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StatusUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $namaPengguna;
    public $statusBaru;
    public $catatanAdmin;
    public $namaModul;

    /**
     * Create a new message instance.
     */
    public function __construct($namaPengguna, $statusBaru, $catatanAdmin, $namaModul)
    {
        $this->namaPengguna = $namaPengguna;
        $this->statusBaru = $statusBaru;
        $this->catatanAdmin = $catatanAdmin;
        $this->namaModul = $namaModul;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Pembaruan Status {$this->namaModul} Anda - SIMPANDU",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.status-update',
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
