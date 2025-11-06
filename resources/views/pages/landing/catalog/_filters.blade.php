{{-- Search and Filter Section --}}
<section id="filters" class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Search and Filter Controls --}}
        <div class="bg-white rounded-2xl p-8 shadow-lg mb-8">
            {{-- Main Search Bar --}}
            <div class="flex gap-4 mb-6">
                <div class="relative flex-1">
                    <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input 
                        type="text" 
                        x-model="searchQuery"
                        @input.debounce.300ms="filterTrainings()"
                        placeholder="Cari nama pelatihan atau pengajar..." 
                        class="w-full pl-12 pr-4 py-4 text-lg border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-500"
                    />
                </div>
                <div class="flex items-center gap-2">
                    <button 
                        @click="resetFilters()" 
                        x-show="searchQuery || selectedCategory !== 'semua' || selectedType !== 'semua' || selectedPrice !== 'semua'"
                        class="px-6 py-4 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-all duration-300 flex items-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Reset
                    </button>
                </div>
            </div>

            {{-- Filter Dropdowns --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- Category Select --}}
                <div>
                    <select 
                        x-model="selectedCategory"
                        @change="filterTrainings()"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-700 bg-white"
                    >
                        <option value="semua">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }} ({{ $category->trainings_count }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Type Select --}}
                <div>
                    <select 
                        x-model="selectedType"
                        @change="filterTrainings()"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-700 bg-white"
                    >
                        <option value="semua">Semua Tipe</option>
                        <option value="offline">Tatap Muka</option>
                        <option value="online">Daring</option>
                        <option value="hybrid">Hybrid</option>
                    </select>
                </div>

                {{-- Price Select --}}
                <div>
                    <select 
                        x-model="selectedPrice"
                        @change="filterTrainings()"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-700 bg-white"
                    >
                        <option value="semua">Semua Harga</option>
                        <option value="1-5">1-5 Juta</option>
                        <option value="5-10">5-10 Juta</option>
                        <option value="10+">10+ Juta</option>
                    </select>
                </div>

                {{-- Sort Select --}}
                <div>
                    <select 
                        x-model="sortBy"
                        @change="filterTrainings()"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-700 bg-white"
                    >
                        <option value="terbaru">Urutkan: Terbaru</option>
                        <option value="terpopuler">Terpopuler</option>
                        <option value="harga-rendah">Harga Terendah</option>
                        <option value="harga-tinggi">Harga Tertinggi</option>
                        <option value="nama">Nama A-Z</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Results Summary --}}
        <div class="mb-8 flex items-center justify-between">
            <p class="text-gray-600 text-lg">
                Ditemukan <span class="font-semibold text-gray-900" x-text="filteredCount"></span> dari <span class="font-semibold text-gray-900" x-text="totalCount"></span> pelatihan
            </p>
            
            <div x-show="searchQuery && searchQuery.trim() !== ''" class="flex items-center gap-2">
                <span class="text-sm text-gray-500">Hasil pencarian untuk:</span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                    "<span x-text="searchQuery"></span>"
                    <button @click="searchQuery = ''; filterTrainings();" class="ml-2 hover:text-blue-900">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </span>
            </div>
        </div>
    </div>
</section>
