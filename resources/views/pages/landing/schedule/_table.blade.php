{{-- Schedule Table Section --}}
<section id="schedule-table" class="pb-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        @php
        $scheduleData = [
            [
                'id' => 1,
                'trainingName' => 'Teknik Sampling Air Sungai Sesuai SNI',
                'date' => '15-17 November 2024',
                'startDate' => '2024-11-15',
                'endDate' => '2024-11-17',
                'instructor' => 'Dr. Ahmad Hidayat',
                'method' => 'Offline',
                'location' => 'Jakarta',
                'capacity' => 20,
                'registered' => 15,
                'price' => 'Rp 2.500.000',
                'month' => 'November'
            ],
            [
                'id' => 2,
                'trainingName' => 'Analisis Kualitas Air Laboratorium',
                'date' => '20-24 November 2024',
                'startDate' => '2024-11-20',
                'endDate' => '2024-11-24',
                'instructor' => 'Prof. Dr. Sari Wahyuni',
                'method' => 'Offline',
                'location' => 'Jakarta',
                'capacity' => 15,
                'registered' => 12,
                'price' => 'Rp 4.200.000',
                'month' => 'November'
            ],
            [
                'id' => 3,
                'trainingName' => 'Manajemen K3L Laboratorium Air',
                'date' => '25-26 November 2024',
                'startDate' => '2024-11-25',
                'endDate' => '2024-11-26',
                'instructor' => 'Ir. Budi Santoso',
                'method' => 'Hybrid',
                'location' => 'Jakarta/Online',
                'capacity' => 25,
                'registered' => 18,
                'price' => 'Rp 1.800.000',
                'month' => 'November'
            ],
            [
                'id' => 4,
                'trainingName' => 'Sampling Air Tanah dan Sumur',
                'date' => '28-30 November 2024',
                'startDate' => '2024-11-28',
                'endDate' => '2024-11-30',
                'instructor' => 'Dr. Rina Marlina',
                'method' => 'Offline',
                'location' => 'Jakarta',
                'capacity' => 18,
                'registered' => 14,
                'price' => 'Rp 2.800.000',
                'month' => 'November'
            ],
            [
                'id' => 5,
                'trainingName' => 'Interpretasi Data Kualitas Air',
                'date' => '02-03 Desember 2024',
                'startDate' => '2024-12-02',
                'endDate' => '2024-12-03',
                'instructor' => 'Dr. Indra Kusuma',
                'method' => 'Online',
                'location' => 'Platform Digital',
                'capacity' => 30,
                'registered' => 22,
                'price' => 'Rp 1.500.000',
                'month' => 'Desember'
            ],
            [
                'id' => 6,
                'trainingName' => 'Mikrobiologi Air dan Sanitasi',
                'date' => '05-08 Desember 2024',
                'startDate' => '2024-12-05',
                'endDate' => '2024-12-08',
                'instructor' => 'Dr. Maya Sari',
                'method' => 'Offline',
                'location' => 'Jakarta',
                'capacity' => 12,
                'registered' => 12,
                'price' => 'Rp 3.500.000',
                'month' => 'Desember'
            ],
            [
                'id' => 7,
                'trainingName' => 'Audit Sistem Manajemen Laboratorium',
                'date' => '10-12 Desember 2024',
                'startDate' => '2024-12-10',
                'endDate' => '2024-12-12',
                'instructor' => 'Ir. Hendra Wijaya',
                'method' => 'Hybrid',
                'location' => 'Jakarta/Online',
                'capacity' => 20,
                'registered' => 16,
                'price' => 'Rp 3.200.000',
                'month' => 'Desember'
            ],
            [
                'id' => 8,
                'trainingName' => 'Kalibrasi Alat Uji Kualitas Air',
                'date' => '15-16 Desember 2024',
                'startDate' => '2024-12-15',
                'endDate' => '2024-12-16',
                'instructor' => 'Ir. Joko Susilo',
                'method' => 'Offline',
                'location' => 'Jakarta',
                'capacity' => 16,
                'registered' => 10,
                'price' => 'Rp 2.200.000',
                'month' => 'Desember'
            ],
            [
                'id' => 9,
                'trainingName' => 'Pengelolaan Limbah Laboratorium',
                'date' => '18-19 Desember 2024',
                'startDate' => '2024-12-18',
                'endDate' => '2024-12-19',
                'instructor' => 'Dr. Lina Hartati',
                'method' => 'Offline',
                'location' => 'Jakarta',
                'capacity' => 22,
                'registered' => 17,
                'price' => 'Rp 1.900.000',
                'month' => 'Desember'
            ],
            [
                'id' => 10,
                'trainingName' => 'Quality Assurance Laboratorium',
                'date' => '08-10 Januari 2025',
                'startDate' => '2025-01-08',
                'endDate' => '2025-01-10',
                'instructor' => 'Prof. Dr. Sari Wahyuni',
                'method' => 'Offline',
                'location' => 'Jakarta',
                'capacity' => 20,
                'registered' => 8,
                'price' => 'Rp 2.800.000',
                'month' => 'Januari'
            ],
            [
                'id' => 11,
                'trainingName' => 'Monitoring Kualitas Air Real-time',
                'date' => '13-15 Januari 2025',
                'startDate' => '2025-01-13',
                'endDate' => '2025-01-15',
                'instructor' => 'Dr. Ahmad Hidayat',
                'method' => 'Hybrid',
                'location' => 'Jakarta/Online',
                'capacity' => 25,
                'registered' => 12,
                'price' => 'Rp 3.000.000',
                'month' => 'Januari'
            ],
            [
                'id' => 12,
                'trainingName' => 'Validasi Metode Analisis Air',
                'date' => '20-22 Januari 2025',
                'startDate' => '2025-01-20',
                'endDate' => '2025-01-22',
                'instructor' => 'Dr. Maya Sari',
                'method' => 'Offline',
                'location' => 'Jakarta',
                'capacity' => 15,
                'registered' => 6,
                'price' => 'Rp 3.500.000',
                'month' => 'Januari'
            ]
        ];

        function getTrainingStatus($startDate, $endDate, $registered, $capacity) {
            $now = strtotime('now');
            $start = strtotime($startDate);
            $end = strtotime($endDate);
            
            if ($now > $end) return 'Selesai';
            if ($now >= $start && $now <= $end) return 'Berlangsung';
            if ($registered >= $capacity) return 'Penuh';
            
            $registrationClose = strtotime('-3 days', $start);
            if ($now > $registrationClose) return 'Tutup Pendaftaran';
            
            return 'Buka Pendaftaran';
        }

        function getStatusBadge($status) {
            $badges = [
                'Buka Pendaftaran' => 'bg-green-100 text-green-800',
                'Tutup Pendaftaran' => 'bg-gray-100 text-gray-800',
                'Berlangsung' => 'bg-blue-100 text-blue-800',
                'Penuh' => 'bg-red-100 text-red-800',
                'Selesai' => 'bg-gray-100 text-gray-600'
            ];
            return $badges[$status] ?? 'bg-gray-100 text-gray-800';
        }

        function getStatusIcon($status) {
            $icons = [
                'Buka Pendaftaran' => '🟢',
                'Tutup Pendaftaran' => '🟡',
                'Berlangsung' => '🔵',
                'Penuh' => '🔴',
                'Selesai' => '⚪'
            ];
            return $icons[$status] ?? '🟢';
        }

        function getMethodBadge($method) {
            $badges = [
                'Offline' => 'bg-blue-100 text-blue-800',
                'Online' => 'bg-purple-100 text-purple-800',
                'Hybrid' => 'bg-green-100 text-green-800'
            ];
            return $badges[$method] ?? 'bg-gray-100 text-gray-800';
        }

        function getAvailabilityColor($registered, $capacity) {
            $percentage = ($registered / $capacity) * 100;
            if ($percentage >= 100) return 'text-red-600';
            if ($percentage >= 80) return 'text-orange-600';
            return 'text-green-600';
        }
        @endphp

        {{-- Schedule Table --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Nama Pelatihan</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Tanggal</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Pengajar</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Metode</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Status</th>
                            <th class="px-6 py-4 text-right text-sm font-semibold text-gray-900">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($scheduleData as $schedule)
                            @php
                                $status = getTrainingStatus($schedule['startDate'], $schedule['endDate'], $schedule['registered'], $schedule['capacity']);
                                $isDisabled = in_array($status, ['Penuh', 'Tutup Pendaftaran', 'Berlangsung', 'Selesai']);
                            @endphp
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        <div class="font-medium text-sm text-gray-900 leading-tight">
                                            {{ $schedule['trainingName'] }}
                                        </div>
                                        <div class="text-xs text-gray-600 flex items-center space-x-4">
                                            <span class="flex items-center space-x-1">
                                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                <span>{{ $schedule['location'] }}</span>
                                            </span>
                                            <span class="font-semibold text-blue-600">{{ $schedule['price'] }}</span>
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <svg class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-sm font-medium text-gray-900">{{ $schedule['date'] }}</span>
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $schedule['instructor'] }}</div>
                                </td>
                                
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ getMethodBadge($schedule['method']) }}">
                                        {{ $schedule['method'] }}
                                    </span>
                                </td>
                                
                                <td class="px-6 py-4">
                                    <div class="space-y-2">
                                        <div class="flex items-center space-x-2">
                                            <span class="text-sm">{{ getStatusIcon($status) }}</span>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ getStatusBadge($status) }}">
                                                {{ $status }}
                                            </span>
                                        </div>
                                        <div class="text-xs">
                                            <span class="font-medium {{ getAvailabilityColor($schedule['registered'], $schedule['capacity']) }}">
                                                {{ $schedule['registered'] }}/{{ $schedule['capacity'] }} peserta
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4 text-right">
                                    <button 
                                        class="inline-flex items-center px-4 py-2 text-xs font-medium rounded-lg transition {{ $isDisabled ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : 'bg-blue-600 text-white hover:bg-blue-700' }}"
                                        {{ $isDisabled ? 'disabled' : '' }}
                                    >
                                        @if($status === 'Penuh')
                                            Penuh
                                        @elseif($status === 'Tutup Pendaftaran')
                                            Tutup
                                        @elseif($status === 'Berlangsung')
                                            Berlangsung
                                        @elseif($status === 'Selesai')
                                            Selesai
                                        @else
                                            Daftar
                                        @endif
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination (if needed) --}}
        <div class="flex justify-center space-x-2 mt-8" x-data="{ currentPage: 1, totalPages: 2 }">
            <button 
                @click="currentPage = Math.max(currentPage - 1, 1)"
                :disabled="currentPage === 1"
                :class="currentPage === 1 ? 'opacity-50 cursor-not-allowed' : ''"
                class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition"
            >
                Sebelumnya
            </button>
            
            <template x-for="page in totalPages" :key="page">
                <button 
                    @click="currentPage = page"
                    :class="currentPage === page ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium transition"
                    x-text="page"
                ></button>
            </template>
            
            <button 
                @click="currentPage = Math.min(currentPage + 1, totalPages)"
                :disabled="currentPage === totalPages"
                :class="currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : ''"
                class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition"
            >
                Berikutnya
            </button>
        </div>

        {{-- No Results Message (if needed) --}}
        <div class="hidden text-center py-12">
            <div class="text-gray-600 mb-4">
                Tidak ada jadwal pelatihan yang sesuai dengan kriteria pencarian
            </div>
            <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                Reset Filter
            </button>
        </div>
    </div>
</section>
