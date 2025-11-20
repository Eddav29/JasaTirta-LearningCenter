{{-- Admin Sidebar --}}
<aside 
    class="fixed top-0 left-0 z-40 h-screen transition-all duration-300 bg-white border-r border-gray-200"
    :class="[
        sidebarOpen ? 'translate-x-0' : '-translate-x-full',
        'lg:translate-x-0',
        desktopSidebarOpen ? 'lg:w-64' : 'lg:w-20',
        'w-64'
    ]"
>
    {{-- Sidebar Header --}}
    <div class="flex items-center justify-between h-20 px-5 border-b border-gray-200">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3" x-show="desktopSidebarOpen || !window.matchMedia('(min-width: 1024px)').matches">
            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                </svg>
            </div>
            <span class="text-xl font-bold text-gray-900">Admin Panel</span>
        </a>
        
        <div x-show="!desktopSidebarOpen" class="hidden lg:flex w-full justify-center">
            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                </svg>
            </div>
        </div>
        
        {{-- Close Button for Mobile --}}
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

    {{-- Navigation --}}
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center gap-4 px-4 py-3.5 text-base font-medium rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <span class="lg:hidden" x-show="desktopSidebarOpen">Dashboard</span>
            <span class="hidden lg:block" x-show="desktopSidebarOpen">Dashboard</span>
        </a>

        {{-- Divider --}}
        <div class="pt-5 pb-3" x-show="desktopSidebarOpen">
            <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Manajemen</p>
        </div>

        {{-- Pelatihan --}}
        <a href="{{ route('admin.trainings.index') }}" 
           class="flex items-center gap-4 px-4 py-3.5 text-base font-medium rounded-lg transition-colors {{ request()->routeIs('admin.trainings.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            <span class="lg:hidden" x-show="desktopSidebarOpen">Pelatihan</span>
            <span class="hidden lg:block" x-show="desktopSidebarOpen">Pelatihan</span>
        </a>

        {{-- Jadwal --}}
        <a href="{{ route('admin.schedules.index') }}" 
           class="flex items-center gap-4 px-4 py-3.5 text-base font-medium rounded-lg transition-colors {{ request()->routeIs('admin.schedules.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <span class="lg:hidden" x-show="desktopSidebarOpen">Jadwal</span>
            <span class="hidden lg:block" x-show="desktopSidebarOpen">Jadwal</span>
        </a>

        {{-- Pengajar --}}
        <a href="{{ route('admin.instructors.index') }}" 
           class="flex items-center gap-4 px-4 py-3.5 text-base font-medium rounded-lg transition-colors {{ request()->routeIs('admin.instructors.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <span class="lg:hidden" x-show="desktopSidebarOpen">Pengajar</span>
            <span class="hidden lg:block" x-show="desktopSidebarOpen">Pengajar</span>
        </a>

        {{-- Peserta --}}
        <a href="{{ route('admin.participants.index') }}" 
           class="flex items-center gap-4 px-4 py-3.5 text-base font-medium rounded-lg transition-colors {{ request()->routeIs('admin.participants.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <span class="lg:hidden" x-show="desktopSidebarOpen">Peserta</span>
            <span class="hidden lg:block" x-show="desktopSidebarOpen">Peserta</span>
        </a>

        {{-- Pendaftaran --}}
        <a href="{{ route('admin.registrations.index') }}" 
           class="flex items-center gap-4 px-4 py-3.5 text-base font-medium rounded-lg transition-colors {{ request()->routeIs('admin.registrations.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
            </svg>
            <span class="lg:hidden" x-show="desktopSidebarOpen">Pendaftaran</span>
            <span class="hidden lg:block" x-show="desktopSidebarOpen">Pendaftaran</span>
        </a>

        {{-- Kategori --}}
        <a href="{{ route('admin.categories.index') }}" 
           class="flex items-center gap-4 px-4 py-3.5 text-base font-medium rounded-lg transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
            </svg>
            <span class="lg:hidden" x-show="desktopSidebarOpen">Kategori</span>
            <span class="hidden lg:block" x-show="desktopSidebarOpen">Kategori</span>
        </a>
        
        {{-- Divider --}}
        <div class="pt-5 pb-3" x-show="desktopSidebarOpen">
            <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Laporan</p>
        </div>

        {{-- Pesan --}}
        <a href="{{ route('admin.messages.index') }}" 
           class="flex items-center gap-4 px-4 py-3.5 text-base font-medium rounded-lg transition-colors {{ request()->routeIs('admin.messages.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
            <span class="lg:hidden" x-show="desktopSidebarOpen">Pesan</span>
            <span class="hidden lg:block" x-show="desktopSidebarOpen">Pesan</span>
        </a>

        {{-- Laporan --}}
        <a href="{{ route('admin.reports') }}" 
           class="flex items-center gap-4 px-4 py-3.5 text-base font-medium rounded-lg transition-colors {{ request()->routeIs('admin.reports') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <span class="lg:hidden" x-show="desktopSidebarOpen">Laporan</span>
            <span class="hidden lg:block" x-show="desktopSidebarOpen">Laporan</span>
        </a>
    </nav>

    {{-- Desktop Toggle Button --}}
    <div class="hidden lg:block absolute bottom-0 left-0 right-0 p-5 border-t border-gray-200">
        <button 
            @click="desktopSidebarOpen = !desktopSidebarOpen"
            class="flex items-center justify-center w-full px-4 py-3 text-base font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors"
        >
            <svg class="w-5 h-5 transition-transform" :class="desktopSidebarOpen ? '' : 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
            </svg>
            <span x-show="desktopSidebarOpen" class="ml-2">Ciutkan</span>
        </button>
    </div>
</aside>
