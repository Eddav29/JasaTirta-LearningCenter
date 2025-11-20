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
            Edit
        </button>
    </div>

    <!-- Content -->
    <div class="p-6">
        <template x-if="!editingPersonalInfo">
            <!-- View Mode -->
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-600">Nama Lengkap</label>
                        <p class="text-gray-900 mt-1" x-text="user.name"></p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-600">Email</label>
                        <p class="text-gray-900 mt-1" x-text="user.email"></p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-600">Telepon</label>
                        <p class="text-gray-900 mt-1" x-text="user.phone"></p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-600">Department</label>
                        <p class="text-gray-900 mt-1" x-text="user.department"></p>
                    </div>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-600">Lokasi</label>
                    <p class="text-gray-900 mt-1" x-text="user.location"></p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-600">Bio</label>
                    <p class="text-gray-900 mt-1" x-text="user.bio"></p>
                </div>
            </div>
        </template>

        <template x-if="editingPersonalInfo">
            <!-- Edit Mode -->
            <form @submit.prevent="savePersonalInfo()" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input 
                            type="text" 
                            x-model="personalInfoForm.name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input 
                            type="email" 
                            x-model="personalInfoForm.email"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required
                        >
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
                        <input 
                            type="tel" 
                            x-model="personalInfoForm.phone"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                        <input 
                            type="text" 
                            x-model="personalInfoForm.department"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                    <input 
                        type="text" 
                        x-model="personalInfoForm.location"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                    <textarea 
                        x-model="personalInfoForm.bio"
                        rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    ></textarea>
                </div>
                
                <div class="flex gap-3 pt-4">
                    <button 
                        type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors"
                    >
                        Simpan Perubahan
                    </button>
                    <button 
                        type="button"
                        @click="cancelEditPersonalInfo()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors"
                    >
                        Batal
                    </button>
                </div>
            </form>
        </template>
    </div>
</div>
