@extends('layouts.app')

@section('content')

{{-- State untuk Popup (Modal) menggunakan Alpine.js --}}
<div x-data="{
    isModalOpen: false,
    modalTitle: '',
    modalCaption: '',
    modalDate: '',
    modalType: '',
    modalFilePath: ''
}" @keydown.escape.window="isModalOpen = false">

    {{-- Kontainer Utama Halaman Galeri --}}
    <div class="bg-white py-24 sm:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-12">GALERI</h1>

            {{-- Grid untuk Gambar/Video --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @forelse ($items as $item)
                    <div @click="
                        isModalOpen = true;
                        modalTitle = '{{ addslashes($item->title) }}';
                        modalCaption = '{{ addslashes($item->caption) }}';
                        modalDate = '{{ $item->published_at->format('d F Y') }}';
                        modalType = '{{ $item->type }}';
                        modalFilePath = '{{ Storage::url($item->file_path) }}';
                    " class="group cursor-pointer aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden">
                        {{-- Tampilkan thumbnail --}}
                        @if ($item->type === 'image')
                            <img src="{{ Storage::url($item->file_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:opacity-75 transition-opacity">
                        @else
                            {{-- Untuk video, kita bisa tampilkan ikon video --}}
                            <div class="w-full h-full flex items-center justify-center bg-gray-800">
                                <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4V5h12v10zM8 8a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1H9a1 1 0 01-1-1V8z"></path></svg>
                            </div>
                        @endif
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">Belum ada item di galeri.</p>
                @endforelse
            </div>

            {{-- Link Paginasi --}}
            <div class="mt-16">
                {{ $items->links() }}
            </div>
        </div>
    </div>

    {{-- POPUP / MODAL --}}
    <div x-show="isModalOpen" x-transition class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-80" style="display: none;">
        <div @click.away="isModalOpen = false" class="relative bg-white rounded-lg shadow-xl max-w-4xl w-full h-[90vh] flex overflow-hidden">
            {{-- Bagian Media (Kiri) --}}
            <div class="w-full md:w-2/3 bg-black flex items-center justify-center">
                {{-- Tampilkan gambar atau video secara kondisional --}}
                <template x-if="modalType === 'image'">
                    <img :src="modalFilePath" alt="Popup Image" class="max-w-full max-h-full object-contain">
                </template>
                <template x-if="modalType === 'video'">
                    <video :src="modalFilePath" controls autoplay class="max-w-full max-h-full"></video>
                </template>
            </div>

            {{-- Bagian Informasi (Kanan) --}}
            <div class="hidden md:block w-1/3 p-6 overflow-y-auto">
                <h3 x-text="modalTitle" class="text-2xl font-bold mb-2"></h3>
                <p x-text="modalDate" class="text-sm text-gray-500 mb-4"></p>
                <div x-html="modalCaption" class="prose"></div>
            </div>
            
            {{-- Tombol Close --}}
            <button @click="isModalOpen = false" class="absolute top-2 right-2 text-white md:text-gray-500 hover:text-gray-800 z-10">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    </div>

</div>

@endsection