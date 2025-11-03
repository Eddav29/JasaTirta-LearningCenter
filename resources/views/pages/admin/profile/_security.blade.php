<div class="bg-white rounded-lg border border-gray-200">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">Keamanan</h3>
            <p class="text-sm text-gray-600 mt-1">Kelola password dan pengaturan keamanan akun</p>
        </div>
        <button 
            x-show="!editingPassword"
            @click="editPassword()"
            class="px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors"
        >
            Ubah Password
        </button>
    </div>

    <!-- Content -->
    <div class="p-6">
        <template x-if="!editingPassword">
            <!-- View Mode -->
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-green-900">Password Aman</div>
                            <div class="text-sm text-green-700">Password terakhir diubah 30 hari yang lalu</div>
                        </div>
                    </div>
                </div>

                <div class="space-y-3 pt-4">
                    <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <div>
                                <div class="text-sm font-medium text-gray-900">Two-Factor Authentication</div>
                                <div class="text-xs text-gray-500">Tambahkan keamanan ekstra ke akun Anda</div>
                            </div>
                        </div>
                        <span class="px-3 py-1 text-xs font-medium text-gray-600 bg-gray-100 rounded-full">
                            Nonaktif
                        </span>
                    </div>

                    <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <div>
                                <div class="text-sm font-medium text-gray-900">Sesi Aktif</div>
                                <div class="text-xs text-gray-500">3 perangkat terhubung</div>
                            </div>
                        </div>
                        <button class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                            Kelola
                        </button>
                    </div>
                </div>
            </div>
        </template>

        <template x-if="editingPassword">
            <!-- Edit Mode -->
            <form @submit.prevent="savePassword()" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                    <input 
                        type="password" 
                        x-model="passwordForm.currentPassword"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                    <input 
                        type="password" 
                        x-model="passwordForm.newPassword"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required
                        minlength="8"
                    >
                    <p class="text-xs text-gray-500 mt-1">Minimal 8 karakter</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                    <input 
                        type="password" 
                        x-model="passwordForm.confirmPassword"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required
                    >
                </div>
                
                <div class="flex gap-3 pt-4">
                    <button 
                        type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors"
                    >
                        Update Password
                    </button>
                    <button 
                        type="button"
                        @click="cancelEditPassword()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors"
                    >
                        Batal
                    </button>
                </div>
            </form>
        </template>
    </div>
</div>
