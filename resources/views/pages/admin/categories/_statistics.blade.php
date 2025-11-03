{{-- Categories Statistics --}}
@php
    $statsConfig = [
        [
            'key' => 'total',
            'title' => 'Total Kategori',
            'icon' => 'folder',
            'bgColor' => 'bg-blue-100',
            'iconColor' => 'text-blue-600'
        ],
        [
            'key' => 'active',
            'title' => 'Kategori Aktif',
            'icon' => 'folder',
            'bgColor' => 'bg-green-100',
            'iconColor' => 'text-green-600'
        ],
        [
            'key' => 'inactive',
            'title' => 'Tidak Aktif',
            'icon' => 'folder',
            'bgColor' => 'bg-red-100',
            'iconColor' => 'text-red-600'
        ],
        [
            'key' => 'totalTrainings',
            'title' => 'Total Pelatihan',
            'icon' => 'tag',
            'bgColor' => 'bg-purple-100',
            'iconColor' => 'text-purple-600'
        ]
    ];
@endphp

<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    @foreach($statsConfig as $statConfig)
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <div class="flex items-center">
            <div class="{{ $statConfig['bgColor'] }} p-3 rounded-full">
                @if($statConfig['icon'] === 'folder')
                <svg class="w-6 h-6 {{ $statConfig['iconColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                </svg>
                @else
                <svg class="w-6 h-6 {{ $statConfig['iconColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                @endif
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">{{ $statConfig['title'] }}</p>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($stats[$statConfig['key']]) }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
