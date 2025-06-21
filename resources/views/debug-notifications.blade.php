<x-filament-widgets::widget>
    <x-filament::card>
        @php
            $user = auth()->user();
            if ($user) {
                $unreadCount = $user->unreadNotifications()->count();
                $notifications = $user->notifications()->limit(5)->get();
            }
        @endphp

        <h2 class="text-lg font-bold">Debug Notifikasi</h2>

        @if ($user)
            <p>User ID Login: <span class="font-bold">{{ $user->id }}</span></p>
            <p>User Name: <span class="font-bold">{{ $user->name }}</span></p>
            <p>Jumlah Notifikasi Belum Dibaca (menurut Filament): <strong class="text-xl {{ $unreadCount > 0 ? 'text-green-500' : 'text-red-500' }}">{{ $unreadCount }}</strong></p>

            <h3 class="mt-4 font-bold border-t pt-2">5 Notifikasi Terakhir dari Database:</h3>
            @forelse ($notifications as $notification)
                <div class="p-2 my-1 border rounded text-xs bg-gray-50">
                    <p><strong>Data:</strong> {{ json_encode($notification->data) }}</p>
                    <p><strong>Status:</strong> {{ $notification->read_at ?? 'Belum dibaca' }}</p>
                </div>
            @empty
                <p class="text-red-500 font-bold">Tidak ada notifikasi ditemukan untuk user ini.</p>
            @endforelse
        @else
            <p class="text-red-500 font-bold">Tidak ada user yang sedang login!</p>
        @endif
    </x-filament::card>
</x-filament-widgets::widget>