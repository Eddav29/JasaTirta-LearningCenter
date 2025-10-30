@php
$data = [
    [
        'id' => 1,
        'name' => 'Sarah Johnson',
        'email' => 'sarah.johnson@email.com',
        'phone' => '+62 812-3456-7890',
        'subject' => 'Pertanyaan tentang Pelatihan Water Quality Analysis',
        'message' => 'Halo, saya tertarik dengan pelatihan Water Quality Analysis. Bisakah Anda memberikan informasi lebih detail tentang kurikulum, jadwal, dan biaya pelatihan? Saya memiliki background kimia dan ingin mengembangkan skill di bidang analisis kualitas air.',
        'status' => 'New',
        'priority' => 'High',
        'category' => 'Course Inquiry',
        'source' => 'Website',
        'createdDate' => '2024-10-25T09:15:00',
        'assignedTo' => 'Admin Training',
        'tags' => ['water-quality', 'new-student', 'chemistry-background'],
        'hasAttachment' => false,
        'responseTime' => null
    ],
    [
        'id' => 2,
        'name' => 'Michael Chen',
        'email' => 'michael.chen@company.com',
        'phone' => '+62 856-9876-5432',
        'subject' => 'Proposal Kerjasama Corporate Training',
        'message' => 'Selamat pagi, kami dari PT. Environmental Solutions Indonesia ingin mengajukan proposal kerjasama untuk corporate training. Kami membutuhkan pelatihan environmental monitoring untuk 20 karyawan kami. Mohon dapat dijadwalkan meeting untuk diskusi lebih lanjut.',
        'status' => 'Read',
        'priority' => 'Urgent',
        'category' => 'General',
        'source' => 'Email',
        'createdDate' => '2024-10-24T14:30:00',
        'assignedTo' => 'Manager',
        'tags' => ['corporate', 'environmental-monitoring', 'bulk-training'],
        'hasAttachment' => true,
        'responseTime' => 2
    ],
    [
        'id' => 3,
        'name' => 'Lisa Putri',
        'email' => 'lisa.putri@gmail.com',
        'phone' => null,
        'subject' => 'Kendala Akses Platform E-learning',
        'message' => 'Saya mengalami kesulitan dalam mengakses platform e-learning. Setelah login, halaman tidak dapat dimuat dengan baik dan video pembelajaran tidak bisa diputar. Mohon bantuan untuk mengatasi masalah ini.',
        'status' => 'Replied',
        'priority' => 'Medium',
        'category' => 'Technical Support',
        'source' => 'Website',
        'createdDate' => '2024-10-23T16:45:00',
        'lastReplied' => '2024-10-23T18:00:00',
        'assignedTo' => 'IT Support',
        'tags' => ['e-learning', 'platform-issue', 'video-problem'],
        'hasAttachment' => false,
        'responseTime' => 1.25
    ],
    [
        'id' => 4,
        'name' => 'Ahmad Rizki',
        'email' => 'ahmad.rizki@student.ac.id',
        'phone' => '+62 821-5555-4444',
        'subject' => 'Pertanyaan Pembayaran Sertifikasi',
        'message' => 'Halo, saya sudah menyelesaikan pelatihan Chemical Analysis Basic namun belum menerima invoice untuk pembayaran sertifikasi. Kapan invoice akan dikirimkan dan apa saja metode pembayaran yang tersedia?',
        'status' => 'Resolved',
        'priority' => 'Low',
        'category' => 'Billing',
        'source' => 'Website',
        'createdDate' => '2024-10-22T11:20:00',
        'lastReplied' => '2024-10-22T15:45:00',
        'assignedTo' => 'Finance',
        'tags' => ['certification', 'payment', 'chemical-analysis'],
        'hasAttachment' => false,
        'responseTime' => 4.5
    ],
    [
        'id' => 5,
        'name' => 'Dr. Indira Sari',
        'email' => 'indira.sari@university.ac.id',
        'phone' => '+62 811-2222-3333',
        'subject' => 'Kerjasama Penelitian Lab Analysis',
        'message' => 'Selamat siang, saya Dr. Indira dari Universitas Indonesia. Kami memiliki proyek penelitian yang membutuhkan analisis lab untuk sample air dan tanah. Apakah JTLC menyediakan layanan testing lab? Jika ya, mohon informasi prosedur dan tarif.',
        'status' => 'New',
        'priority' => 'High',
        'category' => 'General',
        'source' => 'Email',
        'createdDate' => '2024-10-25T13:00:00',
        'assignedTo' => 'Lab Manager',
        'tags' => ['research', 'lab-testing', 'university', 'sample-analysis'],
        'hasAttachment' => true,
        'responseTime' => null
    ],
    [
        'id' => 6,
        'name' => 'Budi Santoso',
        'email' => 'budi.santoso@industry.com',
        'phone' => null,
        'subject' => 'Komplain Kualitas Pelatihan Online',
        'message' => 'Saya mengikuti pelatihan Environmental Impact Assessment secara online, namun merasa kualitas materi dan instruktur kurang memuaskan. Audio tidak jelas, materi presentasi outdated, dan instruktur kurang responsif terhadap pertanyaan peserta.',
        'status' => 'Read',
        'priority' => 'High',
        'category' => 'Complaint',
        'source' => 'Website',
        'createdDate' => '2024-10-21T08:30:00',
        'assignedTo' => 'Quality Assurance',
        'tags' => ['online-training', 'quality-issue', 'instructor-feedback'],
        'hasAttachment' => false,
        'responseTime' => 8
    ]
];
@endphp

