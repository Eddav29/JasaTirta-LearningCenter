{{-- Bulk Actions Bar --}}
<div 
    x-data="notificationsPageManager()"
    x-show="showBulkActions"
    x-transition
    class="bg-blue-50 border border-blue-200 rounded-lg p-4"
>
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <span class="text-sm font-medium text-blue-900">
                <span x-text="selectedNotifications.length"></span> notifikasi dipilih
            </span>
            <div class="flex gap-2">
                <button 
                    @click="bulkStatusChange('Scheduled')"
                    class="px-3 py-1.5 text-sm border border-blue-300 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors"
                >
                    Jadwalkan
                </button>
                <button 
                    @click="bulkStatusChange('Draft')"
                    class="px-3 py-1.5 text-sm border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors"
                >
                    Jadikan Draft
                </button>
                <button 
                    @click="bulkDelete()"
                    class="px-3 py-1.5 text-sm border border-red-300 text-red-700 rounded-lg hover:bg-red-100 transition-colors"
                >
                    Hapus
                </button>
            </div>
        </div>
        <button 
            @click="selectedNotifications = []"
            class="text-sm text-gray-600 hover:text-gray-800"
        >
            Batal
        </button>
    </div>
</div>
