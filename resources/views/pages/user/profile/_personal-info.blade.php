{{-- Personal Information Section --}}
<div class="bg-white rounded-lg border border-gray-200">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">Informasi Pribadi</h3>
            <p class="text-sm text-gray-600 mt-1">Update informasi pribadi dan detail kontak Anda</p>
        </div>
        <button 
            x-show="!editingPersonalInfo"
            @click="editPersonalInfo()"
            class="px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors"
        >
            <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit
        </button>
    </div>

    <!-- Content -->
    <div class="p-6">
        <template x-if="!editingPersonalInfo">
            <!-- View Mode -->
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-sm font-medium text-gray-600">Nama Lengkap</label>
                        <p class="text-gray-900 mt-1 font-medium" x-text="user.name"></p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-600">Email</label>
                        <p class="text-gray-900 mt-1" x-text="user.email"></p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-sm font-medium text-gray-600">Nomor Telepon</label>
                        <p class="text-gray-900 mt-1" x-text="user.phone || 'Belum diisi'"></p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-600">Lokasi</label>
                        <p class="text-gray-900 mt-1" x-text="user.location || 'Belum diisi'"></p>
                    </div>
                </div>
                
                <div>
                    <label class="text-sm font-medium text-gray-600">Bio</label>
                    <p class="text-gray-900 mt-1 leading-relaxed" x-text="user.bio || 'Belum ada bio'"></p>
                </div>
                
                <div>
                    <label class="text-sm font-medium text-gray-600">ID Peserta</label>
                    <p class="text-gray-900 mt-1 font-mono text-lg" x-text="user.studentId"></p>
                </div>
            </div>
        </template>

        <template x-if="editingPersonalInfo">
            <!-- Edit Mode -->
            <form @submit.prevent="savePersonalInfo()" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            x-model="personalInfoForm.name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Masukkan nama lengkap"
                            required
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="email" 
                            x-model="personalInfoForm.email"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="email@example.com"
                            required
                        >
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                        <input 
                            type="tel" 
                            x-model="personalInfoForm.phone"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="+62 812-3456-7890"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                        <input 
                            type="text" 
                            x-model="personalInfoForm.location"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Kota, Provinsi"
                        >
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                    <textarea 
                        x-model="personalInfoForm.bio"
                        rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Ceritakan sedikit tentang diri Anda..."
                    ></textarea>
                    <p class="text-xs text-gray-500 mt-1">Maksimal 200 karakter</p>
                </div>
                
                <div class="flex gap-3 pt-4 border-t border-gray-200">
                    <button 
                        type="submit"
                        class="px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors"
                    >
                        <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Perubahan
                    </button>
                    <button 
                        type="button"
                        @click="cancelEditPersonalInfo()"
                        class="px-6 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors"
                    >
                        Batal
                    </button>
                </div>
            </form>
        </template>
    </div>
</div>