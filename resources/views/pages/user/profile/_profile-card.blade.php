{{-- User Profile Card --}}
<div class="bg-white rounded-lg border border-gray-200 p-6">
    {{-- Avatar Section --}}
    <div class="text-center">
        <div class="relative inline-block">
            <img 
                :src="user.avatar" 
                :alt="user.name"
                class="w-32 h-32 rounded-full mx-auto border-4 border-white shadow-lg"
            >
            <button 
                @click="uploadAvatar()"
                class="absolute bottom-0 right-0 bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700 transition-colors shadow-lg"
                title="Ubah Foto Profil"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </button>
            <input 
                type="file" 
                id="avatar-upload" 
                @change="handleAvatarUpload($event)"
                accept="image/*" 
                class="hidden"
            >
        </div>
        
        <h2 class="mt-4 text-xl font-bold text-gray-900" x-text="user.name"></h2>
        <p class="text-sm text-gray-600" x-text="user.email"></p>
        
        <div class="mt-2 space-y-2">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Peserta
            </span>
            <div class="text-xs text-gray-500">
                ID: <span x-text="user.studentId" class="font-mono"></span>
            </div>
        </div>
    </div>

    {{-- User Info --}}
    <div class="mt-6 pt-6 border-t border-gray-200 space-y-3">
        <div class="flex items-center text-sm text-gray-600">
            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span x-text="user.location"></span>
        </div>
        <div class="flex items-center text-sm text-gray-600">
            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span>Bergabung <span x-text="formatDate(user.joinDate)"></span></span>
        </div>
    </div>

    {{-- Learning Stats --}}
    <div class="mt-6 pt-6 border-t border-gray-200">
        <h3 class="text-sm font-medium text-gray-900 mb-4">Statistik Pembelajaran</h3>
        <div class="grid grid-cols-2 gap-4">
            <div class="text-center p-3 bg-blue-50 rounded-lg">
                <div class="text-2xl font-bold text-blue-600" x-text="stats.coursesEnrolled"></div>
                <div class="text-xs text-gray-600">Kursus Diikuti</div>
            </div>
            <div class="text-center p-3 bg-green-50 rounded-lg">
                <div class="text-2xl font-bold text-green-600" x-text="stats.coursesCompleted"></div>
                <div class="text-xs text-gray-600">Selesai</div>
            </div>
            <div class="text-center p-3 bg-purple-50 rounded-lg">
                <div class="text-2xl font-bold text-purple-600" x-text="stats.certificatesEarned"></div>
                <div class="text-xs text-gray-600">Sertifikat</div>
            </div>
            <div class="text-center p-3 bg-amber-50 rounded-lg">
                <div class="text-2xl font-bold text-amber-600" x-text="stats.totalLearningHours"></div>
                <div class="text-xs text-gray-600">Jam Belajar</div>
            </div>
        </div>
    </div>

    {{-- Recent Activity --}}
    <div class="mt-6 pt-6 border-t border-gray-200">
        <h3 class="text-sm font-medium text-gray-900 mb-4">Aktivitas Terkini</h3>
        <div class="space-y-3">
            <template x-for="course in recentCourses.slice(0, 3)" :key="course.title">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex-1 min-w-0">
                        <h4 class="text-sm font-medium text-gray-900 truncate" x-text="course.title"></h4>
                        <p class="text-xs text-gray-500" x-text="course.lastAccessed"></p>
                        <div class="mt-1 w-full bg-gray-200 rounded-full h-2">
                            <div 
                                class="h-2 rounded-full" 
                                :class="getProgressColor(course.progress)"
                                :style="`width: ${course.progress}%`"
                            ></div>
                        </div>
                    </div>
                    <div class="ml-3">
                        <span 
                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium"
                            :class="getStatusBadge(course.status)"
                            x-text="getStatusText(course.status)"
                        ></span>
                    </div>
                </div>
            </template>
        </div>
        <div class="mt-4">
            <a href="{{ route('user.courses') }}" 
               class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                Lihat Semua Kursus
                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</div>