{{-- User Sidebar --}}
<aside 
    class="fixed top-0 left-0 z-40 h-screen transition-all duration-300 bg-white border-r border-gray-200"
    :class="{
        'translate-x-0': sidebarOpen,
        '-translate-x-full lg:translate-x-0': !sidebarOpen,
        'w-64': true,
        'lg:w-64': desktopSidebarOpen,
        'lg:w-20': !desktopSidebarOpen
    }"
>
    <div class="flex flex-col h-full">
        {{-- Logo & Close Button --}}
        <div class="flex items-center justify-between h-20 px-5 border-b border-gray-200">
            <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3">
                {{-- Logo Icon --}}
                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shrink-0">
                    JT
                </div>
                {{-- Logo Text --}}
                <div x-show="desktopSidebarOpen" class="hidden lg:block">
                    <h1 class="text-lg font-bold text-gray-900">JasaTirta</h1>
                    <p class="text-xs text-gray-500">Learning Center</p>
                </div>
            </a>
            
            {{-- Close Button (Mobile Only) --}}
            <button 
                @click="sidebarOpen = false"
                class="lg:hidden p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors"
                aria-label="Close Sidebar"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Navigation Menu --}}
        <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-2">
            {{-- Dashboard --}}
            <a 
                href="{{ route('user.dashboard') }}" 
                class="flex items-center gap-4 px-4 py-3.5 text-base font-medium rounded-lg transition-colors {{ request()->routeIs('user.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}"
            >
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span x-show="desktopSidebarOpen" class="font-medium">Dashboard</span>
            </a>

            {{-- Divider dengan Label --}}
            <div x-show="desktopSidebarOpen" class="pt-5 pb-3">
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Pembelajaran</p>
            </div>

            {{-- My Courses --}}
            <a 
                href="{{ route('user.courses') }}" 
                class="flex items-center gap-4 px-4 py-3.5 text-base font-medium rounded-lg transition-colors {{ request()->routeIs('user.courses*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}"
            >
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <span x-show="desktopSidebarOpen" class="font-medium">Kursus Saya</span>
            </a>

            {{-- Course Catalog --}}
            <a 
                href="{{ route('user.catalog') }}" 
                class="flex items-center gap-4 px-4 py-3.5 text-base font-medium rounded-lg transition-colors {{ request()->routeIs('user.catalog*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}"
            >
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <span x-show="desktopSidebarOpen" class="font-medium">Katalog Kursus</span>
            </a>

            {{-- Schedules --}}
            <a 
                href="{{ route('user.schedules') }}" 
                class="flex items-center gap-4 px-4 py-3.5 text-base font-medium rounded-lg transition-colors {{ request()->routeIs('user.schedules*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}"
            >
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span x-show="desktopSidebarOpen" class="font-medium">Jadwal Kelas</span>
            </a>

            {{-- Certificates --}}
            <a 
                href="{{ route('user.certificates') }}" 
                class="flex items-center gap-4 px-4 py-3.5 text-base font-medium rounded-lg transition-colors {{ request()->routeIs('user.certificates*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}"
            >
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                </svg>
                <span x-show="desktopSidebarOpen" class="font-medium">Sertifikat</span>
            </a>

            {{-- Achievements --}}
            <a 
                href="{{ route('user.achievements') }}" 
                class="flex items-center gap-4 px-4 py-3.5 text-base font-medium rounded-lg transition-colors {{ request()->routeIs('user.achievements*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}"
            >
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                </svg>
                <span x-show="desktopSidebarOpen" class="font-medium">Pencapaian</span>
            </a>

            {{-- Divider dengan Label --}}
            <div x-show="desktopSidebarOpen" class="pt-5 pb-3">
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Lainnya</p>
            </div>

            {{-- Forum --}}
            <a 
                href="{{ route('user.forum') }}" 
                class="flex items-center gap-4 px-4 py-3.5 text-base font-medium rounded-lg transition-colors {{ request()->routeIs('user.forum*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}"
            >
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                </svg>
                <span x-show="desktopSidebarOpen" class="font-medium">Forum Diskusi</span>
            </a>

            {{-- Settings --}}
            <a 
                href="{{ route('user.settings') }}" 
                class="flex items-center gap-4 px-4 py-3.5 text-base font-medium rounded-lg transition-colors {{ request()->routeIs('user.settings*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}"
            >
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span x-show="desktopSidebarOpen" class="font-medium">Pengaturan</span>
            </a>
        </nav>

        {{-- Toggle Button (Desktop Only) --}}
        <div class="hidden lg:block p-4 border-t border-gray-200">
            <button 
                @click="desktopSidebarOpen = !desktopSidebarOpen"
                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors"
            >
                <svg 
                    class="w-5 h-5 shrink-0 transition-transform duration-300" 
                    :class="{ 'rotate-180': !desktopSidebarOpen }"
                    fill="none" 
                    stroke="currentColor" 
                    viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                </svg>
                <span x-show="desktopSidebarOpen" class="font-medium">Ciutkan</span>
            </button>
        </div>
    </div>
</aside>
