{{-- Bulk Actions Bar --}}
<div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4" x-show="showBulkActions" x-transition>
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <span class="text-sm font-medium text-blue-900" x-text="`${selectedParticipants.length} peserta dipilih`"></span>
            <div class="flex items-center gap-2">
                <select @change="bulkStatusChange($event.target.value); $event.target.value = ''" class="px-3 py-1.5 text-sm border border-blue-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Ubah Status</option>
                    <option value="Active">Set ke Active</option>
                    <option value="Inactive">Set ke Inactive</option>
                    <option value="Suspended">Set ke Suspended</option>
                    <option value="Pending">Set ke Pending</option>
                </select>
                <button @click="bulkDelete()" class="inline-flex items-center px-3 py-1.5 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>
            </div>
        </div>
        <button @click="selectedParticipants = []" class="px-3 py-1.5 text-sm border border-gray-300 rounded-lg bg-white hover:bg-gray-50 transition-colors">
            Batal
        </button>
    </div>
</div>
