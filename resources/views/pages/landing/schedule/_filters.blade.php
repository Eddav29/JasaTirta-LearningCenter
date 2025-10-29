{{-- Filters Section --}}
<section class="py-12" x-data="scheduleFilters()">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Search and Filter Controls --}}
        <div class="bg-white rounded-2xl p-6 shadow-lg mb-8">
            <div class="grid md:grid-cols-2 gap-4">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input 
                        type="text" 
                        x-model="searchQuery"
                        placeholder="Cari nama pelatihan atau pengajar..." 
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    />
                </div>
                
                <div>
                    <select 
                        x-model="selectedMonth"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <option value="semua">Semua Bulan</option>
                        <option value="November">November 2024</option>
                        <option value="Desember">Desember 2024</option>
                        <option value="Januari">Januari 2025</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Results Summary --}}
        <div class="mb-6 flex items-center justify-between">
            <p class="text-gray-600" x-text="`Menampilkan ${displayedCount} dari ${totalCount} jadwal pelatihan`"></p>
            <div class="flex items-center space-x-2 text-sm text-gray-600">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                <span x-text="`Filter aktif: ${selectedMonth !== 'semua' ? selectedMonth : 'Semua Bulan'}`"></span>
            </div>
        </div>
    </div>
</section>

<script>
function scheduleFilters() {
    return {
        searchQuery: '',
        selectedMonth: 'semua',
        displayedCount: 10,
        totalCount: 12
    }
}
</script>
