<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
// --- TAMBAHKAN USE STATEMENT INI ---
use App\Models\Service;
use App\Models\User;

class LaporanBaruDiterima extends Notification
{
    use Queueable;

    // Properti untuk menyimpan data laporan yang baru dibuat
    public Service $service;

    /**
     * Create a new notification instance.
     * Kita modifikasi agar menerima objek Service.
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Get the notification's delivery channels.
     * Kita ubah dari ['mail'] menjadi ['database'].
     *
     * @return array<int, string>
     */
    public function via(User $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the database representation of the notification.
     * Method ini mendefinisikan data yang akan disimpan di tabel notifications.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(User $notifiable): array
    {
        return [
            // Data ini akan digunakan oleh Filament untuk menampilkan notifikasi
            'service_id' => $this->service->id,
            'title'      => 'Laporan Baru Diterima!',
            'body'       => "Laporan '{$this->service->title}' dari {$this->service->name} telah masuk ke sistem.",
        ];
    }
    
    /**
     * Get the array representation of the notification.
     * Kita bisa biarkan ini kosong karena kita menggunakan toDatabase().
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}