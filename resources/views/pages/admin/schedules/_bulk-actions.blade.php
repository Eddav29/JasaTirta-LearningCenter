{{-- Bulk Actions Bar --}}
<div x-show="showBulkActions" x-transition class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6" x-cloak>
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <span class="text-sm font-medium text-blue-900" x-text="`${selectedSchedules.length} jadwal dipilih`"></span>
            <div class="flex gap-2">
                {{-- Bulk Status Update --}}
                <select x-model="bulkStatusValue" class="px-2 py-1 text-sm border border-blue-300 rounded-lg bg-white text-blue-700">
                    <option value="">Pilih Status</option>
                    <option value="buka_pendaftaran">Buka Pendaftaran</option>
                    <option value="penuh">Penuh</option>
                    <option value="berlangsung">Berlangsung</option>
                    <option value="selesai">Selesai</option>
                    <option value="dibatalkan">Dibatalkan</option>
                </select>
                
                <button @click="bulkUpdateStatus()" 
                        x-show="bulkStatusValue"
                        class="px-3 py-1.5 text-sm border border-blue-300 rounded-lg bg-white text-blue-700 hover:bg-blue-50 transition-colors">
                    Update Status
                </button>
                
                <button @click="bulkDelete()" 
                        class="px-3 py-1.5 text-sm border border-red-300 rounded-lg bg-white text-red-700 hover:bg-red-50 transition-colors">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus Terpilih
                </button>
            </div>
        </div>
        <button @click="clearSelection()" 
                class="px-3 py-1.5 text-sm border border-gray-300 rounded-lg bg-white hover:bg-gray-50 transition-colors">
            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            Batal
        </button>
    </div>
</div>
