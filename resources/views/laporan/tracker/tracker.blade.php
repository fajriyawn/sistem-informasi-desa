<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lacak Laporan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-800">Lacak Status Laporan Anda</h2>

        @if (session('error'))
            <div class="p-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('tracker.track') }}" method="GET">
            <div>
                <label for="tracking_code" class="text-sm font-medium text-gray-700">Masukkan Kode Tracking</label>
                <input type="text" name="tracking_code" id="tracking_code" required class="w-full px-3 py-2 mt-1 text-gray-700 border rounded-md focus:outline-none focus:ring focus:ring-blue-500" placeholder="Contoh: LP-XXXXXXXX">
            </div>
            <button type="submit" class="w-full px-4 py-2 mt-6 font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Lacak Sekarang
            </button>
        </form>
    </div>
</body>
</html>