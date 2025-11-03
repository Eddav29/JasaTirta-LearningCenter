@extends('layouts.app')

@section('title', 'Jadwal Pelatihan - Jasa Tirta Learning Center')

@section('content')
<div class="min-h-screen bg-gray-50" x-data="scheduleApp()" x-init="init()">
    {{-- Hero Section --}}
    @include('pages.landing.schedule._hero')

    {{-- Filters Section --}}
    @include('pages.landing.schedule._filters')

    {{-- Schedule Table Section --}}
    @include('pages.landing.schedule._table')

    {{-- Info Section --}}
    @include('pages.landing.schedule._info')
</div>

<script>
function scheduleApp() {
    return {
        allSchedules: @json($schedules),
        filteredSchedules: [],
        searchQuery: '{{ request('search') }}',
        selectedCategory: '{{ request('category', 'semua') }}',
        selectedMethod: '{{ request('method', 'semua') }}',
        selectedMonth: '{{ request('month', 'semua') }}',
        selectedAvailability: '{{ request('availability', 'semua') }}',
        
        init() {
            this.filterSchedules();
        },
        
        filterSchedules() {
            let results = [...this.allSchedules];
            
            // Apply search filter
            if (this.searchQuery && this.searchQuery.trim() !== '') {
                const query = this.searchQuery.toLowerCase();
                results = results.filter(schedule => {
                    return schedule.training.title.toLowerCase().includes(query) ||
                           (schedule.training.instructor && schedule.training.instructor.name.toLowerCase().includes(query));
                });
            }
            
            // Apply category filter
            if (this.selectedCategory !== 'semua') {
                results = results.filter(schedule => schedule.training.category_id == this.selectedCategory);
            }
            
            // Apply method filter
            if (this.selectedMethod !== 'semua') {
                results = results.filter(schedule => schedule.method === this.selectedMethod);
            }
            
            // Apply month filter
            if (this.selectedMonth !== 'semua') {
                results = results.filter(schedule => schedule.month === this.selectedMonth);
            }
            
            // Apply availability filter
            if (this.selectedAvailability === 'available') {
                results = results.filter(schedule => schedule.available_slots > 0);
            } else if (this.selectedAvailability === 'full') {
                results = results.filter(schedule => schedule.available_slots === 0);
            }
            
            this.filteredSchedules = results;
        },
        
        resetFilters() {
            this.searchQuery = '';
            this.selectedCategory = 'semua';
            this.selectedMethod = 'semua';
            this.selectedMonth = 'semua';
            this.selectedAvailability = 'semua';
            this.filterSchedules();
        },
        
        get filteredCount() {
            return this.filteredSchedules.length;
        },
        
        get totalCount() {
            return this.allSchedules.length;
        },
        
        formatDate(startDate, endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            
            if (start.getMonth() === end.getMonth()) {
                return `${start.getDate()}-${end.getDate()} ${months[start.getMonth()]} ${start.getFullYear()}`;
            } else {
                return `${start.getDate()} ${months[start.getMonth()]} - ${end.getDate()} ${months[end.getMonth()]} ${end.getFullYear()}`;
            }
        },
        
        formatPrice(price) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(price);
        },
        
        getAvailabilityClass(availableSlots, totalSlots) {
            const percentage = (availableSlots / totalSlots) * 100;
            if (percentage > 50) return 'bg-green-100 text-green-800';
            if (percentage > 20) return 'bg-yellow-100 text-yellow-800';
            if (percentage > 0) return 'bg-orange-100 text-orange-800';
            return 'bg-red-100 text-red-800';
        },
        
        getAvailabilityText(availableSlots) {
            if (availableSlots === 0) return 'Penuh';
            if (availableSlots <= 3) return 'Hampir Penuh';
            return 'Tersedia';
        }
    }
}
</script>
@endsection
