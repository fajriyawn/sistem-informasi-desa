@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-24 sm:py-32">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Formulir Pengajuan Rehabilitasi</h1>
            <p class="text-gray-600 mb-8">Isi formulir di bawah ini dengan detail mengenai rencana rehabilitasi yang Anda usulkan.</p>

            {{-- Menampilkan error validasi --}}
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('layanan.proposal.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap Penanggung Jawab</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon/HP</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                    </div>
                </div>
                <div>
                    <label for="organization" class="block text-sm font-medium text-gray-700">Nama Organisasi/Kelompok (Opsional)</label>
                    <input type="text" name="organization" id="organization" value="{{ old('organization') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                </div>
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">Lokasi yang Diusulkan (Desa, Kecamatan, Kabupaten)</label>
                    <input type="text" name="location" id="location" value="{{ old('location') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Singkat Masalah dan Rencana Rehabilitasi</label>
                    <textarea name="description" id="description" rows="5" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">{{ old('description') }}</textarea>
                </div>
                <div>
                    <label for="proposal_file" class="block text-sm font-medium text-gray-700">Unggah Proposal Lengkap (Opsional, maks. 5MB)</label>
                    <input type="file" name="proposal_file" id="proposal_file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                </div>
                <!-- Google reCAPTCHA v2 Widget -->
                <div class="mb-4 flex flex-col items-center">
                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                    @error('g-recaptcha-response')
                        <span class="text-red-600 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="pt-4">
                    <button type="submit" class="w-full inline-flex justify-center py-3 px-4 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Kirim Pengajuan
                    </button>
                </div>
            </form>
        </div>
    </div>

<!-- Google reCAPTCHA API -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</div>
@endsection
