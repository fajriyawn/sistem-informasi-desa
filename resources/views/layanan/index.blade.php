@extends('layouts.app')

@section('content')
<div class="bg-white py-24 sm:py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-gray-800 mb-4">Layanan Kami</h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Kami menyediakan berbagai layanan untuk mendukung partisipasi masyarakat dalam menjaga dan merehabilitasi ekosistem pesisir.</p>
        </div>

        {{-- Menampilkan pesan sukses setelah submit form --}}
        @if (session('success'))
            <div class="mt-8 max-w-3xl mx-auto bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Kartu Layanan --}}
        <div class="mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
            {{-- Kartu untuk Pengajuan Rehabilitasi --}}
            <div class="bg-gray-50 border border-gray-200 rounded-lg shadow-lg p-8 flex flex-col">
                <h3 class="text-2xl font-bold text-gray-800">Pengajuan Rehabilitasi Ekosistem</h3>
                <p class="mt-4 text-gray-600 flex-grow">Punya ide atau rencana untuk memperbaiki area pesisir di sekitar Anda? Ajukan proposal Anda dan mari berkolaborasi untuk mewujudkannya.</p>
                <a href="{{ route('layanan.proposal.form') }}" class="mt-6 inline-block text-center bg-green-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-green-700 transition-colors">
                    Ajukan Sekarang
                </a>
            </div>

            {{-- Kartu untuk Pendaftaran Pelatihan --}}
            <div class="bg-gray-50 border border-gray-200 rounded-lg shadow-lg p-8 flex flex-col">
                <h3 class="text-2xl font-bold text-gray-800">Pendaftaran Pelatihan</h3>
                <p class="mt-4 text-gray-600 flex-grow">Tingkatkan pengetahuan dan kapasitas kelompok Anda mengenai pengelolaan ekosistem pesisir melalui program pelatihan yang kami sediakan.</p>
                <a href="{{ route('layanan.training.form') }}" class="mt-6 inline-block text-center bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                    Daftar Pelatihan
                </a>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
