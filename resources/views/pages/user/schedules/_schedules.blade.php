{{-- Schedules List --}}
@php
    use Illuminate\Support\Facades\Storage;
    
    function getMethodColor($method) {
        return match(strtolower($method)) {
            'online' => 'bg-green-100 text-green-800',
            'offline' => 'bg-blue-100 text-blue-800',
            'hybrid' => 'bg-purple-100 text-purple-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    function getLevelColor($level) {
        return match($level) {
            'Beginner' => 'bg-green-100 text-green-800',
            'Intermediate' => 'bg-yellow-100 text-yellow-800',
            'Advanced' => 'bg-orange-100 text-orange-800',
            'Expert' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }
@endphp

<div class="space-y-6">
    {{-- Results Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-semibold text-gray-900">
                @if(isset($schedules) && is_object($schedules) && method_exists($schedules, 'total'))
                    {{ $schedules->total() }} jadwal ditemukan
                @else
                    {{ isset($schedules) ? count($schedules) : 0 }} jadwal ditemukan
                @endif
            </h2>
            @if(request()->hasAny(['search', 'category', 'method', 'level', 'instructor', 'month', 'start_date', 'end_date', 'min_price', 'max_price']))
                <p class="text-sm text-gray-600 mt-1">Hasil pencarian dengan filter yang diterapkan</p>
            @endif
        </div>
    </div>

    {{-- Schedules Grid/List --}}
    @if($schedules->count() > 0)
        <div x-show="viewMode === 'grid'" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($schedules as $schedule)
                <div class="bg-white rounded-lg border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-200 overflow-hidden">
                    {{-- Training Image --}}
                    <div class="relative h-48 bg-gradient-to-br from-blue-500 to-purple-600">
                        @if($schedule->training->image)
                            <img src="{{ Storage::url($schedule->training->image) }}" 
                                 alt="{{ $schedule->training->title }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h1a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                        @endif
                        
                        {{-- Badges Overlay --}}
                        <div class="absolute top-3 left-3 right-3 flex justify-between items-start">
                            <div class="space-y-2">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ getMethodColor($schedule->method) }}">
                                    {{ ucfirst($schedule->method) }}
                                </span>
                                @if($schedule->training->training_type)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ getLevelColor($schedule->training->training_type) }}">
                                        {{ $schedule->training->training_type }}
                                    </span>
                                @endif
                            </div>
                            
                            {{-- Available Slots Badge --}}
                            <div class="bg-white bg-opacity-90 rounded-lg px-2 py-1">
                                <span class="text-xs font-medium text-gray-700">
                                    {{ $schedule->available_slots }}/{{ $schedule->total_slots }} slot
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        {{-- Training Title --}}
                        <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                            <a href="{{ route('user.schedules.show', $schedule) }}" class="hover:text-blue-600 transition-colors">
                                {{ $schedule->training->title }}
                            </a>
                        </h3>

                        {{-- Instructor --}}
                        <div class="flex items-center text-sm text-gray-600 mb-3">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            {{ $schedule->training->instructor->name }}
                        </div>

                        {{-- Schedule Info --}}
                        <div class="space-y-2 mb-4">
                            {{-- Date & Time --}}
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>{{ $schedule->formatted_date_range }}</span>
                            </div>

                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>{{ $schedule->formatted_time_range }}</span>
                            </div>

                            {{-- Location --}}
                            @if($schedule->method !== 'online')
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="line-clamp-1">{{ $schedule->location }}</span>
                                </div>
                            @endif
                        </div>

                        {{-- Price and Action --}}
                        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                            <div class="text-lg font-bold text-gray-900">
                                @if($schedule->training->price > 0)
                                    Rp {{ number_format($schedule->training->price, 0, ',', '.') }}
                                @else
                                    <span class="text-green-600">Gratis</span>
                                @endif
                            </div>
                            
                            <a href="{{ route('user.schedules.show', $schedule) }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                Lihat Detail
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- List View --}}
        <div x-show="viewMode === 'list'" class="space-y-4">
            @foreach($schedules as $schedule)
                <div class="bg-white rounded-lg border border-gray-200 hover:border-gray-300 hover:shadow-md transition-all duration-200 p-6">
                    <div class="flex items-start gap-6">
                        {{-- Training Image --}}
                        <div class="relative w-24 h-24 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg overflow-hidden flex-shrink-0">
                            @if($schedule->training->image)
                                <img src="{{ Storage::url($schedule->training->image) }}" 
                                     alt="{{ $schedule->training->title }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-8 h-8 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h1a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">
                                        <a href="{{ route('user.schedules.show', $schedule) }}" class="hover:text-blue-600 transition-colors">
                                            {{ $schedule->training->title }}
                                        </a>
                                    </h3>
                                    
                                    <div class="flex items-center text-sm text-gray-600 mb-2">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        {{ $schedule->training->instructor->name }}
                                    </div>

                                    {{-- Badges --}}
                                    <div class="flex flex-wrap gap-2 mb-3">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ getMethodColor($schedule->method) }}">
                                            {{ ucfirst($schedule->method) }}
                                        </span>
                                        @if($schedule->training->training_type)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ getLevelColor($schedule->training->training_type) }}">
                                                {{ $schedule->training->training_type }}
                                            </span>
                                        @endif
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $schedule->available_slots }}/{{ $schedule->total_slots }} slot
                                        </span>
                                    </div>
                                </div>

                                {{-- Price --}}
                                <div class="text-right ml-6">
                                    <div class="text-lg font-bold text-gray-900 mb-2">
                                        @if($schedule->training->price > 0)
                                            Rp {{ number_format($schedule->training->price, 0, ',', '.') }}
                                        @else
                                            <span class="text-green-600">Gratis</span>
                                        @endif
                                    </div>
                                    
                                    <a href="{{ route('user.schedules.show', $schedule) }}" 
                                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                        Lihat Detail
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            {{-- Schedule Info --}}
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-sm text-gray-600">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>{{ $schedule->formatted_date_range }}</span>
                                </div>

                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $schedule->formatted_time_range }}</span>
                                </div>

                                @if($schedule->method !== 'online')
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span class="line-clamp-1">{{ $schedule->location }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if(isset($schedules) && is_object($schedules) && method_exists($schedules, 'hasPages') && $schedules->hasPages())
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <div class="text-sm text-gray-600">
                    Menampilkan {{ $schedules->firstItem() }} - {{ $schedules->lastItem() }} dari {{ $schedules->total() }} jadwal
                </div>
                <div class="flex items-center gap-2">
                    {{ $schedules->links() }}
                </div>
            </div>
        @endif
        
    @else
        {{-- Empty State --}}
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada jadwal ditemukan</h3>
            <p class="text-gray-600 mb-6">Tidak ditemukan jadwal pelatihan yang sesuai dengan kriteria pencarian Anda.</p>
            
            @if(request()->hasAny(['search', 'category', 'method', 'level', 'instructor', 'month', 'start_date', 'end_date', 'min_price', 'max_price']))
                <button @click="clearFilters()" 
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Hapus Filter dan Coba Lagi
                </button>
            @else
                <a href="{{ route('user.catalog') }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h1a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    Jelajahi Katalog Pelatihan
                </a>
            @endif
        </div>
    @endif
</div>