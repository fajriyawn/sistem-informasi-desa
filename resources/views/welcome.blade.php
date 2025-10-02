@extends('layouts.app')

@section('content')

<div x-data="{
    isDrawerOpen: false,
    drawerTitle: '',
    drawerData: [],
    openDrawer(city) {
        this.drawerTitle = `Data Detail untuk ${city.name}`;
        this.drawerData = city.regional_data;
        this.isDrawerOpen = true;
    }
}"
@open-drawer.window="openDrawer($event.detail.city)">

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
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Daerah Pesisir</h2>
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
            <p class="mt-4 text-gray-600 leading-relaxed text-justify">SIMPANDU merupakan aplikasi Sistem Informasi dan Monitoring Pengelolaan Terpadu yang ditujukan untuk mengintegrasikan data lingkungan dan sosial-ekonomi secara real-time, tetapi juga memfasilitasi integrasi antara warga, pemerintah desa, dan pemangku kepentingan lainnya dalam pengelolaan sumber daya pesisir yang berkelanjutan. Aplikasi ini dirancang sebagai platform digital yang mendukung pengumpulan, pengolahan, analisis, serta penyajian data terkait kondisi pesisir secara real-time maupun periodik. Sistem ini diharapkan dapat membantu masyarakat dalam menjaga lingkungan pesisir dengan ketersediaan data yang akurat dan terintegrasi. Dengan adanya aplikasi ini, pengelolaan wilayah pesisir dapat dilakukan secara lebih efektif, transparan, dan kolaboratif, sehingga keberlanjutan ekosistem laut dan kesejahteraan masyarakat pesisir dapat terjaga.</p>
        </div>
    </div>
</section>

{{-- 4. STATE OF THE OCEAN SECTION (YANG DIPERBAIKI TOTAL) --}}
{{-- Inisialisasi Alpine.js dengan memanggil fungsi socSection() --}}
<section x-data="socSection()" @keydown.escape.window="isModalOpen = false" class="py-16 sm:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">State of the Coast Jawa Tengah</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            {{-- Card-card ini sekarang hanya memanggil fungsi openModal --}}
            <div @click="openModal('status-lingkungan-pesisir')" class="group cursor-pointer">
                <div class="overflow-hidden rounded-lg"><img src="{{ asset('images/IMG_2255.jpg') }}" alt="Status Lingkungan Pesisir" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"></div>
                <h3 class="mt-4 text-lg font-semibold text-gray-800">Status Lingkungan Pesisir</h3>
            </div>
            <div @click="openModal('diagram-radar-tata-kelola')" class="group cursor-pointer">
                <div class="overflow-hidden rounded-lg"><img src="{{ asset('images/IMG_0699.jpg') }}" alt="Diagram Radar Tata Kelola" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"></div>
                <h3 class="mt-4 text-lg font-semibold text-gray-800">Diagram Radar Tata Kelola</h3>
            </div>
            <div @click="openModal('diagram-radar-pembangunan')" class="group cursor-pointer">
                <div class="overflow-hidden rounded-lg"><img src="{{ asset('images/IMG_2358.jpg') }}" alt="Diagram Radar Pembangunan" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"></div>
                <h3 class="mt-4 text-lg font-semibold text-gray-800">Diagram Radar Pembangunan</h3>
            </div>
            <div @click="openModal('matriks-penilaian')" class="group cursor-pointer">
                <div class="overflow-hidden rounded-lg"><img src="{{ asset('images/IMG_2194.jpg') }}" alt="Matriks Penilaian" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"></div>
                <h3 class="mt-4 text-lg font-semibold text-gray-800">Matriks Penilaian</h3>
            </div>
        </div>
    </div>

    {{-- POPUP (MODAL) --}}
    <div x-show="isModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-75" style="display: none;">
        <div @click.away="isModalOpen = false" class="relative bg-white rounded-lg shadow-xl max-w-3xl w-full p-6">
            <button @click="isModalOpen = false" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <h3 x-text="modalTitle" class="text-2xl font-bold mb-4"></h3>
            <div class="w-full text-center">
                <img :src="modalImageUrl" alt="Gambar Popup" class="w-full h-auto max-h-[70vh] object-contain rounded-md mb-6">
                <a href="/soc" class="inline-block px-8 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition-transform transform hover:scale-105" style="text-decoration: none;">
                    Lihat Detail SOC
                </a>
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
        <p class="mt-4 max-w-2xl mx-auto">Pengelolaan Pesisir Secara Terpadu</p>
        <a href="{{ route('icm_plan.index') }}" class="inline-block mt-8 bg-white text-green-700 font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-gray-200 transition-colors">
            Lihat ICM Plan
        </a>
    </div>
</section>

{{-- SIDE DRAWER UNTUK MENAMPILKAN DATA --}}
<div x-show="isDrawerOpen"
     @keydown.escape.window="isDrawerOpen = false"
     class="fixed inset-0 z-50 overflow-hidden"
     style="display: none;">

    {{-- Latar belakang gelap --}}
    <div x-show="isDrawerOpen" x-transition:enter="ease-in-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="absolute inset-0 bg-gray-600 bg-opacity-75"
         @click="isDrawerOpen = false"></div>

    {{-- Kontainer untuk panel --}}
    {{-- Posisi diubah ke kiri (inset-y-0 left-0) --}}
    <section class="absolute inset-y-0 left-0 flex">
        <div x-show="isDrawerOpen"
             x-transition:enter="transform transition ease-in-out duration-300"
             x-transition:enter-start="-translate-x-full" {{-- Animasi dari kiri --}}
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transform transition ease-in-out duration-300"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full" {{-- Animasi ke kiri --}}

             {{-- Ukuran: full di mobile, 1/4 layar di desktop --}}
             class="w-screen max-w-md md:w-4/4">

            {{-- Ini adalah panelnya --}}
            <div class="h-full flex flex-col bg-white shadow-xl">
                {{-- Header Panel (rounded-t-2xl dihapus) --}}
                <div class="py-4 px-6 bg-green-700 text-white">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold" x-text="drawerTitle"></h2>
                        <button @click="isDrawerOpen = false" class="text-2xl font-light leading-none">&times;</button>
                    </div>
                </div>
                {{-- Konten Tabel --}}
                    <div class="relative flex-1 py-6 px-6 overflow-y-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Indikator</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sumber</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                {{-- Data akan diisi oleh Alpine.js --}}
                                <template x-for="row in drawerData" :key="row.id">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" x-text="row.indicator_name"></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.indicator_value"></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.year"></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.source"></td>
                                    </tr>
                                </template>
                                {{-- Pesan jika data kosong --}}
                                <template x-if="drawerData.length === 0">
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data untuk wilayah ini.</td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

{{-- Pindahkan script Alpine.js ke @section terpisah agar tidak konflik --}}
@push('scripts')
<script>
    // Fungsi ini mendefinisikan semua data dan logika untuk section SOC
    function socSection() {
        return {
            isModalOpen: false,
            modalTitle: '',
            modalImageUrl: '',
            // Mengambil data dari controller Laravel dan mengubahnya menjadi objek JavaScript
            sections: @json($socSections ?? []),

            // Fungsi yang dipanggil saat card di-klik
            openModal(key) {
                // Cari data yang sesuai berdasarkan 'key' unik
                const section = this.sections.find(s => s.key === key);

                // Jika data ditemukan dan memiliki gambar, update properti modal
                if (section && section.image_path) {
                    this.modalTitle = section.title;
                    this.modalImageUrl = `/storage/${section.image_path}`; // URL gambar yang benar
                    this.isModalOpen = true; // Tampilkan modal
                } else {
                    // Beri peringatan di console jika gambar belum di-upload dari admin
                    console.warn(`Data atau gambar untuk key '${key}' tidak ditemukan.`);
                }
            }
        }
    }
</script>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var map = L.map('map').setView([-6.8904411, 110.5644006], 9);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '...' }).addTo(map);

        const citiesData = @json($cities ?? []);
        const cityColors = ['#22c55e', '#3b82f6', '#facc15', '#ef4444', '#8b5cf6'];
        const geoJsonFiles = {
            'Semarang': "{{ asset('geojson/Semarang.geojson') }}",
            'Batang': "{{ asset('geojson/Batang.geojson') }}",
            'Demak': "{{ asset('geojson/Demak.geojson') }}",
            'Jepara': "{{ asset('geojson/Jepara.geojson') }}",
            'Kendal': "{{ asset('geojson/Kendal.geojson') }}",
        };

        citiesData.forEach((city, index) => {
            const geoJsonUrl = geoJsonFiles[city.name];
            if (!geoJsonUrl) return;

            fetch(geoJsonUrl)
                .then(res => res.json())
                .then(data => {
                    const layer = L.geoJSON(data, {
                        style: { fillColor: cityColors[index % cityColors.length], weight: 2, color: 'white', fillOpacity: 0.7 }
                    });

                    // UBAH BAGIAN INI: Sekarang kita menyiarkan event, bukan memanggil fungsi langsung
                    layer.on('click', () => {
                        window.dispatchEvent(new CustomEvent('open-drawer', {
                            detail: {
                                city: city
                            }
                        }));
                    });

                    layer.bindPopup(`<strong>${city.name}</strong><br>Klik untuk lihat detail data.`);
                    layer.addTo(map);
                });
        });
    });
</script>
@endpush
