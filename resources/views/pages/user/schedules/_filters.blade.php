{{-- Filters Section --}}
<div class="bg-white rounded-lg border border-gray-200 mb-6" 
     x-show="showFilters || window.innerWidth >= 1024" 
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0 transform -translate-y-2"
     x-transition:enter-end="opacity-100 transform translate-y-0">
    
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">Filter & Pencarian</h3>
            @if(request()->hasAny(['search', 'category', 'method', 'level', 'instructor', 'month', 'start_date', 'end_date', 'min_price', 'max_price']))
                <button @click="clearFilters()" 
                        class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                    Hapus Semua Filter
                </button>
            @endif
        </div>
    </div>
    
    <form method="GET" action="{{ route('user.schedules') }}" class="p-6">
        {{-- Search Bar --}}
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Cari Pelatihan</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari berdasarkan nama pelatihan, deskripsi, atau lokasi..."
                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                />
            </div>
        </div>

        {{-- Filters Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-6">
            {{-- Category Filter --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="category" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="all">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Method Filter --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Metode</label>
                <select name="method" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="all">Semua Metode</option>
                    <option value="online" {{ request('method') == 'online' ? 'selected' : '' }}>Online</option>
                    <option value="offline" {{ request('method') == 'offline' ? 'selected' : '' }}>Offline</option>
                    <option value="hybrid" {{ request('method') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                </select>
            </div>

            {{-- Level Filter --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Level</label>
                <select name="level" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="all">Semua Level</option>
                    <option value="Beginner" {{ request('level') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                    <option value="Intermediate" {{ request('level') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                    <option value="Advanced" {{ request('level') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                    <option value="Expert" {{ request('level') == 'Expert' ? 'selected' : '' }}>Expert</option>
                </select>
            </div>

            {{-- Instructor Filter --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Instruktur</label>
                <select name="instructor" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="all">Semua Instruktur</option>
                    @foreach($instructors as $instructor)
                        <option value="{{ $instructor->id }}" {{ request('instructor') == $instructor->id ? 'selected' : '' }}>
                            {{ $instructor->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Month Filter --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
                <select name="month" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="all">Semua Bulan</option>
                    @foreach($availableMonths as $month)
                        <option value="{{ $month['value'] }}" {{ request('month') == $month['value'] ? 'selected' : '' }}>
                            {{ $month['label'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Date Range --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                <input
                    type="date"
                    name="start_date"
                    value="{{ request('start_date') }}"
                    min="{{ date('Y-m-d') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                <input
                    type="date"
                    name="end_date"
                    value="{{ request('end_date') }}"
                    min="{{ date('Y-m-d') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
            </div>

            {{-- Price Range --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga Minimal</label>
                <input
                    type="number"
                    name="min_price"
                    value="{{ request('min_price') }}"
                    placeholder="Rp 0"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga Maksimal</label>
                <input
                    type="number"
                    name="max_price"
                    value="{{ request('max_price') }}"
                    placeholder="Rp 10.000.000"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
            </div>
        </div>

        {{-- Keep current view mode --}}
        <input type="hidden" name="view" value="{{ $viewMode }}">

        {{-- Action Buttons --}}
        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
            <div class="flex items-center gap-3">
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari Jadwal
                </button>
            </div>

            {{-- Active Filters Count --}}
            @if(request()->hasAny(['search', 'category', 'method', 'level', 'instructor', 'month', 'start_date', 'end_date', 'min_price', 'max_price']))
                @php
                    $activeFilters = collect(['search', 'category', 'method', 'level', 'instructor', 'month', 'start_date', 'end_date', 'min_price', 'max_price'])
                        ->filter(fn($filter) => request()->filled($filter) && request($filter) !== 'all')
                        ->count();
                @endphp
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"/>
                    </svg>
                    {{ $activeFilters }} filter aktif
                </div>
            @endif
        </div>
    </form>
</div>