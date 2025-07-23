<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema; // 1. Tambahkan ini
use App\Models\Setting;
>>>>>>> d1e372a (Update 23 Juli)

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
<<<<<<< HEAD
        //
    }
}
=======
        // 2. Bungkus semua logika dengan pengecekan ini
        if (Schema::hasTable('settings')) {
            // Ambil 1 baris data setting
            $setting = Setting::first();

            // Jika tidak ada data sama sekali, hindari error dan gunakan nilai default
            if (!$setting) {
                View::share('colorPrimary', '#0f3a2f');
                View::share('colorSecondary', '#ffffff');
                View::share('backgroundImage', '#ffffff');
                View::share('deskripsiDesa', 'Deskripsi belum tersedia');
                View::share('alamatDesa', 'Alamat belum dicantumkan');
                View::share('email', 'Email belum dicantumkan');
                View::share('telepon', 'Nomor telepon belum dicantumkan');
                View::share('kodePos', 'Kode pos belum dicantumkan');
                return; // Hentikan eksekusi jika tidak ada setting
            }

            // Share global ke semua view dari data yang ada di database
            View::share([
                'colorPrimary' => $setting->color_primary ?? '#0f3a2f',
                'colorSecondary' => $setting->color_secondary ?? '#ffffff',
                'backgroundImage' => $setting->background_image ?? '#ffffff',
                'deskripsiDesa' => $setting->deskripsi_desa ?? 'Deskripsi belum tersedia',
                'alamatDesa' => $setting->alamat_desa ?? 'Alamat belum dicantumkan',
                'email' => $setting->email ?? 'Email belum dicantumkan',
                'telepon' => $setting->telepon ?? 'Nomor telepon belum dicantumkan',
                'kodePos' => $setting->kode_pos ?? 'Kode pos belum dicantumkan',
            ]);
        }
    }
}
>>>>>>> d1e372a (Update 23 Juli)
