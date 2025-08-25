<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPANDU - Sistem Informasi Pengelolaan Pesisir Terpadu</title>

    {{-- Memuat Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font dari Google (Opsional, tapi membuat tampilan lebih baik) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Style untuk navbar saat di-scroll */
        #main-navbar.scrolled {
            background-color: #0F3A2F;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        .leaflet-container {
            z-index: 0;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white">

    {{-- =============================================== --}}
    {{-- HEADER & NAVBAR --}}
    {{-- =============================================== --}}
    <header>
        {{-- Kita gunakan @if untuk menentukan class awal navbar --}}
        @if (Route::is('landing'))
            {{-- HANYA untuk landing page: navbar awalnya transparan --}}
            <nav id="main-navbar" class="fixed top-0 left-0 w-full px-4 sm:px-6 lg:px-8 py-4 z-50 transition-all duration-300">
        @else
            {{-- Untuk SEMUA HALAMAN LAIN: navbar langsung punya background solid --}}
            <nav id="main-navbar" class="fixed top-0 left-0 w-full px-4 sm:px-6 lg:px-8 py-4 z-50 transition-all duration-300 scrolled">
        @endif

            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <a href="/" class="text-white font-extrabold text-2xl tracking-wider">SIMPANDU</a>

                <ul class="hidden md:flex items-center space-x-8 text-white font-semibold text-sm">
                    <li><a href="/" class="hover:text-gray-300">BERANDA</a></li>
                    <li><a href="/soc" class="hover:text-gray-300">SOC</a></li>
                    <li><a href="#" class="hover:text-gray-300">ICM PLAN</a></li>
                    <li><a href="/pelaporan" class="hover:text-gray-300">PELAPORAN</a></li>
                    <li><a href="/layanan" class="hover:text-gray-300">LAYANAN</a></li>
                    <li><a href="/galeri" class="hover:text-gray-300">GALERI</a></li>
                </ul>
            </div>
        </nav>
    </header>


    {{-- =============================================== --}}
    {{-- KONTEN UTAMA HALAMAN --}}
    {{-- =============================================== --}}
    <main>
        @yield('content')
    </main>


    {{-- =============================================== --}}
    {{-- FOOTER --}}
    {{-- =============================================== --}}
    <footer class="bg-[#0F3A2F] text-white py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <p class="text-sm">&copy; {{ date('Y') }} SIMPANDU. All Rights Reserved.</p>
            <div class="flex items-center space-x-4">
                {{-- Ganti dengan path logo Anda --}}
                <img src="{{ asset('images/logos/left-logo.png') }}" alt="Norway Logo" class="h-8">
                <img src="{{ asset('images/logos/right-logo.png') }}" alt="Kiara Logo" class="h-8">
            </div>
        </div>
    </footer>

    {{-- Script untuk Navbar Scroll --}}
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
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

    {{-- Yield untuk script spesifik per halaman --}}
    @yield('scripts')
    {{-- Script untuk landing page --}}
    @if (Route::is('landing'))
    <script>
        const nav = document.getElementById('main-navbar');
        if (nav) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 20) {
                    // Class 'scrolled' hanya ditambahkan saat scroll di landing page
                    nav.classList.add('scrolled');
                } else {
                    nav.classList.remove('scrolled');
                }
            });
        }
    </script>
    @endif
</body>
</html>
