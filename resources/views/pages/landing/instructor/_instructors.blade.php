{{-- Instructors Section with Tabs --}}
<section class="py-12" x-data="{ activeTab: 'internal' }">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        @php
        $internalInstructors = [
            [
                'id' => 1,
                'name' => 'Dr. Ahmad Hidayat, M.Si',
                'specialization' => 'Teknik Sampling Air & Quality Control',
                'education' => 'S3 Teknik Lingkungan - ITB',
                'experience' => '15+ tahun',
                'certifications' => ['Lead Auditor ISO/IEC 17025', 'Ahli Muda Lingkungan', 'Certified Water Quality Analyst'],
                'bio' => 'Ahli di bidang sampling dan analisis kualitas air dengan pengalaman lebih dari 15 tahun. Pernah menjadi konsultan untuk berbagai proyek BUMN dan swasta dalam pengelolaan kualitas air.',
                'courses' => ['Teknik Sampling Air Sungai', 'Quality Control Laboratorium', 'Sistem Manajemen Mutu Lab'],
                'email' => 'ahmad.hidayat@jasatirta-lc.com',
                'phone' => '+62 812 3456 7890'
            ],
            [
                'id' => 2,
                'name' => 'Prof. Dr. Sari Wahyuni, M.T',
                'specialization' => 'Analisis Kimia Air & Instrumentasi',
                'education' => 'S3 Kimia Analitik - UI',
                'experience' => '20+ tahun',
                'certifications' => ['Professor Teknik Kimia', 'Lead Assessor Laboratorium', 'International Water Quality Expert'],
                'bio' => 'Professor dengan keahlian khusus dalam analisis kimia air dan pengembangan metode analisis. Aktif dalam penelitian dan publikasi internasional di bidang kualitas air.',
                'courses' => ['Analisis Kualitas Air Laboratorium', 'Instrumentasi Analitik', 'Metode Analisis Terkini'],
                'email' => 'sari.wahyuni@jasatirta-lc.com',
                'phone' => '+62 813 4567 8901'
            ],
            [
                'id' => 3,
                'name' => 'Ir. Budi Santoso, M.Eng',
                'specialization' => 'K3L & Manajemen Laboratorium',
                'education' => 'S2 Teknik Lingkungan - UGM',
                'experience' => '18+ tahun',
                'certifications' => ['Ahli K3 Umum', 'ISO 14001 Lead Auditor', 'OHSAS 18001 Implementer'],
                'bio' => 'Spesialis dalam sistem manajemen K3L laboratorium dan pengelolaan limbah B3. Berpengalaman sebagai konsultan HSE untuk industri kimia dan farmasi.',
                'courses' => ['Manajemen K3L Laboratorium', 'Pengelolaan Limbah Lab', 'Audit Sistem Manajemen'],
                'email' => 'budi.santoso@jasatirta-lc.com',
                'phone' => '+62 814 5678 9012'
            ],
            [
                'id' => 4,
                'name' => 'Dr. Rina Marlina, S.T, M.T',
                'specialization' => 'Hidrogeologi & Sampling Air Tanah',
                'education' => 'S3 Teknik Geologi - UNPAD',
                'experience' => '12+ tahun',
                'certifications' => ['Professional Hydrogeologist', 'Groundwater Modeling Expert', 'Environmental Impact Assessor'],
                'bio' => 'Ahli hidrogeologi dengan fokus pada karakterisasi akuifer dan teknik sampling air tanah. Memiliki pengalaman luas dalam proyek AMDAL dan studi kelayakan lingkungan.',
                'courses' => ['Sampling Air Tanah dan Sumur', 'Hidrogeologi Terapan', 'Groundwater Monitoring'],
                'email' => 'rina.marlina@jasatirta-lc.com',
                'phone' => '+62 815 6789 0123'
            ]
        ];

        $vendorInstructors = [
            [
                'id' => 5,
                'name' => 'Dr. Indra Kusuma, M.Si',
                'specialization' => 'Statistik & Interpretasi Data Lingkungan',
                'company' => 'PT Konsultan Lingkungan Nusantara',
                'education' => 'S3 Statistika Terapan - IPB',
                'experience' => '14+ tahun',
                'certifications' => ['Statistical Analysis Expert', 'Data Science Professional', 'R & Python Specialist'],
                'bio' => 'Pakar statistik lingkungan dengan keahlian dalam analisis big data dan machine learning untuk prediksi kualitas air. Aktif sebagai konsultan untuk WHO dan UNICEF.',
                'courses' => ['Interpretasi Data Kualitas Air', 'Analisis Statistik Lingkungan', 'Data Mining untuk Environment'],
                'email' => 'indra@konsultan-lingkungan.com',
                'phone' => '+62 816 7890 1234'
            ],
            [
                'id' => 6,
                'name' => 'Dr. Maya Sari, S.Si, M.Si',
                'specialization' => 'Mikrobiologi Air & Biosafety',
                'company' => 'Laboratorium Kesehatan Terpadu',
                'education' => 'S3 Mikrobiologi - UNAIR',
                'experience' => '16+ tahun',
                'certifications' => ['Certified Microbiologist', 'Biosafety Officer', 'WHO Water Quality Expert'],
                'bio' => 'Mikrobiolog senior dengan spesialisasi mikroorganisme patogen dalam air. Berpengalaman dalam pengembangan protokol biosafety dan quality assurance laboratorium mikrobiologi.',
                'courses' => ['Mikrobiologi Air dan Sanitasi', 'Biosafety Laboratorium', 'Deteksi Patogen Air'],
                'email' => 'maya.sari@labkesterpadu.com',
                'phone' => '+62 817 8901 2345'
            ],
            [
                'id' => 7,
                'name' => 'Ir. Hendra Wijaya, M.M',
                'specialization' => 'Audit & Sistem Manajemen Mutu',
                'company' => 'Indo Certification Body',
                'education' => 'S2 Manajemen - Prasetiya Mulya',
                'experience' => '22+ tahun',
                'certifications' => ['Lead Auditor ISO/IEC 17025', 'ISO 9001 Lead Auditor', 'IRCA Certified Auditor'],
                'bio' => 'Auditor senior bersertifikat internasional dengan pengalaman audit lebih dari 500 laboratorium. Expertise dalam implementasi dan audit sistem manajemen mutu laboratorium.',
                'courses' => ['Audit Sistem Manajemen Laboratorium', 'ISO/IEC 17025 Implementation', 'Internal Audit Training'],
                'email' => 'hendra@indocert.com',
                'phone' => '+62 818 9012 3456'
            ],
            [
                'id' => 8,
                'name' => 'Ir. Joko Susilo, M.T',
                'specialization' => 'Kalibrasi & Metrologi',
                'company' => 'Kalibrasi Indonesia',
                'education' => 'S2 Teknik Fisika - ITS',
                'experience' => '19+ tahun',
                'certifications' => ['Kalibrator Terakreditasi KAN', 'Metrologist Professional', 'ISO/IEC 17025 Technical Assessor'],
                'bio' => 'Ahli kalibrasi dan metrologi dengan pengalaman dalam kalibrasi instrumen analitik. Memiliki sertifikasi sebagai kalibrator dari Komite Akreditasi Nasional (KAN).',
                'courses' => ['Kalibrasi Alat Uji Kualitas Air', 'Metrologi Dasar', 'Uncertainty Measurement'],
                'email' => 'joko@kalibrasi-indonesia.com',
                'phone' => '+62 819 0123 4567'
            ]
        ];
        @endphp

        {{-- Tabs Navigation --}}
        <div class="flex justify-center mb-8">
            <div class="inline-flex bg-white rounded-lg shadow p-1">
                <button 
                    @click="activeTab = 'internal'"
                    :class="activeTab === 'internal' ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100'"
                    class="px-6 py-2 rounded-lg font-medium transition"
                >
                    Pengajar Internal
                </button>
                <button 
                    @click="activeTab = 'vendor'"
                    :class="activeTab === 'vendor' ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100'"
                    class="px-6 py-2 rounded-lg font-medium transition"
                >
                    Pengajar Vendor
                </button>
            </div>
        </div>

        {{-- Internal Instructors Tab --}}
        <div x-show="activeTab === 'internal'" class="space-y-8">
            <div class="text-center space-y-4">
                <h2 class="text-2xl font-bold text-gray-900">Tim Pengajar Internal</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Staf pengajar tetap Jasa Tirta Learning Center yang berpengalaman langsung dalam implementasi 
                    standar kualitas air di berbagai industri dan instansi pemerintah.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-8">
                @foreach($internalInstructors as $instructor)
                    @include('pages.landing.instructor._instructor-card', ['instructor' => $instructor, 'isVendor' => false])
                @endforeach
            </div>
        </div>

        {{-- Vendor Instructors Tab --}}
        <div x-show="activeTab === 'vendor'" class="space-y-8" style="display: none;">
            <div class="text-center space-y-4">
                <h2 class="text-2xl font-bold text-gray-900">Pengajar Vendor & Mitra</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Pakar eksternal dari berbagai institusi dan perusahaan terkemuka yang berkontribusi 
                    memberikan perspektif industri dan perkembangan teknologi terkini.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-8">
                @foreach($vendorInstructors as $instructor)
                    @include('pages.landing.instructor._instructor-card', ['instructor' => $instructor, 'isVendor' => true])
                @endforeach
            </div>
        </div>
    </div>
</section>
