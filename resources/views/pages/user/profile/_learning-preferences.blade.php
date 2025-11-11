{{-- Learning Preferences Section --}}
<div class="bg-white rounded-lg border border-gray-200">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Preferensi Pembelajaran</h3>
        <p class="text-sm text-gray-600 mt-1">Atur preferensi notifikasi dan pengaturan pembelajaran Anda</p>
    </div>

    <!-- Content -->
    <div class="p-6 space-y-8">

        <!-- Learning Preferences -->
        <div class="border-t border-gray-200 pt-6">
            <h4 class="text-sm font-semibold text-gray-900 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Pengaturan Pembelajaran
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Waktu Belajar Preferensi</label>
                    <select 
                        x-model="preferences.preferredLearningTime"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <option value="morning">Pagi (06:00 - 12:00)</option>
                        <option value="afternoon">Siang (12:00 - 18:00)</option>
                        <option value="evening">Malam (18:00 - 24:00)</option>
                        <option value="flexible">Fleksibel</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Interface Preferences -->
        <div class="border-t border-gray-200 pt-6">
            <h4 class="text-sm font-semibold text-gray-900 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Antarmuka
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bahasa Interface</label>
                    <select 
                        x-model="preferences.language"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <option value="id">Bahasa Indonesia</option>
                        <option value="en">English</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Learning Goals -->
        <div class="border-t border-gray-200 pt-6">
            <h4 class="text-sm font-semibold text-gray-900 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                </svg>
                Target Pembelajaran
            </h4>
            <div class="bg-linear-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                    <div>
                        <div class="text-2xl font-bold text-blue-600">3</div>
                        <div class="text-sm text-gray-600">Kursus/Bulan</div>
                        <div class="text-xs text-gray-500">Target</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-green-600">80%</div>
                        <div class="text-sm text-gray-600">Completion Rate</div>
                        <div class="text-xs text-gray-500">Target</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-purple-600">20</div>
                        <div class="text-sm text-gray-600">Jam/Minggu</div>
                        <div class="text-xs text-gray-500">Target</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-amber-600">2</div>
                        <div class="text-sm text-gray-600">Sertifikat/Bulan</div>
                        <div class="text-xs text-gray-500">Target</div>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 bg-white border border-blue-300 rounded-lg hover:bg-blue-50 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Target
                    </button>
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="border-t border-gray-200 pt-6">
            <button 
                @click="savePreferences()"
                class="w-full md:w-auto px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors"
            >
                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan Preferensi
            </button>
        </div>
    </div>
</div>