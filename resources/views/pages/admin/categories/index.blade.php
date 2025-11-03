@extends('layouts.admin')

@section('title', 'Kategori Pelatihan')

@section('content')
<div class="space-y-6" x-data="categoriesManager()" x-init="categories = {{ json_encode($categories->map(fn($cat) => [
    'id' => $cat->id,
    'name' => $cat->name,
    'slug' => $cat->slug,
    'description' => $cat->description ?? '',
    'icon' => $cat->icon ?? '📁',
    'color' => $cat->color ?? '#3b82f6',
    'trainingCount' => $cat->trainings_count,
    'isActive' => (bool) $cat->is_active,
    'createdAt' => $cat->created_at->format('Y-m-d')
])) }}; console.log('Initial categories:', categories);">
    @include('pages.admin.categories._header')
    @include('pages.admin.categories._statistics')
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
            statusFilter: '',
            currentPage: 1,
            itemsPerPage: 10,
            categories: [],
            showAddDialog: false,
            showEditDialog: false,
            selectedCategory: null,
            selectedIds: [],

            // Form data
            formData: {
                name: '',
                slug: '',
                description: '',
                icon: '',
                color: '#3b82f6',
                isActive: true
            },

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
                        (category.description && category.description.toLowerCase().includes(this.searchQuery.toLowerCase())) ||
                        (category.slug && category.slug.toLowerCase().includes(this.searchQuery.toLowerCase()));
                    
                    const matchesStatus = this.statusFilter === '' ||
                        (this.statusFilter === 'active' && category.isActive) ||
                        (this.statusFilter === 'inactive' && !category.isActive);
                    
                    return matchesSearch && matchesStatus;
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

            // Computed: Statistics
            get stats() {
                return {
                    total: this.categories.length,
                    active: this.categories.filter(cat => cat.isActive).length,
                    inactive: this.categories.filter(cat => !cat.isActive).length,
                    totalTrainings: this.categories.reduce((sum, cat) => sum + cat.trainingCount, 0)
                };
            },

            // Methods
            generateSlug(name) {
                return name
                    .toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim();
            },

            handleNameChange(value) {
                this.formData.name = value;
                this.formData.slug = this.generateSlug(value);
            },

            resetForm() {
                this.formData = {
                    name: '',
                    slug: '',
                    description: '',
                    icon: '',
                    color: '#3b82f6',
                    isActive: true
                };
            },

            openAddDialog() {
                this.resetForm();
                this.showAddDialog = true;
            },

            openEditDialog(category) {
                this.selectedCategory = category;
                this.formData = {
                    name: category.name,
                    slug: category.slug,
                    description: category.description,
                    icon: category.icon || '',
                    color: category.color || '#3b82f6',
                    isActive: category.isActive
                };
                this.showEditDialog = true;
            },

            addCategory() {
                if (!this.formData.name) return;

                const newCategory = {
                    id: this.categories.length + 1,
                    name: this.formData.name,
                    slug: this.formData.slug,
                    description: this.formData.description,
                    icon: this.formData.icon,
                    color: this.formData.color,
                    trainingCount: 0,
                    isActive: this.formData.isActive,
                    createdAt: new Date().toISOString().split('T')[0]
                };

                this.categories.push(newCategory);
                this.showAddDialog = false;
                this.resetForm();
                alert(`Kategori "${newCategory.name}" berhasil ditambahkan`);
            },

            updateCategory() {
                if (!this.selectedCategory) return;

                const index = this.categories.findIndex(cat => cat.id === this.selectedCategory.id);
                if (index !== -1) {
                    this.categories[index] = {
                        ...this.categories[index],
                        name: this.formData.name,
                        slug: this.formData.slug,
                        description: this.formData.description,
                        icon: this.formData.icon,
                        color: this.formData.color,
                        isActive: this.formData.isActive
                    };
                }

                this.showEditDialog = false;
                this.selectedCategory = null;
                this.resetForm();
                alert(`Kategori "${this.formData.name}" berhasil diperbarui`);
            },

            deleteCategory(id) {
                const category = this.categories.find(cat => cat.id === id);
                
                if (category && category.trainingCount > 0) {
                    alert(`Tidak dapat menghapus. Kategori "${category.name}" masih memiliki ${category.trainingCount} pelatihan.`);
                    return;
                }

                if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
                    this.categories = this.categories.filter(cat => cat.id !== id);
                    alert('Kategori berhasil dihapus');
                }
            },

            toggleStatus(id) {
                const index = this.categories.findIndex(cat => cat.id === id);
                if (index !== -1) {
                    this.categories[index].isActive = !this.categories[index].isActive;
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
                    this.categories = this.categories.filter(cat => !this.selectedIds.includes(cat.id));
                    this.selectedIds = [];
                    alert('Kategori berhasil dihapus');
                }
            },

            bulkActivate() {
                if (this.selectedIds.length === 0) return;

                this.selectedIds.forEach(id => {
                    const index = this.categories.findIndex(cat => cat.id === id);
                    if (index !== -1) {
                        this.categories[index].isActive = true;
                    }
                });
                this.selectedIds = [];
                alert('Kategori berhasil diaktifkan');
            },

            bulkDeactivate() {
                if (this.selectedIds.length === 0) return;

                this.selectedIds.forEach(id => {
                    const index = this.categories.findIndex(cat => cat.id === id);
                    if (index !== -1) {
                        this.categories[index].isActive = false;
                    }
                });
                this.selectedIds = [];
                alert('Kategori berhasil dinonaktifkan');
            },

            formatDate(dateString) {
                const date = new Date(dateString);
                return date.toLocaleDateString('id-ID', { year: 'numeric', month: 'short', day: 'numeric' });
            },

            // Watchers
            init() {
                this.$watch('searchQuery', () => {
                    console.log('Search query changed:', this.searchQuery);
                    this.currentPage = 1;
                });
                this.$watch('statusFilter', () => {
                    console.log('Status filter changed:', this.statusFilter);
                    this.currentPage = 1;
                });
                this.$watch('filteredCategories', () => {
                    console.log('Filtered categories:', this.filteredCategories.length);
                });
                console.log('Categories Manager initialized with', this.categories.length, 'categories');
            }
        }));
    });
</script>
@endpush
