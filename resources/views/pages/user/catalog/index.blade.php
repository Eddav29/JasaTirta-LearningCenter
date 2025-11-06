@extends('layouts.user')

@section('content')
<div x-data="catalogApp()" x-init="init()">
    {{-- Header Section --}}
    @include('pages.user.catalog._header')

    {{-- Search and Filters Section --}}
    @include('pages.user.catalog._filters')

    {{-- Course Cards Grid Section --}}
    @include('pages.user.catalog._courses')
</div>

@push('scripts')
<script>
function catalogApp() {
    return {
        // Data
        allCourses: [],
        filteredCourses: [],
        categories: @json($categories ?? []),
        enrolledCourseIds: @json($enrolledCourseIds ?? []),
        
        // Filters
        searchQuery: '',
        selectedCategory: 'semua',
        selectedType: 'semua',
        selectedStatus: 'semua', // semua, enrolled, not-enrolled
        selectedLevel: 'semua',
        sortBy: 'terbaru',
        
        // Pagination
        currentPage: 1,
        perPage: 9,
        totalPages: 1,
        
        // UI State
        viewMode: 'grid', // grid or list
        loading: false,
        
        // Initialize
        init() {
            this.allCourses = @json($courses ?? []);
            this.filterCourses();
        },
        
        // Filter courses
        filterCourses() {
            let filtered = this.allCourses;
            
            // Search filter
            if (this.searchQuery) {
                const query = this.searchQuery.toLowerCase();
                filtered = filtered.filter(course => 
                    course.title.toLowerCase().includes(query) ||
                    course.description.toLowerCase().includes(query) ||
                    (course.instructor && course.instructor.toLowerCase().includes(query))
                );
            }
            
            // Category filter
            if (this.selectedCategory !== 'semua') {
                filtered = filtered.filter(course => 
                    course.category_id == this.selectedCategory
                );
            }
            
            // Type filter
            if (this.selectedType !== 'semua') {
                filtered = filtered.filter(course => 
                    course.training_type === this.selectedType
                );
            }
            
            // Enrollment status filter
            if (this.selectedStatus !== 'semua') {
                if (this.selectedStatus === 'enrolled') {
                    filtered = filtered.filter(course => 
                        this.enrolledCourseIds.includes(course.id)
                    );
                } else if (this.selectedStatus === 'not-enrolled') {
                    filtered = filtered.filter(course => 
                        !this.enrolledCourseIds.includes(course.id)
                    );
                }
            }
            
            // Level filter
            if (this.selectedLevel !== 'semua') {
                filtered = filtered.filter(course => 
                    course.level === this.selectedLevel
                );
            }
            
            // Sorting
            filtered = this.sortCourses(filtered);
            
            // Update pagination
            this.totalPages = Math.ceil(filtered.length / this.perPage);
            this.currentPage = Math.min(this.currentPage, this.totalPages || 1);
            
            this.filteredCourses = filtered;
        },
        
        // Sort courses
        sortCourses(courses) {
            const sorted = [...courses];
            
            switch (this.sortBy) {
                case 'terbaru':
                    return sorted.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                case 'terlama':
                    return sorted.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
                case 'nama-az':
                    return sorted.sort((a, b) => a.title.localeCompare(b.title));
                case 'nama-za':
                    return sorted.sort((a, b) => b.title.localeCompare(a.title));
                case 'rating':
                    return sorted.sort((a, b) => (b.rating || 0) - (a.rating || 0));
                case 'durasi':
                    return sorted.sort((a, b) => (a.duration_days || 0) - (b.duration_days || 0));
                default:
                    return sorted;
            }
        },
        
        // Get paginated courses
        get paginatedCourses() {
            const start = (this.currentPage - 1) * this.perPage;
            const end = start + this.perPage;
            return this.filteredCourses.slice(start, end);
        },
        
        // Check if course is enrolled
        isEnrolled(courseId) {
            return this.enrolledCourseIds.includes(courseId);
        },
        
        // Reset filters
        resetFilters() {
            this.searchQuery = '';
            this.selectedCategory = 'semua';
            this.selectedType = 'semua';
            this.selectedStatus = 'semua';
            this.selectedLevel = 'semua';
            this.sortBy = 'terbaru';
            this.currentPage = 1;
            this.filterCourses();
        },
        
        // Pagination
        goToPage(page) {
            if (page >= 1 && page <= this.totalPages) {
                this.currentPage = page;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        },
        
        get pageNumbers() {
            const pages = [];
            const maxVisible = 5;
            
            if (this.totalPages <= maxVisible) {
                for (let i = 1; i <= this.totalPages; i++) {
                    pages.push(i);
                }
            } else {
                pages.push(1);
                
                if (this.currentPage > 3) {
                    pages.push('...');
                }
                
                const start = Math.max(2, this.currentPage - 1);
                const end = Math.min(this.totalPages - 1, this.currentPage + 1);
                
                for (let i = start; i <= end; i++) {
                    pages.push(i);
                }
                
                if (this.currentPage < this.totalPages - 2) {
                    pages.push('...');
                }
                
                pages.push(this.totalPages);
            }
            
            return pages;
        }
    };
}
</script>
@endpush
@endsection
