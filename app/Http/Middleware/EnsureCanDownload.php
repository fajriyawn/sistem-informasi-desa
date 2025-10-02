<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCanDownload
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil ID file dari URL.
        // Nama 'icmPlan' atau 'socReport' harus sesuai dengan parameter di route Anda.
        $fileId = $request->route('icmPlan') ? $request->route('icmPlan')->id : $request->route('socReport')->id;

        $sessionKey = 'can_download_file_' . $fileId;

        // Cek apakah session key untuk izin download ada dan bernilai true
        if (!$request->session()->has($sessionKey) || $request->session()->get($sessionKey) !== true) {
            // Jika tidak ada izin, alihkan ke halaman awal dengan pesan error
            return redirect()->route('landing')->with('error', 'Akses tidak sah. Silakan isi formulir terlebih dahulu.');
        }

        // Jika izin ada, hapus session key agar tidak bisa digunakan lagi (sekali pakai)
        $request->session()->forget($sessionKey);

        // Lanjutkan request ke controller untuk memulai download
        return $next($request);
    }
}
