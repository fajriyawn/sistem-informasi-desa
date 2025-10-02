<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Failed; // <-- Import event bawaan
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request; // <-- Import Request

class LogSuspiciousLoginAttempt
{
    /**
     * Create the event listener.
     */
    public function __construct(protected Request $request)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Failed $event): void
    {
        // Cek jika ada kredensial yang diberikan
        if (!empty($event->credentials)) {
            Log::warning('Percobaan login gagal terdeteksi', [
                'ip_address' => $this->request->ip(),
                // 'email_attempted' => $event->credentials['email'],
                'user_agent' => $this->request->userAgent(),
            ]);
        }
    }
}
