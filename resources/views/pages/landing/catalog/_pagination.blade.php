{{-- Pagination Section --}}
<section class="pb-12" x-data="{ currentPage: 1, totalPages: 2 }">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-center space-x-2">
            <button 
                @click="currentPage = Math.max(currentPage - 1, 1)"
                :disabled="currentPage === 1"
                :class="currentPage === 1 ? 'opacity-50 cursor-not-allowed' : ''"
                class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition"
            >
                Sebelumnya
            </button>
            
            <template x-for="page in totalPages" :key="page">
                <button 
                    @click="currentPage = page"
                    :class="currentPage === page ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium transition"
                    x-text="page"
                ></button>
            </template>
            
            <button 
                @click="currentPage = Math.min(currentPage + 1, totalPages)"
                :disabled="currentPage === totalPages"
                :class="currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : ''"
                class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition"
            >
                Berikutnya
            </button>
        </div>

        {{-- No Results Message (Hidden by default, shown with Alpine.js when needed) --}}
        <div class="hidden text-center py-12">
            <div class="text-gray-600 mb-4">
                Tidak ada pelatihan yang sesuai dengan kriteria pencarian
            </div>
            <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                Reset Filter
            </button>
        </div>
    </div>
</section>
