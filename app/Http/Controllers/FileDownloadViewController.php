<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Downloadable;
use Illuminate\Support\Facades\View;

class FileDownloadViewController extends Controller
{
    public function index()
    {
        // Grouping berdasarkan region lalu type
        $grouped = Downloadable::orderBy('region')
            ->get()
            ->groupBy('region')
            ->map(fn ($items) => $items->groupBy('type'));

        // dd($grouped);

        return view('frontend.download-list', compact('grouped'));
    }
}
