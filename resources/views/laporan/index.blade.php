@extends('layouts.app')

@section('content')
{{-- Kontainer utama dengan padding atas (py-24) untuk memberi ruang di bawah navbar fixed --}}
<div class="bg-gray-50 py-24 sm:py-32">
    <div class="max-w-5xl mx-auto px-6 lg:px-8">

        {{-- Judul Halaman --}}
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Layanan Laporan Masyarakat</h1>
            <p class="mt-4 text-lg text-gray-600">Pilih salah satu layanan di bawah ini untuk mengirim aduan atau melacak status laporan Anda.</p>
        </div>

        {{-- Menampilkan pesan sukses setelah submit form dari halaman lain --}}
        @if (session('message'))
            <div class="mt-8 max-w-2xl mx-auto bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                <p class="font-bold">Berhasil!</p>
                <p>{{ session('message') }}
                    @if (session('tracking_code'))
                        Kode pelacakan Anda adalah: <strong class="font-mono bg-green-200 px-2 py-1 rounded">{{ session('tracking_code') }}</strong>. Mohon simpan kode ini.
                    @endif
                </p>
            </div>
        @endif

        {{-- Grid untuk 2 Kartu --}}
        <div class="mt-16 grid grid-cols-1 md:grid-cols-2 gap-8">

            {{-- Kartu 1: Buat Laporan Baru --}}
            <a href="{{ route('laporan.create') }}"
               class="block p-8 bg-white border border-gray-200 rounded-2xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">

                <div class="flex items-center justify-center h-16 w-16 bg-green-100 rounded-xl mb-6">
                    {{-- Ikon Buat Laporan --}}
                    <svg class="h-8 w-8 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                </div>

                <h3 class="text-2xl font-bold text-gray-900">Buat Laporan Baru</h3>
                <p class="mt-2 text-gray-600">Sampaikan aduan, masukan, atau informasi terkait pelayanan dan kondisi pesisir di wilayah Anda.</p>
            </a>

            {{-- Kartu 2: Lacak Laporan --}}
            <a href="{{ route('laporan.tracker.show') }}"
               class="block p-8 bg-white border border-gray-200 rounded-2xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">

                <div class="flex items-center justify-center h-16 w-16 bg-blue-100 rounded-xl mb-6">
                    {{-- Ikon Lacak Laporan --}}
                    <svg class="h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>

                <h3 class="text-2xl font-bold text-gray-900">Lacak Laporan Anda</h3>
                <p class="mt-2 text-gray-600">Periksa status dan perkembangan terbaru dari laporan yang sudah Anda kirimkan menggunakan kode pelacakan.</p>
            </a>

        </div>
    </div>
</div>
@endsection
