@extends('layouts.app') {{-- Pastikan ini meng-extend layout utama Anda --}}

@section('content')
{{-- Kontainer utama dengan padding atas (py-24) untuk memberi ruang di bawah navbar fixed --}}
<div class="bg-gray-50 py-24 sm:py-32">
    <div class="container mx-auto w-full max-w-3xl px-4">
        <div class="bg-white p-8 rounded-2xl shadow-lg">

            {{-- Judul Halaman Form --}}
            <div class="text-center mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Buat Laporan Baru</h1>
                <p class="mt-2 text-gray-600">Isi formulir di bawah ini untuk menyampaikan laporan Anda.</p>
            </div>

            {{-- Formulir Laporan --}}
            <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-6">
                    {{-- Bagian Data Diri Pelapor --}}
                    <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Data Diri Pelapor</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Field Nama Lengkap --}}
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                   class="mt-1 input-style @error('name') input-error @enderror"
                                   placeholder="Contoh: Budi Santoso">
                            @error('name') <p class="error-message">{{ $message }}</p> @enderror
                        </div>
                        {{-- Field Nomor Telepon --}}
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                                   class="mt-1 input-style @error('phone') input-error @enderror"
                                   placeholder="Contoh: 081234567890">
                            @error('phone') <p class="error-message">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    {{-- Field Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                               class="mt-1 input-style @error('email') input-error @enderror"
                               placeholder="Contoh: budi.santoso@example.com">
                        @error('email') <p class="error-message">{{ $message }}</p> @enderror
                    </div>

                    {{-- Bagian Detail Laporan --}}
                    <h2 class="text-xl font-semibold text-gray-800 border-b pt-6 pb-2 mb-4">Detail Laporan</h2>
                    {{-- Field Judul Laporan --}}
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul Laporan</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                               class="mt-1 input-style @error('title') input-error @enderror"
                               placeholder="Contoh: Penumpukan Sampah di Pantai A">
                        @error('title') <p class="error-message">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Field Tipe Laporan --}}
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Tipe Laporan</label>
                            <select name="type" id="type" required
                                    class="mt-1 input-style @error('type') input-error @enderror">
                                <option value="" disabled {{ old('type') ? '' : 'selected' }}>Pilih Tipe</option>
                                <option value="Infrastruktur" {{ old('type') == 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                                <option value="Lingkungan" {{ old('type') == 'Lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                                <option value="Pelayanan Publik" {{ old('type') == 'Pelayanan Publik' ? 'selected' : '' }}>Pelayanan Publik</option>
                                <option value="Lainnya" {{ old('type') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('type') <p class="error-message">{{ $message }}</p> @enderror
                        </div>
                        {{-- Field Kabupaten/Kota Lokasi Kejadian --}}
                        <div>
                            <label for="city_name" class="block text-sm font-medium text-gray-700">Kabupaten/Kota Lokasi</label>
                            <select id="city_name" name="city_name" required
                                    class="mt-1 input-style @error('city_name') input-error @enderror">
                                <option value="" disabled {{ old('city_name') ? '' : 'selected' }}>Pilih Kabupaten/Kota</option>
                                <option value="Batang" {{ old('city_name') == 'Batang' ? 'selected' : '' }}>Batang</option>
                                <option value="Jepara" {{ old('city_name') == 'Jepara' ? 'selected' : '' }}>Jepara</option>
                                <option value="Kendal" {{ old('city_name') == 'Kendal' ? 'selected' : '' }}>Kendal</option>
                                <option value="Demak" {{ old('city_name') == 'Demak' ? 'selected' : '' }}>Demak</option>
                                <option value="Semarang" {{ old('city_name') == 'Semarang' ? 'selected' : '' }}>Semarang</option>
                            </select>
                            @error('city_name') <p class="error-message">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    {{-- Field Detail Alamat Kejadian --}}
                    <div>
                        <label for="address_detail" class="block text-sm font-medium text-gray-700">Detail Alamat Kejadian</label>
                        <input type="text" name="address_detail" id="address_detail" value="{{ old('address_detail') }}" required
                               class="mt-1 input-style @error('address_detail') input-error @enderror"
                               placeholder="Contoh: Jl. Pesisir Indah, Desa Mulyorejo, Kec. Tirto">
                        @error('address_detail') <p class="error-message">{{ $message }}</p> @enderror
                    </div>
                    {{-- Field Isi Laporan --}}
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700">Isi Laporan</label>
                        <textarea name="content" id="content" rows="6" required
                                  class="mt-1 input-style @error('content') input-error @enderror"
                                  placeholder="Jelaskan secara rinci laporan atau masukan Anda di sini.">{{ old('content') }}</textarea>
                        @error('content') <p class="error-message">{{ $message }}</p> @enderror
                    </div>

                    {{-- Field Lampiran --}}
                    <div>
                        <label for="attachment" class="block text-sm font-medium text-gray-700">Lampiran (Opsional)</label>
                        <input type="file" name="attachment" id="attachment"
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                        @error('attachment') <p class="error-message">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Tombol Kirim --}}
                <div class="mt-8">
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Kirim Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Tambahkan style global untuk input-style dan error-message di bagian bawah file ini atau di CSS utama --}}
<style>
    .input-style {
        display: block;
        width: 100%;
        border-radius: 0.375rem;
        border: 1px solid #D1D5DB; /* border-gray-300 */
        padding: 0.5rem 0.75rem;
        box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    }
    .input-style:focus {
        outline: none;
        --tw-ring-color: #10B981; /* ring-green-500 */
        border-color: #10B981; /* border-green-500 */
        box-shadow: 0 0 0 1px #10B981;
    }
    .input-error {
        border-color: #EF4444; /* border-red-500 */
    }
    .input-error:focus {
        --tw-ring-color: #EF4444;
        border-color: #EF4444;
        box-shadow: 0 0 0 1px #EF4444;
    }
    .error-message {
        margin-top: 0.5rem;
        font-size: 0.875rem; /* text-sm */
        color: #EF4444; /* text-red-600 */
    }
</style>
@endsection
