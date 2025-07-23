@extends('layouts.app')

@section('content')

{{-- 1. HERO SECTION --}}
<section class="relative w-full h-screen">
    {{-- Background Image --}}
    <div class="absolute inset-0 z-0 bg-cover bg-center" style="background-image: url('{{ asset('images/bg-default.png') }}');">
        {{-- Lapisan Gelap Transparan --}}
        <div class="absolute inset-0 bg-black/60"></div>
    </div>
    
    {{-- Konten Hero --}}
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-full">
        <div class="text-white max-w-2xl">
            <h1 class="text-5xl md:text-6xl font-extrabold leading-tight">SIMPANDU</h1>
            <p class="mt-4 text-lg md:text-xl">Sistem Informasi dan Monitoring Pengelolaan Pesisir Terpadu</p>
        </div>
        <div>
            {{-- Logo Provinsi --}}
            <img src="{{ asset('images/logos/Jateng.png') }}"  alt="Logo Provinsi" class="w-32 md:w-48">
        </div>
    </div>
</section>

{{-- 2. LOKASI SECTION --}}
<section class="py-16 sm:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Lokasi</h2>
        
        {{-- Container untuk Peta --}}
        <div class="w-full h-96 rounded-lg shadow-lg overflow-hidden border border-gray-200">
            <div id="map" class="w-full h-full"></div>
        </div>
    </div>
</section>

{{-- 3. SELAYANG PANDANG SECTION --}}
<section class="py-16 sm:py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
        <div>
            <img src="{{ asset('images/logos/SIMPANDU.png') }}" alt="Selayang Pandang" class="rounded-lg shadow-lg w-full">
        </div>
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Selayang Pandang SIMPANDU</h2>
            <p class="mt-4 text-gray-600 leading-relaxed">Excepteur efficientur emerging, minim veniam enim aute se quid aute. Dolore te export, singulis domesticarum, ut illum nostrud nisi iudicem. Content quis international first-class aute id.</p>
            <a href="#" class="inline-block mt-8 bg-green-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-green-700 transition-colors">
                Read More
            </a>
        </div>
    </div>
</section>

{{-- 4. STATE OF THE OCEAN SECTION --}}
<section x-data="{ isModalOpen: false, modalImageUrl: '', modalTitle: '' }" @keydown.escape.window="isModalOpen = false" class="py-16 sm:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">State of the Ocean Jawa Tengah</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            {{-- Card 1 --}}
            <div @click="isModalOpen = true; modalImageUrl = '{{ asset('images/IMG_225.jpg') }}'; modalTitle = 'Status Lingkungan Pesisir'"
                 class="group cursor-pointer">
                <div class="overflow-hidden rounded-lg">
                    <img src="{{ asset('images/IMG_2255.jpg') }}" alt="Status Lingkungan Pesisir" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-800">Status Lingkungan Pesisir</h3>
            </div>

            {{-- Card 2 --}}
            <div @click="isModalOpen = true; modalImageUrl = '{{ asset('images/soc-2.jpg') }}'; modalTitle = 'Diagram Radar Tata Kelola'"
                 class="group cursor-pointer">
                <div class="overflow-hidden rounded-lg">
                    <img src="{{ asset('images/IMG_0699.jpg') }}" alt="Diagram Radar Tata Kelola" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-800">Diagram Radar Tata Kelola</h3>
            </div>

            {{-- Card 3 --}}
            <div @click="isModalOpen = true; modalImageUrl = '{{ asset('images/soc-3.jpg') }}'; modalTitle = 'Diagram Radar Pembangunan'"
                 class="group cursor-pointer">
                <div class="overflow-hidden rounded-lg">
                    <img src="{{ asset('images/IMG_2358.jpg') }}" alt="Diagram Radar Pembangunan" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-800">Diagram Radar Pembangunan</h3>
            </div>
            
            {{-- Card 4 --}}
            <div @click="isModalOpen = true; modalImageUrl = '{{ asset('images/soc-4.jpg') }}'; modalTitle = 'Matriks Penilaian'"
                 class="group cursor-pointer">
                <div class="overflow-hidden rounded-lg">
                    <img src="{{ asset('images/IMG_2194.jpg') }}" alt="Matriks Penilaian" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-800">Matriks Penilaian</h3>
            </div>
        </div>
    </div>

    {{-- KODE UNTUK POPUP (MODAL) --}}
    <div x-show="isModalOpen" 
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-75"
         style="display: none;"> {{-- style="display: none;" untuk mencegah FOUC --}}

        <div @click.away="isModalOpen = false" class="relative bg-white rounded-lg shadow-xl max-w-3xl w-full p-4">
            {{-- Tombol Close --}}
            <button @click="isModalOpen = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            
            {{-- Judul Gambar (Dinamis) --}}
            <h3 x-text="modalTitle" class="text-xl font-bold mb-4"></h3>

            {{-- Konten Gambar (Dinamis) --}}
            <div class="w-full">
                <img :src="modalImageUrl" alt="Gambar Popup" class="w-full h-auto max-h-[80vh] object-contain">
            </div>
        </div>
    </div>
</section>

{{-- 5. ICM PLAN (CALL TO ACTION) SECTION --}}
<section class="relative py-24 sm:py-32">
    <div class="absolute inset-0 z-0 bg-cover bg-center" style="background-image: url('{{ asset('images/IMG_9831.jpg') }}');">
        <div class="absolute inset-0 bg-black/70"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h2 class="text-4xl font-bold">Integrated Coastal Management Plan</h2>
        <p class="mt-4 max-w-2xl mx-auto">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <a href="#" class="inline-block mt-8 bg-white text-green-700 font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-gray-200 transition-colors">
            Read More
        </a>
    </div>
</section>

@endsection

@section('scripts')
<script>
    // Inisialisasi peta dan atur view ke koordinat yang diinginkan dengan level zoom
    var map = L.map('map').setView([-6.8904411, 110.5644006], 10);

    // Tambahkan tile layer dari OpenStreetMap
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // (Opsional) Tambahkan marker di lokasi
    var marker = L.marker([-6.8904411, 110.5644006]).addTo(map)
        .bindPopup('<b>Lokasi Pesisir Jawa Tengah</b><br>Titik tengah area pantura.')
        .openPopup();
</script>
@endsection