<div x-data="messagesPageManager()" x-init="messages = {{ json_encode($data) }}" class="bg-white rounded-lg border border-gray-200">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900">
            Daftar Pesan (<span x-text="filteredMessages.length"></span>)
        </h2>
        <p class="text-sm text-gray-600 mt-1">Kelola semua pesan masuk dari formulir kontak</p>
    </div>

    <!-- Messages List -->
    <div class="p-6 space-y-4">
        <template x-for="message in paginatedMessages" :key="message.id">
            <div 
                class="border rounded-lg p-4 space-y-3 transition-all hover:shadow-md"
                :class="message.status === 'New' ? 'bg-blue-50 border-blue-200' : 'bg-white border-gray-200'"
            >
                <div class="flex items-start gap-3">
                    <!-- Checkbox -->
                    <input 
                        type="checkbox" 
                        :checked="isSelected(message.id)"
                        @change="toggleSelect(message.id)"
                        class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                    >
                    
                    <div class="flex-1 space-y-2">
                        <!-- Header Row -->
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1">
                                <!-- Name and Attachment -->
                                <div class="flex items-center gap-2 mb-1">
                                    <h3 class="font-semibold text-lg text-gray-900" x-text="message.name"></h3>
                                    <template x-if="message.hasAttachment">
                                        <span class="px-2 py-0.5 text-xs font-medium border border-gray-300 rounded-md">
                                            📎 Attachment
                                        </span>
                                    </template>
                                </div>
                                
                                <!-- Contact Info -->
                                <div class="flex items-center gap-4 text-sm text-gray-600 mb-2">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <span x-text="message.email"></span>
                                    </span>
                                    <template x-if="message.phone">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                            <span x-text="message.phone"></span>
                                        </span>
                                    </template>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span x-text="formatDate(message.createdDate)"></span>
                                    </span>
                                </div>
                                
                                <!-- Subject -->
                                <h4 class="font-medium text-base mb-2 text-gray-900" x-text="message.subject"></h4>
                                
                                <!-- Message Preview -->
                                <p class="text-gray-700 line-clamp-2" x-text="message.message"></p>
                            </div>
                            
                            <!-- Badges Column -->
                            <div class="flex flex-col items-end gap-2 shrink-0">
                                <!-- Status Badge -->
                                <span 
                                    class="px-2.5 py-1 text-xs font-medium rounded-md flex items-center gap-1"
                                    :class="getStatusConfig(message.status).color"
                                >
                                    <span x-text="getStatusConfig(message.status).icon"></span>
                                    <span x-text="getStatusConfig(message.status).label"></span>
                                </span>
                                
                                <!-- Priority Badge -->
                                <span 
                                    class="px-2.5 py-1 text-xs font-medium rounded-md"
                                    :class="getPriorityConfig(message.priority).color"
                                    x-text="message.priority"
                                ></span>
                                
                                <!-- Category Badge -->
                                <span class="px-2.5 py-1 text-xs font-medium border border-gray-300 rounded-md text-gray-700" x-text="message.category"></span>
                                
                                <!-- Source Badge -->
                                <span class="px-2.5 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded-md flex items-center gap-1">
                                    <span x-text="getSourceIcon(message.source)"></span>
                                    <span x-text="message.source"></span>
                                </span>
                            </div>
                        </div>

                        <!-- Footer Row -->
                        <div class="flex items-center justify-between pt-2 border-t border-gray-200">
                            <!-- Meta Info -->
                            <div class="flex items-center gap-4 text-xs text-gray-500">
                                <template x-if="message.assignedTo">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                        </svg>
                                        <span x-text="message.assignedTo"></span>
                                    </span>
                                </template>
                                <template x-if="message.responseTime">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>Response: <span x-text="message.responseTime"></span>h</span>
                                    </span>
                                </template>
                                <template x-if="message.tags.length > 0">
                                    <div class="flex items-center gap-1">
                                        <template x-for="(tag, index) in message.tags.slice(0, 2)" :key="index">
                                            <span class="px-2 py-0.5 text-xs border border-gray-300 rounded-md" x-text="tag"></span>
                                        </template>
                                        <template x-if="message.tags.length > 2">
                                            <span class="text-xs" x-text="`+${message.tags.length - 2} more`"></span>
                                        </template>
                                    </div>
                                </template>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex gap-2">
                                <button
                                    @click="handleViewClick(message)"
                                    class="px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors flex items-center gap-1"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Baca
                                </button>
                                <button
                                    class="px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                                    </svg>
                                </button>
                                <button
                                    @click="handleDeleteMessage(message.id)"
                                    class="px-3 py-1.5 text-sm font-medium text-red-600 bg-white border border-gray-300 rounded-lg hover:bg-red-50 transition-colors"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <!-- Empty State -->
        <template x-if="paginatedMessages.length === 0">
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada pesan</h3>
                <p class="text-gray-500">
                    <template x-if="searchQuery || statusFilter !== 'all' || priorityFilter !== 'all' || categoryFilter !== 'all'">
                        <span>Tidak ada pesan yang sesuai dengan filter yang dipilih.</span>
                    </template>
                    <template x-if="!searchQuery && statusFilter === 'all' && priorityFilter === 'all' && categoryFilter === 'all'">
                        <span>Belum ada pesan masuk.</span>
                    </template>
                </p>
            </div>
        </template>

        <!-- Pagination -->
        <div class="flex items-center justify-between border-t border-gray-200 pt-4">
            <div class="text-sm text-gray-600">
                Menampilkan 
                <span x-text="((currentPage - 1) * itemsPerPage) + 1"></span> 
                sampai 
                <span x-text="Math.min(currentPage * itemsPerPage, filteredMessages.length)"></span> 
                dari 
                <span x-text="filteredMessages.length"></span> 
                pesan
            </div>
            <div class="flex items-center gap-2">
                <button
                    @click="currentPage = Math.max(1, currentPage - 1)"
                    :disabled="currentPage === 1"
                    :class="currentPage === 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-50'"
                    class="px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg transition-colors"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <span class="text-sm text-gray-700">
                    Halaman <span x-text="currentPage"></span> dari <span x-text="totalPages"></span>
                </span>
                <button
                    @click="currentPage = Math.min(totalPages, currentPage + 1)"
                    :disabled="currentPage === totalPages"
                    :class="currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-50'"
                    class="px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg transition-colors"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
