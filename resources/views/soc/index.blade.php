@extends('layouts.app')

@section('content')

{{-- Kontainer utama dengan padding atas untuk memberi ruang di bawah navbar fixed --}}
<div class="bg-gray-50 py-24 sm:py-32">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Judul Halaman --}}
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-gray-800 tracking-tight">State of the Coast</h1>
            <p class="mt-2 text-lg text-gray-600">Laporan kondisi pesisir di kota/kabupaten pesisir Jawa Tengah.</p>
        </div>

        {{-- Daftar Akordion Kota --}}
        <div class="space-y-4">
            {{-- Loop untuk setiap kota --}}
            {{-- Grid Daftar Kota --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            @forelse ($cities as $city)
                <a href="{{ route('soc.show', $city) }}" class="group block bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center justify-center w-12 h-12 bg-green-50 text-green-600 rounded-lg group-hover:bg-green-600 group-hover:text-white transition-colors">
                                {{-- Ikon Peta / Lokasi --}}
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            {{-- Badge jumlah laporan --}}
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $city->socReports->count() }} Laporan
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-green-600 transition-colors">{{ $city->name }}</h3>
                        <p class="mt-2 text-sm text-gray-500">
                            Klik untuk melihat detail laporan SOC, grafik analisis, dan mengunduh dokumen lengkap.
                        </p>
                    </div>
                    <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 flex justify-between items-center">
                        <span class="text-xs text-gray-500 font-medium">Terbaru: {{ $city->socReports->first()->tahun ?? '-' }}</span>
                        <span class="text-sm text-green-600 font-semibold group-hover:translate-x-1 transition-transform">Lihat Detail &rarr;</span>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">Belum ada data kota yang tersedia.</p>
                </div>
            @endforelse
        </div>
        </div>

    </div>
</div>
@endsection
