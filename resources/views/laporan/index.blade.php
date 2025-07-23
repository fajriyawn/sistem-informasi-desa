@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6 pt-28">
    <h2 class="text-xl font-bold mb-4">Layanan Laporan Masyarakat</h2>

    {{-- Tabs --}}
    <div class="border-b border-gray-200 mb-4">
        <ul class="flex space-x-4 text-sm font-medium text-gray-600">
            <li>
                <a href="?tab=create" class="pb-2 border-b-2 {{ request('tab', 'create') === 'create' ? 'border-indigo-500 text-indigo-600' : 'border-transparent hover:text-indigo-600' }}">
                    Buat Laporan
                </a>
            </li>
            <li>
                <a href="?tab=tracker" class="pb-2 border-b-2 {{ request('tab') === 'tracker' ? 'border-indigo-500 text-indigo-600' : 'border-transparent hover:text-indigo-600' }}">
                    Lacak Laporan
                </a>
            </li>
        </ul>
    </div>

    {{-- Konten Tab --}}
    <div class="bg-white p-6 shadow rounded-lg w-full flex justify-center">
        @if (request('tab', 'create') === 'create')
            @include('laporan.create')
        @elseif (request('tab') === 'tracker')
            @include('tracker.lacak')
        @endif
    </div>
</div>
@endsection

