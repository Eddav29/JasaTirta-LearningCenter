{{-- Main Contact Section --}}
<section id="contact-form" class="py-20 bg-white" x-data="contactForm()">
    {{-- Login Required Modal --}}
    <div x-show="showLoginModal" 
         x-cloak
         @keydown.escape.window="showLoginModal = false"
         class="fixed inset-0 z-50 overflow-y-auto" 
         aria-labelledby="modal-title" 
         role="dialog" 
         aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div x-show="showLoginModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" 
                 @click="showLoginModal = false"
                 aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal panel -->
            <div x-show="showLoginModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Login Diperlukan
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Untuk mengirim pesan kepada kami, Anda perlu login terlebih dahulu. 
                                    Jika belum memiliki akun, silakan daftar terlebih dahulu.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-3">
                    <a href="{{ route('login') }}" 
                       class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Login
                    </a>
                    <a href="{{ route('register') }}" 
                       class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Daftar
                    </a>
                    <button type="button" 
                            @click="showLoginModal = false"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

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
                        @auth
                        {{-- User Info Display --}}
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                            <div class="flex items-center space-x-3">
                                <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-blue-900">Login sebagai: {{ Auth::user()->name }}</p>
                                    <p class="text-xs text-blue-700">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        @endauth

                        {{-- Additional Info for Logged Users --}}
                        {{-- Additional Info for Logged Users --}}
                        <div class="space-y-4">
                            <div class="flex items-center space-x-2 mb-4">
                                <svg class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 class="font-medium text-gray-900">Informasi Tambahan (Opsional)</h3>
                                <div class="flex-1 border-t border-gray-200"></div>
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
                        <div x-show="showSuccess" x-transition class="p-4 bg-green-50 border border-green-200 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <svg class="h-5 w-5 text-green-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <h4 class="font-medium text-green-900">Pesan Terkirim!</h4>
                                    <p class="text-sm text-green-700">Terima kasih atas pesan Anda. Kami akan segera menghubungi Anda kembali.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Error Message --}}
                        <div x-show="showError" x-transition class="p-4 bg-red-50 border border-red-200 rounded-lg">
                            <div class="flex items-start space-x-3">
                                <svg class="h-5 w-5 text-red-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <h4 class="font-medium text-red-900">Gagal Mengirim Pesan</h4>
                                    <p class="text-sm text-red-700" x-text="errorMessage"></p>
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
            subject: '',
            message: '',
            phone: '',
            company: ''
        },
        isSubmitting: false,
        showSuccess: false,
        showError: false,
        errorMessage: '',
        showLoginModal: false,
        isAuthenticated: {{ Auth::check() ? 'true' : 'false' }},
        
        async submitForm() {
            // Check if user is authenticated
            if (!this.isAuthenticated) {
                this.showLoginModal = true;
                return;
            }

            // Reset messages
            this.showSuccess = false;
            this.showError = false;
            this.isSubmitting = true;
            
            try {
                const response = await fetch('{{ route('contact.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(this.formData)
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    this.showSuccess = true;
                    
                    // Reset form
                    this.formData = {
                        subject: '',
                        message: '',
                        phone: '',
                        company: ''
                    };
                    
                    // Hide success message after 5 seconds
                    setTimeout(() => {
                        this.showSuccess = false;
                    }, 5000);
                } else {
                    // Show error message
                    this.errorMessage = data.message || 'Terjadi kesalahan. Silakan coba lagi.';
                    this.showError = true;
                    
                    // Hide error message after 10 seconds
                    setTimeout(() => {
                        this.showError = false;
                    }, 10000);
                }
            } catch (error) {
                console.error('Error:', error);
                this.errorMessage = 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.';
                this.showError = true;
                
                setTimeout(() => {
                    this.showError = false;
                }, 10000);
            } finally {
                this.isSubmitting = false;
            }
        }
    }
}
</script>
