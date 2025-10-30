{{-- Schedules List --}}
@php
    $schedules = [
        [
            'id' => 1,
            'trainingId' => 1,
            'trainingTitle' => 'Water Quality Analysis Fundamentals',
            'instructorId' => 1,
            'instructorName' => 'Dr. Sarah Wijaya',
            'startDate' => '2024-11-15',
            'endDate' => '2024-11-17',
            'startTime' => '09:00',
            'endTime' => '16:00',
            'location' => 'Jakarta Lab Center',
            'method' => 'Offline',
            'maxParticipants' => 20,
            'registeredCount' => 15,
            'status' => 'Scheduled',
            'price' => 2500000
        ],
        [
            'id' => 2,
            'trainingId' => 2,
            'trainingTitle' => 'Advanced Microbiology Testing',
            'instructorId' => 2,
            'instructorName' => 'Muhammad Rizki, S.T.',
            'startDate' => '2024-11-20',
            'endDate' => '2024-11-22',
            'startTime' => '08:30',
            'endTime' => '17:00',
            'location' => 'Surabaya Training Center',
            'method' => 'Offline',
            'maxParticipants' => 15,
            'registeredCount' => 12,
            'status' => 'Scheduled',
            'price' => 3200000
        ],
        [
            'id' => 3,
            'trainingId' => 3,
            'trainingTitle' => 'Environmental Sampling Techniques',
            'instructorId' => 3,
            'instructorName' => 'Dr. Lisa Chen',
            'startDate' => '2024-11-25',
            'endDate' => '2024-11-26',
            'startTime' => '09:00',
            'endTime' => '15:00',
            'location' => 'Online Platform',
            'method' => 'Online',
            'maxParticipants' => 30,
            'registeredCount' => 28,
            'status' => 'Scheduled',
            'price' => 1800000
        ],
        [
            'id' => 4,
            'trainingId' => 1,
            'trainingTitle' => 'Water Quality Analysis Fundamentals',
            'instructorId' => 1,
            'instructorName' => 'Dr. Sarah Wijaya',
            'startDate' => '2024-10-15',
            'endDate' => '2024-10-17',
            'startTime' => '09:00',
            'endTime' => '16:00',
            'location' => 'Bandung Lab Center',
            'method' => 'Offline',
            'maxParticipants' => 20,
            'registeredCount' => 20,
            'status' => 'Completed',
            'price' => 2500000
        ],
        [
            'id' => 5,
            'trainingId' => 4,
            'trainingTitle' => 'Chemical Analysis Laboratory Management',
            'instructorId' => 4,
            'instructorName' => 'Ahmad Fadli, M.Sc.',
            'startDate' => '2024-12-05',
            'endDate' => '2024-12-07',
            'startTime' => '08:00',
            'endTime' => '17:30',
            'location' => 'Yogyakarta Training Center',
            'method' => 'Hybrid',
            'maxParticipants' => 25,
            'registeredCount' => 8,
            'status' => 'Scheduled',
            'price' => 2800000
        ]
    ];

    function getScheduleStatusColor($status) {
        return match($status) {
            'Scheduled' => 'bg-blue-100 text-blue-800',
            'Ongoing' => 'bg-yellow-100 text-yellow-800',
            'Completed' => 'bg-green-100 text-green-800',
            'Cancelled' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    function getScheduleMethodColor($method) {
        return match($method) {
            'Online' => 'bg-green-100 text-green-800',
            'Offline' => 'bg-blue-100 text-blue-800',
            'Hybrid' => 'bg-purple-100 text-purple-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }
@endphp

<div class="bg-white rounded-lg border border-gray-200" x-init="schedules = {{ json_encode($schedules) }}">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-bold text-gray-900">Daftar Jadwal</h3>
        <p class="text-sm text-gray-600 mt-1">
            <span x-text="`${filteredSchedules.length} jadwal ditemukan`"></span>
        </p>
    </div>

    <div class="p-6">
        <div class="space-y-4">
            <template x-for="schedule in paginatedSchedules" :key="schedule.id">
                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start gap-3 flex-1">
                            {{-- Checkbox --}}
                            <input 
                                type="checkbox"
                                @change="toggleSelect(schedule.id)"
                                :checked="isSelected(schedule.id)"
                                class="w-4 h-4 mt-1 text-blue-600 rounded focus:ring-blue-500"
                            />

                            <div class="space-y-2 flex-1">
                                {{-- Title and Badges --}}
                                <div class="flex items-center gap-2 flex-wrap">
                                    <h3 class="font-medium text-gray-900" x-text="schedule.trainingTitle"></h3>
                                    <span 
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                        :class="{
                                            'bg-blue-100 text-blue-800': schedule.status === 'Scheduled',
                                            'bg-yellow-100 text-yellow-800': schedule.status === 'Ongoing',
                                            'bg-green-100 text-green-800': schedule.status === 'Completed',
                                            'bg-red-100 text-red-800': schedule.status === 'Cancelled'
                                        }"
                                        x-text="schedule.status">
                                    </span>
                                    <span 
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                        :class="{
                                            'bg-green-100 text-green-800': schedule.method === 'Online',
                                            'bg-blue-100 text-blue-800': schedule.method === 'Offline',
                                            'bg-purple-100 text-purple-800': schedule.method === 'Hybrid'
                                        }"
                                        x-text="schedule.method">
                                    </span>
                                </div>

                                {{-- Schedule Info Grid --}}
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span x-text="formatDateRange(schedule.startDate, schedule.endDate)"></span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span x-text="`${schedule.startTime} - ${schedule.endTime}`"></span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span x-text="schedule.location"></span>
                                    </div>
                                </div>

                                {{-- Additional Info --}}
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-600">Instructor:</span>
                                        <span class="ml-1 font-medium text-gray-900" x-text="schedule.instructorName"></span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Peserta:</span>
                                        <span class="ml-1 font-medium text-gray-900" x-text="`${schedule.registeredCount}/${schedule.maxParticipants}`"></span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Harga:</span>
                                        <span class="ml-1 font-medium text-gray-900" x-text="`Rp ${schedule.price.toLocaleString('id-ID')}`"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center gap-1 ml-4">
                            <button class="p-2 hover:bg-gray-100 rounded-lg transition-colors" title="Lihat Detail">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                            <button class="p-2 hover:bg-gray-100 rounded-lg transition-colors" title="Edit">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </button>
                            <button @click="deleteSchedule(schedule.id)" class="p-2 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </template>

            {{-- Empty State --}}
            <div x-show="paginatedSchedules.length === 0" class="text-center py-8 text-gray-500">
                Tidak ada jadwal yang ditemukan
            </div>
        </div>

        {{-- Pagination --}}
        <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-200">
            <div class="text-sm text-gray-600">
                <span x-text="`Menampilkan ${((currentPage - 1) * itemsPerPage) + 1} - ${Math.min(currentPage * itemsPerPage, filteredSchedules.length)} dari ${filteredSchedules.length} jadwal`"></span>
            </div>
            <div class="flex items-center gap-2">
                <button 
                    @click="currentPage = Math.max(1, currentPage - 1)"
                    :disabled="currentPage === 1"
                    :class="currentPage === 1 ? 'opacity-50 cursor-not-allowed' : ''"
                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 transition-colors"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <span class="text-sm text-gray-600">
                    <span x-text="`${currentPage} / ${totalPages}`"></span>
                </span>
                <button 
                    @click="currentPage = Math.min(totalPages, currentPage + 1)"
                    :disabled="currentPage >= totalPages"
                    :class="currentPage >= totalPages ? 'opacity-50 cursor-not-allowed' : ''"
                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 transition-colors"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
