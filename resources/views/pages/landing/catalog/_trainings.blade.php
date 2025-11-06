{{-- Training Cards Grid Section --}}
<section id="trainings-section" class="pb-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Training Cards Grid --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
            <template x-for="training in paginatedTrainings" :key="training.id">
                <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 cursor-pointer" @click="window.location.href = `/training/${training.id}`">
                    {{-- Image --}}
                    <div class="aspect-video overflow-hidden relative bg-linear-to-br from-blue-500 to-blue-700">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="h-16 w-16 text-white/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                    </div>
                    
                    {{-- Card Header --}}
                    <div class="p-6 pb-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800" x-text="training.category?.name"></span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                  :class="{
                                      'bg-blue-100 text-blue-800': training.training_type === 'offline',
                                      'bg-purple-100 text-purple-800': training.training_type === 'online',
                                      'bg-green-100 text-green-800': training.training_type === 'hybrid'
                                  }"
                                  x-text="training.training_type === 'offline' ? 'Tatap Muka' : training.training_type === 'online' ? 'Daring' : 'Hybrid'">
                            </span>
                        </div>
                        <h3 class="text-lg font-semibold leading-tight line-clamp-2 text-gray-900 mb-2" x-text="training.title"></h3>
                        <p class="text-sm text-gray-600 leading-relaxed line-clamp-3" x-text="training.description"></p>
                    </div>
                    
                    {{-- Card Content --}}
                    <div class="px-6 pb-6 space-y-4">
                        {{-- Rating and Reviews --}}
                        <div class="flex items-center space-x-2 text-sm">
                            <div class="flex items-center space-x-1">
                                <svg class="h-4 w-4 fill-yellow-400 text-yellow-400" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="font-medium" x-text="(training.rating || 4.5).toFixed(1)"></span>
                            </div>
                            <span class="text-gray-500">(<span x-text="training.review_count || 0"></span> ulasan)</span>
                            <template x-if="training.learning_hours">
                                <>
                                    <span class="text-gray-500">•</span>
                                    <span class="text-gray-500" x-text="training.learning_hours + ' JP'"></span>
                                </>
                            </template>
                        </div>

                        <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                            <div class="flex items-center space-x-2">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span x-text="training.duration"></span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <span x-text="(training.capacity || 20) + ' peserta'"></span>
                            </div>
                            <template x-if="training.schedules && training.schedules.length > 0">
                                <div class="flex items-center space-x-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span x-text="new Date(training.schedules[0].start_date).toLocaleDateString('id-ID', {day: 'numeric', month: 'short'})"></span>
                                </div>
                            </template>
                            <template x-if="training.schedules && training.schedules.length > 0">
                                <div class="flex items-center space-x-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="truncate" x-text="training.schedules[0].location || 'TBA'"></span>
                                </div>
                            </template>
                        </div>

                        {{-- Availability Status --}}
                        <template x-if="training.schedules && training.schedules.length > 0 && training.schedules[0].available_slots">
                            <div class="flex items-center justify-between text-xs">
                                <span class="font-medium"
                                      :class="{
                                          'text-green-600': (training.schedules[0].available_slots / training.schedules[0].total_slots * 100) > 50,
                                          'text-orange-600': (training.schedules[0].available_slots / training.schedules[0].total_slots * 100) > 20 && (training.schedules[0].available_slots / training.schedules[0].total_slots * 100) <= 50,
                                          'text-red-600': (training.schedules[0].available_slots / training.schedules[0].total_slots * 100) <= 20
                                      }"
                                      x-text="(training.schedules[0].available_slots / training.schedules[0].total_slots * 100) > 50 ? 'Tersedia' : (training.schedules[0].available_slots / training.schedules[0].total_slots * 100) > 20 ? 'Terbatas' : 'Hampir Penuh'">
                                </span>
                                <span class="text-gray-500">
                                    <span x-text="training.schedules[0].available_slots"></span> dari <span x-text="training.schedules[0].total_slots"></span> slot tersisa
                                </span>
                            </div>
                        </template>
                        
                        <div class="border-t pt-4">
                            <div class="flex flex-col space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-2xl font-bold text-blue-600">Rp <span x-text="new Intl.NumberFormat('id-ID').format(training.price || 0)"></span></span>
                                    <span class="text-sm text-gray-500">per peserta</span>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <a :href="`/training/${training.id}`" @click.stop class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                                        Detail
                                    </a>
                                    <a href="{{ route('register') }}" @click.stop class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition"
                                       :class="{'opacity-50 cursor-not-allowed': training.schedules && training.schedules[0] && training.schedules[0].available_slots === 0}"
                                       x-text="(training.schedules && training.schedules[0] && training.schedules[0].available_slots === 0) ? 'Penuh' : 'Daftar'">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        
        {{-- Empty State --}}
        <div x-show="paginatedTrainings.length === 0 && filteredTrainings.length === 0" class="col-span-full text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada pelatihan ditemukan</h3>
            <p class="mt-1 text-sm text-gray-500">Coba ubah filter atau kata kunci pencarian Anda.</p>
            <button @click="resetFilters()" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                Reset Filter
            </button>
        </div>
    </div>
</section>
