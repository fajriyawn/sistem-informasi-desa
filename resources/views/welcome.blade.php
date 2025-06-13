<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sistem Informasi Manajemen Desa Pesisir</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-white text-black">

  {{-- Header --}}
  @include('frontend.partials.navbar', ['colorPrimary' => $colorPrimary, 'colorSecondary' => $colorSecondary])

    {{-- Hero --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between pb-20 pt-10 md:pt-24">
        <div class="flex flex-col mx-auto">
        <div class="flex flex-row justify-between ">
      <div class="max-w-xl text-white">
        <button class="mb-6 bg-white text-[#0f3a2f] text-xs font-semibold rounded-full px-4 py-1">Welcome</button>
        <h1 class="text-2xl md:text-3xl font-semibold leading-tight mb-4">Sistem Informasi Manajemen Desa Pesisir</h1>
        <p class="text-xs md:text-sm max-w-md leading-relaxed mb-10">
          Sistem ini adalah Sistem Informasi Manajemen Desa Pesisir yang dikembangkan untuk mendukung pengelolaan data dan informasi desa pesisir secara efektif dan efisien.
        </p>
        {{-- Ikon Navigasi --}}
      </div>
      <div class="mt-10 md:mt-0 md:ml-10 flex-shrink-0">
        <img src="{{ asset('images/logos/logo-demak.png') }}" class="w-40 md:w-48" alt="Logo Demak" />
      </div>
    </div>
    <div class="grid grid-cols-4 md:grid-cols-9 gap-4 text-white text-xs md:text-sm">
          @php
            $icons = [
              ['icon' => 'fas fa-water', 'label' => 'Gambaran<br>Umum'],
              ['icon' => 'fas fa-seedling', 'label' => 'Lingkungan'],
              ['icon' => 'fas fa-book-medical', 'label' => 'Pendidikan<br>dan Kesehatan'],
              ['icon' => 'fas fa-landmark', 'label' => 'Sejarah<br>dan Budaya'],
              ['icon' => 'fas fa-home', 'label' => 'Pemerintahan'],
              ['icon' => 'fas fa-users', 'label' => 'Kelembagaan<br>Sosial'],
              ['icon' => 'fas fa-briefcase', 'label' => 'Perekonomian<br>Desa'],
              ['icon' => 'fas fa-clipboard-list', 'label' => 'Pemanfaatan<br>Lahan'],
              ['icon' => 'fas fa-tools', 'label' => 'Proyek<br>Pembangunan'],
            ];
          @endphp

          @foreach($icons as $icon)
          <div class="flex flex-col items-center space-y-1">
            <i class="{{ $icon['icon'] }} text-lg"></i>
            <span>{!! $icon['label'] !!}</span>
          </div>
          @endforeach
        </div>
        </div>
    </div>
  </header>

  {{-- Lokasi Desa --}}
  @include('frontend.sections.location')
  @include('frontend.sections.general', ['deskripsiDesa' => $deskripsiDesa])
  @include('frontend.sections.environment')
  @include('frontend.sections.academic-health')
  @include('frontend.sections.history-culture')
  @include('frontend.sections.government')
  @include('frontend.sections.social')
  @include('frontend.sections.economy')
  @include('frontend.sections.land-use')
  @include('frontend.sections.development')

  {{-- Footer --}}
    @include('frontend.partials.footer')

</body>
</html>
