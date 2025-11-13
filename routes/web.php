<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\IcmPlanController;
use App\Http\Controllers\LayananController;      // Digunakan untuk semua fitur di /layanan
use App\Http\Controllers\LaporanPublikController; // Digunakan untuk semua fitur di /laporan

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini adalah tempat Anda mendaftarkan semua rute untuk aplikasi Anda.
|
*/

// == HALAMAN UTAMA ==
// Hanya ada satu definisi untuk '/', menggunakan HomeController adalah praktik terbaik.
Route::get('/', [HomeController::class, 'index'])->name('landing');


// == HALAMAN LAYANAN ==
// Menggunakan grup agar lebih rapi dan semua rute dihandle oleh LayananController.
Route::controller(LayananController::class)->group(function () {
    Route::get('/layanan', 'index')->name('layanan.index');
    // Rute untuk form dan proses pengajuan rehabilitasi
    Route::get('/layanan/pengajuan-rehabilitasi', 'showProposalForm')->name('layanan.proposal.form');
    Route::post('/layanan/pengajuan-rehabilitasi', 'storeProposal')->name('layanan.proposal.store');
    // Rute untuk form dan proses pengajuan pelatihan
    Route::get('/layanan/pengajuan-pelatihan', 'showTrainingForm')->name('layanan.training.form');
    Route::post('/layanan/pengajuan-pelatihan', 'storeTraining')->name('layanan.training.store');
});


// == HALAMAN PELAPORAN MASYARAKAT ==
// Menggunakan grup dan URI yang konsisten (/laporan/*)
Route::controller(LaporanPublikController::class)->group(function () {
    Route::get('/laporan', 'index')->name('laporan.index');
    Route::get('/laporan/buat', 'create')->name('laporan.create');
    Route::post('/laporan/buat', 'store')->name('laporan.store')
        ->middleware('throttle:5,1');

    // Ini adalah route untuk menampilkan form pelacakan
    Route::get('/laporan/lacak', 'showTracker')->name('laporan.tracker.show');

    // Ini adalah route untuk MEMPROSES form pelacakan
    Route::post('/laporan/lacak', 'track')->name('laporan.tracker.track');
});
// Route untuk halaman sukses (di luar grup karena tidak ada di controller)
Route::get('/laporan/sukses', function () {
    if (session('tracking_code')) {
        return view('laporan.sukses');
    }
    return redirect()->route('laporan.index');
})->name('laporan.sukses');


// == HALAMAN STATE OF THE COAST (SOC) ==
Route::controller(SocController::class)->group(function () {
    Route::get('/soc', 'index')->name('soc.index');
    Route::get('/soc/kota/{city}', 'show')->name('soc.show');
    Route::post('/soc/download/{report}', 'processDownload')->name('soc.download.process');
});

Route::get('/icm-plan', [IcmPlanController::class, 'index'])->name('icm_plan.index');
Route::get('/icm-plan/download/{icmPlan}', [IcmPlanController::class, 'download'])->name('icm_plan.download');
Route::get('/icm-plan/download-form/{icmPlan}', [IcmPlanController::class, 'showDownloadForm'])->name('icm_plan.download.form');
// Route::post('/icm-plan/download/{icmPlan}', [IcmPlanController::class, 'processDownload'])->name('icm_plan.download.process');
Route::post('/icm-plan/process-download/{icmPlan}', [IcmPlanController::class, 'processDownload'])->name('icm_plan.download.process');
Route::get('/icm-plan/download/{icmPlan}', [IcmPlanController::class, 'downloadFile'])->name('icm_plan.download.file')->middleware('can.download');

// == HALAMAN GALERI ==
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');


/*
// --- Rute yang Tidak Aktif ---
// Route::get('/download/form/{region}/{category}/{year}', [DownloadController::class, 'showForm'])->name('file.download.form');
// Route::post('/download/submit', [DownloadController::class, 'handleForm'])->name('file.download.submit');
// Route::get('/downloads', [FileDownloadViewController::class, 'index'])->name('downloads.list');
*/
