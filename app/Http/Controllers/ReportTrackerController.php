<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ReportTrackerController extends Controller
{
    // Menampilkan halaman form pencarian
    public function index()
    {
<<<<<<< HEAD
        return view('tracker.index');
=======
        return view('tracker.lacak');
>>>>>>> d1e372a (Update 23 Juli)
    }

    // Memproses pencarian dan menampilkan hasil
    public function track(Request $request)
    {
        $request->validate([
            'tracking_code' => 'required|string|max:20',
        ]);

        $service = Service::where('tracking_code', $request->tracking_code)->first();

        if (!$service) {
<<<<<<< HEAD
            return redirect()->route('tracker.index')->with('error', 'Kode Tracking tidak ditemukan.');
=======
            return redirect()->route('tracker.lacak')->with('error', 'Kode Tracking tidak ditemukan.');
>>>>>>> d1e372a (Update 23 Juli)
        }

        return view('tracker.show', compact('service'));
    }
}