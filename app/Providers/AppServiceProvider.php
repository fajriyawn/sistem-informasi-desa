<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema; 
use App\Models\Setting;

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
        if ($this->app->isProduction()) {
            URL::forceScheme('https');
        }

        if (Schema::hasTable('settings')) {
            $setting = Setting::first();

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
