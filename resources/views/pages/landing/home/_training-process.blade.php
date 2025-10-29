{{-- Training Process Section --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center space-y-4 mb-16">
            <div class="inline-block mb-4 bg-blue-100 text-blue-900 border border-blue-200 px-4 py-2 rounded-full text-sm font-semibold">
                Metodologi Terpercaya
            </div>
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900">
                Alur Pelatihan yang Terstruktur
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Metodologi pelatihan sistematis untuk memastikan pencapaian kompetensi optimal
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            @php
            $steps = [
                ['number' => '01', 'title' => 'Pendaftaran & Pre-Test', 'description' => 'Daftar online dan ikuti assessment awal untuk mengetahui level kompetensi', 'icon' => 'file'],
                ['number' => '02', 'title' => 'Sesi Teori Interaktif', 'description' => 'Pembelajaran konsep dan standar melalui metode interaktif dan studi kasus', 'icon' => 'book'],
                ['number' => '03', 'title' => 'Praktikum & Simulasi', 'description' => 'Praktik langsung teknik sampling dan analisis dengan bimbingan ahli', 'icon' => 'play'],
                ['number' => '04', 'title' => 'Post-Test & Sertifikasi', 'description' => 'Evaluasi akhir dan pemberian sertifikat kompetensi resmi', 'icon' => 'award']
            ];
            @endphp

            @foreach($steps as $index => $step)
            <div class="relative">
                <div class="bg-gray-50 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-blue-200 hover:-translate-y-1">
                    <div class="relative">
                        <div class="absolute -top-4 -left-4 w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            {{ $step['number'] }}
                        </div>
                        <div class="mt-6">
                            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-4">
                                @if($step['icon'] === 'file')
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                @elseif($step['icon'] === 'book')
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                @elseif($step['icon'] === 'play')
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                @else
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                                @endif
                            </div>
                            <h3 class="font-bold text-lg mb-3 text-gray-900">{{ $step['title'] }}</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $step['description'] }}</p>
                        </div>
                    </div>
                </div>
                @if($index < count($steps) - 1)
                <div class="hidden lg:flex absolute top-1/2 -right-4 transform -translate-y-1/2 z-20">
                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center shadow-lg">
                        <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
