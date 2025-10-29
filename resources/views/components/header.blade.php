{{-- Header Component with Alpine.js for interactivity --}}
<header 
    x-data="{ 
        mobileMenuOpen: false, 
        isScrolled: false 
    }"
    x-init="
        window.addEventListener('scroll', () => {
            isScrolled = window.scrollY > 20;
        });
    "
    :class="isScrolled ? 'bg-white shadow-xl border-b border-gray-200' : 'bg-white shadow-md border-b border-gray-100'"
    class="fixed top-0 z-50 w-full transition-all duration-500"
>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex h-16 items-center justify-between">
        {{-- Logo --}}
        <a href="/" class="flex items-center space-x-2">
            <div class="h-8 w-8 rounded-lg bg-blue-600 flex items-center justify-center shadow-md">
                <span class="text-sm font-bold text-white">JT</span>
            </div>
            <span 
                :class="isScrolled ? 'text-gray-900' : 'text-gray-800'"
                class="text-lg font-semibold transition-all duration-300"
            >
                Jasa Tirta Learning Center
            </span>
        </a>

        {{-- Desktop Navigation --}}
        <nav class="hidden md:flex items-center space-x-6 text-sm font-medium">
            @php
            $navItems = [
                ['name' => 'Beranda', 'path' => '/'],
                ['name' => 'Katalog Pelatihan', 'path' => '/katalog'],
                ['name' => 'Pengajar', 'path' => '/pengajar'],
                ['name' => 'Jadwal', 'path' => '/jadwal'],
                ['name' => 'Kontak', 'path' => '/kontak'],
            ];
            $currentPath = request()->path() === '/' ? '/' : '/' . request()->path();
            @endphp

            @foreach($navItems as $item)
            <a 
                href="{{ $item['path'] }}" 
                class="relative transition-all duration-300 hover:text-blue-600 {{ $currentPath === $item['path'] ? 'text-blue-600 font-medium' : 'text-gray-700' }}"
            >
                {{ $item['name'] }}
                @if($currentPath === $item['path'])
                <div class="absolute -bottom-2 left-0 right-0 h-0.5 bg-blue-600 rounded-full"></div>
                @endif
            </a>
            @endforeach
        </nav>

        {{-- Login Button (Desktop) --}}
        <div class="hidden md:flex">
            <a 
                href="/login" 
                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-300 shadow-md text-sm"
            >
                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                Login
            </a>
        </div>

        {{-- Mobile Menu Button --}}
        <button
            @click="mobileMenuOpen = !mobileMenuOpen"
            :class="isScrolled ? 'text-gray-700 hover:text-blue-600' : 'text-gray-700 hover:text-blue-600'"
            class="md:hidden transition-all duration-300 p-2 rounded-lg hover:bg-gray-100"
        >
            <svg x-show="!mobileMenuOpen" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <svg x-show="mobileMenuOpen" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div 
        x-show="mobileMenuOpen" 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="md:hidden"
        style="display: none;"
    >
        <div class="px-2 pt-2 pb-3 space-y-1 bg-white shadow-xl border-b border-gray-200">
            @foreach($navItems as $item)
            <a 
                href="{{ $item['path'] }}" 
                @click="mobileMenuOpen = false"
                class="block px-3 py-2 rounded-md text-base font-medium transition-colors {{ $currentPath === $item['path'] ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-blue-50' }}"
            >
                {{ $item['name'] }}
            </a>
            @endforeach
            <div class="px-3 py-2">
                <a 
                    href="/login" 
                    class="flex items-center justify-center w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-300 text-sm"
                >
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Login
                </a>
            </div>
        </div>
    </div>
</header>

{{-- Spacer to prevent content from going under fixed header --}}
<div class="h-16"></div>
