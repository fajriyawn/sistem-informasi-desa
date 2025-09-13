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
