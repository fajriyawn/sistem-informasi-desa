<?php

namespace App\Http\Controllers;

use App\Models\Service;
<<<<<<< HEAD
=======
use App\Models\Setting;
>>>>>>> d1e372a (Update 23 Juli)
use Illuminate\Http\Request;

class LaporanPublikController extends Controller
{
    /**
     * Menampilkan halaman form untuk membuat laporan baru.
     */
    public function create()
    {
<<<<<<< HEAD
        return view('laporan.create');
=======
        $setting = Setting::first();
        $deskripsiDesa = $setting->deskripsi_desa ?? 'Deskripsi belum tersedia.';
        $alamatDesa = $setting->alamat_desa ?? 'alamat belum dicantumkan.';
        $telepon = $setting->telepon ?? 'no. telepon belum dicantumkan.';
        $email = $setting->email ?? 'email belum dicantumkan.';
        $kodePos = $setting->kode_pos ?? 'kode pos belum dicantumkan.';
        $backgroundImage = $setting->background_image ?? 'kode pos belum dicantumkan.';

        return view('laporan.create', compact('deskripsiDesa', 'alamatDesa', 'telepon', 'email', 'kodePos'));
        // return view('laporan.create');
>>>>>>> d1e372a (Update 23 Juli)
    }

    /**
     * Menyimpan laporan baru yang dikirim dari form.
     */
    public function store(Request $request)
    {
        //Validasi data yang masuk
        $validatedData = $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'email'   => 'required|email|max:255',
            'title'   => 'required|string|max:255',
            'type'    => 'required|string',
            'content' => 'required|string',
            
        ]);

         $dataToSave = $validatedData;
         $dataToSave['type'] = 'laporan'; 

        // Simpan data ke database.
    
        $service = Service::create($validatedData);

        // Arahkan pengguna ke halaman sukses dengan membawa pesan dan kode tracking
        return redirect()->route('laporan.sukses')
                         ->with([
                             'message' => 'Laporan Anda telah berhasil dikirim!',
                             'tracking_code' => $service->tracking_code
                         ]);
    }
}