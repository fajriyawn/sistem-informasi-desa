@extends('layouts.app')

@section('content')
{{-- Alpine.js Data untuk Modal Preview Gambar --}}
<div x-data="{
    imgModalOpen: false,
    imgModalSrc: '',
    imgModalTitle: '',
    openImage(src, title) {
        this.imgModalSrc = src;
        this.imgModalTitle = title;
        this.imgModalOpen = true;
    }
}"
@keydown.escape.window="imgModalOpen = false"
class="bg-gray-50 py-24 sm:py-32 min-h-screen">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- HEADER: Navigasi Breadcrumb & Judul --}}
        <div class="mb-8">
            <a href="{{ route('icm_plan.index') }}" class="text-sm text-green-600 hover:underline mb-2 inline-block">&larr; Kembali ke Daftar Daerah</a>
            <h1 class="text-3xl font-extrabold text-gray-900">ICM Plan: {{ $city->name }}</h1>
            <p class="text-gray-600 mt-1">Integrated Coastal Management Plan - Dokumen Perencanaan.</p>
        </div>

        {{-- SECTION ATAS: Daftar Tahun --}}
        <div class="mb-8 overflow-x-auto">
            <div class="flex space-x-2 border-b border-gray-200 pb-2">
                @foreach($availablePlans as $history)
                    <a href="{{ route('icm_plan.show', ['city' => $city->id, 'year' => $history->tahun]) }}"
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 whitespace-nowrap
                       {{ $plan->id == $history->id
                          ? 'bg-green-600 text-white shadow-md'
                          : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
                        Tahun {{ $history->tahun }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- LAYOUT UTAMA --}}
        <div class="lg:grid lg:grid-cols-3 lg:gap-10 lg:items-start">

            {{-- KOLOM KIRI: Preview File & Deskripsi --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Kartu Informasi Ringkasan --}}
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Rencana Pengelolaan Tahun {{ $plan->tahun }}</h2>

                    {{-- Menampilkan Deskripsi Rich Text --}}
                    <div class="prose max-w-none text-gray-600 text-sm mb-6">
                        {!! $plan->description !!}
                    </div>

                    <p class="text-sm text-gray-500 italic border-t pt-4">
                        Geser gambar di bawah ke kanan untuk melihat visualisasi data pendukung.
                    </p>
                </div>

                {{-- CONTAINER GAMBAR MENYAMPING (Horizontal Scroll) --}}
                <div class="flex space-x-6 overflow-x-auto pb-8 snap-x scrollbar-hide">

                    {{-- 1. Status Lingkungan --}}
                    @if($plan->ss_lingkungan)
                    <div class="flex-none w-80 md:w-96 snap-center group cursor-pointer"
                         @click="openImage('{{ Storage::url($plan->ss_lingkungan) }}', 'Status Lingkungan Pesisir')">
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200 hover:shadow-md transition-shadow">
                            <div class="h-56 w-full overflow-hidden bg-gray-100">
                                <img src="{{ Storage::url($plan->ss_lingkungan) }}" alt="Status Lingkungan" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800 group-hover:text-green-600 transition-colors">Status Lingkungan</h3>
                                <p class="text-xs text-gray-500 mt-1">Klik untuk memperbesar</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- 2. Tata Kelola --}}
                    @if($plan->ss_tata_kelola)
                    <div class="flex-none w-80 md:w-96 snap-center group cursor-pointer"
                         @click="openImage('{{ Storage::url($plan->ss_tata_kelola) }}', 'Diagram Radar Tata Kelola')">
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200 hover:shadow-md transition-shadow">
                            <div class="h-56 w-full overflow-hidden bg-gray-100">
                                <img src="{{ Storage::url($plan->ss_tata_kelola) }}" alt="Tata Kelola" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800 group-hover:text-green-600 transition-colors">Tata Kelola</h3>
                                <p class="text-xs text-gray-500 mt-1">Klik untuk memperbesar</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- 3. Pembangunan --}}
                    @if($plan->ss_pembangunan)
                    <div class="flex-none w-80 md:w-96 snap-center group cursor-pointer"
                         @click="openImage('{{ Storage::url($plan->ss_pembangunan) }}', 'Diagram Pembangunan Berkelanjutan')">
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200 hover:shadow-md transition-shadow">
                            <div class="h-56 w-full overflow-hidden bg-gray-100">
                                <img src="{{ Storage::url($plan->ss_pembangunan) }}" alt="Pembangunan" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800 group-hover:text-green-600 transition-colors">Pembangunan Berkelanjutan</h3>
                                <p class="text-xs text-gray-500 mt-1">Klik untuk memperbesar</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- 4. Matriks ICM --}}
                    @if($plan->ss_matriks_icm)
                    <div class="flex-none w-80 md:w-96 snap-center group cursor-pointer"
                         @click="openImage('{{ Storage::url($plan->ss_matriks_icm) }}', 'Matriks Penilaian ICM')">
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200 hover:shadow-md transition-shadow">
                            <div class="h-56 w-full overflow-hidden bg-gray-100">
                                <img src="{{ Storage::url($plan->ss_matriks_icm) }}" alt="Matriks ICM" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800 group-hover:text-green-600 transition-colors">Matriks Penilaian</h3>
                                <p class="text-xs text-gray-500 mt-1">Klik untuk memperbesar</p>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>

            {{-- KOLOM KANAN: Form Download (Sticky) --}}
            <div class="lg:col-span-1 mt-8 lg:mt-0" x-data="{ tab: 'unduh' }">
                
                {{-- Navigasi Tab --}}
                <div class="flex space-x-1 rounded-lg bg-gray-200 p-1 mb-4 sticky top-24">
                    <button @click="tab = 'unduh'" 
                            :class="tab === 'unduh' ? 'bg-white shadow text-gray-900' : 'text-gray-600 hover:bg-gray-100'"
                            class="flex-1 px-3 py-2 text-sm font-medium rounded-md transition-colors">
                        Unduh Dokumen
                    </button>
                    <button @click="tab = 'ulasan'" 
                            :class="tab === 'ulasan' ? 'bg-white shadow text-gray-900' : 'text-gray-600 hover:bg-gray-100'"
                            class="flex-1 px-3 py-2 text-sm font-medium rounded-md transition-colors">
                        Ulasan Publik
                    </button>
                </div>

                {{-- Tab Content: Unduh Dokumen --}}
                <div x-show="tab === 'unduh'" class="sticky top-28">
                    <div class="bg-white p-6 rounded-xl shadow-lg border border-green-100">
                        <div class="text-center mb-6">
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-100 text-green-600 mb-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Unduh Rencana Lengkap</h3>
                            <p class="text-sm text-gray-500">Dokumen ICM {{ $city->name }} Tahun {{ $plan->tahun }}</p>
                        </div>

                        @if($plan->file_laporan)
                            {{-- Form Download --}}
                            <form action="{{ route('icm_plan.download.process', $plan) }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label for="name" class="block text-xs font-medium text-gray-700 uppercase tracking-wider mb-1">Nama Lengkap</label>
                                    <input type="text" name="name" id="name" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 text-sm py-2" placeholder="Masukkan nama Anda">
                                    @error('name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-xs font-medium text-gray-700 uppercase tracking-wider mb-1">Email Instansi/Pribadi</label>
                                    <input type="email" name="email" id="email" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 text-sm py-2" placeholder="email@contoh.com">
                                    @error('email') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-semibold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                    Unduh Dokumen (.pdf)
                                </button>

                                <p class="text-xs text-center text-gray-400 mt-2">
                                    *Data Anda kami rekam untuk keperluan statistik unduhan.
                                </p>
                            </form>
                        @else
                            <div class="text-center py-4 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                <p class="text-gray-500 text-sm">Dokumen belum tersedia untuk diunduh.</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Tab Content: Ulasan Publik --}}
                <div x-show="tab === 'ulasan'" class="sticky top-28 space-y-6">
                    @if($plan->reviews_enabled)
                        {{-- Card 1: Daftar Ulasan --}}
                        <div class="bg-white p-6 rounded-xl shadow-lg border border-green-100">
                            <div class="text-center mb-6">
                                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 text-blue-600 mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.001 8.001 0 01-7.7-6M3 12c0-4.418 3.582-8 8-8s8 3.582 8 8z"></path></svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Ulasan Publik</h3>
                                <p class="text-sm text-gray-500">Masukan dari pembaca dokumen</p>
                            </div>

                            {{-- Daftar Ulasan --}}
                            <div class="space-y-4 max-h-96 overflow-y-auto">
                                @forelse($plan->reviews as $review)
                                    <div class="border-b py-4 last:border-b-0">
                                        <div class="flex justify-between items-start mb-2">
                                            <strong>{{ $review->name ?? 'Anonym' }}</strong>
                                            <span class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-gray-700 mt-1">{{ $review->content }}</p>
                                    </div>
                                @empty
                                    <div class="text-center py-8">
                                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 text-gray-400 mb-4">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                                        </div>
                                        <p class="text-gray-500">Belum ada ulasan. Jadilah yang pertama memberikan masukan!</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        {{-- Card 2: Form Beri Ulasan --}}
                        <div class="bg-white p-6 rounded-xl shadow-lg border border-green-100">
                            <div class="text-center mb-6">
                                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-100 text-green-600 mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Beri Ulasan Anda</h3>
                                <p class="text-sm text-gray-500">Bagikan pendapat tentang dokumen ini</p>
                            </div>

                            <form action="{{ route('review.store') }}" method="POST" class="space-y-4">
                                @csrf
                                
                                {{-- Hidden fields --}}
                                <input type="hidden" name="reviewable_id" value="{{ $plan->id }}">
                                <input type="hidden" name="reviewable_type" value="{{ get_class($plan) }}">
                                
                                {{-- Name field --}}
                                <div>
                                    <label for="review_name" class="block text-sm font-medium text-gray-700 mb-1">Nama (Opsional)</label>
                                    <input type="text" name="name" id="review_name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 text-sm py-2" placeholder="Masukkan nama Anda">
                                    @error('name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                </div>
                                
                                {{-- Email field --}}
                                <div>
                                    <label for="review_email" class="block text-sm font-medium text-gray-700 mb-1">Email (Opsional)</label>
                                    <input type="email" name="email" id="review_email" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 text-sm py-2" placeholder="email@contoh.com">
                                    @error('email') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                </div>
                                
                                {{-- Content field --}}
                                <div>
                                    <label for="review_content" class="block text-sm font-medium text-gray-700 mb-1">Ulasan <span class="text-red-500">*</span></label>
                                    <textarea name="content" id="review_content" required rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 text-sm py-2" placeholder="Berikan ulasan Anda mengenai dokumen ini..."></textarea>
                                    @error('content') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                </div>
                                
                                {{-- Submit button --}}
                                <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-semibold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                    Kirim Ulasan
                                </button>
                            </form>
                        </div>
                    @else
                        {{-- Card: Ulasan Dinonaktifkan --}}
                        <div class="bg-white p-6 rounded-xl shadow-lg border border-green-100">
                            <div class="text-center mb-6">
                                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-100 text-gray-400 mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Ulasan Publik</h3>
                                <p class="text-gray-500">Ulasan dinonaktifkan untuk dokumen ini.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {{-- MODAL / LIGHTBOX --}}
    <div x-show="imgModalOpen"
         x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black bg-opacity-90 backdrop-blur-sm" style="display: none;">

        <div @click.away="imgModalOpen = false" class="relative w-full max-w-5xl max-h-[90vh]">
            <button @click="imgModalOpen = false" class="absolute -top-10 right-0 text-white hover:text-gray-300 focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <img :src="imgModalSrc" class="w-full h-full object-contain rounded-lg shadow-2xl max-h-[85vh] mx-auto">
            <p x-text="imgModalTitle" class="text-center text-white mt-4 text-lg font-medium tracking-wide"></p>
        </div>
    </div>

</div>
@endsection
