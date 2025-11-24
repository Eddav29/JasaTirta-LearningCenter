{{-- Course Cards Grid/List Section --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
    {{-- Grid View --}}
    <div x-show="viewMode === 'grid'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <template x-for="course in paginatedCourses" :key="course.id">
            <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 relative">
                {{-- Enrollment Badge --}}
                <div x-show="isEnrolled(course.id)" class="absolute top-4 right-4 z-10">
                    <span class="px-3 py-1 bg-green-600 text-white text-xs font-semibold rounded-full shadow-lg flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Terdaftar
                    </span>
                </div>

                {{-- Thumbnail --}}
                <div class="aspect-video overflow-hidden relative bg-linear-to-br from-blue-500 to-blue-700">
                    <template x-if="course.thumbnail">
                        <img :src="course.thumbnail" :alt="course.title" class="w-full h-full object-cover">
                    </template>
                    <template x-if="!course.thumbnail">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="h-16 w-16 text-white/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    </template>
                </div>

                {{-- Card Content --}}
                <div class="p-5">
                    {{-- Category and Type Badges --}}
                    <div class="flex items-center justify-between mb-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800" x-text="course.category?.name || 'Uncategorized'"></span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                              :class="{
                                  'bg-blue-100 text-blue-800': course.training_type === 'offline',
                                  'bg-purple-100 text-purple-800': course.training_type === 'online',
                                  'bg-green-100 text-green-800': course.training_type === 'hybrid'
                              }"
                              x-text="course.training_type === 'offline' ? 'Tatap Muka' : course.training_type === 'online' ? 'Daring' : 'Hybrid'">
                        </span>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 min-h-14" x-text="course.title"></h3>

                    {{-- Instructor --}}
                    <p class="text-sm text-gray-600 mb-3" x-text="course.instructor || 'TBA'"></p>

                    {{-- Description --}}
                    <p class="text-sm text-gray-600 leading-relaxed line-clamp-2 mb-4" x-text="course.description"></p>

                    {{-- Meta Information --}}
                    <div class="space-y-2 mb-4">
                        {{-- Rating --}}
                        <div class="flex items-center gap-2 text-sm">
                            <div class="flex items-center">
                                <svg class="h-4 w-4 fill-yellow-400 text-yellow-400" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="ml-1 font-medium" x-text="Number(course.rating || 0).toFixed(1)"></span>
                            </div>
                            <span class="text-gray-400">•</span>
                            <template x-if="course.level">
                                <span class="text-gray-600" x-text="course.level === 'beginner' ? 'Pemula' : course.level === 'intermediate' ? 'Menengah' : 'Lanjutan'"></span>
                            </template>
                        </div>

                        {{-- Duration and Capacity --}}
                        <div class="flex items-center gap-4 text-sm text-gray-600">
                            <div class="flex items-center gap-1">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span x-text="course.duration || 'TBA'"></span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span x-text="(course.capacity || 20) + ' peserta'"></span>
                            </div>
                        </div>
                    </div>

                    {{-- Action Button --}}
                    <template x-if="isEnrolled(course.id)">
                        <a :href="`/user/courses/${course.id}`" class="block w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-center font-medium rounded-lg transition-colors">
                            Lanjutkan Belajar
                        </a>
                    </template>
                    <template x-if="!isEnrolled(course.id)">
                        <div class="grid grid-cols-2 gap-3">
                            <a :href="`/catalog/${course.slug || course.id}`" class="block w-full px-4 py-2 bg-white border-2 border-blue-600 hover:bg-blue-50 text-blue-600 text-center font-medium rounded-lg transition-colors">
                                Detail
                            </a>
                            <a :href="getRegistrationUrl(course)" class="block w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-center font-medium rounded-lg transition-colors">
                                Daftar
                            </a>
                        </div>
                    </template>
                </div>
            </div>
        </template>
    </div>

    {{-- List View --}}
    <div x-show="viewMode === 'list'" class="space-y-4 mb-8" style="display: none;">
        <template x-for="course in paginatedCourses" :key="course.id">
            <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
                <div class="flex flex-col lg:flex-row gap-4 p-5">
                    {{-- Thumbnail --}}
                    <div class="lg:w-64 shrink-0 relative">
                        <div x-show="isEnrolled(course.id)" class="absolute top-2 right-2 z-10">
                            <span class="px-2 py-1 bg-green-600 text-white text-xs font-semibold rounded-full shadow-lg flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Terdaftar
                            </span>
                        </div>
                        <div class="aspect-video rounded-lg overflow-hidden bg-linear-to-br from-blue-500 to-blue-700">
                            <template x-if="course.thumbnail">
                                <img :src="course.thumbnail" :alt="course.title" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!course.thumbnail">
                                <div class="flex items-center justify-center h-full">
                                    <svg class="h-12 w-12 text-white/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="flex-1">
                        <div class="flex items-start justify-between gap-4 mb-2">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800" x-text="course.category?.name || 'Uncategorized'"></span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                          :class="{
                                              'bg-blue-100 text-blue-800': course.training_type === 'offline',
                                              'bg-purple-100 text-purple-800': course.training_type === 'online',
                                              'bg-green-100 text-green-800': course.training_type === 'hybrid'
                                          }"
                                          x-text="course.training_type === 'offline' ? 'Tatap Muka' : course.training_type === 'online' ? 'Daring' : 'Hybrid'">
                                    </span>
                                    <template x-if="course.level">
                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800" x-text="course.level === 'beginner' ? 'Pemula' : course.level === 'intermediate' ? 'Menengah' : 'Lanjutan'"></span>
                                    </template>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-1" x-text="course.title"></h3>
                                <p class="text-sm text-gray-600 mb-2" x-text="course.instructor || 'TBA'"></p>
                            </div>
                        </div>

                        <p class="text-sm text-gray-600 leading-relaxed line-clamp-2 mb-4" x-text="course.description"></p>

                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                                <div class="flex items-center gap-1">
                                    <svg class="h-4 w-4 fill-yellow-400 text-yellow-400" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span class="font-medium" x-text="Number(course.rating || 0).toFixed(1)"></span>
                                </div>
                                <span class="text-gray-400">•</span>
                                <div class="flex items-center gap-1">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span x-text="course.duration || 'TBA'"></span>
                                </div>
                                <span class="text-gray-400">•</span>
                                <div class="flex items-center gap-1">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span x-text="(course.capacity || 20) + ' peserta'"></span>
                                </div>
                            </div>

                            <div class="flex gap-2">
                                <template x-if="isEnrolled(course.id)">
                                    <a :href="`/user/courses/${course.id}`" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                                        Lanjutkan Belajar
                                    </a>
                                </template>
                                <template x-if="!isEnrolled(course.id)">
                                    <div class="flex gap-2">
                                        <a :href="`/catalog/${course.slug || course.id}`" class="px-6 py-2 bg-white border-2 border-blue-600 hover:bg-blue-50 text-blue-600 font-medium rounded-lg transition-colors">
                                            Detail
                                        </a>
                                        <a :href="getRegistrationUrl(course)" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                                            Daftar
                                        </a>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>

    {{-- Empty State --}}
    <div x-show="filteredCourses.length === 0" class="text-center py-16">
        <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak ada kursus ditemukan</h3>
        <p class="text-gray-600 mb-6">Coba ubah filter atau kata kunci pencarian Anda</p>
        <button @click="resetFilters()" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
            Reset Filter
        </button>
    </div>

    {{-- Pagination --}}
    <div x-show="totalPages > 1" class="flex items-center justify-center gap-2">
        <button 
            @click="goToPage(currentPage - 1)"
            :disabled="currentPage === 1"
            :class="currentPage === 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-100'"
            class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 transition-colors"
        >
            Prev
        </button>

        <template x-for="page in pageNumbers" :key="page">
            <button 
                @click="page !== '...' && goToPage(page)"
                :class="{
                    'bg-blue-600 text-white': page === currentPage,
                    'hover:bg-gray-100 text-gray-700': page !== currentPage && page !== '...',
                    'cursor-default': page === '...'
                }"
                class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium transition-colors"
                :disabled="page === '...'"
                x-text="page"
            >
            </button>
        </template>

        <button 
            @click="goToPage(currentPage + 1)"
            :disabled="currentPage === totalPages"
            :class="currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-100'"
            class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 transition-colors"
        >
            Next
        </button>
    </div>
</div>
