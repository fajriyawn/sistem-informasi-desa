<header class="relative bg-gradient-to-b from-[#0f3a2f] to-transparent">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between py-3">
    {{-- Logo dan navigasi dipindah ke partials/navbar --}}
  </div>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between pb-20 pt-10 md:pt-24">
    <div class="max-w-xl text-white">
      <button class="mb-6 bg-white text-[#0f3a2f] text-xs font-semibold rounded-full px-4 py-1">Welcome</button>
      <h1 class="text-2xl md:text-3xl font-semibold leading-tight mb-4">
        Sistem Informasi Manajemen Desa Pesisir
      </h1>
      <p class="text-xs md:text-sm max-w-md leading-relaxed mb-10">
        Sistem ini adalah Sistem Informasi Manajemen Desa Pesisir...
      </p>
      @include('frontend.sections.icons')
    </div>
    <div class="mt-10 md:mt-0 md:ml-10 flex-shrink-0">
      <img class="w-40 md:w-48" src="https://storage.googleapis.com/..." alt="Logo Demak" />
    </div>
  </div>
</header>
