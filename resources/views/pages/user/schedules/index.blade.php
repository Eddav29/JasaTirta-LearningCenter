@extends('layouts.user')

@section('title', 'Jadwal Pelatihan')

@section('content')
<div class="space-y-6" x-data="schedulesManager()">
    @include('pages.user.schedules._header')
    @include('pages.user.schedules._stats')
    @include('pages.user.schedules._filters')
    @include('pages.user.schedules._schedules')
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('schedulesManager', () => ({
            viewMode: '{{ request("view", "grid") }}',
            
            get stats() {
                return @json($stats);
            },
            
            toggleView(mode) {
                this.viewMode = mode;
                // Update URL with new view mode
                const url = new URL(window.location);
                url.searchParams.set('view', mode);
                window.history.pushState({}, '', url);
            },
            
            applySort(sortBy, direction = 'asc') {
                const url = new URL(window.location);
                url.searchParams.set('sort', sortBy);
                url.searchParams.set('direction', direction);
                window.location.href = url.toString();
            },
            
            clearFilters() {
                const url = new URL(window.location);
                // Keep only essential params
                const paramsToKeep = ['view'];
                const newParams = new URLSearchParams();
                
                paramsToKeep.forEach(param => {
                    if (url.searchParams.has(param)) {
                        newParams.set(param, url.searchParams.get(param));
                    }
                });
                
                window.location.href = url.pathname + '?' + newParams.toString();
            },
            
            formatPrice(price) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(price);
            }
        }));
    });
</script>
@endpush