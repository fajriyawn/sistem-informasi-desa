<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Service; // <-- TAMBAHKAN ATAU PASTIKAN BARIS INI ADA

class LaporanPublikController extends Controller
{
    /**
     * Menampilkan halaman menu utama (dengan 2 kartu).
     */
    public function index()
    {
        return view('laporan.index');
    }

    /**
     * Menampilkan halaman form untuk membuat laporan baru.
     */
    public function create()
    {
        return view('laporan.create');
    }

    /**
     * Menyimpan laporan baru yang dikirim dari form.
     */
    public function store(Request $request)
    {
        // ... Logika store Anda
    }

    /**
     * Menampilkan halaman form untuk melacak laporan.
     */
    public function showTracker()
    {
        return view('laporan.tracker', ['laporan' => null]);
    }

    /**
     * Memproses & menampilkan hasil pelacakan laporan.
     */
    public function track(Request $request)
    {
        $request->validate(['tracking_code' => 'required|string|max:20']);

        // Baris ini yang menyebabkan error jika 'use App\Models\Laporan;' tidak ada
        $laporan = Service::where('tracking_code', $request->tracking_code)->first();

        return view('laporan.tracker', compact('laporan'))->withInput($request->all());
    }
}
