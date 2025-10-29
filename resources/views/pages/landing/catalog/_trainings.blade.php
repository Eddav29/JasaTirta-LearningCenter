{{-- Training Cards Grid Section --}}
<section class="pb-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        @php
        $trainings = [
            [
                'id' => 1,
                'title' => 'Pelatihan Spektrofotometri UV-Vis',
                'category' => 'Analisis Lab',
                'type' => 'offline',
                'description' => 'Pelatihan komprehensif penggunaan spektrofotometer UV-Vis untuk analisis kualitatif dan kuantitatif. Mencakup teori dasar, kalibrasi instrumen, dan teknik analisis sesuai standar.',
                'duration' => '3 Hari',
                'price' => 'Rp 3.500.000',
                'instructor' => 'Dr. Sari Indrawati, M.Si',
                'capacity' => 20,
                'nextSchedule' => '20-22 Nov 2024',
                'rating' => 4.8,
                'reviewCount' => 95,
                'availableSlots' => 6,
                'featured' => 'popular'
            ],
            [
                'id' => 2,
                'title' => 'Pelatihan Petugas Pengambilan Contoh Uji Udara Ambien / Sampling Udara Ambien',
                'category' => 'Sampling Lingkungan',
                'type' => 'offline',
                'description' => 'Pelatihan khusus untuk petugas pengambilan contoh uji udara ambien dengan metode sampling yang sesuai dengan peraturan dan standar nasional.',
                'duration' => '2 Hari',
                'price' => 'Rp 2.800.000',
                'instructor' => 'Ir. Bambang Suryanto, M.T',
                'capacity' => 16,
                'nextSchedule' => '25-26 Nov 2024',
                'rating' => 4.7,
                'reviewCount' => 68,
                'availableSlots' => 8,
                'learningHours' => '14 JP',
                'featured' => 'new'
            ],
            [
                'id' => 3,
                'title' => 'Teknik Sampling Air Sungai Sesuai SNI',
                'category' => 'Sampling Air',
                'type' => 'offline',
                'description' => 'Pelatihan komprehensif teknik pengambilan contoh air sungai yang tepat sesuai dengan standar SNI 6989.57:2008. Mencakup teori dasar, praktik lapangan, dan sertifikasi kompetensi.',
                'duration' => '3 Hari',
                'price' => 'Rp 2.500.000',
                'instructor' => 'Dr. Ahmad Hidayat',
                'capacity' => 20,
                'nextSchedule' => '15-17 Nov 2024',
                'rating' => 4.6,
                'reviewCount' => 78,
                'availableSlots' => 12
            ],
            [
                'id' => 4,
                'title' => 'Analisis Kualitas Air Laboratorium',
                'category' => 'Analisis Lab',
                'type' => 'offline',
                'description' => 'Metode analisis parameter fisik, kimia, dan biologi air menggunakan peralatan laboratorium modern. Pelatihan hands-on dengan instrumen terkini.',
                'duration' => '5 Hari',
                'price' => 'Rp 4.200.000',
                'instructor' => 'Prof. Dr. Sari Wahyuni',
                'capacity' => 15,
                'nextSchedule' => '20-24 Nov 2024',
                'rating' => 4.9,
                'reviewCount' => 112,
                'availableSlots' => 5
            ],
            [
                'id' => 5,
                'title' => 'Manajemen K3L Laboratorium Air',
                'category' => 'K3L',
                'type' => 'hybrid',
                'description' => 'Sistem manajemen keselamatan, kesehatan kerja, dan lingkungan khusus untuk laboratorium analisis air. Includes risk assessment dan emergency procedures.',
                'duration' => '2 Hari',
                'price' => 'Rp 1.800.000',
                'instructor' => 'Ir. Budi Santoso',
                'capacity' => 25,
                'nextSchedule' => '25-26 Nov 2024',
                'rating' => 4.5,
                'reviewCount' => 89,
                'availableSlots' => 18
            ],
            [
                'id' => 6,
                'title' => 'Sampling Air Tanah dan Sumur',
                'category' => 'Sampling Air',
                'type' => 'offline',
                'description' => 'Teknik khusus pengambilan sampel air tanah dan air sumur untuk berbagai keperluan analisis lingkungan dan monitoring kualitas.',
                'duration' => '3 Hari',
                'price' => 'Rp 2.800.000',
                'instructor' => 'Dr. Rina Marlina',
                'capacity' => 18,
                'nextSchedule' => '28-30 Nov 2024',
                'rating' => 4.7,
                'reviewCount' => 65,
                'availableSlots' => 10
            ],
            [
                'id' => 7,
                'title' => 'Interpretasi Data Kualitas Air',
                'category' => 'Analisis Data',
                'type' => 'online',
                'description' => 'Analisis statistik dan interpretasi hasil pengujian kualitas air untuk pengambilan keputusan yang tepat dalam pengelolaan lingkungan.',
                'duration' => '2 Hari',
                'price' => 'Rp 1.500.000',
                'instructor' => 'Dr. Indra Kusuma',
                'capacity' => 30,
                'nextSchedule' => '02-03 Des 2024',
                'rating' => 4.4,
                'reviewCount' => 45,
                'availableSlots' => 22
            ],
            [
                'id' => 8,
                'title' => 'Mikrobiologi Air dan Sanitasi',
                'category' => 'Analisis Lab',
                'type' => 'offline',
                'description' => 'Analisis mikrobiologi air minum, air limbah, dan air permukaan. Mencakup identifikasi bakteri patogen dan indikator sanitasi.',
                'duration' => '4 Hari',
                'price' => 'Rp 3.500.000',
                'instructor' => 'Dr. Maya Sari',
                'capacity' => 12,
                'nextSchedule' => '05-08 Des 2024',
                'rating' => 4.8,
                'reviewCount' => 73,
                'availableSlots' => 4
            ],
            [
                'id' => 9,
                'title' => 'Audit Sistem Manajemen Laboratorium',
                'category' => 'Manajemen',
                'type' => 'hybrid',
                'description' => 'Pelatihan auditor internal untuk sistem manajemen mutu laboratorium sesuai ISO/IEC 17025. Teknik audit dan pelaporan yang efektif.',
                'duration' => '3 Hari',
                'price' => 'Rp 3.200.000',
                'instructor' => 'Ir. Hendra Wijaya',
                'capacity' => 20,
                'nextSchedule' => '10-12 Des 2024',
                'rating' => 4.6,
                'reviewCount' => 57,
                'availableSlots' => 14
            ],
            [
                'id' => 10,
                'title' => 'Kalibrasi Alat Uji Kualitas Air',
                'category' => 'Kalibrasi',
                'type' => 'offline',
                'description' => 'Prosedur kalibrasi dan pemeliharaan instrument analisis kualitas air untuk memastikan akurasi dan keandalan hasil pengujian.',
                'duration' => '2 Hari',
                'price' => 'Rp 2.200.000',
                'instructor' => 'Ir. Joko Susilo',
                'capacity' => 16,
                'nextSchedule' => '15-16 Des 2024',
                'rating' => 4.5,
                'reviewCount' => 41,
                'availableSlots' => 9
            ],
            [
                'id' => 11,
                'title' => 'Pengelolaan Limbah Laboratorium',
                'category' => 'K3L',
                'type' => 'offline',
                'description' => 'Manajemen limbah kimia dan biologi laboratorium sesuai peraturan lingkungan. Treatment dan disposal yang aman dan bertanggung jawab.',
                'duration' => '2 Hari',
                'price' => 'Rp 1.900.000',
                'instructor' => 'Dr. Lina Hartati',
                'capacity' => 22,
                'nextSchedule' => '18-19 Des 2024',
                'rating' => 4.4,
                'reviewCount' => 36,
                'availableSlots' => 16
            ]
        ];
        @endphp

        {{-- Training Cards Grid --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
            @foreach($trainings as $training)
                @php
                $percentage = ($training['availableSlots'] / $training['capacity']) * 100;
                if ($percentage > 50) {
                    $availabilityColor = 'text-green-600';
                    $availabilityText = 'Tersedia';
                } elseif ($percentage > 20) {
                    $availabilityColor = 'text-orange-600';
                    $availabilityText = 'Terbatas';
                } else {
                    $availabilityColor = 'text-red-600';
                    $availabilityText = 'Hampir Penuh';
                }

                $typeLabels = [
                    'offline' => 'Tatap Muka',
                    'online' => 'Daring',
                    'hybrid' => 'Hybrid'
                ];

                $typeBadgeColors = [
                    'offline' => 'bg-blue-100 text-blue-800',
                    'online' => 'bg-purple-100 text-purple-800',
                    'hybrid' => 'bg-green-100 text-green-800'
                ];
                @endphp

                <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    {{-- Image --}}
                    <div class="aspect-video overflow-hidden relative bg-gradient-to-br from-blue-500 to-blue-700">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="h-16 w-16 text-white/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                        
                        {{-- Featured Badge --}}
                        @if(isset($training['featured']))
                            <div class="absolute top-3 left-3">
                                @if($training['featured'] === 'popular')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-yellow-500 text-yellow-900">
                                        ⭐ Populer
                                    </span>
                                @elseif($training['featured'] === 'new')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-blue-500 text-white">
                                        🆕 Baru
                                    </span>
                                @endif
                            </div>
                        @endif
                    </div>
                    
                    {{-- Card Header --}}
                    <div class="p-6 pb-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $training['category'] }}
                            </span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $typeBadgeColors[$training['type']] }}">
                                {{ $typeLabels[$training['type']] }}
                            </span>
                        </div>
                        <h3 class="text-lg font-semibold leading-tight line-clamp-2 text-gray-900 mb-2">
                            {{ $training['title'] }}
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                            {{ $training['description'] }}
                        </p>
                    </div>
                    
                    {{-- Card Content --}}
                    <div class="px-6 pb-6 space-y-4">
                        {{-- Rating and Reviews --}}
                        <div class="flex items-center space-x-2 text-sm">
                            <div class="flex items-center space-x-1">
                                <svg class="h-4 w-4 fill-yellow-400 text-yellow-400" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="font-medium">{{ $training['rating'] }}</span>
                            </div>
                            <span class="text-gray-500">({{ $training['reviewCount'] }} ulasan)</span>
                            @if(isset($training['learningHours']))
                                <span class="text-gray-500">•</span>
                                <span class="text-gray-500">{{ $training['learningHours'] }}</span>
                            @endif
                        </div>

                        <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                            <div class="flex items-center space-x-2">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ $training['duration'] }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <span>{{ $training['capacity'] }} peserta</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $training['nextSchedule'] }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span class="truncate">{{ explode(',', $training['instructor'])[0] }}</span>
                            </div>
                        </div>

                        {{-- Availability Status --}}
                        <div class="flex items-center justify-between text-xs">
                            <span class="font-medium {{ $availabilityColor }}">
                                {{ $availabilityText }}
                            </span>
                            <span class="text-gray-500">
                                {{ $training['availableSlots'] }} dari {{ $training['capacity'] }} slot tersisa
                            </span>
                        </div>
                        
                        <div class="border-t pt-4">
                            <div class="flex flex-col space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-2xl font-bold text-blue-600">{{ $training['price'] }}</span>
                                    <span class="text-sm text-gray-500">per peserta</span>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <a href="#" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                                        Detail
                                    </a>
                                    <a href="#" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition {{ $training['availableSlots'] === 0 ? 'opacity-50 cursor-not-allowed' : '' }}">
                                        {{ $training['availableSlots'] === 0 ? 'Penuh' : 'Daftar' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
