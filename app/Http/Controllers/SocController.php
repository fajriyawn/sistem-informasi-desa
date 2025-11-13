<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Models\SocReport;
use Illuminate\Support\Facades\Storage;
use App\Models\DownloadLog;

class SocController extends Controller
{
    public function index()
    {
        $provinceName = 'Jawa Tengah';

        $cities = City::has('socReports')
                      ->with(['socReports' => function ($query) {
                          $query->orderBy('tahun', 'desc');
                      }])
                      // Tambahkan dua baris orderBy ini:
                      ->orderByRaw("CASE WHEN name = ? THEN 0 ELSE 1 END", [$provinceName])
                      ->orderBy('name', 'asc')
                      ->get();

        return view('soc.index', compact('cities'));
    }

    public function show(Request $request, City $city)
    {
        // Ambil semua laporan SOC milik kota ini, urutkan tahun terbaru
        // Kita butuh ini untuk membuat navigasi daftar tahun di bagian atas
        $availableReports = $city->socReports()->orderBy('tahun', 'desc')->get();

        // Tentukan laporan mana yang mau ditampilkan
        // Jika ada parameter ?year=2022 di URL, cari tahun itu
        // Jika tidak ada, ambil yang paling baru (first)
        $selectedYear = $request->query('year');

        if ($selectedYear) {
            $report = $availableReports->where('tahun', $selectedYear)->first();
        } else {
            $report = $availableReports->first();
        }

        // Jika tidak ada laporan sama sekali untuk kota ini
        if (!$report) {
            return redirect()->route('soc.index')->with('error', 'Belum ada laporan untuk kota ini.');
        }

        return view('soc.show', compact('city', 'availableReports', 'report'));
    }

    // Method untuk menampilkan halaman form
    public function showDownloadForm(SocReport $report)
    {
        return view('soc.download_form', compact('report'));
    }

    // Method untuk memproses form & download
    public function processDownload(Request $request, SocReport $report)
    {
        // 1. Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // 2. Simpan data ke log
        $report->downloadLogs()->create($validated);

        // 3. Cek file dan mulai download dengan nama asli
        if ($report->file_laporan && Storage::disk('public')->exists($report->file_laporan)) {
            $filename = $report->original_filename ?? basename($report->file_laporan);
            return Storage::disk('public')->download($report->file_laporan, $filename);
        }

        return back()->with('error', 'File tidak ditemukan.');
    }
}
