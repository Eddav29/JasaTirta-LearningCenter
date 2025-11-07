{{-- Categories Table --}}

<div class="bg-white rounded-lg border border-gray-200">
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Daftar Kategori</h3>
                <p class="text-sm text-gray-600 mt-1">
                    Kelola dan organisir kategori pelatihan
                </p>
            </div>
            <div class="text-sm text-gray-600">
                <span x-show="searchQuery || statusFilter" x-cloak>
                    Menampilkan <span class="font-medium text-gray-900" x-text="filteredCategories.length"></span> 
                    dari <span class="font-medium text-gray-900" x-text="categories.length"></span> kategori
                </span>
                <span x-show="!searchQuery && !statusFilter">
                    Total <span class="font-medium text-gray-900" x-text="categories.length"></span> kategori
                </span>
            </div>
        </div>
    </div>
    
    <div class="p-6">
        {{-- Bulk Actions Bar --}}
        <div 
            x-show="selectedIds.length > 0" 
            x-cloak
            class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-lg flex items-center justify-between"
        >
            <div class="flex items-center gap-3">
                <span class="text-sm font-medium text-blue-900">
                    <span x-text="selectedIds.length"></span> kategori dipilih
                </span>
                <button 
                    @click="selectedIds = []"
                    class="text-sm text-blue-600 hover:text-blue-800 font-medium"
                >
                    Batal Pilih
                </button>
            </div>
            <div class="flex items-center gap-2">
                <button 
                    @click="bulkDelete()"
                    class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700 transition-colors"
                >
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>
            </div>
        </div>

        {{-- Empty State for No Results --}}
        <div x-show="filteredCategories.length === 0" x-cloak class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada kategori ditemukan</h3>
            <p class="mt-1 text-sm text-gray-500">Coba ubah kriteria pencarian atau filter Anda</p>
            <button 
                @click="searchQuery = ''; statusFilter = ''"
                class="mt-4 inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50"
            >
                Reset Filter
            </button>
        </div>

        <div x-show="filteredCategories.length > 0" class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="w-12 py-3 px-4">
                            <input 
                                type="checkbox" 
                                :checked="allSelected"
                                @change="toggleAll()"
                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                            />
                        </th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Kategori</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Deskripsi</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Pelatihan</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Dibuat</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="category in paginatedCategories" :key="category.id">
                        <tr class="border-b border-gray-100 hover:bg-gray-50" :class="selectedIds.includes(category.id) ? 'bg-blue-50' : ''">
                            <td class="py-4 px-4">
                                <input 
                                    type="checkbox" 
                                    :checked="selectedIds.includes(category.id)"
                                    @change="toggleSelect(category.id)"
                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                />
                            </td>
                            <td class="py-4 px-4">
                                <div>
                                    <p class="font-medium text-gray-900" x-text="category.name"></p>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-gray-600 max-w-xs">
                                <p class="truncate" x-text="category.description"></p>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    <span x-text="category.trainingCount"></span> pelatihan
                                </span>
                            </td>
                            <td class="py-4 px-4 text-gray-600" x-text="formatDate(category.createdAt)"></td>
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-2">
                                    <a 
                                        :href="`{{ route('admin.categories.index') }}/${category.id}`"
                                        class="p-1 text-gray-600 hover:text-green-600 hover:bg-green-50 rounded transition-colors" 
                                        title="Lihat Detail"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a 
                                        :href="`{{ route('admin.categories.index') }}/${category.id}/edit`"
                                        class="p-1 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded transition-colors" 
                                        title="Edit"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <button 
                                        @click="deleteCategory(category.id)"
                                        class="p-1 text-red-600 hover:text-red-800 hover:bg-red-50 rounded transition-colors"
                                        title="Hapus"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
            
            {{-- Empty State --}}
            <div x-show="filteredCategories.length === 0" class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada kategori</h3>
                <p class="mt-1 text-sm text-gray-500">Tidak ada kategori yang sesuai dengan filter yang dipilih.</p>
            </div>
        </div>
        
        {{-- Pagination --}}
        <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-200" x-show="filteredCategories.length > 0">
            <div class="text-sm text-gray-600">
                Menampilkan <span x-text="(currentPage - 1) * itemsPerPage + 1"></span>-<span x-text="Math.min(currentPage * itemsPerPage, filteredCategories.length)"></span> dari <span x-text="filteredCategories.length"></span> kategori
            </div>
            <div class="flex items-center gap-2">
                <button
                    @click="currentPage > 1 && currentPage--"
                    :disabled="currentPage === 1"
                    :class="currentPage === 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-50'"
                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm text-gray-700 rounded-lg transition-colors"
                >
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Previous
                </button>
                <span class="text-sm text-gray-600">
                    Halaman <span x-text="currentPage"></span> dari <span x-text="totalPages"></span>
                </span>
                <button
                    @click="currentPage < totalPages && currentPage++"
                    :disabled="currentPage >= totalPages"
                    :class="currentPage >= totalPages ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-50'"
                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm text-gray-700 rounded-lg transition-colors"
                >
                    Next
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Edit Dialog --}}
    <div 
        x-show="showEditDialog" 
        x-cloak
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
        @click.self="showEditDialog = false"
    >
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <div class="mb-4">
                <h3 class="text-xl font-bold text-gray-900">Edit Kategori</h3>
                <p class="text-sm text-gray-600 mt-1">Perbarui informasi kategori</p>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori *</label>
                    <input 
                        type="text" 
                        x-model="formData.name"
                        @input="handleNameChange($event.target.value)"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                    <input 
                        type="text" 
                        x-model="formData.slug"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea 
                        x-model="formData.description"
                        rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    ></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Warna</label>
                    <input 
                        type="color" 
                        x-model="formData.color"
                        class="w-full h-10 px-1 py-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    />
                </div>

                <div class="flex items-center gap-2">
                    <input 
                        type="checkbox" 
                        id="edit-isActive"
                        x-model="formData.isActive"
                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
                    />
                    <label for="edit-isActive" class="text-sm font-medium text-gray-700">Aktif</label>
                </div>
            </div>

            <div class="flex items-center gap-3 mt-6">
                <button 
                    @click="showEditDialog = false"
                    class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors"
                >
                    Batal
                </button>
                <button 
                    @click="updateCategory()"
                    class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                >
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>
