@extends('layouts.app')

@section('title', 'Katalog Pelatihan - Jasa Tirta Learning Center')

@section('content')
<div x-data="catalogApp()" x-init="init()">
    {{-- Hero Section --}}
    @include('pages.landing.catalog._hero')

    {{-- Search and Filter Section --}}
    @include('pages.landing.catalog._filters')

    {{-- Training Cards Grid Section --}}
    @include('pages.landing.catalog._trainings')

    {{-- Pagination Section --}}
    @include('pages.landing.catalog._pagination')
</div>

<script>
function catalogApp() {
    return {
        allTrainings: @json($trainings),
        filteredTrainings: [],
        paginatedTrainings: [],
        searchQuery: '{{ request('search') }}',
        selectedCategory: '{{ request('category', 'semua') }}',
        selectedType: '{{ request('type', 'semua') }}',
        selectedPrice: '{{ request('price', 'semua') }}',
        sortBy: '{{ request('sort', 'terbaru') }}',
        currentPage: 1,
        itemsPerPage: 6,
        
        init() {
            this.filterTrainings();
        },
        
        filterTrainings() {
            let results = [...this.allTrainings];
            
            // Apply search filter
            if (this.searchQuery && this.searchQuery.trim() !== '') {
                const query = this.searchQuery.toLowerCase();
                results = results.filter(training => {
                    return training.title.toLowerCase().includes(query) ||
                           training.description.toLowerCase().includes(query) ||
                           (training.instructor && training.instructor.name.toLowerCase().includes(query));
                });
            }
            
            // Apply category filter
            if (this.selectedCategory !== 'semua') {
                results = results.filter(training => training.category_id == this.selectedCategory);
            }
            
            // Apply type filter
            if (this.selectedType !== 'semua') {
                results = results.filter(training => training.training_type === this.selectedType);
            }
            
            // Apply price filter
            if (this.selectedPrice !== 'semua') {
                if (this.selectedPrice === '1-5') {
                    results = results.filter(training => training.price >= 0 && training.price <= 5000000);
                } else if (this.selectedPrice === '5-10') {
                    results = results.filter(training => training.price > 5000000 && training.price <= 10000000);
                } else if (this.selectedPrice === '10+') {
                    results = results.filter(training => training.price > 10000000);
                }
            }
            
            // Apply sorting
            results = this.sortTrainings(results);
            
            this.filteredTrainings = results;
            this.currentPage = 1; // Reset to first page when filters change
            this.updatePagination();
        },
        
        sortTrainings(trainings) {
            const sorted = [...trainings];
            
            switch(this.sortBy) {
                case 'terpopuler':
                    return sorted.sort((a, b) => {
                        if (b.rating !== a.rating) return b.rating - a.rating;
                        return b.review_count - a.review_count;
                    });
                case 'harga-rendah':
                    return sorted.sort((a, b) => a.price - b.price);
                case 'harga-tinggi':
                    return sorted.sort((a, b) => b.price - a.price);
                case 'nama':
                    return sorted.sort((a, b) => a.title.localeCompare(b.title));
                default: // terbaru
                    return sorted.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
            }
        },
        
        updatePagination() {
            const startIndex = (this.currentPage - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            this.paginatedTrainings = this.filteredTrainings.slice(startIndex, endIndex);
        },
        
        goToPage(page) {
            if (page >= 1 && page <= this.totalPages) {
                this.currentPage = page;
                this.updatePagination();
                
                // Scroll to top of trainings section
                document.getElementById('trainings-section').scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        },
        
        resetFilters() {
            this.searchQuery = '';
            this.selectedCategory = 'semua';
            this.selectedType = 'semua';
            this.selectedPrice = 'semua';
            this.sortBy = 'terbaru';
            this.filterTrainings();
        },
        
        get filteredCount() {
            return this.filteredTrainings.length;
        },
        
        get totalCount() {
            return this.allTrainings.length;
        },
        
        get totalPages() {
            return Math.ceil(this.filteredTrainings.length / this.itemsPerPage);
        },
        
        get showingStart() {
            return this.filteredTrainings.length === 0 ? 0 : (this.currentPage - 1) * this.itemsPerPage + 1;
        },
        
        get showingEnd() {
            const end = this.currentPage * this.itemsPerPage;
            return end > this.filteredTrainings.length ? this.filteredTrainings.length : end;
        }
    }
}
</script>
@endsection
