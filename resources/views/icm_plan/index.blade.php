@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-24 sm:py-32 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-gray-800 tracking-tight">Integrated Coastal Management (ICM) Plan</h1>
            <p class="mt-2 text-lg text-gray-600">Dokumen perencanaan pengelolaan pesisir terpadu per wilayah.</p>
        </div>

        {{-- Grid Daftar Kota --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            @forelse ($cities as $city)
                <a href="{{ route('icm_plan.show', $city) }}" class="group block bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center justify-center w-12 h-12 bg-green-50 text-green-600 rounded-lg group-hover:bg-green-600 group-hover:text-white transition-colors">
                                {{-- Ikon Dokumen --}}
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            {{-- Badge jumlah rencana --}}
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $city->icmPlans->count() }} Dokumen
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-green-600 transition-colors">{{ $city->name }}</h3>
                        <p class="mt-2 text-sm text-gray-500">
                            Akses dokumen rencana strategis dan data pendukung pengelolaan pesisir.
                        </p>
                    </div>
                    <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 flex justify-between items-center">
                        <span class="text-xs text-gray-500 font-medium">Terbaru: {{ $city->icmPlans->first()->tahun ?? '-' }}</span>
                        <span class="text-sm text-green-600 font-semibold group-hover:translate-x-1 transition-transform">Lihat Rencana &rarr;</span>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-12 bg-white rounded-xl border border-dashed border-gray-300">
                    <p class="text-gray-500">Belum ada data ICM Plan yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
