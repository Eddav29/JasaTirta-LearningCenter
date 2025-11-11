{{-- Certificate Detail Modal --}}
<div 
    x-show="showCertificateModal"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 overflow-y-auto"
    x-cloak
>
    {{-- Backdrop --}}
    <div 
        class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm"
        @click="closeCertificateModal()"
    ></div>
    
    {{-- Modal --}}
    <div class="flex items-center justify-center min-h-screen p-4">
        <div 
            x-show="showCertificateModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="relative bg-white rounded-xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden"
        >
            {{-- Modal Header --}}
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <div>
                    <h3 class="text-xl font-semibold text-gray-900">Detail Sertifikat</h3>
                    <p class="text-sm text-gray-500">Informasi lengkap sertifikat Anda</p>
                </div>
                <button 
                    @click="closeCertificateModal()"
                    class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition-colors"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            {{-- Modal Content --}}
            <div class="overflow-y-auto max-h-[calc(90vh-140px)]">
                <template x-if="selectedCertificate">
                    <div class="p-6">
                        {{-- Certificate Preview --}}
                        <div class="mb-6">
                            <div class="aspect-w-4 aspect-h-3 bg-linear-to-br from-blue-500 to-blue-700 rounded-lg relative overflow-hidden">
                                <div class="absolute inset-0 flex items-center justify-center text-white p-8">
                                    <div class="text-center">
                                        <svg class="w-16 h-16 mx-auto mb-4 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                        </svg>
                                        <h2 class="text-2xl font-bold mb-2" x-text="selectedCertificate?.title"></h2>
                                        <p class="text-lg opacity-90" x-text="selectedCertificate?.course"></p>
                                        <p class="text-sm opacity-75 mt-2">Jasa Tirta Learning Center</p>
                                    </div>
                                </div>
                                
                                {{-- Certificate Status Overlay --}}
                                <div class="absolute top-4 right-4">
                                    <span 
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white shadow-sm"
                                        :class="selectedCertificate ? getStatusColor(selectedCertificate.status).replace('bg-', 'text-') : ''"
                                        x-text="selectedCertificate ? getStatusText(selectedCertificate.status) : ''"
                                    ></span>
                                </div>
                                
                                {{-- Grade Badge --}}
                                <div class="absolute top-4 left-4">
                                    <div class="bg-white rounded-lg px-4 py-2 shadow-sm">
                                        <div class="text-center">
                                            <div 
                                                class="text-2xl font-bold"
                                                :class="selectedCertificate ? getGradeColor(selectedCertificate.grade) : ''"
                                                x-text="selectedCertificate?.grade"
                                            ></div>
                                            <div class="text-xs text-gray-500" x-text="selectedCertificate ? selectedCertificate.score + '/100' : ''"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Certificate Details --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Left Column --}}
                            <div class="space-y-6">
                                {{-- Basic Information --}}
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Informasi Dasar</h4>
                                    <dl class="space-y-3">
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Nama Sertifikat</dt>
                                            <dd class="text-sm text-gray-900 font-medium" x-text="selectedCertificate?.title"></dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Program/Kursus</dt>
                                            <dd class="text-sm text-gray-900" x-text="selectedCertificate?.course"></dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Tipe Sertifikat</dt>
                                            <dd class="text-sm text-gray-900">
                                                <span 
                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium"
                                                    :class="selectedCertificate?.type === 'professional' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800'"
                                                    x-text="selectedCertificate?.type === 'professional' ? 'Sertifikat Profesional' : 'Sertifikat Kursus'"
                                                ></span>
                                            </dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Instruktur</dt>
                                            <dd class="text-sm text-gray-900" x-text="selectedCertificate?.instructor"></dd>
                                        </div>
                                    </dl>
                                </div>
                                
                                {{-- Achievement Details --}}
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Pencapaian</h4>
                                    <dl class="space-y-3">
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Nilai Akhir</dt>
                                            <dd class="text-sm text-gray-900 flex items-center">
                                                <span class="font-medium" x-text="selectedCertificate ? selectedCertificate.score + '/100' : ''"></span>
                                                <span 
                                                    class="ml-2 font-bold"
                                                    :class="selectedCertificate ? getGradeColor(selectedCertificate.grade) : ''"
                                                    x-text="'(' + (selectedCertificate?.grade || '') + ')'"
                                                ></span>
                                            </dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Kredit (SKS)</dt>
                                            <dd class="text-sm text-gray-900 font-medium" x-text="selectedCertificate ? selectedCertificate.credits + ' SKS' : ''"></dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Status Sertifikat</dt>
                                            <dd class="text-sm">
                                                <span 
                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium border"
                                                    :class="selectedCertificate ? getStatusColor(selectedCertificate.status) : ''"
                                                    x-text="selectedCertificate ? getStatusText(selectedCertificate.status) : ''"
                                                ></span>
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                            
                            {{-- Right Column --}}
                            <div class="space-y-6">
                                {{-- Certificate Metadata --}}
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Metadata Sertifikat</h4>
                                    <dl class="space-y-3">
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Nomor Sertifikat</dt>
                                            <dd class="text-sm text-gray-900 font-mono" x-text="selectedCertificate?.certificateNumber"></dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Kode Verifikasi</dt>
                                            <dd class="text-sm text-gray-900 font-mono" x-text="selectedCertificate?.verificationCode"></dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Tanggal Terbit</dt>
                                            <dd class="text-sm text-gray-900" x-text="selectedCertificate ? formatDate(selectedCertificate.issueDate) : ''"></dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Tanggal Berakhir</dt>
                                            <dd class="text-sm text-gray-900" x-text="selectedCertificate ? formatDate(selectedCertificate.expiryDate) : ''"></dd>
                                        </div>
                                    </dl>
                                </div>
                                
                                {{-- Quick Actions --}}
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Aksi</h4>
                                    <div class="space-y-3">
                                        <button 
                                            @click="downloadCertificate(selectedCertificate)"
                                            :disabled="isLoading"
                                            class="w-full flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                                        >
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <span x-show="!isLoading">Unduh PDF</span>
                                            <span x-show="isLoading">Mengunduh...</span>
                                        </button>
                                        
                                        <button 
                                            @click="shareCertificate(selectedCertificate)"
                                            class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors"
                                        >
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
                                            </svg>
                                            Bagikan Link
                                        </button>
                                        
                                        <button 
                                            @click="verifyCertificate(selectedCertificate)"
                                            class="w-full flex items-center justify-center px-4 py-2 border border-green-300 text-green-700 rounded-lg hover:bg-green-50 transition-colors"
                                        >
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                            </svg>
                                            Verifikasi Online
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            
            {{-- Modal Footer --}}
            <div class="flex items-center justify-end px-6 py-4 border-t border-gray-200 bg-gray-50">
                <button 
                    @click="closeCertificateModal()"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors"
                >
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>