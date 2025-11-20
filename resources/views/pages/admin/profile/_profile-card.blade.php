<div class="bg-white rounded-lg border border-gray-200 p-6">
    <!-- Avatar -->
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
        <div class="mt-2">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                <span x-text="user.role"></span>
            </span>
        </div>
    </div>

    <!-- Info -->
    <div class="mt-6 pt-6 border-t border-gray-200 space-y-3">
        <div class="flex items-center text-sm text-gray-600">
            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            <span x-text="user.department"></span>
        </div>
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

    <!-- Stats -->
    <div class="mt-6 pt-6 border-t border-gray-200 grid grid-cols-2 gap-4">
        <div class="text-center">
            <div class="text-2xl font-bold text-gray-900" x-text="stats.totalTrainings"></div>
            <div class="text-xs text-gray-600">Pelatihan</div>
        </div>
        <div class="text-center">
            <div class="text-2xl font-bold text-gray-900" x-text="stats.activeParticipants"></div>
            <div class="text-xs text-gray-600">Peserta</div>
        </div>
        <div class="text-center">
            <div class="text-2xl font-bold text-gray-900" x-text="stats.completedCourses"></div>
            <div class="text-xs text-gray-600">Selesai</div>
        </div>
        <div class="text-center">
            <div class="text-2xl font-bold text-gray-900">
                <span x-text="stats.averageRating"></span>
                <span class="text-yellow-500">★</span>
            </div>
            <div class="text-xs text-gray-600">Rating</div>
        </div>
    </div>
</div>
