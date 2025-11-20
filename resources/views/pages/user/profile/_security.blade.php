{{-- Security Section --}}
<div class="bg-white rounded-lg border border-gray-200">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">Keamanan Akun</h3>
            <p class="text-sm text-gray-600 mt-1">Kelola password dan pengaturan keamanan akun Anda</p>
        </div>
        <button 
            x-show="!editingPassword"
            @click="editPassword()"
            class="px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors"
        >
            <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-3a1 1 0 011-1h2.586l4.707-4.707A6 6 0 0118 9z"></path>
            </svg>
            Ubah Password
        </button>
    </div>

    <!-- Content -->
    <div class="p-6">
        <template x-if="!editingPassword">
            <!-- View Mode -->
            <div class="space-y-6">
                <!-- Password Status -->
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
                    <div class="text-sm text-green-600 font-medium">
                        Aktif
                    </div>
                </div>

                <!-- Security Options -->
                <div class="space-y-4">
                    <h4 class="text-sm font-semibold text-gray-900">Opsi Keamanan</h4>
                    
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-3a1 1 0 011-1h2.586l4.707-4.707A6 6 0 0118 9z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Password</div>
                                    <div class="text-xs text-gray-500">Terakhir diubah 30 hari yang lalu</div>
                                </div>
                            </div>
                            <span class="px-3 py-1 text-xs font-medium text-gray-600 bg-gray-100 rounded-full">
                                Kuat
                            </span>
                        </div>

                        <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Autentikasi Dua Faktor</div>
                                    <div class="text-xs text-gray-500">Tambahkan lapisan keamanan ekstra</div>
                                </div>
                            </div>
                            <button class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                                Aktifkan
                            </button>
                        </div>

                        <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Riwayat Login</div>
                                    <div class="text-xs text-gray-500">Lihat aktivitas login terbaru</div>
                                </div>
                            </div>
                            <button class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                                Lihat
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Account Actions -->
                <div class="pt-4 border-t border-gray-200">
                    <h4 class="text-sm font-semibold text-gray-900 mb-3">Tindakan Akun</h4>
                    <div class="space-y-2">
                        <button class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Nonaktifkan Akun
                        </button>
                    </div>
                </div>
            </div>
        </template>

        <template x-if="editingPassword">
            <!-- Edit Password Mode -->
            <form @submit.prevent="savePassword()" class="space-y-6">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h4 class="text-sm font-medium text-blue-900">Tips Password Aman</h4>
                            <ul class="text-sm text-blue-700 mt-1 space-y-1">
                                <li>• Minimal 8 karakter</li>
                                <li>• Kombinasi huruf besar, kecil, angka, dan simbol</li>
                                <li>• Hindari informasi pribadi</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Password Saat Ini <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="password" 
                        x-model="passwordForm.currentPassword"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Masukkan password saat ini"
                        required
                    >
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Password Baru <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="password" 
                        x-model="passwordForm.newPassword"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Masukkan password baru"
                        required
                        minlength="8"
                    >
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Konfirmasi Password Baru <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="password" 
                        x-model="passwordForm.confirmPassword"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Ulangi password baru"
                        required
                    >
                </div>
                
                <div class="flex gap-3 pt-4 border-t border-gray-200">
                    <button 
                        type="submit"
                        class="px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors"
                    >
                        <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Password
                    </button>
                    <button 
                        type="button"
                        @click="cancelEditPassword()"
                        class="px-6 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors"
                    >
                        Batal
                    </button>
                </div>
            </form>
        </template>
    </div>
</div>