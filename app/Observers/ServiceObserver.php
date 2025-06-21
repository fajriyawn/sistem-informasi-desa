<?php

namespace App\Observers;

use App\Models\Service;
use App\Models\User;
use App\Notifications\LaporanBaruDiterima;
use Illuminate\Support\Facades\Notification;

class ServiceObserver
{
    /**
     * Handle the Service "created" event.
     */
    public function created(Service $service): void
    {
        // Ambil semua user admin yang terdaftar
        $admins = User::all();

        // Kirim notifikasi ke semua admin
        Notification::send($admins, new LaporanBaruDiterima($service));
    }
}