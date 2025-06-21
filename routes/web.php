<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\LaporanPublikController;
use App\Http\Controllers\ReportTrackerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index']);


Route::get('/layanan', [ServiceController::class, 'create'])->name('service.form');
Route::post('/layanan', [ServiceController::class, 'store'])->name('service.store');

// Route untuk menampilkan halaman pencarian kode
Route::get('/track', [ReportTrackerController::class, 'index'])->name('tracker.index');
// Route untuk menampilkan hasil pencarian
Route::get('/track/result', [ReportTrackerController::class, 'track'])->name('tracker.track');

// Route untuk menampilkan form laporan
Route::get('/lapor', [LaporanPublikController::class, 'create'])->name('laporan.create');

// Route untuk memproses data dari form saat dikirim
Route::post('/lapor', [LaporanPublikController::class, 'store'])->name('laporan.store');

// Route untuk halaman "sukses" setelah laporan terkirim
Route::get('/lapor/sukses', function () {
    // Pastikan halaman ini hanya bisa diakses setelah berhasil mengirim form
    if (!session('tracking_code')) {
        return redirect()->route('laporan.create');
    }
    return view('laporan.sukses');
})->name('laporan.sukses');