{{-- FAQ Section --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center space-y-4 mb-16">
            <h2 class="text-3xl lg:text-4xl font-bold">Pertanyaan yang Sering Diajukan</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Temukan jawaban atas pertanyaan umum seputar pelatihan kami
            </p>
        </div>

        <div class="max-w-3xl mx-auto space-y-4">
            @php
            $faqs = [
                [
                    'question' => 'Bagaimana cara mendaftar pelatihan?',
                    'answer' => 'Anda dapat mendaftar melalui website kami, menghubungi tim marketing di nomor yang tercantum, atau datang langsung ke kantor kami. Proses pendaftaran mudah dengan mengisi formulir dan melakukan pembayaran.'
                ],
                [
                    'question' => 'Apakah sertifikat yang diberikan diakui secara resmi?',
                    'answer' => 'Ya, sertifikat kompetensi kami diakui secara nasional dan sesuai dengan standar BNSP (Badan Nasional Sertifikasi Profesi). Sertifikat dapat digunakan untuk persyaratan karir dan tender proyek.'
                ],
                [
                    'question' => 'Apakah ada diskon untuk pelatihan korporat?',
                    'answer' => 'Kami menyediakan paket khusus dan diskon menarik untuk pelatihan korporat dengan minimum 5 peserta. Silakan hubungi tim kami untuk mendiskusikan kebutuhan dan mendapatkan penawaran terbaik.'
                ],
                [
                    'question' => 'Bagaimana jika tidak bisa mengikuti jadwal yang tersedia?',
                    'answer' => 'Kami menyediakan jadwal reguler setiap bulan. Untuk kebutuhan khusus, kami juga melayani pelatihan in-house dengan jadwal yang dapat disesuaikan dengan kebutuhan perusahaan Anda.'
                ],
                [
                    'question' => 'Apa saja fasilitas yang disediakan selama pelatihan?',
                    'answer' => 'Fasilitas lengkap meliputi ruang kelas ber-AC, laboratorium modern, peralatan sampling, modul pelatihan, sertifikat, konsumsi, dan akses ke instruktur untuk konsultasi lanjutan.'
                ]
            ];
            @endphp

            @foreach($faqs as $index => $faq)
            <details class="border rounded-lg px-6 py-4 group">
                <summary class="text-left font-semibold cursor-pointer flex justify-between items-center text-gray-900">
                    {{ $faq['question'] }}
                    <svg class="w-5 h-5 text-gray-500 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </summary>
                <div class="mt-4 text-gray-600 leading-relaxed">
                    {{ $faq['answer'] }}
                </div>
            </details>
            @endforeach
        </div>
    </div>
</section>
