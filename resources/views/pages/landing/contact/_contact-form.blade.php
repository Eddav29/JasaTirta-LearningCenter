{{-- Main Contact Section --}}
<section class="py-20" x-data="contactForm()">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-12 max-w-7xl mx-auto">
            {{-- Contact Information --}}
            <div class="lg:col-span-1 space-y-8">
                <div class="space-y-6">
                    <div class="space-y-3">
                        <h2 class="text-2xl font-bold text-gray-900">Informasi Kontak</h2>
                        <p class="text-gray-600">
                            Kami siap membantu Anda 24/7. Hubungi kami melalui berbagai channel yang tersedia.
                        </p>
                    </div>

                    <div class="space-y-6">
                        {{-- Address --}}
                        <div class="flex items-start space-x-4 group">
                            <div class="bg-blue-100 p-3 rounded-xl group-hover:bg-blue-200 transition-colors">
                                <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-900 text-sm mb-1">Alamat Kantor</h3>
                                <div class="text-gray-900 font-semibold text-sm space-y-1">
                                    <div>Jl. Lingkungan No. 123, Gedung Pembelajaran</div>
                                    <div>Jakarta 12345, Indonesia</div>
                                </div>
                                <p class="text-gray-600 text-xs mt-1">Kantor pusat dan tempat pelaksanaan pelatihan</p>
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div class="flex items-start space-x-4 group">
                            <div class="bg-blue-100 p-3 rounded-xl group-hover:bg-blue-200 transition-colors">
                                <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-900 text-sm mb-1">Telepon</h3>
                                <p class="text-gray-900 font-semibold text-sm">+62 21 1234 5678</p>
                                <p class="text-gray-600 text-xs mt-1">Layanan customer service</p>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="flex items-start space-x-4 group">
                            <div class="bg-blue-100 p-3 rounded-xl group-hover:bg-blue-200 transition-colors">
                                <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-900 text-sm mb-1">Email</h3>
                                <p class="text-gray-900 font-semibold text-sm">info@jasatirta-lc.com</p>
                                <p class="text-gray-600 text-xs mt-1">Untuk inquiry dan informasi umum</p>
                            </div>
                        </div>

                        {{-- Operating Hours --}}
                        <div class="flex items-start space-x-4 group">
                            <div class="bg-blue-100 p-3 rounded-xl group-hover:bg-blue-200 transition-colors">
                                <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-900 text-sm mb-1">Jam Operasional</h3>
                                <div class="text-gray-900 font-semibold text-sm space-y-1">
                                    <div>Senin - Jumat: 08:00 - 17:00 WIB</div>
                                    <div>Sabtu: 08:00 - 12:00 WIB</div>
                                </div>
                                <p class="text-gray-600 text-xs mt-1">Waktu pelayanan customer service</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Response Promise --}}
                <div class="bg-blue-50 border-l-4 border-blue-600 rounded-lg p-6">
                    <div class="flex items-start space-x-3">
                        <svg class="h-5 w-5 text-blue-600 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h4 class="font-medium text-gray-900 mb-2">Respon Cepat</h4>
                            <p class="text-gray-600 text-sm">
                                Tim kami berkomitmen merespons inquiry Anda dalam waktu maksimal 2 jam kerja.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Map Placeholder --}}
                <div class="bg-white rounded-lg overflow-hidden shadow">
                    <div class="bg-linear-to-br from-blue-50 to-blue-100 h-48 flex items-center justify-center relative">
                        <div class="text-center text-gray-600">
                            <svg class="h-12 w-12 mx-auto mb-3 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <p class="font-medium">Lokasi Kantor Kami</p>
                            <p class="text-sm mt-1">Google Maps akan diintegrasikan</p>
                        </div>
                        <div class="absolute top-4 right-4">
                            <div class="bg-blue-200 px-3 py-1 rounded-full text-xs text-blue-700 font-medium">
                                Jakarta Pusat
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Contact Form --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl border-0 overflow-hidden">
                    {{-- Card Header --}}
                    <div class="p-6 pb-8 border-b border-gray-100">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">Kirim Pesan Kepada Kami</h2>
                                <p class="text-sm text-gray-600 mt-1">
                                    Ceritakan kebutuhan pelatihan Anda dan kami akan menyiapkan solusi terbaik
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Form --}}
                    <form @submit.prevent="submitForm" class="p-6 space-y-6">
                        {{-- Personal Information --}}
                        <div class="space-y-4">
                            <div class="flex items-center space-x-2 mb-4">
                                <svg class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <h3 class="font-medium text-gray-900">Informasi Personal</h3>
                                <div class="flex-1 border-t border-gray-200"></div>
                            </div>
                            
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="space-y-3">
                                    <label for="name" class="block text-sm font-medium text-gray-900">
                                        Nama Lengkap *
                                    </label>
                                    <input
                                        type="text"
                                        id="name"
                                        x-model="formData.name"
                                        placeholder="Masukkan nama lengkap"
                                        required
                                        class="w-full h-11 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                    />
                                </div>
                                <div class="space-y-3">
                                    <label for="email" class="block text-sm font-medium text-gray-900">
                                        Alamat Email *
                                    </label>
                                    <input
                                        type="email"
                                        id="email"
                                        x-model="formData.email"
                                        placeholder="nama@contoh.com"
                                        required
                                        class="w-full h-11 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                    />
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="space-y-3">
                                    <label for="phone" class="block text-sm font-medium text-gray-900">
                                        Nomor Telepon
                                    </label>
                                    <input
                                        type="tel"
                                        id="phone"
                                        x-model="formData.phone"
                                        placeholder="+62 812 3456 7890"
                                        class="w-full h-11 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                    />
                                </div>
                                <div class="space-y-3">
                                    <label for="company" class="block text-sm font-medium text-gray-900">
                                        Perusahaan/Institusi
                                    </label>
                                    <input
                                        type="text"
                                        id="company"
                                        x-model="formData.company"
                                        placeholder="Nama perusahaan/institusi"
                                        class="w-full h-11 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                    />
                                </div>
                            </div>
                        </div>

                        {{-- Message Details --}}
                        <div class="space-y-4">
                            <div class="flex items-center space-x-2 mb-4">
                                <svg class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <h3 class="font-medium text-gray-900">Detail Pesan</h3>
                                <div class="flex-1 border-t border-gray-200"></div>
                            </div>

                            <div class="space-y-3">
                                <label for="subject" class="block text-sm font-medium text-gray-900">
                                    Subjek Pesan *
                                </label>
                                <input
                                    type="text"
                                    id="subject"
                                    x-model="formData.subject"
                                    placeholder="Contoh: Inquiry Pelatihan Sampling Air"
                                    required
                                    class="w-full h-11 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                />
                            </div>

                            <div class="space-y-3">
                                <label for="message" class="block text-sm font-medium text-gray-900">
                                    Pesan Anda *
                                </label>
                                <textarea
                                    id="message"
                                    x-model="formData.message"
                                    placeholder="Deskripsikan kebutuhan pelatihan Anda, jumlah peserta, timeline, atau pertanyaan lainnya..."
                                    required
                                    rows="5"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none transition"
                                ></textarea>
                                <p class="text-xs text-gray-600">
                                    Semakin detail informasi yang Anda berikan, semakin tepat solusi yang dapat kami tawarkan.
                                </p>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button 
                                type="submit"
                                :disabled="isSubmitting"
                                :class="isSubmitting ? 'opacity-70 cursor-not-allowed' : 'hover:bg-blue-700'"
                                class="w-full h-12 bg-blue-600 text-white font-semibold rounded-lg shadow-lg transition flex items-center justify-center"
                            >
                                <template x-if="isSubmitting">
                                    <div class="flex items-center">
                                        <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white mr-3"></div>
                                        <span>Mengirim Pesan...</span>
                                    </div>
                                </template>
                                <template x-if="!isSubmitting">
                                    <div class="flex items-center">
                                        <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                        </svg>
                                        <span>Kirim Pesan Sekarang</span>
                                    </div>
                                </template>
                            </button>
                            <p class="text-xs text-gray-600 text-center mt-3">
                                Dengan mengirim pesan, Anda menyetujui untuk dihubungi oleh tim kami.
                            </p>
                        </div>

                        {{-- Success Message --}}
                        <div x-show="showSuccess" x-transition class="hidden p-4 bg-green-50 border border-green-200 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <h4 class="font-medium text-green-900">Pesan Terkirim!</h4>
                                    <p class="text-sm text-green-700">Terima kasih atas pesan Anda. Kami akan segera menghubungi Anda kembali.</p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function contactForm() {
    return {
        formData: {
            name: '',
            email: '',
            phone: '',
            company: '',
            subject: '',
            message: ''
        },
        isSubmitting: false,
        showSuccess: false,
        
        async submitForm() {
            this.isSubmitting = true;
            
            // Simulate form submission
            await new Promise(resolve => setTimeout(resolve, 2000));
            
            this.showSuccess = true;
            this.isSubmitting = false;
            
            // Reset form
            this.formData = {
                name: '',
                email: '',
                phone: '',
                company: '',
                subject: '',
                message: ''
            };
            
            // Hide success message after 5 seconds
            setTimeout(() => {
                this.showSuccess = false;
            }, 5000);
        }
    }
}
</script>
