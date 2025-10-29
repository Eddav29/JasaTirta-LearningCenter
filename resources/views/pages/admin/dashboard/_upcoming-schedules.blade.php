{{-- Upcoming Schedules Section --}}
@php
    $upcomingSchedules = [
        [
            'id' => 1,
            'title' => 'Teknik Sampling Air Sungai',
            'date' => '15 November 2024',
            'time' => '08:00 - 17:00',
            'participants' => 18,
            'capacity' => 20,
            'instructor' => 'Dr. Ahmad Hidayat',
            'status' => 'confirmed'
        ],
        [
            'id' => 2,
            'title' => 'Analisis Kualitas Air Lab',
            'date' => '20 November 2024',
            'time' => '08:00 - 17:00',
            'participants' => 15,
            'capacity' => 15,
            'instructor' => 'Prof. Dr. Sari Wahyuni',
            'status' => 'full'
        ],
        [
            'id' => 3,
            'title' => 'K3L Laboratorium',
            'date' => '25 November 2024',
            'time' => '09:00 - 16:00',
            'participants' => 12,
            'capacity' => 25,
            'instructor' => 'Ir. Budi Santoso',
            'status' => 'open'
        ]
    ];

    function getScheduleStatusColor($status) {
        return match($status) {
            'confirmed' => 'bg-blue-100 text-blue-800',
            'full' => 'bg-red-100 text-red-800',
            'open' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    function getScheduleStatusText($status) {
        return match($status) {
            'confirmed' => 'Terkonfirmasi',
            'full' => 'Penuh',
            'open' => 'Terbuka',
            default => $status
        };
    }
@endphp

<div class="bg-white rounded-lg border border-gray-200">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-bold text-gray-900">Jadwal Mendatang</h3>
        <p class="text-sm text-gray-600 mt-1">Pelatihan yang akan dimulai dalam 7 hari ke depan</p>
    </div>
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Pelatihan</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Tanggal & Waktu</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Peserta</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Pengajar</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Status</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($upcomingSchedules as $schedule)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-4 px-4">
                                <div>
                                    <p class="font-medium text-gray-900 text-sm">{{ $schedule['title'] }}</p>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="text-sm">
                                    <p class="text-gray-900">{{ $schedule['date'] }}</p>
                                    <p class="text-gray-600">{{ $schedule['time'] }}</p>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="text-sm">
                                    <p class="text-gray-900">{{ $schedule['participants'] }}/{{ $schedule['capacity'] }}</p>
                                    {{-- Mini Progress Bar --}}
                                    <div class="w-16 bg-gray-200 rounded-full h-1 mt-1">
                                        <div class="bg-blue-600 h-1 rounded-full" style="width: {{ ($schedule['participants'] / $schedule['capacity']) * 100 }}%"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <p class="text-sm text-gray-900">{{ $schedule['instructor'] }}</p>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ getScheduleStatusColor($schedule['status']) }}">
                                    {{ getScheduleStatusText($schedule['status']) }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <button class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
