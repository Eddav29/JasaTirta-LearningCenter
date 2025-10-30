{{-- Bulk Actions Bar --}}
<div x-show="showBulkActions" x-transition class="bg-blue-50 border border-blue-200 rounded-lg p-4">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <span class="text-sm font-medium text-blue-900" x-text="`${selectedSchedules.length} jadwal dipilih`"></span>
            <div class="flex gap-2">
                <button @click="bulkStatusChange('Scheduled')" class="px-3 py-1.5 text-sm border border-blue-300 rounded-lg bg-white text-blue-700 hover:bg-blue-50 transition-colors">
                    Jadwalkan
                </button>
                <button @click="bulkStatusChange('Cancelled')" class="px-3 py-1.5 text-sm border border-orange-300 rounded-lg bg-white text-orange-700 hover:bg-orange-50 transition-colors">
                    Batalkan
                </button>
                <button @click="bulkDelete()" class="px-3 py-1.5 text-sm border border-red-300 rounded-lg bg-white text-red-700 hover:bg-red-50 transition-colors">
                    Hapus
                </button>
            </div>
        </div>
        <button @click="selectedSchedules = []" class="px-3 py-1.5 text-sm border border-gray-300 rounded-lg bg-white hover:bg-gray-50 transition-colors">
            Batal
        </button>
    </div>
</div>
