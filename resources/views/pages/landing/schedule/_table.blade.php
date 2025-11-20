{{-- Schedule Table Section --}}
<section id="schedule-table" class="pb-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Desktop Table View --}}
        <div class="hidden lg:block bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-linear-to-r from-blue-600 to-blue-700">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Nama Pelatihan
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Pengajar
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Metode
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Ketersediaan
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Harga
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- Alpine.js Template for Schedule Rows --}}
                        <template x-for="schedule in paginatedSchedules" :key="schedule.id">
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                {{-- Training Name --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-start">
                                        <div>
                                            <div class="text-sm font-semibold text-gray-900" x-text="schedule.training.title"></div>
                                            <div class="text-xs text-gray-500 mt-1" x-text="schedule.training.category.name"></div>
                                        </div>
                                    </div>
                                </td>
                                
                                {{-- Date --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900" x-text="formatDate(schedule.start_date, schedule.end_date)"></div>
                                    <div class="text-xs text-gray-500 mt-1" x-text="schedule.duration + ' hari'"></div>
                                </td>
                                
                                {{-- Instructor --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900" x-text="schedule.training.instructor ? schedule.training.instructor.name : 'TBA'"></div>
                                            <div class="text-xs text-gray-500" x-text="schedule.training.instructor ? schedule.training.instructor.specialization : ''"></div>
                                        </div>
                                    </div>
                                </td>
                                
                                {{-- Method --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col gap-1">
                                        <span 
                                            :class="{
                                                'bg-green-100 text-green-800': schedule.method === 'online',
                                                'bg-blue-100 text-blue-800': schedule.method === 'offline',
                                                'bg-purple-100 text-purple-800': schedule.method === 'hybrid'
                                            }"
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize"
                                        >
                                            <span x-text="schedule.method"></span>
                                        </span>
                                        <span class="text-xs text-gray-500" x-text="schedule.location"></span>
                                    </div>
                                </td>
                                
                                {{-- Availability --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col gap-1">
                                        <span 
                                            :class="getAvailabilityClass(schedule.available_slots, schedule.max_participants)"
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                            x-text="getAvailabilityText(schedule.available_slots)"
                                        ></span>
                                        <span class="text-xs text-gray-600" x-text="`${schedule.registered_count}/${schedule.max_participants} peserta`"></span>
                                    </div>
                                </td>
                                
                                {{-- Price --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900" x-text="formatPrice(schedule.price)"></div>
                                </td>
                                
                                {{-- Action --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <a 
                                        :href="`/training/${schedule.training_id}`" 
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-150"
                                    >
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        </template>
                        
                        {{-- Empty State --}}
                        <tr x-show="filteredSchedules.length === 0">
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak ada jadwal yang ditemukan</h3>
                                    <p class="text-gray-500 mb-4">Coba ubah filter atau kata kunci pencarian Anda</p>
                                    <button 
                                        @click="resetFilters()"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                                    >
                                        Reset Filter
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Mobile Card View --}}
        <div class="lg:hidden space-y-4">
            {{-- Alpine.js Template for Mobile Cards --}}
            <template x-for="schedule in paginatedSchedules" :key="schedule.id">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        {{-- Header --}}
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2" x-text="schedule.training.title"></h3>
                                <p class="text-sm text-blue-600 font-medium" x-text="schedule.training.category.name"></p>
                            </div>
                            <span 
                                :class="getAvailabilityClass(schedule.available_slots, schedule.max_participants)"
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                x-text="getAvailabilityText(schedule.available_slots)"
                            ></span>
                        </div>
                        
                        {{-- Details Grid --}}
                        <div class="space-y-3">
                            {{-- Date --}}
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-400 mt-0.5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-900" x-text="formatDate(schedule.start_date, schedule.end_date)"></p>
                                    <p class="text-xs text-gray-500" x-text="schedule.duration + ' hari'"></p>
                                </div>
                            </div>
                            
                            {{-- Instructor --}}
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-400 mt-0.5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-900" x-text="schedule.training.instructor ? schedule.training.instructor.name : 'TBA'"></p>
                                    <p class="text-xs text-gray-500" x-text="schedule.training.instructor ? schedule.training.instructor.specialization : ''"></p>
                                </div>
                            </div>
                            
                            {{-- Method & Location --}}
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-400 mt-0.5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <span 
                                        :class="{
                                            'bg-green-100 text-green-800': schedule.method === 'online',
                                            'bg-blue-100 text-blue-800': schedule.method === 'offline',
                                            'bg-purple-100 text-purple-800': schedule.method === 'hybrid'
                                        }"
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize"
                                        x-text="schedule.method"
                                    ></span>
                                    <p class="text-xs text-gray-500 mt-1" x-text="schedule.location"></p>
                                </div>
                            </div>
                            
                            {{-- Capacity --}}
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-400 mt-0.5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <p class="text-sm text-gray-900" x-text="`${schedule.registered_count}/${schedule.max_participants} peserta terdaftar`"></p>
                            </div>
                        </div>
                        
                        {{-- Footer --}}
                        <div class="mt-6 pt-4 border-t border-gray-200 flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-500">Harga</p>
                                <p class="text-lg font-bold text-gray-900" x-text="formatPrice(schedule.price)"></p>
                            </div>
                            <a 
                                :href="`/training/${schedule.training_id}`" 
                                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-150"
                            >
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </template>
            
            {{-- Mobile Empty State --}}
            <div x-show="filteredSchedules.length === 0" class="bg-white rounded-xl shadow-md p-8 text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak ada jadwal yang ditemukan</h3>
                <p class="text-gray-500 mb-4">Coba ubah filter atau kata kunci pencarian Anda</p>
                <button 
                    @click="resetFilters()"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                >
                    Reset Filter
                </button>
            </div>
        </div>

        {{-- Pagination --}}
        <div x-show="totalPages > 1" class="mt-8">
            <nav class="flex items-center justify-between border-t border-gray-200 px-4 sm:px-0">
                <div class="-mt-px flex w-0 flex-1">
                    <button
                        @click="previousPage()"
                        :disabled="currentPage === 1"
                        :class="currentPage === 1 ? 'opacity-50 cursor-not-allowed' : 'hover:border-gray-300 hover:text-gray-700'"
                        class="inline-flex items-center border-t-2 border-transparent pt-4 pr-1 text-sm font-medium text-gray-500"
                    >
                        <svg class="mr-3 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Sebelumnya
                    </button>
                </div>
                <div class="hidden md:-mt-px md:flex">
                    <template x-for="page in pageNumbers" :key="page">
                        <button
                            @click="goToPage(page)"
                            :class="currentPage === page ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="inline-flex items-center border-t-2 px-4 pt-4 text-sm font-medium"
                            x-text="page"
                        ></button>
                    </template>
                </div>
                <div class="-mt-px flex w-0 flex-1 justify-end">
                    <button
                        @click="nextPage()"
                        :disabled="currentPage === totalPages"
                        :class="currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : 'hover:border-gray-300 hover:text-gray-700'"
                        class="inline-flex items-center border-t-2 border-transparent pt-4 pl-1 text-sm font-medium text-gray-500"
                    >
                        Berikutnya
                        <svg class="ml-3 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </nav>
            
            {{-- Mobile Pagination Info --}}
            <div class="mt-4 flex items-center justify-center text-sm text-gray-700 md:hidden">
                <span>Halaman <span x-text="currentPage"></span> dari <span x-text="totalPages"></span></span>
            </div>
        </div>
    </div>
</section>
