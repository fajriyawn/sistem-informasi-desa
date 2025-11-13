<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'reviewable_id' => 'required',
            'reviewable_type' => 'required|string',
            'content' => 'required|string|min:3',
            'name' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        Review::create($request->all());

        return redirect()->back()->with('success', 'Ulasan Anda berhasil dikirim.');
    }
}