@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-24 sm:py-32">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Formulir Unduh ICM Plan</h1>
            <p class="text-gray-600 mb-6">Silakan isi nama dan email Anda untuk mengunduh dokumen: <br><strong>{{ $plan->title ?? 'ICM Plan' }} ({{ $plan->tahun }})</strong>.</p>

            <form action="{{ route('icm_plan.download.process', $plan) }}" method="POST">
                @csrf
                <div class="space-y-4">
                    {{-- Field Nama --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                               class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm @error('name') border-red-500 @else border-gray-300 @enderror">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Field Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                               class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm @error('email') border-red-500 @else border-gray-300 @enderror">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                        Unduh File Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
