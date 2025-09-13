<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPANDU - Sistem Informasi Pengelolaan Pesisir Terpadu</title>

    {{-- Memuat Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Memuat Alpine.js (diberi 'defer' agar dieksekusi setelah HTML siap) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- CSS untuk Leaflet Map --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    {{-- Font dari Google --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Stack untuk CSS spesifik per halaman --}}
    @stack('styles')

    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Style untuk navbar saat di-scroll */
        #main-navbar.scrolled {
            background-color: #0F3A2F;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }
        .leaflet-container { z-index: 0; }
    </style>
</head>
<body class="bg-white flex flex-col min-h-screen">

    {{-- =============================================== --}}
    {{-- HEADER & NAVBAR --}}
    {{-- =============================================== --}}
    {{-- Inisialisasi Alpine.js untuk state menu mobile (isOpen) --}}
    <header x-data="{ isOpen: false }" class="relative">
        @if (Route::is('landing'))
            <nav id="main-navbar" class="fixed top-0 left-0 w-full px-4 sm:px-6 lg:px-8 py-4 z-50 transition-all duration-300">
        @else
            <nav id="main-navbar" class="fixed top-0 left-0 w-full px-4 sm:px-6 lg:px-8 py-4 z-50 transition-all duration-300 scrolled">
        @endif
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                {{-- Brand/Logo --}}
                <a href="/" class="text-white font-extrabold text-2xl tracking-wider">SIMPANDU</a>

                {{-- Menu untuk Desktop (Medium screen ke atas) --}}
                <ul class="hidden md:flex items-center space-x-8 text-white font-semibold text-sm">
                    <li><a href="{{ route('landing') }}" class="hover:text-gray-300">BERANDA</a></li>
                    <li><a href="{{ route('soc.index') }}" class="hover:text-gray-300">SOC</a></li>
                    <li><a href="{{ route('icm_plan.index') }}" class="hover:text-gray-300">ICM PLAN</a></li>
                    <li><a href="{{ route('laporan.index') }}" class="hover:text-gray-300">PELAPORAN</a></li>
                    <li><a href="{{ route('layanan.index') }}" class="hover:text-gray-300">LAYANAN</a></li>
                    <li><a href="{{ route('gallery.index') }}" class="hover:text-gray-300">GALERI</a></li>
                </ul>

                {{-- Tombol Hamburger (Hanya tampil di mobile) --}}
                <div class="md:hidden">
                    <button @click="isOpen = !isOpen" class="text-white focus:outline-none">
                        {{-- Ikon Hamburger --}}
                        <svg x-show="!isOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        {{-- Ikon Close (X) --}}
                        <svg x-show="isOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>

            {{-- Menu Dropdown untuk Mobile --}}
            <div x-show="isOpen" @click.away="isOpen = false" x-transition
                 class="md:hidden absolute top-full left-0 w-full bg-[#0F3A2F] bg-opacity-95 shadow-lg rounded-b-lg">
                <ul class="flex flex-col items-center space-y-4 py-6 text-white text-lg">
                    <li><a href="{{ route('landing') }}" @click="isOpen = false">BERANDA</a></li>
                    <li><a href="{{ route('soc.index') }}" @click="isOpen = false">SOC</a></li>
                    <li><a href="{{ route('icm_plan.index') }}" @click="isOpen = false">ICM PLAN</a></li>
                    <li><a href="{{ route('laporan.index') }}" @click="isOpen = false">PELAPORAN</a></li>
                    <li><a href="{{ route('layanan.index') }}" @click="isOpen = false">LAYANAN</a></li>
                    <li><a href="{{ route('gallery.index') }}" @click="isOpen = false">GALERI</a></li>
                </ul>
            </div>
        </nav>
    </header>

    {{-- KONTEN UTAMA HALAMAN --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-[#0F3A2F] text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row md:justify-between md:items-center">

            {{-- Logo-logo (Urutan pertama di mobile, kedua di desktop) --}}
            <div class="flex items-center space-x-6 order-1 md:order-2 mb-6 md:mb-0">
                <a href="#" class="hover:opacity-80 transition-opacity">
                    <img src="{{ asset('images/logos/left-logo.png') }}" alt="Left Logo" class="h-8">
                </a>
                <a href="#" class="hover:opacity-80 transition-opacity">
                    <img src="{{ asset('images/logos/right-logo.png') }}" alt="Right Logo" class="h-8">
                </a>
            </div>

            {{-- Copyright (Urutan kedua di mobile, pertama di desktop) --}}
            <p class="text-sm text-gray-400 order-2 md:order-1">&copy; {{ date('Y') }} SIMPANDU. All Rights Reserved.</p>

        </div>
    </footer>

    {{-- SCRIPT GLOBAL --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    {{-- Script untuk Navbar Scroll (HANYA AKTIF di landing page) --}}
    @if (Route::is('landing'))
    <script>
        const nav = document.getElementById('main-navbar');
        if (nav) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 20) {
                    nav.classList.add('scrolled');
                } else {
                    nav.classList.remove('scrolled');
                }
            });
        }
    </script>
    @endif

    {{-- Stack untuk script spesifik per halaman (misalnya untuk peta) --}}
    @stack('scripts')

</body>
</html>
