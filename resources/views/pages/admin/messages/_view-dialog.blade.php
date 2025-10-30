<div x-data="messagesPageManager()" x-show="viewDialogOpen" x-cloak class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="viewDialogOpen = false"></div>
    
    <!-- Dialog -->
    <div class="flex items-center justify-center min-h-screen p-4">
        <div 
            class="relative bg-white rounded-lg shadow-xl max-w-3xl w-full max-h-[90vh] overflow-y-auto"
            @click.stop
            x-show="viewDialogOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
        >
            <template x-if="viewMessage">
                <div>
                    <!-- Header -->
                    <div class="flex items-center justify-between p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">Detail Pesan</h2>
                        <button 
                            @click="viewDialogOpen = false"
                            class="text-gray-400 hover:text-gray-600 transition-colors"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Content -->
                    <div class="p-6 space-y-6">
                        <!-- Sender Info -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pengirim</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Nama</label>
                                    <p class="text-gray-900 mt-1" x-text="viewMessage.name"></p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Email</label>
                                    <p class="text-gray-900 mt-1" x-text="viewMessage.email"></p>
                                </div>
                                <template x-if="viewMessage.phone">
                                    <div>
                                        <label class="text-sm font-medium text-gray-600">Telepon</label>
                                        <p class="text-gray-900 mt-1" x-text="viewMessage.phone"></p>
                                    </div>
                                </template>
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Sumber</label>
                                    <p class="text-gray-900 mt-1">
                                        <span x-text="getSourceIcon(viewMessage.source)"></span>
                                        <span x-text="viewMessage.source"></span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Message Details -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Pesan</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Subjek</label>
                                    <p class="text-gray-900 mt-1 font-medium" x-text="viewMessage.subject"></p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Pesan</label>
                                    <p class="text-gray-900 mt-1 whitespace-pre-wrap" x-text="viewMessage.message"></p>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-sm font-medium text-gray-600">Kategori</label>
                                        <p class="text-gray-900 mt-1" x-text="viewMessage.category"></p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-600">Tanggal</label>
                                        <p class="text-gray-900 mt-1" x-text="formatDate(viewMessage.createdDate)"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status Info -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Status & Prioritas</h3>
                            <div class="flex gap-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-600 block mb-2">Status</label>
                                    <span 
                                        class="px-3 py-1.5 text-sm font-medium rounded-md inline-flex items-center gap-1"
                                        :class="getStatusConfig(viewMessage.status).color"
                                    >
                                        <span x-text="getStatusConfig(viewMessage.status).icon"></span>
                                        <span x-text="getStatusConfig(viewMessage.status).label"></span>
                                    </span>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-600 block mb-2">Prioritas</label>
                                    <span 
                                        class="px-3 py-1.5 text-sm font-medium rounded-md inline-block"
                                        :class="getPriorityConfig(viewMessage.priority).color"
                                        x-text="viewMessage.priority"
                                    ></span>
                                </div>
                                <template x-if="viewMessage.assignedTo">
                                    <div>
                                        <label class="text-sm font-medium text-gray-600 block mb-2">Ditugaskan ke</label>
                                        <p class="text-gray-900" x-text="viewMessage.assignedTo"></p>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Tags -->
                        <template x-if="viewMessage.tags && viewMessage.tags.length > 0">
                            <div>
                                <label class="text-sm font-medium text-gray-600 block mb-2">Tags</label>
                                <div class="flex flex-wrap gap-2">
                                    <template x-for="tag in viewMessage.tags" :key="tag">
                                        <span class="px-3 py-1 text-sm border border-gray-300 rounded-md text-gray-700" x-text="tag"></span>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Footer -->
                    <div class="flex items-center justify-between p-6 border-t border-gray-200 bg-gray-50">
                        <button
                            @click="viewDialogOpen = false"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors"
                        >
                            Tutup
                        </button>
                        <div class="flex gap-2">
                            <button
                                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                </svg>
                                Balas Pesan
                            </button>
                            <button
                                @click="handleBulkStatusChange('Resolved')"
                                class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors flex items-center gap-2"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Tandai Selesai
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>
