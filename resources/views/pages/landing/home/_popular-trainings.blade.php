{{-- Popular Trainings Section --}}
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center space-y-4 mb-16">
            <h2 class="text-3xl lg:text-4xl font-bold">Program Pelatihan Terpopuler</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Pilihan pelatihan favorit yang paling diminati oleh perusahaan dan individu profesional
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
            $trainings = [
                [
                    'title' => 'Teknik Sampling Air Sungai Sesuai SNI',
                    'category' => 'Sampling Air',
                    'description' => 'Pelatihan komprehensif teknik pengambilan contoh air sungai yang tepat sesuai dengan standar SNI 6989.57:2008',
                    'duration' => '3 Hari',
                    'price' => 'Rp 2.500.000'
                ],
                [
                    'title' => 'Analisis Kualitas Air Laboratorium',
                    'category' => 'Analisis Lab',
                    'description' => 'Metode analisis parameter fisik, kimia, dan biologi air menggunakan peralatan laboratorium modern',
                    'duration' => '5 Hari',
                    'price' => 'Rp 4.200.000'
                ],
                [
                    'title' => 'Manajemen K3L Laboratorium Air',
                    'category' => 'K3L',
                    'description' => 'Sistem manajemen keselamatan, kesehatan kerja, dan lingkungan khusus untuk laboratorium analisis air',
                    'duration' => '2 Hari',
                    'price' => 'Rp 1.800.000'
                ]
            ];
            @endphp

            @foreach($trainings as $index => $training)
            <div class="overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 rounded-lg bg-white">
                <div class="aspect-video overflow-hidden bg-linear-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                    <p class="text-white text-xl font-bold">Training Image {{ $index + 1 }}</p>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 text-sm font-semibold rounded-full">{{ $training['category'] }}</span>
                        <span class="text-sm font-medium text-gray-500">{{ $training['duration'] }}</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2 leading-tight">{{ $training['title'] }}</h3>
                    <p class="text-sm leading-relaxed text-gray-600 mb-4">{{ $training['description'] }}</p>
                    <div class="flex items-center justify-between pt-4 border-t">
                        <span class="text-lg font-bold text-blue-600">{{ $training['price'] }}</span>
                        <a href="#" class="px-4 py-2 border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-lg text-sm font-semibold transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="/catalog" class="inline-flex items-center px-8 py-3 border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white rounded-lg font-semibold transition">
                Lihat Semua Pelatihan
                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
</section>
