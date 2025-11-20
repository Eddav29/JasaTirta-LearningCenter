@extends('layouts.admin')

@section('title', 'Kategori Pelatihan')

@section('content')
<div class="space-y-6" x-data="categoriesManager()" x-init="categories = {{ json_encode($categories->map(fn($cat) => [
    'id' => $cat->id,
    'name' => $cat->name,
    'description' => $cat->description ?? '',
    'trainingCount' => $cat->trainings_count,
    'createdAt' => $cat->created_at->format('Y-m-d')
])) }}; console.log('Initial categories:', categories);">
    @include('pages.admin.categories._header')
    @include('pages.admin.categories._search-filter')
    @include('pages.admin.categories._table')
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('categoriesManager', () => ({
            // State
            searchQuery: '',
            currentPage: 1,
            itemsPerPage: 10,
            categories: [],
            selectedIds: [],

            // Computed: All selected
            get allSelected() {
                return this.paginatedCategories.length > 0 && 
                       this.paginatedCategories.every(cat => this.selectedIds.includes(cat.id));
            },

            // Computed: Filtered categories
            get filteredCategories() {
                return this.categories.filter(category => {
                    const matchesSearch = this.searchQuery === '' ||
                        (category.name && category.name.toLowerCase().includes(this.searchQuery.toLowerCase())) ||
                        (category.description && category.description.toLowerCase().includes(this.searchQuery.toLowerCase()));
                    
                    return matchesSearch;
                });
            },

            // Computed: Paginated categories
            get paginatedCategories() {
                const start = (this.currentPage - 1) * this.itemsPerPage;
                const end = start + this.itemsPerPage;
                return this.filteredCategories.slice(start, end);
            },

            // Computed: Total pages
            get totalPages() {
                return Math.ceil(this.filteredCategories.length / this.itemsPerPage);
            },

            // Methods
            deleteCategory(id) {
                const category = this.categories.find(cat => cat.id === id);
                
                if (category && category.trainingCount > 0) {
                    alert(`Tidak dapat menghapus. Kategori "${category.name}" masih memiliki ${category.trainingCount} pelatihan.`);
                    return;
                }

                if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
                    // Submit delete form
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `{{ route('admin.categories.index') }}/${id}`;
                    
                    const csrfField = document.createElement('input');
                    csrfField.type = 'hidden';
                    csrfField.name = '_token';
                    csrfField.value = '{{ csrf_token() }}';
                    
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    
                    form.appendChild(csrfField);
                    form.appendChild(methodField);
                    document.body.appendChild(form);
                    form.submit();
                }
            },

            // Bulk Actions
            toggleAll() {
                if (this.allSelected) {
                    // Deselect all on current page
                    this.paginatedCategories.forEach(cat => {
                        const idx = this.selectedIds.indexOf(cat.id);
                        if (idx > -1) this.selectedIds.splice(idx, 1);
                    });
                } else {
                    // Select all on current page
                    this.paginatedCategories.forEach(cat => {
                        if (!this.selectedIds.includes(cat.id)) {
                            this.selectedIds.push(cat.id);
                        }
                    });
                }
            },

            toggleSelect(id) {
                const idx = this.selectedIds.indexOf(id);
                if (idx > -1) {
                    this.selectedIds.splice(idx, 1);
                } else {
                    this.selectedIds.push(id);
                }
            },

            bulkDelete() {
                if (this.selectedIds.length === 0) return;

                const categoriesWithTrainings = this.selectedIds
                    .map(id => this.categories.find(cat => cat.id === id))
                    .filter(cat => cat && cat.trainingCount > 0);

                if (categoriesWithTrainings.length > 0) {
                    alert(`Tidak dapat menghapus ${categoriesWithTrainings.length} kategori yang masih memiliki pelatihan.`);
                    return;
                }

                if (confirm(`Apakah Anda yakin ingin menghapus ${this.selectedIds.length} kategori?`)) {
                    // Submit bulk delete form
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route('admin.categories.bulk-delete') }}';
                    
                    const csrfField = document.createElement('input');
                    csrfField.type = 'hidden';
                    csrfField.name = '_token';
                    csrfField.value = '{{ csrf_token() }}';
                    
                    this.selectedIds.forEach(id => {
                        const idField = document.createElement('input');
                        idField.type = 'hidden';
                        idField.name = 'ids[]';
                        idField.value = id;
                        form.appendChild(idField);
                    });
                    
                    form.appendChild(csrfField);
                    document.body.appendChild(form);
                    form.submit();
                }
            },

            formatDate(dateString) {
                const date = new Date(dateString);
                return date.toLocaleDateString('id-ID', { year: 'numeric', month: 'short', day: 'numeric' });
            },

            // Watchers
            init() {
                this.$watch('searchQuery', () => {
                    this.currentPage = 1;
                });
            }
        }));
    });
</script>
@endpush
