<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $colorPrimary = Setting::first()->color_primary ?? '#0f3a2f';
        $colorSecondary = Setting::first()->color_secondary ?? '#14532d';
        $deskripsiDesa = Setting::first()->deskripsi_desa ?? 'Deskripsi belum tersedia.';
        $alamatDesa = Setting::first()->alamat_desa ?? 'alamat belum dicantumkan.';
        $telepon = Setting::first()->telepon ?? 'no. telepon belum dicantumkan.';
        $email = Setting::first()->email ?? 'email belum dicantumkan.';
        $kodePos = Setting::first()->kode_pos ?? 'kode pos belum dicantumkan.';
        $backgroundImage = Setting::first()->background_image ?? 'kode pos belum dicantumkan.';

        return view('welcome', compact('deskripsiDesa', 'colorPrimary', 'colorSecondary', 'alamatDesa', 'telepon', 'email', 'kodePos'));
    }
}
