{{-- Search and Filter Section --}}
<section id="filters" class="py-12 bg-gray-50" x-data="catalogFilters()">
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
                        placeholder="Cari nama pelatihan atau pengajar..." 
                        class="w-full pl-12 pr-4 py-4 text-lg border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-500"
                    />
                </div>
                <button class="px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Cari
                </button>
            </div>

            {{-- Filter Dropdowns --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- Category Select --}}
                <div>
                    <select 
                        x-model="selectedCategory"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-700 bg-white"
                    >
                        <option value="semua">Semua Kategori</option>
                        <option value="Analisis Lab">Analisis Lab</option>
                        <option value="Sampling Lingkungan">Sampling Lingkungan</option>
                        <option value="Sampling Air">Sampling Air</option>
                        <option value="K3L">K3L</option>
                        <option value="Analisis Data">Analisis Data</option>
                        <option value="Manajemen">Manajemen</option>
                        <option value="Kalibrasi">Kalibrasi</option>
                    </select>
                </div>

                {{-- Type Select --}}
                <div>
                    <select 
                        x-model="selectedType"
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
        <div class="mb-8">
            <p class="text-gray-600 text-lg" x-text="`Menampilkan ${filteredCount} dari ${totalCount} pelatihan`"></p>
        </div>
    </div>
</section>

<script>
function catalogFilters() {
    return {
        searchQuery: '',
        selectedCategory: 'semua',
        selectedType: 'semua',
        selectedPrice: 'semua',
        sortBy: 'terbaru',
        filteredCount: 11,
        totalCount: 11
    }
}
</script>
