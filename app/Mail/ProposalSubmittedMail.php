<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProposalSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Data pengajuan proposal
     *
     * @var array
     */
    public $proposalData;

    /**
     * Create a new message instance.
     *
     * @param array $proposalData
     */
    public function __construct(array $proposalData)
    {
        $this->proposalData = $proposalData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pengajuan Rehabilitasi Anda Telah Diterima - SIMPANDU')
                    ->view('emails.proposal-submitted');
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
