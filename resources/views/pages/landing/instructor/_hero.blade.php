{{-- Hero Section --}}
<section class="relative min-h-screen flex items-center overflow-hidden">
    {{-- Dynamic Gradient Background (Same as Schedule) --}}
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

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 items-center min-h-screen py-20">
            {{-- Left Content --}}
            <div class="lg:order-1 order-2 space-y-8 flex flex-col justify-center">
                {{-- Main Headline --}}
                <div class="space-y-6">
                    <h1 class="text-4xl lg:text-6xl font-black text-white leading-tight">
                        Tim Pengajar
                        <span class="block text-transparent bg-clip-text bg-linear-to-r from-cyan-400 to-blue-400">
                            Profesional
                        </span>
                    </h1>
                    <p class="text-xl text-gray-300 leading-relaxed max-w-xl">
                        Belajar langsung dari para praktisi berpengalaman dan akademisi terkemuka di bidang analisis dan pengelolaan kualitas air
                    </p>
                </div>

                {{-- Stats --}}
                <div class="grid grid-cols-3 gap-8 py-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white mb-1">8+</div>
                        <div class="text-sm text-gray-400">Expert Instructors</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-cyan-400 mb-1">25+</div>
                        <div class="text-sm text-gray-400">Tahun Pengalaman Rata-rata</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-purple-400 mb-1">15+</div>
                        <div class="text-sm text-gray-400">Sertifikasi Internasional</div>
                    </div>
                </div>

                {{-- CTA --}}
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#instructors" class="inline-flex items-center justify-center px-8 py-4 bg-linear-to-r from-cyan-500 to-blue-600 text-white font-semibold rounded-xl hover:from-cyan-600 hover:to-blue-700 transition-all duration-300 shadow-2xl hover:shadow-cyan-500/25 transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        Lihat Tim Pengajar
                    </a>
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white/10 backdrop-blur-md border border-white/20 text-white font-semibold rounded-xl hover:bg-white/20 transition-all duration-300 shadow-xl hover:shadow-2xl">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        Konsultasi Program
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
