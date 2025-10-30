<div x-data="messagesPageManager()" x-show="showBulkActions" x-transition class="bg-blue-50 border border-blue-200 rounded-lg p-4">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <span class="text-sm font-medium text-blue-900">
                <span x-text="selectedMessages.length"></span> pesan dipilih
            </span>
            <div class="flex gap-2">
                <button 
                    @click="handleBulkStatusChange('Read')"
                    class="px-3 py-1.5 text-sm font-medium text-blue-700 bg-white border border-blue-300 rounded-lg hover:bg-blue-50 transition-colors"
                >
                    Tandai Dibaca
                </button>
                <button 
                    @click="handleBulkStatusChange('Resolved')"
                    class="px-3 py-1.5 text-sm font-medium text-green-700 bg-white border border-green-300 rounded-lg hover:bg-green-50 transition-colors"
                >
                    Tandai Selesai
                </button>
                <button 
                    @click="handleBulkAssign('Admin Training')"
                    class="px-3 py-1.5 text-sm font-medium text-purple-700 bg-white border border-purple-300 rounded-lg hover:bg-purple-50 transition-colors"
                >
                    Assign ke Admin
                </button>
                <button 
                    @click="handleBulkDelete()"
                    class="px-3 py-1.5 text-sm font-medium text-red-700 bg-white border border-red-300 rounded-lg hover:bg-red-50 transition-colors"
                >
                    Hapus
                </button>
            </div>
        </div>
        <button
            @click="selectedMessages = []"
            class="px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition-colors"
        >
            Batal
        </button>
    </div>
</div>
