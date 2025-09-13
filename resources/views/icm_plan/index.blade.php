@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-24 sm:py-32">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-gray-800 tracking-tight">Integrated Coastal Management (ICM) Plan</h1>
            <p class="mt-2 text-lg text-gray-600">Dokumen perencanaan pengelolaan pesisir terpadu per wilayah.</p>
        </div>

        <div class="space-y-4">
            @forelse ($cities as $city)
                <div x-data="{ open: false }" class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-5 text-left">
                        <span class="text-xl font-bold text-gray-800">{{ $city->name }}</span>
                        <svg :class="{'rotate-180': open}" class="w-6 h-6 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>

                    <div x-show="open" x-transition class="p-5 border-t border-gray-200 space-y-3">
                        @foreach ($city->icmPlans as $plan)
                            <div x-data="{ openYear: false }" class="border border-gray-200 rounded-md">
                                <button @click="openYear = !openYear" class="w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100 text-left">
                                    <span class="font-semibold text-gray-700">Tahun {{ $plan->tahun }}</span>
                                    <svg :class="{'rotate-180': openYear}" class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>

                                <div x-show="openYear" x-transition class="p-4 space-y-6">
                                    <h4 class="text-lg font-bold">{{ $plan->title }}</h4>
                                    <div class="prose max-w-none text-gray-600">
                                        {!! $plan->description !!}
                                    </div>

                                    {{-- TAMBAHKAN BLOK INI UNTUK MENAMPILKAN SCREENSHOT --}}
                                    @if ($plan->ss_lingkungan)
                                    <div>
                                        <h5 class="font-semibold mb-2">Status Lingkungan Pesisir</h5>
                                        <img src="{{ Storage::url($plan->ss_lingkungan) }}" class="w-full rounded-md shadow-md">
                                    </div>
                                    @endif

                                    @if ($plan->ss_tata_kelola)
                                    <div>
                                        <h5 class="font-semibold mb-2">Diagram Radar Tata Kelola</h5>
                                        <img src="{{ Storage::url($plan->ss_tata_kelola) }}" class="w-full rounded-md shadow-md">
                                    </div>
                                    @endif

                                    @if ($plan->ss_pembangunan)
                                    <div>
                                        <h5 class="font-semibold mb-2">Diagram Radar Pembangunan Berkelanjutan</h5>
                                        <img src="{{ Storage::url($plan->ss_pembangunan) }}" class="w-full rounded-md shadow-md">
                                    </div>
                                    @endif

                                    @if ($plan->ss_matriks_icm)
                                    <div>
                                        <h5 class="font-semibold mb-2">Matriks Penilaian Capaian Indikator ICM</h5>
                                        <img src="{{ Storage::url($plan->ss_matriks_icm) }}" class="w-full rounded-md shadow-md">
                                    </div>
                                    @endif
                                    {{-- BATAS BLOK BARU --}}

                                    @if ($plan->file_laporan)
                                        <div class="pt-4 border-t border-gray-200 text-right">
                                            <a href="{{ route('icm_plan.download.form', $plan) }}" class="inline-flex ...">
                                                Download Rencana (.pdf)
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">Belum ada data ICM Plan yang tersedia.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
