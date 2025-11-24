{{-- Why Choose Us Section --}}
<section class="py-24 bg-linear-to-b from-white via-slate-50 to-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center space-y-6 mb-20">
            <div class="inline-flex items-center gap-2 bg-blue-100 text-blue-700 px-4 py-2 rounded-full font-semibold text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                Keunggulan Kami
            </div>
            <h2 class="text-4xl lg:text-5xl font-black text-gray-900 leading-tight">Mengapa Memilih <br/><span class="bg-linear-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Jasa Tirta Learning Center?</span></h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Keunggulan yang membuat kami menjadi pilihan utama untuk pengembangan kompetensi SDM
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
            $features = [
                [
                    'title' => 'Kurikulum Berbasis SNI Terbaru',
                    'description' => 'Materi pelatihan mengacu pada standar SNI terkini untuk memastikan kompetensi sesuai regulasi nasional',
                    'icon' => 'book',
                    'color' => 'blue'
                ],
                [
                    'title' => 'Instruktur Ahli dari Praktisi',
                    'description' => 'Tim pengajar berpengalaman puluhan tahun di bidang analisis kualitas air dan laboratorium',
                    'icon' => 'users',
                    'color' => 'purple'
                ],
                [
                    'title' => 'Sertifikasi Resmi',
                    'description' => 'Sertifikat kompetensi yang diakui secara nasional dan dapat digunakan untuk persyaratan karir',
                    'icon' => 'award',
                    'color' => 'green'
                ],
                [
                    'title' => 'Praktikum Lapangan Intensif',
                    'description' => 'Latihan langsung dengan peralatan modern di laboratorium dan lokasi sampling sesungguhnya',
                    'icon' => 'microscope',
                    'color' => 'orange'
                ]
            ];
            @endphp

            @foreach($features as $feature)
            <div class="group relative bg-white border-2 border-gray-100 hover:border-{{ $feature['color'] }}-300 shadow-lg hover:shadow-2xl transition-all duration-500 rounded-2xl p-8 hover:-translate-y-2">
                <div class="absolute inset-0 bg-linear-to-br from-{{ $feature['color'] }}-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-2xl"></div>
                <div class="relative">
                    <div class="mb-6">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-linear-to-br from-{{ $feature['color'] }}-500 to-{{ $feature['color'] }}-600 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            @if($feature['icon'] === 'book')
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            @elseif($feature['icon'] === 'users')
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            @elseif($feature['icon'] === 'award')
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                            @else
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                            </svg>
                            @endif
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 leading-snug">{{ $feature['title'] }}</h3>
                    <p class="text-sm leading-relaxed text-gray-600">{{ $feature['description'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
