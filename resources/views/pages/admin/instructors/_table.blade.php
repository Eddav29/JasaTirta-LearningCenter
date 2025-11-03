{{-- Instructors Table --}}

<div class="bg-white rounded-lg border border-gray-200">
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Daftar Instructor</h3>
                <p class="text-sm text-gray-600 mt-1">
                    Kelola data instructor dan pengajar
                </p>
            </div>
            <div class="text-sm text-gray-600">
                <span x-show="searchQuery || specializationFilter !== 'all' || experienceLevelFilter !== 'all' || statusFilter !== 'all'" x-cloak>
                    Menampilkan <span class="font-medium text-gray-900" x-text="filteredInstructors.length"></span> 
                    dari <span class="font-medium text-gray-900" x-text="instructors.length"></span> instructor
                </span>
                <span x-show="!searchQuery && specializationFilter === 'all' && experienceLevelFilter === 'all' && statusFilter === 'all'">
                    Total <span class="font-medium text-gray-900" x-text="instructors.length"></span> instructor
                </span>
            </div>
        </div>
    </div>
    
    <div class="p-6">
        {{-- Bulk Actions Bar --}}
        <div 
            x-show="selectedInstructors.length > 0" 
            x-cloak
            class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-lg flex items-center justify-between"
        >
            <div class="flex items-center gap-3">
                <span class="text-sm font-medium text-blue-900">
                    <span x-text="selectedInstructors.length"></span> instructor dipilih
                </span>
                <button 
                    @click="selectedInstructors = []"
                    class="text-sm text-blue-600 hover:text-blue-800 font-medium"
                >
                    Batal Pilih
                </button>
            </div>
            <div class="flex items-center gap-2">
                <select 
                    @change="bulkStatusChange($event.target.value); $event.target.value = ''" 
                    class="px-3 py-1.5 text-sm border border-blue-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">Ubah Status</option>
                    <option value="Active">Set ke Active</option>
                    <option value="Inactive">Set ke Inactive</option>
                    <option value="On Leave">Set ke On Leave</option>
                    <option value="Retired">Set ke Retired</option>
                </select>
                <button 
                    @click="bulkDelete()"
                    class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700 transition-colors"
                >
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>
            </div>
        </div>

        {{-- Empty State for No Results --}}
        <div x-show="filteredInstructors.length === 0" x-cloak class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada instructor ditemukan</h3>
            <p class="mt-1 text-sm text-gray-500">Coba ubah kriteria pencarian atau filter Anda</p>
            <button 
                @click="searchQuery = ''; specializationFilter = 'all'; experienceLevelFilter = 'all'; statusFilter = 'all'"
                class="mt-4 inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50"
            >
                Reset Filter
            </button>
        </div>

        <div x-show="filteredInstructors.length > 0" class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-medium text-gray-900 w-12">
                            <input 
                                type="checkbox" 
                                @change="selectAll()"
                                :checked="selectedInstructors.length === paginatedInstructors.length && paginatedInstructors.length > 0"
                                class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
                            />
                        </th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Instructor</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Spesialisasi</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Level</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Status</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Courses</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Rating</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="instructor in paginatedInstructors" :key="instructor.id">
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-4 px-4">
                                <input 
                                    type="checkbox" 
                                    :checked="isSelected(instructor.id)"
                                    @change="toggleSelect(instructor.id)"
                                    class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
                                />
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                        <span x-text="getInitials(instructor.name)"></span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-medium text-gray-900" x-text="instructor.name"></p>
                                        <p class="text-sm text-gray-600" x-text="instructor.email"></p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex flex-wrap gap-1">
                                    <template x-for="(spec, index) in instructor.specialization.slice(0, 2)" :key="index">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800" x-text="spec"></span>
                                    </template>
                                    <template x-if="instructor.specialization.length > 2">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium border border-gray-300 text-gray-700">
                                            +<span x-text="instructor.specialization.length - 2"></span>
                                        </span>
                                    </template>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span 
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium"
                                    :class="instructor.experienceLevel === 'Expert' ? 'bg-blue-100 text-blue-800' : (instructor.experienceLevel === 'Senior' ? 'bg-indigo-100 text-indigo-800' : (instructor.experienceLevel === 'Junior' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'))"
                                    x-text="instructor.experienceLevel"
                                ></span>
                            </td>
                            <td class="py-4 px-4">
                                <span 
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium"
                                    :class="instructor.status === 'Active' ? 'bg-green-100 text-green-800' : (instructor.status === 'On Leave' ? 'bg-yellow-100 text-yellow-800' : (instructor.status === 'Inactive' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800'))"
                                    x-text="instructor.status"
                                ></span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="text-sm">
                                    <p class="font-medium"><span x-text="instructor.coursesCount"></span> courses</p>
                                    <p class="text-gray-600"><span x-text="instructor.studentsCount"></span> students</p>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-yellow-500 fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span class="ml-1 text-sm font-medium" x-text="instructor.rating"></span>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-2">
                                    <button class="p-1 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded transition-colors" title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                    <button class="p-1 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    <button 
                                        @click="deleteInstructor(instructor.id)"
                                        class="p-1 text-red-600 hover:text-red-800 hover:bg-red-50 rounded transition-colors"
                                        title="Hapus"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
            
            {{-- Empty State --}}
            <div x-show="filteredInstructors.length === 0" class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada instructor</h3>
                <p class="mt-1 text-sm text-gray-500">Tidak ada instructor yang sesuai dengan filter yang dipilih.</p>
            </div>
        </div>
        
        {{-- Pagination --}}
        <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-200" x-show="filteredInstructors.length > 0">
            <div class="text-sm text-gray-600">
                Menampilkan <span x-text="(currentPage - 1) * itemsPerPage + 1"></span>-<span x-text="Math.min(currentPage * itemsPerPage, filteredInstructors.length)"></span> dari <span x-text="filteredInstructors.length"></span> instructor
            </div>
            <div class="flex items-center gap-2">
                <button
                    @click="currentPage > 1 && currentPage--"
                    :disabled="currentPage === 1"
                    :class="currentPage === 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-50'"
                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm text-gray-700 rounded-lg transition-colors"
                >
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Previous
                </button>
                <span class="text-sm text-gray-600">
                    Halaman <span x-text="currentPage"></span> dari <span x-text="totalPages"></span>
                </span>
                <button
                    @click="currentPage < totalPages && currentPage++"
                    :disabled="currentPage >= totalPages"
                    :class="currentPage >= totalPages ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-50'"
                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm text-gray-700 rounded-lg transition-colors"
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

