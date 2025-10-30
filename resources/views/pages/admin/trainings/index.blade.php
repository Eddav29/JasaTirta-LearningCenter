@extends('layouts.admin')

@section('title', 'Manajemen Pelatihan')

@section('content')
<div class="space-y-6">
    @include('pages.admin.trainings._header')
    @include('pages.admin.trainings._search-filter')
    @include('pages.admin.trainings._bulk-actions')
    @include('pages.admin.trainings._statistics')
    @include('pages.admin.trainings._table')
</div>
@endsection

@push('scripts')
<script>
    // Alpine.js component for trainings management
    document.addEventListener('alpine:init', () => {
        Alpine.data('trainingsManager', () => ({
            searchQuery: '',
            categoryFilter: 'all',
            levelFilter: 'all',
            statusFilter: 'all',
            instructorFilter: 'all',
            currentPage: 1,
            itemsPerPage: 5,
            selectedTrainings: [],
            
            get filteredTrainings() {
                return this.trainings.filter(training => {
                    const matchesSearch = 
                        training.title.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        training.description.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        training.category.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        training.instructorName.toLowerCase().includes(this.searchQuery.toLowerCase());
                    
                    const matchesCategory = this.categoryFilter === 'all' || training.category === this.categoryFilter;
                    const matchesLevel = this.levelFilter === 'all' || training.level === this.levelFilter;
                    const matchesStatus = this.statusFilter === 'all' || training.status === this.statusFilter;
                    const matchesInstructor = this.instructorFilter === 'all' || training.instructorName === this.instructorFilter;

                    return matchesSearch && matchesCategory && matchesLevel && matchesStatus && matchesInstructor;
                });
            },
            
            get paginatedTrainings() {
                const startIndex = (this.currentPage - 1) * this.itemsPerPage;
                return this.filteredTrainings.slice(startIndex, startIndex + this.itemsPerPage);
            },
            
            get totalPages() {
                return Math.ceil(this.filteredTrainings.length / this.itemsPerPage);
            },
            
            get showBulkActions() {
                return this.selectedTrainings.length > 0;
            },
            
            selectAll() {
                if (this.selectedTrainings.length === this.paginatedTrainings.length) {
                    this.selectedTrainings = [];
                } else {
                    this.selectedTrainings = this.paginatedTrainings.map(t => t.id);
                }
            },
            
            toggleSelect(id) {
                const index = this.selectedTrainings.indexOf(id);
                if (index > -1) {
                    this.selectedTrainings.splice(index, 1);
                } else {
                    this.selectedTrainings.push(id);
                }
            },
            
            isSelected(id) {
                return this.selectedTrainings.includes(id);
            },
            
            deleteTraining(id) {
                if (confirm('Apakah Anda yakin ingin menghapus pelatihan ini?')) {
                    this.trainings = this.trainings.filter(t => t.id !== id);
                }
            },
            
            bulkDelete() {
                if (confirm(`Hapus ${this.selectedTrainings.length} pelatihan?`)) {
                    this.trainings = this.trainings.filter(t => !this.selectedTrainings.includes(t.id));
                    this.selectedTrainings = [];
                }
            },
            
            bulkStatusChange(status) {
                this.trainings = this.trainings.map(t => 
                    this.selectedTrainings.includes(t.id) ? {...t, status} : t
                );
                this.selectedTrainings = [];
            },
            
            init() {
                this.$watch('searchQuery', () => this.currentPage = 1);
                this.$watch('categoryFilter', () => this.currentPage = 1);
                this.$watch('levelFilter', () => this.currentPage = 1);
                this.$watch('statusFilter', () => this.currentPage = 1);
                this.$watch('instructorFilter', () => this.currentPage = 1);
            }
        }));
    });
</script>
@endpush
