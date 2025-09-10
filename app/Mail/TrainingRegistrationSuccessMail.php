<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TrainingRegistrationSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Data pendaftaran pelatihan
     *
     * @var array
     */
    public $trainingData;

    /**
     * Create a new message instance.
     *
     * @param array $trainingData
     */
    public function __construct(array $trainingData)
    {
        $this->trainingData = $trainingData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pendaftaran Pelatihan Berhasil - SIMPANDU')
                    ->view('emails.training-success');
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
