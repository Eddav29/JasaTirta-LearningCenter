{{-- Recent Activities and Popular Trainings Section --}}
@php
    $recentActivities = [
        [
            'id' => 1,
            'type' => 'registration',
            'title' => 'Pendaftaran Baru',
            'description' => 'Ahmad Hidayat mendaftar "Teknik Sampling Air Sungai"',
            'time' => '2 menit yang lalu',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>',
            'color' => 'text-green-600'
        ],
        [
            'id' => 2,
            'type' => 'schedule',
            'title' => 'Jadwal Ditambahkan',
            'description' => 'Jadwal baru "Analisis Kualitas Air Lab" - 15 Des 2024',
            'time' => '15 menit yang lalu',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
            'color' => 'text-blue-600'
        ],
        [
            'id' => 3,
            'type' => 'training',
            'title' => 'Pelatihan Selesai',
            'description' => 'Batch "Mikrobiologi Air" telah menyelesaikan program',
            'time' => '1 jam yang lalu',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>',
            'color' => 'text-purple-600'
        ],
        [
            'id' => 4,
            'type' => 'message',
            'title' => 'Pesan Kontak Baru',
            'description' => 'PT Tirta Mandiri mengirim inquiry pelatihan korporat',
            'time' => '2 jam yang lalu',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>',
            'color' => 'text-orange-600'
        ],
        [
            'id' => 5,
            'type' => 'training',
            'title' => 'Program Baru',
            'description' => 'Pelatihan "Validasi Metode Analisis" telah dipublikasi',
            'time' => '3 jam yang lalu',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>',
            'color' => 'text-indigo-600'
        ]
    ];

    $popularTrainings = [
        [
            'id' => 1,
            'title' => 'Teknik Sampling Air Sungai',
            'participants' => 45,
            'capacity' => 60,
            'revenue' => 'Rp 112.5M',
            'status' => 'active',
            'growth' => '+15%'
        ],
        [
            'id' => 2,
            'title' => 'Analisis Kualitas Air Lab',
            'participants' => 38,
            'capacity' => 45,
            'revenue' => 'Rp 159.6M',
            'status' => 'active',
            'growth' => '+22%'
        ],
        [
            'id' => 3,
            'title' => 'Manajemen K3L Laboratorium',
            'participants' => 52,
            'capacity' => 75,
            'revenue' => 'Rp 93.6M',
            'status' => 'active',
            'growth' => '+8%'
        ],
        [
            'id' => 4,
            'title' => 'Mikrobiologi Air',
            'participants' => 28,
            'capacity' => 36,
            'revenue' => 'Rp 98M',
            'status' => 'full',
            'growth' => '+18%'
        ]
    ];

    function getStatusColor($status) {
        return match($status) {
            'active' => 'bg-green-100 text-green-800',
            'full' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    function getStatusText($status) {
        return match($status) {
            'active' => 'Aktif',
            'full' => 'Penuh',
            default => $status
        };
    }
@endphp

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    {{-- Recent Activities Card --}}
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Aktivitas Terbaru</h3>
                    <p class="text-sm text-gray-600 mt-1">Aktivitas sistem dalam 24 jam terakhir</p>
                </div>
                <button class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @foreach($recentActivities as $activity)
                    <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="p-2 rounded-full bg-gray-100 {{ $activity['color'] }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $activity['icon'] !!}
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-sm text-gray-900">{{ $activity['title'] }}</p>
                            <p class="text-sm text-gray-600 truncate">{{ $activity['description'] }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $activity['time'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Popular Trainings Card --}}
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-900">Pelatihan Terpopuler</h3>
            <p class="text-sm text-gray-600 mt-1">Program dengan pendaftaran tertinggi bulan ini</p>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @foreach($popularTrainings as $training)
                    <div class="p-4 rounded-lg border border-gray-200 hover:border-blue-200 transition-colors">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="font-medium text-gray-900 text-sm">{{ $training['title'] }}</h4>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ getStatusColor($training['status']) }}">
                                {{ getStatusText($training['status']) }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-sm text-gray-600 mb-3">
                            <span>{{ $training['participants'] }}/{{ $training['capacity'] }} peserta</span>
                            <span class="font-medium text-green-600">{{ $training['growth'] }}</span>
                        </div>
                        {{-- Progress Bar --}}
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ ($training['participants'] / $training['capacity']) * 100 }}%"></div>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">Pendapatan</span>
                            <span class="font-medium text-gray-900">{{ $training['revenue'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
