{{-- Statistics Cards Section --}}
@php
    $stats = [
        [
            'title' => 'Total Pengguna',
            'value' => '1,247',
            'change' => '+12%',
            'changeType' => 'increase',
            'description' => 'dari bulan lalu',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>'
        ],
        [
            'title' => 'Pelatihan Aktif',
            'value' => '23',
            'change' => '+3',
            'changeType' => 'increase',
            'description' => 'program berjalan',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>'
        ],
        [
            'title' => 'Jadwal Bulan Ini',
            'value' => '18',
            'change' => '+5',
            'changeType' => 'increase',
            'description' => 'sesi terjadwal',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>'
        ],
        [
            'title' => 'Pendapatan',
            'value' => 'Rp 125M',
            'change' => '+8.5%',
            'changeType' => 'increase',
            'description' => 'dari target',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>'
        ]
    ];
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    @foreach($stats as $stat)
        <div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">{{ $stat['title'] }}</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stat['value'] }}</p>
                    <div class="flex items-center mt-2">
                        @if($stat['changeType'] === 'increase')
                            <svg class="w-4 h-4 text-green-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        @else
                            <svg class="w-4 h-4 text-red-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
                            </svg>
                        @endif
                        <span class="text-sm font-medium {{ $stat['changeType'] === 'increase' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $stat['change'] }}
                        </span>
                        <span class="text-sm text-gray-500 ml-1">{{ $stat['description'] }}</span>
                    </div>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $stat['icon'] !!}
                    </svg>
                </div>
            </div>
        </div>
    @endforeach
</div>
