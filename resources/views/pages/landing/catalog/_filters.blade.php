{{-- Search and Filter Section --}}
<section id="filters" class="py-12 bg-white" x-data="catalogFilters()">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Search and Filter Controls --}}
        <div class="bg-white rounded-2xl p-6 shadow-lg mb-8">
            <div class="grid md:grid-cols-3 gap-4">
                {{-- Search Input --}}
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input 
                        type="text" 
                        x-model="searchQuery"
                        placeholder="Cari nama pelatihan..." 
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    />
                </div>
                
                {{-- Category Select --}}
                <div>
                    <select 
                        x-model="selectedCategory"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
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
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <option value="semua">Semua Tipe</option>
                        <option value="offline">Tatap Muka</option>
                        <option value="online">Daring</option>
                        <option value="hybrid">Hybrid</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Results Summary --}}
        <div class="mb-8">
            <p class="text-gray-600" x-text="`Menampilkan ${filteredCount} dari ${totalCount} pelatihan`"></p>
        </div>
    </div>
</section>

<script>
function catalogFilters() {
    return {
        searchQuery: '',
        selectedCategory: 'semua',
        selectedType: 'semua',
        filteredCount: 11,
        totalCount: 11
    }
}
</script>
