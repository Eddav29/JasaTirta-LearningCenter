{{-- Trainings Table --}}
@php
    $trainings = [
        [
            'id' => 1,
            'title' => 'Water Quality Analysis Fundamentals',
            'description' => 'Comprehensive training on basic water quality testing methods and interpretation of results.',
            'category' => 'Water Quality',
            'level' => 'Beginner',
            'duration' => 16,
            'price' => 2500000,
            'status' => 'Active',
            'instructorName' => 'Dr. Sarah Wijaya',
            'maxParticipants' => 20,
            'enrolledCount' => 18,
            'rating' => 4.8,
            'isCertified' => true,
            'isOnline' => false
        ],
        [
            'id' => 2,
            'title' => 'Advanced Environmental Sampling Techniques',
            'description' => 'Advanced training for environmental sampling procedures and quality control measures.',
            'category' => 'Environmental',
            'level' => 'Advanced',
            'duration' => 24,
            'price' => 3500000,
            'status' => 'Active',
            'instructorName' => 'Muhammad Rizki, S.T.',
            'maxParticipants' => 15,
            'enrolledCount' => 12,
            'rating' => 4.7,
            'isCertified' => true,
            'isOnline' => false
        ],
        [
            'id' => 3,
            'title' => 'Microbiology Laboratory Management',
            'description' => 'Complete training on managing microbiology laboratory operations and safety protocols.',
            'category' => 'Microbiology',
            'level' => 'Expert',
            'duration' => 32,
            'price' => 4500000,
            'status' => 'Active',
            'instructorName' => 'Dr. Lisa Chen',
            'maxParticipants' => 12,
            'enrolledCount' => 10,
            'rating' => 4.9,
            'isCertified' => true,
            'isOnline' => true
        ],
        [
            'id' => 4,
            'title' => 'Introduction to Chemical Analysis',
            'description' => 'Basic training for chemical analysis methods and instrument operation.',
            'category' => 'Chemical Analysis',
            'level' => 'Beginner',
            'duration' => 20,
            'price' => 2800000,
            'status' => 'Draft',
            'instructorName' => 'Ahmad Fadli, M.Sc.',
            'maxParticipants' => 18,
            'enrolledCount' => 0,
            'rating' => 0,
            'isCertified' => true,
            'isOnline' => false
        ],
        [
            'id' => 5,
            'title' => 'Food Safety and HACCP Implementation',
            'description' => 'Comprehensive training on food safety principles and HACCP system implementation.',
            'category' => 'Food Safety',
            'level' => 'Intermediate',
            'duration' => 28,
            'price' => 3200000,
            'status' => 'Active',
            'instructorName' => 'Dr. Lisa Chen',
            'maxParticipants' => 25,
            'enrolledCount' => 22,
            'rating' => 4.6,
            'isCertified' => true,
            'isOnline' => true
        ],
        [
            'id' => 6,
            'title' => 'Laboratory Quality Management Systems',
            'description' => 'Training on implementing and maintaining quality management systems in laboratories.',
            'category' => 'Quality Management',
            'level' => 'Advanced',
            'duration' => 30,
            'price' => 4000000,
            'status' => 'Inactive',
            'instructorName' => 'Dr. Sarah Wijaya',
            'maxParticipants' => 16,
            'enrolledCount' => 5,
            'rating' => 4.5,
            'isCertified' => true,
            'isOnline' => false
        ]
    ];

    function getStatusColor($status) {
        return match($status) {
            'Active' => 'bg-green-100 text-green-800',
            'Inactive' => 'bg-red-100 text-red-800',
            'Draft' => 'bg-yellow-100 text-yellow-800',
            'Archived' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    function getLevelColor($level) {
        return match($level) {
            'Expert' => 'bg-purple-100 text-purple-800',
            'Advanced' => 'bg-blue-100 text-blue-800',
            'Intermediate' => 'bg-indigo-100 text-indigo-800',
            'Beginner' => 'bg-green-100 text-green-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    function formatCurrency($amount) {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
@endphp

<div class="bg-white rounded-lg border border-gray-200" x-data="trainingsManager()" x-init="trainings = {{ json_encode($trainings) }}">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-bold text-gray-900">Daftar Pelatihan</h3>
        <p class="text-sm text-gray-600 mt-1">
            <span x-text="`Menampilkan ${filteredTrainings.length} dari ${trainings.length} pelatihan`"></span>
        </p>
    </div>
    
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-medium text-gray-900 w-12">
                            <input 
                                type="checkbox" 
                                @change="selectAll()"
                                :checked="selectedTrainings.length === paginatedTrainings.length && paginatedTrainings.length > 0"
                                class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
                            />
                        </th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Pelatihan</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Kategori</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Level</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Status</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Instructor</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Peserta</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Harga</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="training in paginatedTrainings" :key="training.id">
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-4 px-4">
                                <input 
                                    type="checkbox"
                                    @change="toggleSelect(training.id)"
                                    :checked="isSelected(training.id)"
                                    class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
                                />
                            </td>
                            <td class="py-4 px-4">
                                <div>
                                    <p class="font-medium text-gray-900" x-text="training.title"></p>
                                    <p class="text-sm text-gray-600 line-clamp-2" x-text="training.description"></p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-xs text-gray-500" x-text="`${training.duration} jam`"></span>
                                        <template x-if="training.isCertified">
                                            <span class="inline-flex items-center gap-1">
                                                <svg class="w-3 h-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                                </svg>
                                                <span class="text-xs text-orange-600">Bersertifikat</span>
                                            </span>
                                        </template>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800" x-text="training.category"></span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                      :class="{
                                          'bg-purple-100 text-purple-800': training.level === 'Expert',
                                          'bg-blue-100 text-blue-800': training.level === 'Advanced',
                                          'bg-indigo-100 text-indigo-800': training.level === 'Intermediate',
                                          'bg-green-100 text-green-800': training.level === 'Beginner'
                                      }"
                                      x-text="training.level">
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                      :class="{
                                          'bg-green-100 text-green-800': training.status === 'Active',
                                          'bg-red-100 text-red-800': training.status === 'Inactive',
                                          'bg-yellow-100 text-yellow-800': training.status === 'Draft',
                                          'bg-gray-100 text-gray-800': training.status === 'Archived'
                                      }"
                                      x-text="training.status">
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <p class="text-sm font-medium" x-text="training.instructorName"></p>
                            </td>
                            <td class="py-4 px-4">
                                <div class="text-sm">
                                    <p class="font-medium" x-text="`${training.enrolledCount}/${training.maxParticipants}`"></p>
                                    <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                                        <div class="bg-blue-600 h-1.5 rounded-full" :style="`width: ${(training.enrolledCount / training.maxParticipants) * 100}%`"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <p class="text-sm font-medium" x-text="`Rp ${training.price.toLocaleString('id-ID')}`"></p>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-2">
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
                                    <button @click="deleteTraining(training.id)" class="p-2 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="flex items-center justify-between px-6 py-4 border-t border-gray-200 mt-4">
            <div class="text-sm text-gray-600">
                <span x-text="`Menampilkan ${(currentPage - 1) * itemsPerPage + 1}-${Math.min(currentPage * itemsPerPage, filteredTrainings.length)} dari ${filteredTrainings.length} pelatihan`"></span>
            </div>
            <div class="flex items-center gap-2">
                <button 
                    @click="currentPage = Math.max(currentPage - 1, 1)"
                    :disabled="currentPage === 1"
                    :class="currentPage === 1 ? 'opacity-50 cursor-not-allowed' : ''"
                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 transition-colors"
                >
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Previous
                </button>
                <span class="text-sm text-gray-600">
                    <span x-text="`Halaman ${currentPage} dari ${totalPages}`"></span>
                </span>
                <button 
                    @click="currentPage = Math.min(currentPage + 1, totalPages)"
                    :disabled="currentPage >= totalPages"
                    :class="currentPage >= totalPages ? 'opacity-50 cursor-not-allowed' : ''"
                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 transition-colors"
                >
                    Next
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
