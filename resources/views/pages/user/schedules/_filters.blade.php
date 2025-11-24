{{-- Compact Search Bar --}}
<div class="bg-white rounded-lg border border-gray-200 mb-6 p-4">
    <form method="GET" action="{{ route('user.schedules') }}" class="space-y-4">
        
        {{-- Main Search --}}
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
                placeholder="Cari pelatihan berdasarkan nama, deskripsi, atau lokasi..."
                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            />
        </div>

        {{-- Collapsible Filters --}}
        <div x-data="{ 
            showAdvanced: {{ request()->hasAny(['category', 'method', 'level', 'instructor', 'month', 'start_date', 'end_date', 'min_price', 'max_price']) ? 'true' : 'false' }},
            clearFilters() {
                window.location.href = '{{ route('user.schedules') }}' + (new URLSearchParams(window.location.search).get('view') ? '?view=' + new URLSearchParams(window.location.search).get('view') : '');
            }
        }">
            {{-- Filter Toggle & Quick Actions --}}
            <div class="flex items-center justify-between">
                <button 
                    type="button" 
                    @click="showAdvanced = !showAdvanced"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"/>
                    </svg>
                    <span x-text="showAdvanced ? 'Sembunyikan Filter' : 'Tampilkan Filter'"></span>
                    <svg class="w-4 h-4 ml-1 transition-transform" :class="showAdvanced ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div class="flex items-center gap-2">
                    @if(request()->hasAny(['search', 'category', 'method', 'level', 'instructor', 'month', 'start_date', 'end_date', 'min_price', 'max_price']))
                        @php
                            $activeFilters = collect([
                                'search', 'category', 'method', 'level', 'instructor', 
                                'month', 'start_date', 'end_date', 'min_price', 'max_price'
                            ])
                            ->filter(fn($filter) => request()->filled($filter) && request($filter) !== 'all')
                            ->count();
                        @endphp
                        
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $activeFilters }} filter aktif
                        </span>
                        
                        <button 
                            type="button" 
                            @click="clearFilters()" 
                            class="text-sm text-red-600 hover:text-red-800 font-medium"
                        >
                            Hapus Semua
                        </button>
                    @endif

                    <button 
                        type="submit" 
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Cari
                    </button>
                </div>
            </div>
            
            {{-- Advanced Filters --}}
            <div 
                x-show="showAdvanced" 
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-2"
                class="mt-4 p-4 bg-gray-50 rounded-lg"
            >
                
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">
                    {{-- Category Filter --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Kategori</label>
                        <select name="category" class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 bg-white">
                            <option value="all">Semua</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Method Filter --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Metode</label>
                        <select name="method" class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 bg-white">
                            <option value="all">Semua</option>
                            <option value="online" {{ request('method') == 'online' ? 'selected' : '' }}>Online</option>
                            <option value="offline" {{ request('method') == 'offline' ? 'selected' : '' }}>Offline</option>
                            <option value="hybrid" {{ request('method') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                    </div>

                    {{-- Level Filter --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Level</label>
                        <select name="level" class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 bg-white">
                            <option value="all">Semua</option>
                            <option value="Beginner" {{ request('level') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                            <option value="Intermediate" {{ request('level') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="Advanced" {{ request('level') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                            <option value="Expert" {{ request('level') == 'Expert' ? 'selected' : '' }}>Expert</option>
                        </select>
                    </div>

                    {{-- Instructor Filter --}}
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-xs font-medium text-gray-600 mb-1">Instruktur</label>
                        <select name="instructor" class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 bg-white">
                            <option value="all">Semua</option>
                            @foreach($instructors as $instructor)
                                <option value="{{ $instructor->id }}" {{ request('instructor') == $instructor->id ? 'selected' : '' }}>
                                    {{ $instructor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
        </div>
        {{-- Keep current view mode --}}
        <input type="hidden" name="view" value="{{ $viewMode }}">
    </form>
</div>