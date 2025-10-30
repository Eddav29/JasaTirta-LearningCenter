{{-- Notifications List --}}
@php
    $notifications = [
        [
            'id' => 1,
            'title' => 'Pembukaan Pendaftaran Pelatihan Water Quality',
            'message' => 'Pendaftaran pelatihan Water Quality Analysis Fundamentals telah dibuka. Kuota terbatas, daftar sekarang!',
            'type' => 'Announcement',
            'priority' => 'High',
            'status' => 'Sent',
            'targetType' => 'All Users',
            'targetCount' => 1250,
            'deliveredCount' => 1180,
            'readCount' => 890,
            'channel' => 'All Channels',
            'sentDate' => '2024-10-15T09:00:00',
            'createdBy' => 'Admin',
            'createdDate' => '2024-10-14',
            'expiryDate' => '2024-11-15'
        ],
        [
            'id' => 2,
            'title' => 'Pengingat Pembayaran Pelatihan',
            'message' => 'Anda memiliki pembayaran pelatihan yang belum diselesaikan. Silakan selesaikan pembayaran dalam 2 hari.',
            'type' => 'Warning',
            'priority' => 'Medium',
            'status' => 'Sent',
            'targetType' => 'Students',
            'targetCount' => 45,
            'deliveredCount' => 43,
            'readCount' => 32,
            'channel' => 'Email',
            'sentDate' => '2024-10-20T14:30:00',
            'createdBy' => 'System',
            'createdDate' => '2024-10-20',
            'expiryDate' => '2024-10-22'
        ],
        [
            'id' => 3,
            'title' => 'Pelatihan Dimulai Besok',
            'message' => 'Pelatihan Environmental Sampling Techniques akan dimulai besok pukul 09:00 WIB. Pastikan Anda telah menyiapkan materi.',
            'type' => 'Info',
            'priority' => 'High',
            'status' => 'Sent',
            'targetType' => 'Students',
            'targetCount' => 28,
            'deliveredCount' => 28,
            'readCount' => 25,
            'channel' => 'In-App',
            'sentDate' => '2024-10-24T18:00:00',
            'createdBy' => 'Admin',
            'createdDate' => '2024-10-24',
            'expiryDate' => '2024-10-25'
        ],
        [
            'id' => 4,
            'title' => 'Sistem Maintenance Terjadwal',
            'message' => 'Sistem akan menjalani maintenance pada tanggal 30 Oktober 2024 pukul 02:00-04:00 WIB. Mohon maaf atas ketidaknyamanannya.',
            'type' => 'Warning',
            'priority' => 'Medium',
            'status' => 'Scheduled',
            'targetType' => 'All Users',
            'targetCount' => 1250,
            'deliveredCount' => 0,
            'readCount' => 0,
            'channel' => 'All Channels',
            'scheduledDate' => '2024-10-29T09:00:00',
            'createdBy' => 'Tech Team',
            'createdDate' => '2024-10-25',
            'expiryDate' => '2024-10-30'
        ],
        [
            'id' => 5,
            'title' => 'Selamat! Sertifikat Tersedia',
            'message' => 'Selamat! Sertifikat pelatihan Anda telah tersedia dan dapat diunduh melalui dashboard.',
            'type' => 'Success',
            'priority' => 'Low',
            'status' => 'Sent',
            'targetType' => 'Students',
            'targetCount' => 18,
            'deliveredCount' => 18,
            'readCount' => 16,
            'channel' => 'Email',
            'sentDate' => '2024-10-22T10:15:00',
            'createdBy' => 'System',
            'createdDate' => '2024-10-22'
        ],
        [
            'id' => 6,
            'title' => 'Gagal Mengirim Email Reminder',
            'message' => 'Terjadi kegagalan dalam mengirim email reminder untuk pelatihan Chemical Analysis. Silakan periksa konfigurasi email.',
            'type' => 'Error',
            'priority' => 'High',
            'status' => 'Failed',
            'targetType' => 'Instructors',
            'targetCount' => 5,
            'deliveredCount' => 2,
            'readCount' => 1,
            'channel' => 'Email',
            'sentDate' => '2024-10-23T08:00:00',
            'createdBy' => 'System',
            'createdDate' => '2024-10-23'
        ]
    ];

    function getTypeColor($type) {
        return match($type) {
            'Info' => 'bg-blue-100 text-blue-800',
            'Warning' => 'bg-yellow-100 text-yellow-800',
            'Success' => 'bg-green-100 text-green-800',
            'Error' => 'bg-red-100 text-red-800',
            'Announcement' => 'bg-purple-100 text-purple-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    function getStatusColor($status) {
        return match($status) {
            'Draft' => 'bg-gray-100 text-gray-800',
            'Scheduled' => 'bg-blue-100 text-blue-800',
            'Sent' => 'bg-green-100 text-green-800',
            'Failed' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    function getPriorityColor($priority) {
        return match($priority) {
            'Low' => 'bg-gray-100 text-gray-800',
            'Medium' => 'bg-yellow-100 text-yellow-800',
            'High' => 'bg-orange-100 text-orange-800',
            'Urgent' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }
@endphp

<div class="bg-white rounded-lg border border-gray-200" x-data="notificationsPageManager()" x-init="notifications = {{ json_encode($notifications) }}">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-bold text-gray-900">Daftar Notifikasi</h3>
        <p class="text-sm text-gray-600 mt-1">
            <span x-text="filteredNotifications.length"></span> notifikasi ditemukan
        </p>
    </div>
    
    <div class="p-6">
        <div class="space-y-4">
            <template x-for="notification in paginatedNotifications" :key="notification.id">
                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start gap-3">
                        {{-- Checkbox --}}
                        <input 
                            type="checkbox" 
                            :checked="isSelected(notification.id)"
                            @change="toggleSelect(notification.id)"
                            class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 mt-1"
                        />

                        {{-- Content --}}
                        <div class="flex-1 space-y-3">
                            {{-- Title and Badges --}}
                            <div class="flex flex-wrap items-center gap-2">
                                <h3 class="font-medium text-gray-900" x-text="notification.title"></h3>
                                @foreach($notifications as $notif)
                                <template x-if="notification.id === {{ $notif['id'] }}">
                                    <div class="flex flex-wrap gap-2">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ getTypeColor($notif['type']) }}" x-text="notification.type"></span>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ getStatusColor($notif['status']) }}" x-text="notification.status"></span>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ getPriorityColor($notif['priority']) }}" x-text="notification.priority"></span>
                                    </div>
                                </template>
                                @endforeach
                            </div>

                            {{-- Message --}}
                            <p class="text-sm text-gray-600 line-clamp-2" x-text="notification.message"></p>

                            {{-- Stats Grid --}}
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm text-gray-600">
                                <div class="flex items-center gap-1">
                                    <span x-html="getChannelIcon(notification.channel)"></span>
                                    <span x-text="notification.channel"></span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    <span x-text="`${notification.targetType} (${notification.targetCount})`"></span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>Terkirim: <span x-text="calculateDeliveryRate(notification.deliveredCount, notification.targetCount)"></span>%</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <span>Dibaca: <span x-text="calculateReadRate(notification.readCount, notification.deliveredCount)"></span>%</span>
                                </div>
                            </div>

                            {{-- Info Grid --}}
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div>
                                    <span class="text-gray-600">Dibuat:</span>
                                    <span class="ml-1 font-medium" x-text="notification.createdBy"></span>
                                </div>
                                <div>
                                    <span class="text-gray-600">Tanggal:</span>
                                    <span class="ml-1 font-medium" x-text="notification.sentDate ? formatDate(notification.sentDate) : (notification.scheduledDate ? `Terjadwal: ${formatDate(notification.scheduledDate)}` : new Date(notification.createdDate).toLocaleDateString('id-ID'))"></span>
                                </div>
                                <div x-show="notification.expiryDate">
                                    <span class="text-gray-600">Kedaluwarsa:</span>
                                    <span class="ml-1 font-medium" x-text="notification.expiryDate ? new Date(notification.expiryDate).toLocaleDateString('id-ID') : ''"></span>
                                </div>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center gap-1">
                            <button class="p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded transition-colors" title="Lihat Detail">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                            <button class="p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </button>
                            <button 
                                @click="deleteNotification(notification.id)"
                                class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded transition-colors"
                                title="Hapus"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </template>

            {{-- Empty State --}}
            <div x-show="filteredNotifications.length === 0" class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada notifikasi</h3>
                <p class="mt-1 text-sm text-gray-500">Tidak ada notifikasi yang sesuai dengan filter yang dipilih.</p>
            </div>
        </div>
        
        {{-- Pagination --}}
        <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-200" x-show="filteredNotifications.length > 0">
            <div class="text-sm text-gray-600">
                Menampilkan <span x-text="(currentPage - 1) * itemsPerPage + 1"></span>-<span x-text="Math.min(currentPage * itemsPerPage, filteredNotifications.length)"></span> dari <span x-text="filteredNotifications.length"></span> notifikasi
            </div>
            <div class="flex items-center gap-2">
                <button
                    @click="currentPage > 1 && currentPage--"
                    :disabled="currentPage === 1"
                    :class="currentPage === 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-50'"
                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm text-gray-700 rounded-lg transition-colors"
                >
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Previous
                </button>
                <span class="text-sm text-gray-600">
                    Halaman <span x-text="currentPage"></span> dari <span x-text="totalPages"></span>
                </span>
                <button
                    @click="currentPage < totalPages && currentPage++"
                    :disabled="currentPage >= totalPages"
                    :class="currentPage >= totalPages ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-50'"
                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm text-gray-700 rounded-lg transition-colors"
                >
                    Next
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
