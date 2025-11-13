@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-24 sm:py-32 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- HEADER: Navigasi Breadcrumb & Judul --}}
        <div class="mb-8">
            <a href="{{ route('soc.index') }}" class="text-sm text-green-600 hover:underline mb-2 inline-block">&larr; Kembali ke Daftar Daerah</a>
            <h1 class="text-3xl font-extrabold text-gray-900">State of the Coast: {{ $city->name }}</h1>
            <p class="text-gray-600 mt-1">Laporan kondisi pesisir dan analisis data.</p>
        </div>

        {{-- SECTION ATAS: Daftar Tahun --}}
        <div class="mb-10 overflow-x-auto">
            <div class="flex space-x-2 border-b border-gray-200 pb-2">
                @foreach($availableReports as $history)
                    <a href="{{ route('soc.show', ['city' => $city->id, 'year' => $history->tahun]) }}"
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 whitespace-nowrap
                       {{ $report->id == $history->id
                          ? 'bg-green-600 text-white shadow-md'
                          : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
                        Tahun {{ $history->tahun }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- LAYOUT UTAMA: Kiri (Preview) & Kanan (Form) --}}
        <div class="lg:grid lg:grid-cols-3 lg:gap-10">

            {{-- KOLOM KIRI: Preview File / Gambar (2/3 layar) --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- Kartu Informasi Dokumen --}}
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Ringkasan Laporan {{ $report->tahun }}</h2>
                    <div class="prose max-w-none text-gray-600">
                        {{-- Jika Anda punya kolom deskripsi di soc_reports, tampilkan disini --}}
                        <p>Berikut adalah pratinjau visual dari indikator utama State of the Coast untuk {{ $city->name }} tahun {{ $report->tahun }}. Unduh dokumen lengkap di sebelah kanan untuk analisis mendalam.</p>
                    </div>
                </div>

                {{-- Loop Gambar Preview --}}
                {{-- 1. Status Lingkungan --}}
                @if($report->ss_lingkungan)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                    <div class="p-4 border-b bg-gray-50"><h3 class="font-semibold text-gray-700">1. Status Lingkungan Pesisir</h3></div>
                    <img src="{{ Storage::url($report->ss_lingkungan) }}" alt="Status Lingkungan" class="w-full h-auto object-contain">
                </div>
                @endif

                {{-- 2. Tata Kelola --}}
                @if($report->ss_tata_kelola)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                    <div class="p-4 border-b bg-gray-50"><h3 class="font-semibold text-gray-700">2. Diagram Radar Tata Kelola</h3></div>
                    <img src="{{ Storage::url($report->ss_tata_kelola) }}" alt="Tata Kelola" class="w-full h-auto object-contain">
                </div>
                @endif

                {{-- 3. Pembangunan --}}
                @if($report->ss_pembangunan)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                    <div class="p-4 border-b bg-gray-50"><h3 class="font-semibold text-gray-700">3. Diagram Pembangunan Berkelanjutan</h3></div>
                    <img src="{{ Storage::url($report->ss_pembangunan) }}" alt="Pembangunan" class="w-full h-auto object-contain">
                </div>
                @endif

                {{-- 4. Matriks ICM --}}
                @if($report->ss_matriks_icm)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                    <div class="p-4 border-b bg-gray-50"><h3 class="font-semibold text-gray-700">4. Matriks Penilaian ICM</h3></div>
                    <img src="{{ Storage::url($report->ss_matriks_icm) }}" alt="Matriks ICM" class="w-full h-auto object-contain">
                </div>
                @endif
            </div>

            {{-- KOLOM KANAN: Form Download (1/3 layar & Sticky) --}}
            <div class="lg:col-span-1 mt-8 lg:mt-0">
                <div class="sticky top-28"> {{-- Membuat elemen menempel saat discroll --}}
                    <div class="bg-white p-6 rounded-xl shadow-lg border border-green-100">
                        <div class="text-center mb-6">
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-100 text-green-600 mb-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Unduh Dokumen Lengkap</h3>
                            <p class="text-sm text-gray-500">Laporan SOC {{ $city->name }} Tahun {{ $report->tahun }}</p>
                        </div>

                        @if($report->file_laporan)
                            {{-- Form Download Langsung Disini --}}
                            <form action="{{ route('soc.download.process', $report) }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label for="name" class="block text-xs font-medium text-gray-700 uppercase tracking-wider mb-1">Nama Lengkap</label>
                                    <input type="text" name="name" id="name" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 text-sm py-2" placeholder="Masukkan nama Anda">
                                    @error('name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-xs font-medium text-gray-700 uppercase tracking-wider mb-1">Email Instansi/Pribadi</label>
                                    <input type="email" name="email" id="email" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 text-sm py-2" placeholder="email@contoh.com">
                                    @error('email') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-semibold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                    Unduh Sekarang (.pdf)
                                </button>

                                <p class="text-xs text-center text-gray-400 mt-2">
                                    *Data Anda kami rekam untuk keperluan statistik unduhan.
                                </p>
                            </form>
                        @else
                            <div class="text-center py-4 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                <p class="text-gray-500 text-sm">File dokumen belum tersedia untuk diunduh.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
