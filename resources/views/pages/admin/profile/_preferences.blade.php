<div class="bg-white rounded-lg border border-gray-200">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Preferensi</h3>
        <p class="text-sm text-gray-600 mt-1">Atur preferensi notifikasi dan tampilan</p>
    </div>

    <!-- Content -->
    <div class="p-6 space-y-6">
        <!-- Notifications -->
        <div>
            <h4 class="text-sm font-semibold text-gray-900 mb-4">Notifikasi</h4>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm font-medium text-gray-900">Email Notifications</div>
                        <div class="text-xs text-gray-500">Terima notifikasi via email</div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" x-model="preferences.emailNotifications" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>
                
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm font-medium text-gray-900">Push Notifications</div>
                        <div class="text-xs text-gray-500">Terima notifikasi push di browser</div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" x-model="preferences.pushNotifications" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>
                
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm font-medium text-gray-900">Weekly Report</div>
                        <div class="text-xs text-gray-500">Terima laporan mingguan via email</div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" x-model="preferences.weeklyReport" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>
                
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm font-medium text-gray-900">Marketing Emails</div>
                        <div class="text-xs text-gray-500">Terima email promosi dan update</div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" x-model="preferences.marketingEmails" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>
            </div>
        </div>

        <!-- Localization -->
        <div class="pt-6 border-t border-gray-200">
            <h4 class="text-sm font-semibold text-gray-900 mb-4">Lokalisasi</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bahasa</label>
                    <select 
                        x-model="preferences.language"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <option value="id">Bahasa Indonesia</option>
                        <option value="en">English</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Timezone</label>
                    <select 
                        x-model="preferences.timezone"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <option value="Asia/Jakarta">Asia/Jakarta (WIB)</option>
                        <option value="Asia/Makassar">Asia/Makassar (WITA)</option>
                        <option value="Asia/Jayapura">Asia/Jayapura (WIT)</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Format Tanggal</label>
                    <select 
                        x-model="preferences.dateFormat"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <option value="DD/MM/YYYY">DD/MM/YYYY</option>
                        <option value="MM/DD/YYYY">MM/DD/YYYY</option>
                        <option value="YYYY-MM-DD">YYYY-MM-DD</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="pt-6 border-t border-gray-200">
            <button 
                @click="savePreferences()"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors"
            >
                Simpan Preferensi
            </button>
        </div>
    </div>
</div>
