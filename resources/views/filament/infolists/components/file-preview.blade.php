@php
    $filePath = $getState();
    $fileUrl = $filePath ? Illuminate\Support\Facades\Storage::disk('public')->url($filePath) : null;
    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
@endphp

<div class="p-4 border rounded-lg">
    <h3 class="text-lg font-semibold mb-2">Preview Lampiran Proposal</h3>
    @if($fileUrl)
        @if(in_array(strtolower($fileExtension), ['pdf']))
            <embed src="{{ $fileUrl }}" type="application/pdf" width="100%" height="500px" />
        @elseif(in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
            <img src="{{ $fileUrl }}" alt="Preview Lampiran" class="max-w-full h-auto rounded-lg">
        @else
            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                <x-heroicon-o-document-arrow-down class="w-8 h-8 text-gray-500"/>
                <div>
                    <p class="font-semibold text-gray-800">File tidak dapat dipratinjau.</p>
                    <a href="{{ $fileUrl }}" download
                       class="text-sm text-primary-600 hover:underline font-semibold">
                        Download File ({{ basename($filePath) }})
                    </a>
                </div>
            </div>
        @endif
    @else
        <p class="text-gray-500">Tidak ada file lampiran yang diunggah.</p>
    @endif
</div>