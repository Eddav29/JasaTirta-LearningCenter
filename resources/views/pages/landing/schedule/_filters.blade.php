{{-- Filters Section --}}
<section class="py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Search and Filter Controls --}}
        <div class="bg-white rounded-2xl p-6 shadow-lg mb-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-5 gap-4">
                {{-- Search Input --}}
                <div class="lg:col-span-2 relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input 
                        type="text" 
                        x-model="searchQuery"
                        @input.debounce.300ms="filterSchedules()"
                        placeholder="Cari nama pelatihan atau pengajar..." 
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    />
                </div>
                
                {{-- Category Filter --}}
                <div>
                    <select 
                        x-model="selectedCategory"
                        @change="filterSchedules()"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <option value="semua">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                {{-- Method Filter --}}
                <div>
                    <select 
                        x-model="selectedMethod"
                        @change="filterSchedules()"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <option value="semua">Semua Metode</option>
                        <option value="online">Online</option>
                        <option value="offline">Offline</option>
                        <option value="hybrid">Hybrid</option>
                    </select>
                </div>
                
                {{-- Month Filter --}}
                <div>
                    <select 
                        x-model="selectedMonth"
                        @change="filterSchedules()"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <option value="semua">Semua Bulan</option>
                        <option value="November">November 2024</option>
                        <option value="Desember">Desember 2024</option>
                        <option value="Januari">Januari 2025</option>
                    </select>
                </div>
            </div>
            
            {{-- Additional Filters Row --}}
            <div class="grid md:grid-cols-2 gap-4 mt-4">
                {{-- Availability Filter --}}
                <div>
                    <select 
                        x-model="selectedAvailability"
                        @change="filterSchedules()"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <option value="semua">Semua Status</option>
                        <option value="available">Tersedia</option>
                        <option value="full">Penuh</option>
                    </select>
                </div>
                
                {{-- Reset Button --}}
                <div class="flex items-center justify-end">
                    <button 
                        @click="resetFilters()"
                        x-show="searchQuery !== '' || selectedCategory !== 'semua' || selectedMethod !== 'semua' || selectedMonth !== 'semua' || selectedAvailability !== 'semua'"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors flex items-center gap-2"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Reset Filter
                    </button>
                </div>
            </div>
        </div>

        {{-- Results Summary --}}
        <div class="mb-6 flex items-center justify-between">
            <p class="text-gray-600">
                <span x-text="`Menampilkan ${filteredCount} dari ${totalCount} jadwal pelatihan`"></span>
            </p>
            <div class="flex items-center space-x-2 text-sm text-gray-600">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Terakhir diperbarui: {{ now()->format('d M Y') }}</span>
            </div>
        </div>
    </div>
</section>
