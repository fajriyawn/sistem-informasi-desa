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
            @forelse ($cities as $city)
                {{-- Akordion untuk satu kota --}}
                <div x-data="{ open: false }" class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                    {{-- Tombol untuk Buka/Tutup Akordion Kota --}}
                    <button @click="open = !open" class="w-full flex justify-between items-center p-5 text-left">
                        <span class="text-xl font-bold text-gray-800">{{ $city->name }}</span>
                        <svg :class="{'rotate-180': open}" class="w-6 h-6 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>

                    {{-- Konten Akordion Kota (muncul saat di-klik) --}}
                    <div x-show="open" x-transition class="p-5 border-t border-gray-200 space-y-3">
                        {{-- Loop untuk setiap laporan (tahun) di dalam kota --}}
                        @foreach ($city->socReports as $report)
                            {{-- Akordion untuk satu tahun --}}
                            <div x-data="{ openYear: false }" class="border border-gray-200 rounded-md">
                                {{-- Tombol untuk Buka/Tutup Akordion Tahun --}}
                                <button @click="openYear = !openYear" class="w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100 text-left">
                                    <span class="font-semibold text-gray-700">Tahun {{ $report->tahun }}</span>
                                    <svg :class="{'rotate-180': openYear}" class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>

                                {{-- Konten Akordion Tahun (muncul saat di-klik) --}}
                                <div x-show="openYear" x-transition class="p-4 space-y-6">
                                    {{-- Tampilkan screenshot jika ada --}}
                                    @if ($report->ss_lingkungan)
                                    <div>
                                        <h4 class="font-semibold mb-2">Status Lingkungan Pesisir</h4>
                                        <img src="{{ Storage::url($report->ss_lingkungan) }}" alt="Status Lingkungan Pesisir" class="w-full rounded-md shadow-md">
                                    </div>
                                    @endif

                                    @if ($report->ss_tata_kelola)
                                    <div>
                                        <h4 class="font-semibold mb-2">Diagram Radar Tata Kelola</h4>
                                        <img src="{{ Storage::url($report->ss_tata_kelola) }}" alt="Diagram Radar Tata Kelola" class="w-full rounded-md shadow-md">
                                    </div>
                                    @endif

                                    @if ($report->ss_pembangunan)
                                    <div>
                                        <h4 class="font-semibold mb-2">Diagram Radar Pembangunan Berkelanjutan</h4>
                                        <img src="{{ Storage::url($report->ss_pembangunan) }}" alt="Diagram Radar Pembangunan" class="w-full rounded-md shadow-md">
                                    </div>
                                    @endif

                                    @if ($report->ss_matriks_icm)
                                    <div>
                                        <h4 class="font-semibold mb-2">Matriks Penilaian Capaian Indikator ICM</h4>
                                        <img src="{{ Storage::url($report->ss_matriks_icm) }}" alt="Matriks Penilaian ICM" class="w-full rounded-md shadow-md">
                                    </div>
                                    @endif

                                    @if ($report->file_laporan)
                                        <div class="pt-4 border-t border-gray-200 text-right">
                                            <a href="{{ route('soc.download.form', $report) }}" 
                                            class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-800 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                                Download Laporan
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="text-center py-10 px-4 bg-white rounded-lg shadow-sm">
                    <p class="text-gray-500">Belum ada data laporan SOC yang tersedia.</p>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection