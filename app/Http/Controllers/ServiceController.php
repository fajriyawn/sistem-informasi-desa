<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function create()
    {
        return view('frontend.service-form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'keluhan' => 'required|string',
        ]);

        Service::create($request->only(['nama', 'alamat', 'keluhan']));

        return redirect()->back()->with('success', 'Keluhan berhasil dikirim!');
    }
}
