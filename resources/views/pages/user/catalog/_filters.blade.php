{{-- Search and Filter Section --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
    <div class="bg-white rounded-xl shadow-md p-6">
        {{-- Search Bar --}}
        <div class="mb-6">
            <div class="relative">
                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input 
                    type="text" 
                    x-model="searchQuery"
                    @input.debounce.300ms="filterCourses()"
                    placeholder="Cari nama kursus, pengajar, atau kata kunci..." 
                    class="w-full pl-12 pr-4 py-3 text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                />
            </div>
        </div>

        {{-- Filters Row --}}
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
            {{-- Category Filter --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select 
                    x-model="selectedCategory"
                    @change="filterCourses()"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                >
                    <option value="semua">Semua Kategori</option>
                    <template x-for="category in categories" :key="category.id">
                        <option :value="category.id" x-text="category.name"></option>
                    </template>
                </select>
            </div>

            {{-- Type Filter --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipe</label>
                <select 
                    x-model="selectedType"
                    @change="filterCourses()"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                >
                    <option value="semua">Semua Tipe</option>
                    <option value="offline">Tatap Muka</option>
                    <option value="online">Daring</option>
                    <option value="hybrid">Hybrid</option>
                </select>
            </div>

            {{-- Level Filter --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Level</label>
                <select 
                    x-model="selectedLevel"
                    @change="filterCourses()"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                >
                    <option value="semua">Semua Level</option>
                    <option value="beginner">Pemula</option>
                    <option value="intermediate">Menengah</option>
                    <option value="advanced">Lanjutan</option>
                </select>
            </div>

            {{-- Enrollment Status Filter --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select 
                    x-model="selectedStatus"
                    @change="filterCourses()"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                >
                    <option value="semua">Semua Kursus</option>
                    <option value="enrolled">Sudah Terdaftar</option>
                    <option value="not-enrolled">Belum Terdaftar</option>
                </select>
            </div>

            {{-- Sort By --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Urutkan</label>
                <select 
                    x-model="sortBy"
                    @change="filterCourses()"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                >
                    <option value="terbaru">Terbaru</option>
                    <option value="terlama">Terlama</option>
                    <option value="nama-az">Nama A-Z</option>
                    <option value="nama-za">Nama Z-A</option>
                    <option value="rating">Rating Tertinggi</option>
                    <option value="durasi">Durasi Terpendek</option>
                </select>
            </div>
        </div>

        {{-- Active Filters & Reset --}}
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-600">
                Menampilkan <span class="font-semibold" x-text="paginatedCourses.length"></span> dari 
                <span class="font-semibold" x-text="filteredCourses.length"></span> kursus
            </div>
            
            <button 
                @click="resetFilters()" 
                x-show="searchQuery || selectedCategory !== 'semua' || selectedType !== 'semua' || selectedStatus !== 'semua' || selectedLevel !== 'semua' || sortBy !== 'terbaru'"
                class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors flex items-center gap-2"
            >
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                Reset Filter
            </button>
        </div>
    </div>
</div>
