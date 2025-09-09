@extends('layouts.app')

@section('content')
{{-- Kontainer utama dengan padding atas untuk memberi ruang di bawah navbar fixed --}}
<div class="bg-gray-50 py-24 sm:py-32">
    <div class="max-w-2xl mx-auto px-4 text-center">
        <div class="bg-white p-8 sm:p-12 rounded-2xl shadow-lg">

            {{-- Ikon Sukses --}}
            <div class="mx-auto flex items-center justify-center h-20 w-20 bg-green-100 rounded-full mb-6">
                <svg class="h-12 w-12 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>

            {{-- Pesan Sukses --}}
            <h1 class="text-3xl font-extrabold text-gray-900">Laporan Berhasil Dikirim!</h1>

            @if (session('message'))
                <p class="mt-4 text-gray-600">{{ session('message') }}</p>
            @endif

            {{-- Kode Pelacakan --}}
            @if (session('tracking_code'))
                <div class="mt-6">
                    <p class="text-gray-600">Mohon simpan kode pelacakan Anda:</p>
                    <div class="mt-2 inline-block bg-gray-100 text-gray-800 text-2xl font-mono font-bold px-6 py-3 rounded-lg border border-gray-200">
                        {{ session('tracking_code') }}
                    </div>
                </div>
            @endif

            {{-- Tombol Aksi --}}
            <div class="mt-8">
                {{-- INI ADALAH PERBAIKANNYA: Menggunakan route('laporan.tracker.show') --}}
                <a href="{{ route('laporan.tracker.show', ['tracking_code' => session('tracking_code')]) }}"
                   class="inline-block w-full sm:w-auto px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition-colors">
                    Lacak Laporan Sekarang
                </a>
                <a href="{{ route('landing') }}"
                   class="mt-4 sm:mt-0 sm:ml-4 inline-block w-full sm:w-auto px-6 py-3 text-gray-700 font-semibold">
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
