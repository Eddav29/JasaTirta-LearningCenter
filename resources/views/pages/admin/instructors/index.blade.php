@extends('layouts.admin')

@section('title', 'Manajemen Instructor')

@section('content')
<div class="space-y-6" x-data="instructorsManager()" x-init="instructors = {{ json_encode($instructors->map(fn($i) => [
    'id' => $i->id,
    'name' => $i->name,
    'email' => $i->email,
    'phone' => $i->phone ?? null,
    'specialization' => explode(',', $i->specialization ?? ''),
    'experienceLevel' => $i->experience ?? null,
    'status' => 'Active',
    'coursesCount' => intval($i->trainings_count ?? 0),
    'studentsCount' => 0,
    'rating' => 4.5,
    'joinDate' => optional($i->created_at)->format('Y-m-d')
])) }}">
    @include('pages.admin.instructors._header')
    @include('pages.admin.instructors._statistics')
    @include('pages.admin.instructors._search-filter')
    @include('pages.admin.instructors._table')
</div>
@endsection

@push('scripts')
<script>
    // Alpine.js component for instructors management
    document.addEventListener('alpine:init', () => {
        Alpine.data('instructorsManager', () => ({
            searchQuery: '',
            specializationFilter: 'all',
            experienceLevelFilter: 'all',
            statusFilter: 'all',
            currentPage: 1,
            itemsPerPage: 5,
            selectedInstructors: [],
            instructors: [],
            
            get filteredInstructors() {
            return this.instructors.filter(instructor => {
                const matchesSearch = 
                    instructor.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    instructor.email.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    instructor.specialization.some(spec => spec.toLowerCase().includes(this.searchQuery.toLowerCase()));
                
                const matchesSpecialization = this.specializationFilter === 'all' || 
                    instructor.specialization.some(spec => spec.toLowerCase().includes(this.specializationFilter.toLowerCase()));
                
                const matchesExperienceLevel = this.experienceLevelFilter === 'all' || 
                    instructor.experienceLevel === this.experienceLevelFilter;
                
                const matchesStatus = this.statusFilter === 'all' || instructor.status === this.statusFilter;

                return matchesSearch && matchesSpecialization && matchesExperienceLevel && matchesStatus;
                });
            },
            
            get paginatedInstructors() {
                const startIndex = (this.currentPage - 1) * this.itemsPerPage;
                return this.filteredInstructors.slice(startIndex, startIndex + this.itemsPerPage);
            },
            
            get totalPages() {
                return Math.ceil(this.filteredInstructors.length / this.itemsPerPage);
            },
            
            get stats() {
                const total = this.instructors.length;
                const active = this.instructors.filter(i => i.status === 'Active').length;
                const expert = this.instructors.filter(i => i.experienceLevel === 'Expert' || i.experienceLevel === 'Master').length;
                const averageRating = this.instructors.reduce((sum, i) => sum + i.rating, 0) / total;
                
                return {
                    total,
                    active,
                    expert,
                    averageRating: averageRating.toFixed(1)
                };
            },
            
            get showBulkActions() {
                return this.selectedInstructors.length > 0;
            },
            
            get allSelected() {
                return this.paginatedInstructors.length > 0 && 
                       this.selectedInstructors.length === this.paginatedInstructors.length;
            },
            
            selectAll() {
                if (this.selectedInstructors.length === this.paginatedInstructors.length) {
                    this.selectedInstructors = [];
                } else {
                    this.selectedInstructors = this.paginatedInstructors.map(i => i.id);
                }
            },
            
            toggleSelect(id) {
                const index = this.selectedInstructors.indexOf(id);
                if (index > -1) {
                    this.selectedInstructors.splice(index, 1);
                } else {
                    this.selectedInstructors.push(id);
                }
            },
            
            isSelected(id) {
                return this.selectedInstructors.includes(id);
            },
            
            getInitials(name) {
                return name.split(' ').map(n => n[0]).join('');
            },
            
            deleteInstructorWithForm(id) {
                if (confirm('Apakah Anda yakin ingin menghapus instructor ini?')) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/instructors/${id}`;
                    
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    
                    form.appendChild(csrfToken);
                    form.appendChild(methodField);
                    document.body.appendChild(form);
                    form.submit();
                }
            },
            
            bulkDelete() {
                if (confirm(`Hapus ${this.selectedInstructors.length} instructor?`)) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/admin/instructors/bulk-destroy';
                    
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    
                    this.selectedInstructors.forEach((id, index) => {
                        const idField = document.createElement('input');
                        idField.type = 'hidden';
                        idField.name = `instructor_ids[${index}]`;
                        idField.value = id;
                        form.appendChild(idField);
                    });
                    
                    form.appendChild(csrfToken);
                    document.body.appendChild(form);
                    form.submit();
                }
            },
            
            bulkStatusChange(status) {
                this.instructors = this.instructors.map(i => 
                    this.selectedInstructors.includes(i.id) ? {...i, status} : i
                );
                this.selectedInstructors = [];
            },
            
            init() {
                this.$watch('searchQuery', () => this.currentPage = 1);
                this.$watch('specializationFilter', () => this.currentPage = 1);
                this.$watch('experienceLevelFilter', () => this.currentPage = 1);
                this.$watch('statusFilter', () => this.currentPage = 1);
            }
        }));
    });
</script>
@endpush

