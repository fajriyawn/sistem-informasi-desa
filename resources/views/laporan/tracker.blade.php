@extends('layouts.app')

@section('content')
{{-- Kontainer utama dengan padding atas untuk memberi ruang di bawah navbar fixed --}}
<div class="bg-gray-50 py-24 sm:py-32">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white p-8 rounded-2xl shadow-lg">

            {{-- Judul Halaman --}}
            <div class="text-center mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900">Lacak Status Laporan Anda</h1>
                <p class="mt-2 text-gray-600">Masukkan kode pelacakan unik yang Anda terima setelah mengirim laporan.</p>
            </div>

            {{-- Formulir Pelacakan --}}
            <form action="{{ route('laporan.tracker.track') }}" method="POST">
                @csrf
                <label for="tracking_code" class="block text-sm font-medium text-gray-700">Kode Pelacakan</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                    <input type="text" name="tracking_code" id="tracking_code" value="{{ old('tracking_code', request()->get('tracking_code')) }}" required
                           class="flex-1 block w-full rounded-none rounded-l-md border-gray-300 focus:ring-green-500 focus:border-green-500 px-3 py-2"
                           placeholder="Contoh: A1B2C3D4E5">
                    <button type="submit" class="inline-flex items-center px-6 py-2 border border-l-0 border-gray-300 bg-green-600 text-white font-semibold rounded-r-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Lacak
                    </button>
                </div>
                @error('tracking_code')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </form>

            {{-- Bagian untuk Menampilkan Hasil --}}
            @if (isset($laporan))
                {{-- Jika Laporan DITEMUKAN --}}
                <div class="mt-8 border-t border-gray-200 pt-6">
                    <h2 class="text-xl font-bold text-gray-800">Hasil Pelacakan:</h2>
                    <div class="mt-4 bg-gray-50 p-4 rounded-lg space-y-3">
                        <div>
                            <span class="font-semibold text-gray-600">Kode:</span>
                            <span class="font-mono text-gray-900">{{ $laporan->tracking_code }}</span>
                        </div>
                        <div>
                            <span class="font-semibold text-gray-600">Judul:</span>
                            <span class="text-gray-900">{{ $laporan->title }}</span>
                        </div>
                        <div>
                            <span class="font-semibold text-gray-600">Tanggal Lapor:</span>
                            <span class="text-gray-900">{{ $laporan->created_at->format('d F Y, H:i') }} WIB</span>
                        </div>
                        <div>
                            <span class="font-semibold text-gray-600">Status Saat Ini:</span>
                            <span class="px-2 py-1 text-sm font-semibold rounded-full
                                @if($laporan->status == 'Dikirim') bg-blue-100 text-blue-800 @endif
                                @if($laporan->status == 'Sedang Diproses') bg-yellow-100 text-yellow-800 @endif
                                @if($laporan->status == 'Selesai') bg-green-100 text-green-800 @endif
                                ">
                                {{ $laporan->status }}
                            </span>
                        </div>
                    </div>
                </div>
            @elseif (request()->isMethod('post'))
                {{-- Jika Laporan TIDAK DITEMUKAN setelah submit form --}}
                <div class="mt-8 border-t border-gray-200 pt-6 text-center">
                    <p class="text-red-600 font-semibold">Maaf, laporan dengan kode tersebut tidak ditemukan.</p>
                    <p class="text-gray-500 text-sm">Mohon periksa kembali kode pelacakan Anda.</p>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
