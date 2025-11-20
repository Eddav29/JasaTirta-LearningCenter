{{-- Hero Section --}}
<section class="relative min-h-screen overflow-hidden">
    {{-- Dynamic Gradient Background --}}
    <div class="absolute inset-0 bg-linear-to-br from-slate-900 via-blue-900 to-indigo-900">
        {{-- Animated Mesh Gradient --}}
        <div class="absolute inset-0 bg-linear-to-tr from-purple-600/20 via-transparent to-cyan-400/20 animate-pulse"></div>
        
        {{-- Floating Orbs --}}
        <div class="absolute top-20 left-10 w-72 h-72 bg-linear-to-r from-blue-400/30 to-cyan-400/30 rounded-full blur-3xl animate-blob"></div>
        <div class="absolute bottom-20 right-10 w-80 h-80 bg-linear-to-r from-purple-400/30 to-pink-400/30 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-linear-to-r from-indigo-400/20 to-blue-400/20 rounded-full blur-3xl animate-blob animation-delay-4000"></div>
        
        {{-- Grid Pattern --}}
        <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        
        {{-- Noise Overlay --}}
        <div class="absolute inset-0 bg-noise opacity-30"></div>
    </div>

    {{-- Main Content Container --}}
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 items-center min-h-screen py-20">
            {{-- Left Content --}}
            <div class="lg:order-1 order-2 space-y-8">
                {{-- Main Headline --}}
                <div class="space-y-6">
                    <h1 class="text-5xl lg:text-7xl font-black text-white leading-tight tracking-tight">
                        Jadwal
                        <span class="block text-transparent bg-clip-text bg-linear-to-r from-cyan-400 via-blue-400 to-purple-400 animate-pulse">
                            Terbuka
                        </span>
                        <span class="text-4xl lg:text-5xl font-light text-gray-300">Sekarang</span>
                    </h1>
                    <p class="text-xl lg:text-2xl text-gray-300 font-light max-w-2xl leading-relaxed">
                        Bergabunglah dengan program pelatihan profesional yang dirancang khusus untuk mengembangkan keahlian Anda
                    </p>
                </div>

                {{-- Quick Stats --}}
                <div class="grid grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white mb-1">12+</div>
                        <div class="text-sm text-gray-400">Program Aktif</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-cyan-400 mb-1">100+</div>
                        <div class="text-sm text-gray-400">Peserta Aktif</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-purple-400 mb-1">15+</div>
                        <div class="text-sm text-gray-400">Tahun Pengalaman</div>
                    </div>
                </div>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#schedule-table" class="group inline-flex items-center justify-center px-8 py-4 bg-linear-to-r from-cyan-500 to-blue-600 text-white font-semibold rounded-xl hover:from-cyan-600 hover:to-blue-700 transition-all duration-300 shadow-2xl hover:shadow-cyan-500/25 transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-3 group-hover:animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Lihat Jadwal Lengkap
                    </a>
                    
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white/10 backdrop-blur-md border border-white/20 text-white font-semibold rounded-xl hover:bg-white/20 transition-all duration-300 shadow-xl hover:shadow-2xl">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        Konsultasi Gratis
                    </a>
                </div>
            </div>

        </div>
    </div>



    {{-- Custom Animations & Styles --}}
    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob { animation: blob 7s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
        .bg-grid-pattern {
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        .bg-noise {
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.4'/%3E%3C/svg%3E");
        }
    </style>
</section>
