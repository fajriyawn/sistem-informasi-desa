<?php

namespace App\Http\Controllers;

use App\Models\Download;
use App\Models\Downloadable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function showForm($region, $category, $year)
    {
            // dd($region, $category, $year); // ← Tambahkan ini dulu untuk tes

        return view('frontend.download-form', compact('region', 'category', 'year'));
    }

    public function handleForm(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'region' => 'required|string',
            'category' => 'required|string',
            'year' => 'required|numeric',
        ]);

        $downloadable = Downloadable::where([
            'region' => $request->region,
            'type' => $request->category,
            'year' => $request->year,
        ])->first();

        if (!$downloadable || !Storage::disk('public')->exists($downloadable->file_path)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        Download::create([
            'name' => $request->name,
            'email' => $request->email,
            'region' => $request->region,
            'category' => $request->category,
            'year' => $request->year,
            'file_path' => $downloadable->file_path,
        ]);

        return Storage::disk('public')->download($downloadable->file_path);
    }

}
