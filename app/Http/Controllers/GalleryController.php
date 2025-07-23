<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        // Ambil data, urutkan berdasarkan terbaru, dan bagi per 6 item per halaman
        $items = GalleryItem::latest('published_at')->paginate(6);
        return view('gallery.index', compact('items'));
    }
}