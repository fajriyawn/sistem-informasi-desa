@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-24 sm:py-32">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Formulir Unduh Laporan</h1>
            <p class="text-gray-600 mb-6">Silakan isi nama dan email Anda untuk melanjutkan proses unduh laporan SOC untuk **{{ $report->city->name }} Tahun {{ $report->tahun }}**.</p>
            
            <form action="{{ route('soc.download.process', $report) }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="name" id="name" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                        <input type="email" name="email" id="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                        Unduh File Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection