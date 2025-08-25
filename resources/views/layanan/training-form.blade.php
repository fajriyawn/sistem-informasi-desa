@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-24 sm:py-32">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Formulir Pendaftaran Pelatihan</h1>
            <p class="text-gray-600 mb-8">Daftarkan instansi atau kelompok Anda untuk mengikuti pelatihan pengelolaan pesisir.</p>

            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <form action="{{ route('layanan.training.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="organization_name" class="block text-sm font-medium text-gray-700">Nama Instansi/Sekolah/Kelompok</label>
                    <input type="text" name="organization_name" value="{{ old('organization_name') }}" required class="mt-1 block w-full input-style">
                </div>
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap Penanggung Jawab</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="mt-1 block w-full input-style">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="mt-1 block w-full input-style">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon/HP</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required class="mt-1 block w-full input-style">
                    </div>
                </div>
                <div>
                    <label for="training_topic" class="block text-sm font-medium text-gray-700">Topik Pelatihan yang Diinginkan</label>
                    <select name="training_topic" required class="mt-1 block w-full input-style">
                        <option value="" disabled {{ old('training_topic') ? '' : 'selected' }}>Pilih Topik</option>
                        <option value="Penanaman dan Perawatan Mangrove" {{ old('training_topic') == 'Penanaman dan Perawatan Mangrove' ? 'selected' : '' }}>Penanaman dan Perawatan Mangrove</option>
                        <option value="Identifikasi Biota Pesisir" {{ old('training_topic') == 'Identifikasi Biota Pesisir' ? 'selected' : '' }}>Identifikasi Biota Pesisir</option>
                        <option value="Pengelolaan Sampah Pesisir" {{ old('training_topic') == 'Pengelolaan Sampah Pesisir' ? 'selected' : '' }}>Pengelolaan Sampah Pesisir</option>
                        <option value="Lainnya" {{ old('training_topic') == 'Lainnya' ? 'selected' : '' }}>Lainnya (Jelaskan di pesan)</option>
                    </select>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="participant_count" class="block text-sm font-medium text-gray-700">Perkiraan Jumlah Peserta</label>
                        <input type="number" name="participant_count" value="{{ old('participant_count') }}" required class="mt-1 block w-full input-style" min="1">
                    </div>
                    <div>
                        <label for="proposed_date" class="block text-sm font-medium text-gray-700">Usulan Tanggal Pelaksanaan</label>
                        <input type="date" name="proposed_date" value="{{ old('proposed_date') }}" required class="mt-1 block w-full input-style">
                    </div>
                </div>
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700">Pesan Tambahan (Opsional)</label>
                    <textarea name="message" rows="4" class="mt-1 block w-full input-style">{{ old('message') }}</textarea>
                </div>
                <div class="pt-4">
                    <button type="submit" class="w-full inline-flex justify-center py-3 px-4 btn-submit">
                        Kirim Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>.input-style {border-radius: 0.375rem; border: 1px solid #D1D5DB; width: 100%; padding: 0.5rem 0.75rem;} .btn-submit{background-color: #2563EB; color: white; font-weight: 600; border-radius: 0.375rem;}</style>
@endsection
