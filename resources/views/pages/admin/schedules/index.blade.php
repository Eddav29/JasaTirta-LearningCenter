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
            searchQuery: '',
            statusFilter: 'all',
            methodFilter: 'all',
            instructorFilter: 'all',
            monthFilter: 'all',
            currentPage: 1,
            itemsPerPage: 5,
            selectedSchedules: [],
            schedules: [],
            
            get filteredSchedules() {
                return this.schedules.filter(schedule => {
                    const matchesSearch = 
                        schedule.trainingTitle.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        schedule.instructorName.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        schedule.location.toLowerCase().includes(this.searchQuery.toLowerCase());
                    
                    const matchesStatus = this.statusFilter === 'all' || schedule.status === this.statusFilter;
                    const matchesMethod = this.methodFilter === 'all' || schedule.method === this.methodFilter;
                    const matchesInstructor = this.instructorFilter === 'all' || schedule.instructorName === this.instructorFilter;
                    
                    const scheduleMonth = new Date(schedule.startDate).toLocaleDateString('id-ID', { month: 'long' });
                    const matchesMonth = this.monthFilter === 'all' || scheduleMonth === this.monthFilter;
                    
                    return matchesSearch && matchesStatus && matchesMethod && matchesInstructor && matchesMonth;
                });
            },
            
            get paginatedSchedules() {
                const startIndex = (this.currentPage - 1) * this.itemsPerPage;
                return this.filteredSchedules.slice(startIndex, startIndex + this.itemsPerPage);
            },
            
            get totalPages() {
                return Math.ceil(this.filteredSchedules.length / this.itemsPerPage);
            },
            
            get showBulkActions() {
                return this.selectedSchedules.length > 0;
            },
            
            get stats() {
                return {
                    total: this.schedules.length,
                    scheduled: this.schedules.filter(s => s.status === 'Scheduled').length,
                    completed: this.schedules.filter(s => s.status === 'Completed').length,
                    totalParticipants: this.schedules.reduce((sum, s) => sum + s.registeredCount, 0)
                };
            },
            
            toggleSelect(id) {
                const index = this.selectedSchedules.indexOf(id);
                if (index > -1) {
                    this.selectedSchedules.splice(index, 1);
                } else {
                    this.selectedSchedules.push(id);
                }
            },
            
            selectAll() {
                if (this.selectedSchedules.length === this.paginatedSchedules.length) {
                    this.selectedSchedules = [];
                } else {
                    this.selectedSchedules = this.paginatedSchedules.map(s => s.id);
                }
            },
            
            isSelected(id) {
                return this.selectedSchedules.includes(id);
            },
            
            deleteSchedule(id) {
                if (confirm('Apakah Anda yakin ingin menghapus jadwal ini?')) {
                    this.schedules = this.schedules.filter(s => s.id !== id);
                }
            },
            
            bulkDelete() {
                if (confirm(`Hapus ${this.selectedSchedules.length} jadwal?`)) {
                    this.schedules = this.schedules.filter(s => !this.selectedSchedules.includes(s.id));
                    this.selectedSchedules = [];
                }
            },
            
            bulkStatusChange(status) {
                this.schedules = this.schedules.map(s => 
                    this.selectedSchedules.includes(s.id) ? {...s, status} : s
                );
                this.selectedSchedules = [];
            },
            
            formatDate(dateString) {
                return new Date(dateString).toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                });
            },
            
            formatDateRange(startDate, endDate) {
                if (startDate === endDate) {
                    return this.formatDate(startDate);
                }
                return `${this.formatDate(startDate)} - ${this.formatDate(endDate)}`;
            },
            
            init() {
                this.$watch('searchQuery', () => this.currentPage = 1);
                this.$watch('statusFilter', () => this.currentPage = 1);
                this.$watch('methodFilter', () => this.currentPage = 1);
                this.$watch('instructorFilter', () => this.currentPage = 1);
                this.$watch('monthFilter', () => this.currentPage = 1);
            }
        }));
    });
</script>
@endpush
