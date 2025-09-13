<?php
namespace App\Http\Controllers;

use App\Models\City;
use App\Models\IcmPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IcmPlanController extends Controller
{
    public function index()
    {
        $provinceName = 'Provinsi Jawa Tengah'; // Sesuaikan jika perlu
        $cities = City::has('icmPlans')
            ->with(['icmPlans' => fn($q) => $q->orderBy('tahun', 'desc')])
            ->orderByRaw("CASE WHEN name = ? THEN 0 ELSE 1 END", [$provinceName])
            ->orderBy('name', 'asc')
            ->get();
        return view('icm_plan.index', compact('cities'));
    }

    public function download(IcmPlan $icmPlan)
    {
        // GANTI 'file_path' MENJADI 'file_laporan' DI SINI
        if ($icmPlan->file_laporan && Storage::disk('public')->exists($icmPlan->file_laporan)) {

            $filename = $icmPlan->original_filename ?? basename($icmPlan->file_laporan);

            // DAN GANTI JUGA DI SINI
            return Storage::disk('public')->download($icmPlan->file_laporan, $filename);
        }

        return back()->with('error', 'File tidak ditemukan.');
    }

    public function showDownloadForm(IcmPlan $icmPlan)
    {
        // Kita bisa buat satu view form generik jika mau, tapi untuk sekarang kita pisah
        return view('icm_plan.download_form', ['plan' => $icmPlan]);
    }

    // Method untuk memproses form & download
    public function processDownload(Request $request, IcmPlan $icmPlan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Logika create sekarang menggunakan relasi polimorfik
        $icmPlan->downloadLogs()->create($validated);

        // Panggil method download yang sudah ada
        return $this->download($icmPlan);
    }
}
