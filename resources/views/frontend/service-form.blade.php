@extends('frontend.layouts.app')

@section('content')
<section class="max-w-2xl mx-auto py-10 px-4">
    <h2 class="text-xl font-semibold mb-4">Form Layanan Masyarakat</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('service.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" id="nama" required class="mt-1 block w-full border border-gray-300 rounded px-3 py-2">
        </div>
        <div>
            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
            <input type="text" name="alamat" id="alamat" required class="mt-1 block w-full border border-gray-300 rounded px-3 py-2">
        </div>
        <div>
            <label for="keluhan" class="block text-sm font-medium text-gray-700">Keluhan</label>
            <textarea name="keluhan" id="keluhan" rows="4" required class="mt-1 block w-full border border-gray-300 rounded px-3 py-2"></textarea>
        </div>
        <button type="submit" class="bg-[#0f3a2f] text-white px-4 py-2 rounded hover:bg-green-900">
            Kirim
        </button>
    </form>
</section>
@endsection
