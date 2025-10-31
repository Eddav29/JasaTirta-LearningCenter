{{-- Categories Search & Filter --}}
<div class="bg-white rounded-lg border border-gray-200 p-6" x-data="categoriesManager()">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div class="flex flex-col sm:flex-row gap-4 flex-1">
            {{-- Search --}}
            <div class="relative w-full lg:w-80">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input 
                    type="text" 
                    x-model="searchQuery"
                    placeholder="Cari kategori..." 
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                />
            </div>

            {{-- Status Filter --}}
            <select 
                x-model="statusFilter"
                class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            >
                <option value="">Semua Status</option>
                <option value="active">Aktif</option>
                <option value="inactive">Tidak Aktif</option>
            </select>
        </div>

        {{-- Add Button --}}
        <div class="shrink-0">
            <button 
                @click="openAddDialog()"
                class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shrink-0 whitespace-nowrap"
            >
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Kategori
            </button>
        </div>
    </div>

    {{-- Add Dialog --}}
    <div 
        x-show="showAddDialog" 
        x-cloak
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
        @click.self="showAddDialog = false"
    >
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <div class="mb-4">
                <h3 class="text-xl font-bold text-gray-900">Tambah Kategori Baru</h3>
                <p class="text-sm text-gray-600 mt-1">Buat kategori baru untuk mengorganisir pelatihan</p>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori *</label>
                    <input 
                        type="text" 
                        x-model="formData.name"
                        @input="handleNameChange($event.target.value)"
                        placeholder="Contoh: Teknik Sampling"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                    <input 
                        type="text" 
                        x-model="formData.slug"
                        placeholder="teknik-sampling"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea 
                        x-model="formData.description"
                        placeholder="Deskripsi kategori..."
                        rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    ></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Icon (Emoji)</label>
                        <input 
                            type="text" 
                            x-model="formData.icon"
                            placeholder="🔬"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Warna</label>
                        <input 
                            type="color" 
                            x-model="formData.color"
                            class="w-full h-10 px-1 py-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        />
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <input 
                        type="checkbox" 
                        id="add-isActive"
                        x-model="formData.isActive"
                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
                    />
                    <label for="add-isActive" class="text-sm font-medium text-gray-700">Aktif</label>
                </div>
            </div>

            <div class="flex items-center gap-3 mt-6">
                <button 
                    @click="showAddDialog = false"
                    class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors"
                >
                    Batal
                </button>
                <button 
                    @click="addCategory()"
                    :disabled="!formData.name"
                    :class="!formData.name ? 'opacity-50 cursor-not-allowed' : ''"
                    class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                >
                    Tambah Kategori
                </button>
            </div>
        </div>
    </div>
</div>
