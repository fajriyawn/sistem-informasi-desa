<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Berhasil Dikirim</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-lg p-10 text-center bg-white rounded-lg shadow-lg">
        <svg class="w-16 h-16 mx-auto text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <h1 class="text-3xl font-bold text-gray-800 mt-4">Terima Kasih!</h1>
        <p class="text-gray-600 mt-2">{{ session('message') }}</p>

        <div class="mt-8 p-4 bg-indigo-50 border-2 border-dashed border-indigo-200 rounded-lg">
            <p class="text-sm font-medium text-gray-700">Simpan kode tracking Anda untuk melacak status laporan:</p>
            <p class="text-2xl font-mono font-bold text-indigo-600 tracking-widest mt-2">{{ session('tracking_code') }}</p>
        </div>

        <div class="mt-8">
            <a href="{{ route('tracker.lacak', ['tracking_code' => session('tracking_code')]) }}" class="inline-block px-6 py-3 font-semibold text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                Lacak Laporan Anda Sekarang
            </a>
             <a href="{{ route('laporan.create') }}" class="inline-block mt-2 text-sm text-gray-600 hover:underline">
                Buat laporan baru
            </a>
        </div>
    </div>
</body>
