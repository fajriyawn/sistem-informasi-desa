<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class LaporanPublikController extends Controller
{
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