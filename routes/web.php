<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\LaporanPublikController;
use App\Http\Controllers\ReportTrackerController;
use App\Http\Controllers\FileDownloadViewController;
use App\Http\Controllers\SocController;
use App\Http\Controllers\GalleryController;

Route::get('/', function () {
    $colorPrimary = '#0F3A2F'; 
    // $backgroundImage = 'hero-background.jpg';
    return view('welcome', compact('colorPrimary', 'backgroundImage'));
})->name('landing');

Route::get('/', [HomeController::class, 'index']);


Route::get('/layanan', [ServiceController::class, 'create'])->name('service.form');
Route::post('/layanan', [ServiceController::class, 'store'])->name('service.store');

// Route untuk menampilkan halaman pencarian kode
Route::get('/track', [ReportTrackerController::class, 'index'])->name('laporan.index');

// Route untuk menampilkan hasil pencarian
Route::get('/track/result', [ReportTrackerController::class, 'track'])->name('tracker.lacak');

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

Route::get('/pelaporan', function () {
    return view('laporan.index');
})->name('pelaporan');

// Route::get('/download/form/{region}/{category}/{year}', [DownloadController::class, 'showForm'])->name('file.download.form');
// Route::post('/download/submit', [DownloadController::class, 'handleForm'])->name('file.download.submit');

// Route::get('/downloads', [FileDownloadViewController::class, 'index'])->name('downloads.list');

Route::get('/soc', [SocController::class, 'index'])->name('soc.index');

// Route untuk menampilkan form
Route::get('/soc/download-form/{report}', [SocController::class, 'showDownloadForm'])->name('soc.download.form');
// Route untuk memproses form dan memulai download
Route::post('/soc/download/{report}', [SocController::class, 'processDownload'])->name('soc.download.process');

Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');
