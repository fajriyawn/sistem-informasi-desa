<?php

namespace App\Http\Controllers;

use App\Models\Service; // Menggunakan model Service
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Menampilkan halaman utama yang berisi form dan tab.
     */
    public function index()
    {
        return view('services.index');
    }

    /**
     * Menyimpan laporan baru yang dikirim dari form.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'           => 'required|string|max:255',
            'phone'          => 'required|string|max:20',
            'email'          => 'required|email|max:255',
            'title'          => 'required|string|max:255',
            'type'           => 'required|string',
            'city_name'      => 'required|string|max:255',
            'address_detail' => 'required|string|max:255',
            'content'        => 'required|string',
            'attachment'     => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ]);

        $filePath = null;
        if ($request->hasFile('attachment')) {
            $filePath = $request->file('attachment')->store('service-attachments', 'public');
        }

        $trackingCode = strtoupper(Str::random(10));
        while (Service::where('tracking_code', $trackingCode)->exists()) {
            $trackingCode = strtoupper(Str::random(10));
        }

        $dataToSave = $validatedData;
        $dataToSave['file_path'] = $filePath;
        $dataToSave['tracking_code'] = $trackingCode;
        // Hapus 'attachment' dari array karena itu bukan nama kolom di DB
        unset($dataToSave['attachment']);

        $service = Service::create($dataToSave);

        // PENTING: Arahkan ke route 'sukses' yang jelas untuk memutus loop
        return redirect()->route('services.success')
                         ->with([
                             'message' => 'Laporan Anda telah berhasil dikirim!',
                             'tracking_code' => $service->tracking_code
                         ]);
    }

    /**
     * Menampilkan halaman sukses setelah form disubmit.
     */
    public function success()
    {
        // Pastikan session 'message' ada sebelum menampilkan halaman ini
        if (!session('message')) {
            return redirect()->route('services.index');
        }
        return view('services.success');
    }

    /**
     * Menampilkan hasil pelacakan laporan.
     */
    public function track(Request $request)
    {
        $request->validate(['tracking_code' => 'required|string|max:20']);
        $service = Service::where('tracking_code', $request->tracking_code)->first();

        // Kembali ke halaman index dengan membawa hasil pencarian
        return view('services.index', ['service' => $service, 'tab' => 'tracker']);
    }
}
