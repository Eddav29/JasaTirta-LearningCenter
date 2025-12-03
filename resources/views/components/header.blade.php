{{-- Modern Header Component with Scroll Effects --}}
<header 
    x-data="{ 
        isScrolled: false,
        isMenuOpen: false
    }"
    x-init="
        window.addEventListener('scroll', () => {
            isScrolled = window.scrollY > 50;
        });
    "
    :class="{
        'bg-white/95 backdrop-blur-md shadow-lg': isScrolled,
        'bg-transparent': !isScrolled
    }"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 ease-in-out"
>
    <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-20">
            {{-- Logo --}}
            <div class="shrink-0">
                <a href="{{ route('home') }}" class="flex items-center">
                    {{-- Logo putih saat di atas, logo warna saat scroll --}}
                    <img 
                        x-show="!isScrolled" 
                        src="{{ asset('images/logo-putih.png') }}" 
                        alt="JTLC Logo" 
                        class="h-12 w-auto transition-opacity duration-300"
                    >
                    <img 
                        x-show="isScrolled" 
                        src="{{ asset('images/logo.png') }}" 
                        alt="JTLC Logo" 
                        class="h-12 w-auto transition-opacity duration-300"
                        style="display: none;"
                    >
                    {{-- Logo text putih saat di atas, logo text warna saat scroll --}}
                    <img 
                        x-show="!isScrolled" 
                        src="{{ asset('images/logo-teks-putih.png') }}" 
                        alt="Jasa Tirta I Learning Center" 
                        class="h-37.5 w-auto transition-opacity duration-300"
                    >
                    <img 
                        x-show="isScrolled" 
                        src="{{ asset('images/logo-teks.png') }}" 
                        alt="Jasa Tirta I Learning Center" 
                        class="h-37.5 w-auto transition-opacity duration-300"
                        style="display: none;"
                    >
                </a>
            </div>

            {{-- Desktop Navigation --}}
            <div class="hidden lg:flex items-center space-x-8">
                <a 
                    href="{{ route('home') }}" 
                    :class="isScrolled ? 'text-gray-700 hover:text-blue-600' : 'text-white hover:text-blue-200'"
                    class="font-medium transition-colors duration-300"
                >
                    Beranda
                </a>
                <a 
                    href="{{ route('catalog') }}" 
                    :class="isScrolled ? 'text-gray-700 hover:text-blue-600' : 'text-white hover:text-blue-200'"
                    class="font-medium transition-colors duration-300"
                >
                    Katalog Pelatihan
                </a>
                <a 
                    href="{{ route('pengajar') }}" 
                    :class="isScrolled ? 'text-gray-700 hover:text-blue-600' : 'text-white hover:text-blue-200'"
                    class="font-medium transition-colors duration-300"
                >
                    Pengajar
                </a>
                <a 
                    href="{{ route('jadwal') }}" 
                    :class="isScrolled ? 'text-gray-700 hover:text-blue-600' : 'text-white hover:text-blue-200'"
                    class="font-medium transition-colors duration-300"
                >
                    Jadwal
                </a>
                <a 
                    href="{{ route('contact') }}" 
                    :class="isScrolled ? 'text-gray-700 hover:text-blue-600' : 'text-white hover:text-blue-200'"
                    class="font-medium transition-colors duration-300"
                >
                    Kontak
                </a>
            </div>

            {{-- Desktop Auth Buttons --}}
            <div class="hidden lg:flex items-center space-x-4">
                @auth
                    <div class="flex items-center space-x-4">
                        <span 
                            :class="isScrolled ? 'text-gray-700' : 'text-white'"
                            class="text-sm font-medium transition-colors duration-300"
                        >
                            Halo, {{ Auth::user()->first_name }}
                        </span>
                        <a 
                            href="{{ route('dashboard') }}"
                            :class="isScrolled ? 'bg-blue-600 hover:bg-blue-700' : 'bg-white/20 hover:bg-white/30 backdrop-blur-sm'"
                            class="px-4 py-2 rounded-lg text-white font-medium transition-all duration-300"
                        >
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button 
                                type="submit"
                                :class="isScrolled ? 'text-gray-600 hover:text-red-600' : 'text-white/80 hover:text-white'"
                                class="font-medium transition-colors duration-300"
                            >
                                Keluar
                            </button>
                        </form>
                    </div>
                @else
                    <a 
                        href="{{ route('login') }}"
                        :class="isScrolled ? 'text-gray-700 hover:text-blue-600' : 'text-white hover:text-blue-200'"
                        class="font-medium transition-colors duration-300"
                    >
                        Masuk
                    </a>
                    <a 
                        href="{{ route('register') }}"
                        :class="isScrolled ? 'bg-blue-600 hover:bg-blue-700' : 'bg-white/20 hover:bg-white/30 backdrop-blur-sm'"
                        class="px-4 py-2 rounded-lg text-white font-medium transition-all duration-300"
                    >
                        Daftar
                    </a>
                @endauth
            </div>

            {{-- Mobile Menu Button --}}
            <div class="lg:hidden">
                <button 
                    @click="isMenuOpen = !isMenuOpen"
                    :class="isScrolled ? 'text-gray-700' : 'text-white'"
                    class="p-2 transition-colors duration-300"
                >
                    <svg x-show="!isMenuOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="isMenuOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

    {{-- Mobile Menu --}}
            {{-- Mobile Menu --}}
        <div 
            x-show="isMenuOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="lg:hidden absolute top-full left-0 right-0 bg-white/95 backdrop-blur-md shadow-lg border-t border-gray-200/20"
        >
            <div class="px-4 py-6 space-y-4">
                <a href="{{ route('home') }}" class="block text-gray-700 hover:text-blue-600 font-medium transition-colors">
                    Beranda
                </a>
                <a href="{{ route('catalog') }}" class="block text-gray-700 hover:text-blue-600 font-medium transition-colors">
                    Katalog Pelatihan
                </a>
                <a href="{{ route('pengajar') }}" class="block text-gray-700 hover:text-blue-600 font-medium transition-colors">
                    Pengajar
                </a>
                <a href="{{ route('jadwal') }}" class="block text-gray-700 hover:text-blue-600 font-medium transition-colors">
                    Jadwal
                </a>
                <a href="{{ route('contact') }}" class="block text-gray-700 hover:text-blue-600 font-medium transition-colors">
                    Kontak
                </a>
                <div class="border-t border-gray-200 pt-4 space-y-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium text-center transition-colors">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left text-gray-700 hover:text-red-600 font-medium transition-colors">
                                Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block text-gray-700 hover:text-blue-600 font-medium transition-colors">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium text-center transition-colors">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>


