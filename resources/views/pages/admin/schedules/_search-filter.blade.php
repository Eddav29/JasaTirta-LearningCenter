{{-- Search and Filter Section --}}
<div class="bg-white rounded-lg border border-gray-200">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900 mb-1">Filter & Pencarian</h3>
        <p class="text-sm text-gray-600">Temukan jadwal dengan filter dan pencarian yang sesuai</p>
    </div>
    
    <form method="GET" action="{{ route('admin.schedules.index') }}" class="p-6 space-y-4">
        {{-- Search Bar --}}
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
                placeholder="Cari berdasarkan nama pelatihan, instructor, atau lokasi..."
                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
            />
        </div>

        {{-- Filter Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            {{-- Status Filter --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm bg-white"
                        onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="buka_pendaftaran" {{ request('status') == 'buka_pendaftaran' ? 'selected' : '' }}>Buka Pendaftaran</option>
                    <option value="penuh" {{ request('status') == 'penuh' ? 'selected' : '' }}>Penuh</option>
                    <option value="berlangsung" {{ request('status') == 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>

            {{-- Method Filter --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Metode</label>
                <select name="method" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm bg-white"
                        onchange="this.form.submit()">
                    <option value="">Semua Metode</option>
                    <option value="online" {{ request('method') == 'online' ? 'selected' : '' }}>Online</option>
                    <option value="offline" {{ request('method') == 'offline' ? 'selected' : '' }}>Offline</option>
                    <option value="hybrid" {{ request('method') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                </select>
            </div>

            {{-- Instructor Filter --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Instructor</label>
                <select name="instructor_id" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm bg-white"
                        onchange="this.form.submit()">
                    <option value="">Semua Instructor</option>
                    @if(isset($instructors))
                        @foreach($instructors as $instructor)
                            <option value="{{ $instructor->id }}" {{ request('instructor_id') == $instructor->id ? 'selected' : '' }}>
                                {{ $instructor->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            {{-- Month Filter --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
                <select name="month" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm bg-white"
                        onchange="this.form.submit()">
                    <option value="">Semua Bulan</option>
                    @for($i = 1; $i <= 12; $i++)
                        @php
                            $month = date('Y-m', mktime(0, 0, 0, $i, 1, date('Y')));
                            $monthName = date('F Y', mktime(0, 0, 0, $i, 1, date('Y')));
                        @endphp
                        <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                            {{ $monthName }}
                        </option>
                    @endfor
                </select>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
            <div class="flex items-center gap-3">
                {{-- Search Button --}}
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari
                </button>

                {{-- Clear Filter Button --}}
                @if(request()->hasAny(['search', 'status', 'method', 'instructor_id', 'month']))
                    <a href="{{ route('admin.schedules.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 text-sm font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Reset Filter
                    </a>
                @endif
            </div>

            {{-- Active Filters Indicator --}}
            @if(request()->hasAny(['search', 'status', 'method', 'instructor_id', 'month']))
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    {{ collect(['search', 'status', 'method', 'instructor_id', 'month'])->filter(fn($key) => request()->filled($key))->count() }} filter aktif
                </div>
            @endif
        </div>
    </form>
</div>

