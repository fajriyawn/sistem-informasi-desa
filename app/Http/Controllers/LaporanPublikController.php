<?php

namespace App\Http\Controllers;

use App\Mail\LaporanDiterimaMail;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LaporanPublikController extends Controller
{
    /**
     * Menampilkan halaman form untuk membuat laporan baru.
     */
    public function create()
    {
        $setting = Setting::first();
        $deskripsiDesa = $setting->deskripsi_desa ?? 'Deskripsi belum tersedia.';
        $alamatDesa = $setting->alamat_desa ?? 'alamat belum dicantumkan.';
        $telepon = $setting->telepon ?? 'no. telepon belum dicantumkan.';
        $email = $setting->email ?? 'email belum dicantumkan.';
        $kodePos = $setting->kode_pos ?? 'kode pos belum dicantumkan.';
        $backgroundImage = $setting->background_image ?? 'kode pos belum dicantumkan.';

        return view('laporan.create', compact('deskripsiDesa', 'alamatDesa', 'telepon', 'email', 'kodePos'));
        // return view('laporan.create');
    }

    /**
     * Menyimpan laporan baru yang dikirim dari form.
     */
    public function store(Request $request)
    {
        // Debug log
        \Log::info('LaporanPublikController store method called', [
            'request_data' => $request->all()
        ]);

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

        \Log::info('Service created', [
            'service_id' => $service->id,
            'tracking_code' => $service->tracking_code,
            'email' => $request->email
        ]);

        // Kirim email konfirmasi ke pelapor
        try {
            Mail::to($request->email)->send(new LaporanDiterimaMail($service->tracking_code));
            \Log::info('Email sent successfully', [
                'email' => $request->email,
                'tracking_code' => $service->tracking_code
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to send email', [
                'error' => $e->getMessage(),
                'email' => $request->email,
                'tracking_code' => $service->tracking_code
            ]);
        }

        // Arahkan pengguna ke halaman sukses dengan membawa pesan dan kode tracking
        return redirect()->route('laporan.sukses')
                         ->with([
                             'message' => 'Laporan Anda telah berhasil dikirim!',
                             'tracking_code' => $service->tracking_code
                         ]);
    }
}