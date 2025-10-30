{{-- Hero Section --}}
<section class="relative min-h-screen flex items-center overflow-hidden bg-white">
    {{-- Animated Background Elements --}}
    <div class="absolute inset-0">
        {{-- Primary Gradient Background --}}
        <div class="absolute inset-0 bg-linear-to-br from-slate-900 via-blue-900 to-indigo-900"></div>
        
        {{-- Animated Floating Elements --}}
        <div class="absolute top-20 left-10 w-32 h-32 bg-blue-400 rounded-full mix-blend-screen filter blur-xl opacity-30 animate-blob"></div>
        <div class="absolute top-40 right-10 w-32 h-32 bg-purple-400 rounded-full mix-blend-screen filter blur-xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-32 h-32 bg-indigo-400 rounded-full mix-blend-screen filter blur-xl opacity-30 animate-blob animation-delay-4000"></div>
        
        {{-- Grid Pattern Overlay --}}
        <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
    </div>

    {{-- Main Content Container --}}
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 items-center min-h-screen py-20">
            {{-- Left Content --}}
            <div class="space-y-8">
                {{-- Badge --}}
                <div class="inline-flex items-center px-6 py-3 bg-linear-to-r from-blue-600 to-indigo-600 rounded-full text-white text-sm font-medium shadow-lg shadow-blue-200">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Konsultasi Gratis - Tim Ahli Siap Membantu
                </div>

                {{-- Main Headline --}}
                <div class="space-y-4">
                    <h1 class="text-5xl lg:text-7xl font-bold text-white leading-tight">
                        Hubungi
                        <span class="text-transparent bg-clip-text bg-linear-to-r from-blue-200 via-indigo-200 to-purple-200">
                            Tim Ahli
                        </span>
                        <span class="block text-4xl lg:text-5xl text-blue-100 font-medium">
                            Jasa Tirta Learning Center
                        </span>
                    </h1>
                </div>

                {{-- Description --}}
                <p class="text-xl text-blue-100 leading-relaxed max-w-lg">
                    Dapatkan konsultasi profesional untuk merancang program pelatihan yang tepat sasaran. 
                    Tim berpengalaman kami siap membantu meningkatkan kompetensi SDM perusahaan Anda.
                </p>

                {{-- Contact Methods --}}
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="flex items-center p-4 bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Telepon</p>
                            <p class="font-semibold text-gray-900">+62 123 456 789</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center p-4 bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-semibold text-gray-900">info@jasatirta-lc.com</p>
                        </div>
                    </div>
                </div>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <button class="group inline-flex items-center justify-center px-8 py-4 bg-linear-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-2xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 shadow-xl shadow-blue-200 hover:shadow-2xl hover:shadow-blue-300 transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-3 group-hover:rotate-12 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        Mulai Konsultasi
                    </button>
                    
                    <a href="{{ route('catalog') }}" class="inline-flex items-center justify-center px-8 py-4 border-2 border-white/30 text-white font-semibold rounded-2xl hover:border-blue-400 hover:text-blue-200 transition-colors duration-300">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Lihat Program
                    </a>
                </div>
            </div>

            {{-- Right Visual Content --}}
            <div class="relative lg:order-first order-last">
                {{-- Main Illustration Container --}}
                <div class="relative">
                    {{-- Background Decorative Elements --}}
                    <div class="absolute -inset-4">
                        <div class="w-full h-full bg-linear-to-r from-blue-400 to-indigo-500 rounded-3xl transform rotate-3 opacity-20"></div>
                    </div>
                    <div class="absolute -inset-2">
                        <div class="w-full h-full bg-linear-to-r from-indigo-400 to-purple-500 rounded-3xl transform -rotate-2 opacity-20"></div>
                    </div>
                    
                    {{-- Main Content Card --}}
                    <div class="relative bg-white rounded-3xl shadow-2xl p-8 transform hover:scale-105 transition-transform duration-500">
                        {{-- Header --}}
                        <div class="text-center mb-8">
                            <div class="w-20 h-20 bg-linear-to-r from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Siap Membantu Anda</h3>
                            <p class="text-gray-600">Tim professional dengan pengalaman 15+ tahun</p>
                        </div>

                        {{-- Contact Stats --}}
                        <div class="grid grid-cols-2 gap-6 mb-8">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-blue-600 mb-1">24/7</div>
                                <div class="text-sm text-gray-600">Layanan Konsultasi</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-indigo-600 mb-1">1000+</div>
                                <div class="text-sm text-gray-600">Klien Terpuaskan</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-purple-600 mb-1">50+</div>
                                <div class="text-sm text-gray-600">Program Pelatihan</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-green-600 mb-1">15+</div>
                                <div class="text-sm text-gray-600">Tahun Pengalaman</div>
                            </div>
                        </div>

                        {{-- Quick Contact Form Teaser --}}
                        <div class="bg-gray-50 rounded-2xl p-6">
                            <h4 class="font-semibold text-gray-900 mb-4">Konsultasi Cepat</h4>
                            <div class="space-y-3">
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Analisis kebutuhan pelatihan
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Rekomendasi program terbaik
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Penawaran khusus untuk perusahaan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Animations --}}
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
    </style>
</section>
