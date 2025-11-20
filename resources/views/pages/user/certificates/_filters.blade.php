{{-- Filters and Search --}}
<div class="bg-white rounded-lg border border-gray-200 p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        {{-- Search --}}
        <div class="flex-1 max-w-md">
            <label for="search-certificates" class="sr-only">Cari sertifikat</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input 
                    type="text" 
                    id="search-certificates"
                    x-model="searchQuery"
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                    placeholder="Cari sertifikat, kursus, atau instruktur..."
                >
            </div>
        </div>

        {{-- Sort Options --}}
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-2">
                <label for="sort-certificates" class="text-sm font-medium text-gray-700 whitespace-nowrap">
                    Urutkan:
                </label>
                <select 
                    id="sort-certificates"
                    x-model="sortBy"
                    @change="setSortBy(sortBy)"
                    class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
                    <option value="latest">Terbaru</option>
                    <option value="oldest">Terlama</option>
                    <option value="title">Judul A-Z</option>
                    <option value="score">Nilai Tertinggi</option>
                </select>
            </div>
            
            {{-- View Toggle --}}
            <div class="flex items-center space-x-1 bg-gray-100 rounded-lg p-1">
                <button 
                    @click="viewMode = 'grid'"
                    :class="viewMode === 'grid' ? 'bg-white shadow-sm' : ''"
                    class="p-2 rounded-md text-gray-400 hover:text-gray-500 transition-colors"
                    title="Grid View"
                >
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                </button>
                <button 
                    @click="viewMode = 'list'"
                    :class="viewMode === 'list' ? 'bg-white shadow-sm' : ''"
                    class="p-2 rounded-md text-gray-400 hover:text-gray-500 transition-colors"
                    title="List View"
                >
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    {{-- Results Count --}}
    <div class="mt-4 flex items-center justify-between">
        <div class="text-sm text-gray-500">
            <span x-text="filteredCertificates.length"></span> dari <span x-text="certificates.length"></span> sertifikat
        </div>
        
        {{-- Active Filters --}}
        <div class="flex items-center space-x-2">
            <template x-if="activeFilter !== 'all'">
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    <span x-text="activeFilter === 'active' ? 'Aktif' : activeFilter === 'expiring' ? 'Akan Berakhir' : 'Berakhir'"></span>
                    <button @click="setFilter('all')" class="ml-1 inline-flex items-center justify-center w-4 h-4 text-blue-400 hover:text-blue-500">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </span>
            </template>
            
            <template x-if="searchQuery">
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <span x-text="'Pencarian: ' + searchQuery"></span>
                    <button @click="searchQuery = ''" class="ml-1 inline-flex items-center justify-center w-4 h-4 text-green-400 hover:text-green-500">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </span>
            </template>
        </div>
    </div>
</div>