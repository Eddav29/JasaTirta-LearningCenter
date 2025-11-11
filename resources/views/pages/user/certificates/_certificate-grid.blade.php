{{-- Certificate Grid --}}
<div x-data="{ viewMode: 'grid' }">
    <template x-if="filteredCertificates.length === 0">
        <div class="bg-white rounded-lg border border-gray-200 p-12">
            <div class="text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada sertifikat</h3>
                <p class="mt-1 text-sm text-gray-500">Tidak ditemukan sertifikat dengan filter yang dipilih.</p>
                <div class="mt-6">
                    <a href="{{ route('user.catalog') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Mulai Belajar
                    </a>
                </div>
            </div>
        </div>
    </template>

    {{-- Grid View --}}
    <template x-if="viewMode === 'grid' && filteredCertificates.length > 0">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            <template x-for="certificate in filteredCertificates" :key="certificate.id">
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    {{-- Certificate Header --}}
                    <div class="relative">
                        <div class="aspect-w-4 aspect-h-3 bg-linear-to-br from-blue-500 to-blue-700">
                            <div class="flex items-center justify-center p-6">
                                <div class="text-center text-white">
                                    <svg class="w-12 h-12 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20" x-html="'<path stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot; stroke-width=&quot;2&quot; d=&quot;' + getTypeIcon(certificate.type) + '&quot;/>'">
                                    </svg>
                                    <div class="text-sm font-medium opacity-90">Sertifikat</div>
                                    <div class="text-xs opacity-75" x-text="certificate.type === 'professional' ? 'Profesional' : 'Kursus'"></div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Status Badge --}}
                        <div class="absolute top-3 right-3">
                            <span 
                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium border"
                                :class="getStatusColor(certificate.status)"
                                x-text="getStatusText(certificate.status)"
                            ></span>
                        </div>
                        
                        {{-- Grade Badge --}}
                        <div class="absolute top-3 left-3">
                            <span 
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-white shadow-sm"
                                :class="getGradeColor(certificate.grade)"
                                x-text="certificate.grade"
                            ></span>
                        </div>
                    </div>

                    {{-- Certificate Content --}}
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <h3 
                                class="text-lg font-semibold text-gray-900 line-clamp-2 cursor-pointer hover:text-blue-600 transition-colors"
                                @click="viewCertificate(certificate)"
                                x-text="certificate.title"
                            ></h3>
                        </div>
                        
                        <p class="text-sm text-gray-600 mb-3 line-clamp-1" x-text="certificate.course"></p>
                        
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span>Diterbitkan:</span>
                                <span x-text="formatDate(certificate.issueDate)"></span>
                            </div>
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span>Berakhir:</span>
                                <span x-text="formatDate(certificate.expiryDate)"></span>
                            </div>
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span>Nilai:</span>
                                <span class="font-medium" x-text="certificate.score + '/100'"></span>
                            </div>
                        </div>
                        
                        <div class="text-xs text-gray-500 mb-4">
                            <span>Instruktur: </span>
                            <span class="font-medium" x-text="certificate.instructor"></span>
                        </div>
                        
                        {{-- Action Buttons --}}
                        <div class="flex space-x-2">
                            <button 
                                @click="viewCertificate(certificate)"
                                class="flex-1 px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors"
                            >
                                Lihat
                            </button>
                            <button 
                                @click="downloadCertificate(certificate)"
                                :disabled="isLoading"
                                class="flex-1 px-3 py-2 text-sm font-medium text-gray-700 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                            >
                                <span x-show="!isLoading">Unduh</span>
                                <span x-show="isLoading" class="flex items-center justify-center">
                                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Loading...
                                </span>
                            </button>
                            <button 
                                @click="shareCertificate(certificate)"
                                class="px-3 py-2 text-sm font-medium text-gray-400 hover:text-gray-600 transition-colors"
                                title="Bagikan"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </template>

    {{-- List View --}}
    <template x-if="viewMode === 'list' && filteredCertificates.length > 0">
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
            <div class="divide-y divide-gray-200">
                <template x-for="certificate in filteredCertificates" :key="certificate.id">
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center space-x-4">
                            {{-- Certificate Icon --}}
                            <div class="shrink-0">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path x-html="'d=&quot;' + getTypeIcon(certificate.type) + '&quot;'"></path>
                                    </svg>
                                </div>
                            </div>
                            
                            {{-- Certificate Info --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 
                                            class="text-lg font-semibold text-gray-900 cursor-pointer hover:text-blue-600 transition-colors"
                                            @click="viewCertificate(certificate)"
                                            x-text="certificate.title"
                                        ></h3>
                                        <p class="text-sm text-gray-600" x-text="certificate.course"></p>
                                        <p class="text-xs text-gray-500" x-text="'Instruktur: ' + certificate.instructor"></p>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <div class="text-right">
                                            <div 
                                                class="text-lg font-bold"
                                                :class="getGradeColor(certificate.grade)"
                                                x-text="certificate.grade"
                                            ></div>
                                            <div class="text-xs text-gray-500" x-text="certificate.score + '/100'"></div>
                                        </div>
                                        <span 
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium border"
                                            :class="getStatusColor(certificate.status)"
                                            x-text="getStatusText(certificate.status)"
                                        ></span>
                                    </div>
                                </div>
                                
                                <div class="mt-2 flex items-center justify-between">
                                    <div class="flex items-center space-x-4 text-xs text-gray-500">
                                        <span x-text="'Diterbitkan: ' + formatDate(certificate.issueDate)"></span>
                                        <span x-text="'Berakhir: ' + formatDate(certificate.expiryDate)"></span>
                                    </div>
                                    
                                    <div class="flex items-center space-x-2">
                                        <button 
                                            @click="viewCertificate(certificate)"
                                            class="px-3 py-1 text-xs font-medium text-blue-600 bg-blue-50 rounded hover:bg-blue-100 transition-colors"
                                        >
                                            Lihat Detail
                                        </button>
                                        <button 
                                            @click="downloadCertificate(certificate)"
                                            :disabled="isLoading"
                                            class="px-3 py-1 text-xs font-medium text-gray-700 bg-gray-50 rounded hover:bg-gray-100 transition-colors disabled:opacity-50"
                                        >
                                            Unduh
                                        </button>
                                        <button 
                                            @click="shareCertificate(certificate)"
                                            class="px-2 py-1 text-xs font-medium text-gray-400 hover:text-gray-600 transition-colors"
                                            title="Bagikan"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </template>
</div>