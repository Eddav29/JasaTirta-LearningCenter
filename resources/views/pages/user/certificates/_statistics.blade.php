{{-- Statistics Sidebar --}}
<div class="space-y-6">
    {{-- Overview Stats --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan</h3>
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm font-medium text-gray-900">Total Sertifikat</div>
                        <div class="text-xs text-gray-500">Yang dimiliki</div>
                    </div>
                </div>
                <div class="text-2xl font-bold text-blue-600" x-text="stats.totalCertificates"></div>
            </div>
            
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm font-medium text-gray-900">Kursus Selesai</div>
                        <div class="text-xs text-gray-500">Total penyelesaian</div>
                    </div>
                </div>
                <div class="text-2xl font-bold text-green-600" x-text="stats.completedCourses"></div>
            </div>
            
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm font-medium text-gray-900">Rata-rata Nilai</div>
                        <div class="text-xs text-gray-500">Semua sertifikat</div>
                    </div>
                </div>
                <div class="text-2xl font-bold text-yellow-600" x-text="stats.averageScore"></div>
            </div>
        </div>
    </div>

    {{-- Status Filter --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Filter Status</h3>
        <div class="space-y-2">
            <button 
                @click="setFilter('all')"
                :class="activeFilter === 'all' ? 'bg-blue-50 text-blue-700 border-blue-200' : 'text-gray-700 border-gray-200 hover:bg-gray-50'"
                class="w-full flex items-center justify-between px-4 py-3 border rounded-lg font-medium transition-colors"
            >
                <span>Semua Sertifikat</span>
                <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-600 rounded-full" x-text="certificates.length"></span>
            </button>
            
            <button 
                @click="setFilter('active')"
                :class="activeFilter === 'active' ? 'bg-green-50 text-green-700 border-green-200' : 'text-gray-700 border-gray-200 hover:bg-gray-50'"
                class="w-full flex items-center justify-between px-4 py-3 border rounded-lg font-medium transition-colors"
            >
                <span>Aktif</span>
                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-600 rounded-full" x-text="certificatesByStatus.active"></span>
            </button>
            
            <button 
                @click="setFilter('expiring')"
                :class="activeFilter === 'expiring' ? 'bg-yellow-50 text-yellow-700 border-yellow-200' : 'text-gray-700 border-gray-200 hover:bg-gray-50'"
                class="w-full flex items-center justify-between px-4 py-3 border rounded-lg font-medium transition-colors"
            >
                <span>Akan Berakhir</span>
                <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-600 rounded-full" x-text="certificatesByStatus.expiring"></span>
            </button>
            
            <button 
                @click="setFilter('expired')"
                :class="activeFilter === 'expired' ? 'bg-red-50 text-red-700 border-red-200' : 'text-gray-700 border-gray-200 hover:bg-gray-50'"
                class="w-full flex items-center justify-between px-4 py-3 border rounded-lg font-medium transition-colors"
            >
                <span>Berakhir</span>
                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-600 rounded-full" x-text="certificatesByStatus.expired"></span>
            </button>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
        <div class="space-y-3">
            <button 
                @click="alert('Fitur unduh semua akan segera tersedia!')"
                class="w-full flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors"
            >
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Unduh Semua
            </button>
            
            <button 
                @click="alert('Fitur ekspor portfolio akan segera tersedia!')"
                class="w-full flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors"
            >
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                </svg>
                Ekspor Portfolio
            </button>
            
            <a href="{{ route('user.profile') }}" 
               class="w-full flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Lihat Profil
            </a>
        </div>
    </div>
</div>