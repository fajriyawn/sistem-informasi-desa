<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Mail\LaporanDiterimaMail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

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
        // 1. Validasi form
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'nomor_telepon' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'judul_laporan' => 'required|string|max:255',
            'tipe_laporan' => 'required|string|max:50',
            'kabupaten_kota_lokasi' => 'required|string|max:50',
            'detail_alamat' => 'required|string|max:255',
            'isi_laporan' => 'required|string',
            'lampiran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'g-recaptcha-response' => 'required|string',
        ]);

        // 2. Validasi reCAPTCHA manual
        $recaptchaResponse = $validated['g-recaptcha-response'];
        $recaptchaSecret = config('services.recaptcha.secret_key') ?? config('services.recaptcha.secret');
        $recaptcha = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $recaptchaSecret,
            'response' => $recaptchaResponse,
            'remoteip' => $request->ip(),
        ]);
        $recaptchaData = $recaptcha->json();
        if (!($recaptchaData['success'] ?? false)) {
            throw ValidationException::withMessages([
                'g-recaptcha-response' => ['Verifikasi captcha gagal, silakan coba lagi.'],
            ]);
        }

        // 3. Proses file lampiran
        $lampiranPath = null;
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('lampiran_laporan', 'public');
        }

        // 4. Generate kode tracking unik
        $kodeTracking = strtoupper(Str::random(10));

        // 5. Simpan ke database
        $laporan = new Service();
        $laporan->name = $validated['nama_lengkap'];
        $laporan->phone = $validated['nomor_telepon'];
        $laporan->email = $validated['email'];
        $laporan->title = $validated['judul_laporan'];
        $laporan->type = $validated['tipe_laporan'];
        $laporan->city_name = $validated['kabupaten_kota_lokasi'];
        $laporan->address_detail = $validated['detail_alamat'];
        $laporan->content = $validated['isi_laporan'];
        $laporan->attachment = $lampiranPath;
        $laporan->tracking_code = $kodeTracking;
        $laporan->status = 'Baru Masuk';
        $laporan->save();

        // 6. Kirim email notifikasi ke pelapor
        Mail::to($laporan->email)->send(new LaporanDiterimaMail($kodeTracking));

        // 7. Redirect ke halaman sukses dengan kode tracking di session
        return redirect()->route('laporan.sukses')->with('tracking_code', $kodeTracking);
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

        
        $laporan = Service::where('tracking_code', $request->tracking_code)->first();

        return view('laporan.tracker', compact('laporan'))->withInput($request->all());
    }
}
