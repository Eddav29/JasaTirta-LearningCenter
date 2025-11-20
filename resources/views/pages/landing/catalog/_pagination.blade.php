{{-- Pagination Section --}}
<section class="pb-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Pagination Info --}}
        <div x-show="filteredTrainings.length > 0" class="flex flex-col sm:flex-row items-center justify-between mb-6">
            <div class="text-sm text-gray-700 mb-4 sm:mb-0">
                Menampilkan <span class="font-medium" x-text="showingStart"></span> sampai <span class="font-medium" x-text="showingEnd"></span> dari <span class="font-medium" x-text="filteredCount"></span> hasil
            </div>
        </div>

        {{-- Pagination Controls --}}
        <div x-show="totalPages > 1" class="flex justify-center space-x-2">
            {{-- Previous Button --}}
            <button 
                @click="goToPage(currentPage - 1)"
                :disabled="currentPage === 1"
                :class="currentPage === 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-50'"
                class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white transition"
            >
                Sebelumnya
            </button>
            
            {{-- Page Numbers --}}
            <template x-for="page in Array.from({length: totalPages}, (_, i) => i + 1)" :key="page">
                <button 
                    x-show="page === 1 || page === totalPages || (page >= currentPage - 2 && page <= currentPage + 2)"
                    @click="goToPage(page)"
                    :class="currentPage === page ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 hover:bg-gray-50 border-gray-300'"
                    class="px-4 py-2 border rounded-lg text-sm font-medium transition"
                    x-text="page"
                ></button>
            </template>

            {{-- Show dots if there are gaps --}}
            <template x-if="totalPages > 7 && currentPage < totalPages - 3">
                <span class="px-2 py-2 text-gray-500">...</span>
            </template>
            
            {{-- Next Button --}}
            <button 
                @click="goToPage(currentPage + 1)"
                :disabled="currentPage === totalPages"
                :class="currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-50'"
                class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white transition"
            >
                Berikutnya
            </button>
        </div>
    </div>
</section>
