{{-- Why Choose Us Section --}}
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center space-y-4 mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-900">Mengapa Memilih Jasa Tirta Learning Center?</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Keunggulan yang membuat kami menjadi pilihan utama untuk pengembangan kompetensi SDM
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            @php
            $features = [
                [
                    'title' => 'Kurikulum Berbasis SNI Terbaru',
                    'description' => 'Materi pelatihan mengacu pada standar SNI terkini untuk memastikan kompetensi sesuai regulasi nasional',
                    'icon' => 'book'
                ],
                [
                    'title' => 'Instruktur Ahli dari Praktisi',
                    'description' => 'Tim pengajar berpengalaman puluhan tahun di bidang analisis kualitas air dan laboratorium',
                    'icon' => 'users'
                ],
                [
                    'title' => 'Sertifikasi Resmi',
                    'description' => 'Sertifikat kompetensi yang diakui secara nasional dan dapat digunakan untuk persyaratan karir',
                    'icon' => 'award'
                ],
                [
                    'title' => 'Praktikum Lapangan Intensif',
                    'description' => 'Latihan langsung dengan peralatan modern di laboratorium dan lokasi sampling sesungguhnya',
                    'icon' => 'microscope'
                ]
            ];
            @endphp

            @foreach($features as $feature)
            <div class="text-center bg-white border border-gray-100 shadow-lg hover:shadow-xl transition-shadow duration-300 rounded-lg p-6">
                <div class="mx-auto bg-blue-50 p-4 rounded-2xl w-fit mb-4">
                    @if($feature['icon'] === 'book')
                    <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    @elseif($feature['icon'] === 'users')
                    <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    @elseif($feature['icon'] === 'award')
                    <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                    @else
                    <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                    </svg>
                    @endif
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $feature['title'] }}</h3>
                <p class="text-sm leading-relaxed text-gray-600">{{ $feature['description'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
