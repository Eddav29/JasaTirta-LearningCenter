@extends('layouts.admin')

@section('title', 'Manajemen Jadwal')

@section('content')
<div class="space-y-6" x-data="schedulesManager()">
    @include('pages.admin.schedules._header')
    @include('pages.admin.schedules._statistics')
    @include('pages.admin.schedules._search-filter')
    @include('pages.admin.schedules._bulk-actions')
    @include('pages.admin.schedules._list')
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('schedulesManager', () => ({
            selectedSchedules: [],
            bulkStatusValue: '',
            
            get showBulkActions() {
                return this.selectedSchedules.length > 0;
            },
            
            get stats() {
                // Calculate stats from static data for now
                return {
                    total: 0,
                    scheduled: 0,
                    completed: 0,
                    totalParticipants: 0
                };
            },
            
            clearSelection() {
                this.selectedSchedules = [];
                this.bulkStatusValue = '';
            },
            
            async bulkDelete() {
                if (this.selectedSchedules.length === 0) {
                    alert('Pilih jadwal yang akan dihapus terlebih dahulu');
                    return;
                }
                
                if (!confirm(`Hapus ${this.selectedSchedules.length} jadwal terpilih?`)) {
                    return;
                }
                
                try {
                    const response = await fetch('{{ route("admin.schedules.bulk-destroy") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            ids: this.selectedSchedules
                        })
                    });
                    
                    const result = await response.json();
                    
                    if (response.ok && result.success) {
                        alert(result.message);
                        window.location.reload();
                    } else {
                        alert(result.error || 'Terjadi kesalahan');
                    }
                } catch (error) {
                    alert('Terjadi kesalahan: ' + error.message);
                }
            },
            
            async bulkUpdateStatus() {
                if (this.selectedSchedules.length === 0) {
                    alert('Pilih jadwal yang akan diperbarui terlebih dahulu');
                    return;
                }
                
                if (!this.bulkStatusValue) {
                    alert('Pilih status baru terlebih dahulu');
                    return;
                }
                
                try {
                    const response = await fetch('{{ route("admin.schedules.bulk-status") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            ids: this.selectedSchedules,
                            status: this.bulkStatusValue
                        })
                    });
                    
                    const result = await response.json();
                    
                    if (response.ok && result.success) {
                        alert(result.message);
                        window.location.reload();
                    } else {
                        alert(result.error || 'Terjadi kesalahan');
                    }
                } catch (error) {
                    alert('Terjadi kesalahan: ' + error.message);
                }
            }
        }));
    });
</script>
@endpush
