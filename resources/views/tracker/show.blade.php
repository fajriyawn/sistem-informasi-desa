<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Status Laporan: {{ $service->tracking_code }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-2xl p-8 space-y-6 bg-white rounded-lg shadow-md">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-800">Status Laporan</h2>
            <p class="text-lg font-mono text-indigo-600">{{ $service->tracking_code }}</p>
        </div>

        <div class="p-6 border-t">
            <h3 class="text-lg font-semibold text-gray-900">Judul Laporan:</h3>
            <p class="mt-1 text-gray-700">{{ $service->title }}</p>

            <h3 class="mt-4 text-lg font-semibold text-gray-900">Tanggal Dilaporkan:</h3>
            <p class="mt-1 text-gray-700">{{ $service->created_at->format('d F Y, H:i') }} WIB</p>

            <h3 class="mt-4 text-lg font-semibold text-gray-900">Status Terkini:</h3>
            <span class="inline-flex items-center px-3 py-1 mt-2 text-sm font-semibold text-white bg-blue-500 rounded-full">
                {{ $service->status }}
            </span>
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('tracker.index') }}" class="text-blue-600 hover:underline">Lacak laporan lain</a>
        </div>
    </div>
</body>
</html>