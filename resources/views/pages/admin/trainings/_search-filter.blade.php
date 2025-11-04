{{-- Search and Filter Section --}}
<div class="bg-white p-6 rounded-lg border border-gray-200">
    <form method="GET" action="{{ route('admin.trainings.index') }}" class="space-y-4">
        {{-- Header Section --}}
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Filter & Pencarian</h3>
                <p class="text-sm text-gray-600 mt-1">Cari dan filter pelatihan sesuai kebutuhan</p>
            </div>
            {{-- Active Filters Indicator --}}
            @if(request()->hasAny(['search', 'category', 'level', 'status', 'instructor']))
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        {{ collect(['search', 'category', 'level', 'status', 'instructor'])->filter(fn($key) => request($key) && request($key) !== 'all' && request($key) !== '')->count() }} Filter Aktif
                    </span>
                </div>
            @endif
        </div>

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
                placeholder="Cari berdasarkan judul, deskripsi, kategori, atau nama instructor..."
                class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
            />
        </div>

        {{-- Filters Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            {{-- Category Filter --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="category" class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="all">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Level Filter --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Level</label>
                <select name="level" class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="all">Semua Level</option>
                    <option value="Beginner" {{ request('level') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                    <option value="Intermediate" {{ request('level') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                    <option value="Advanced" {{ request('level') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                    <option value="Expert" {{ request('level') == 'Expert' ? 'selected' : '' }}>Expert</option>
                </select>
            </div>

            {{-- Status Filter --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            {{-- Instructor Filter --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Instructor</label>
                <select name="instructor" class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="all">Semua Instructor</option>
                    @foreach($instructors as $instructor)
                        <option value="{{ $instructor->id }}" {{ request('instructor') == $instructor->id ? 'selected' : '' }}>
                            {{ $instructor->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
            <div class="flex items-center gap-3">
                {{-- Search Button --}}
                <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari & Filter
                </button>

                {{-- Reset Button --}}
                @if(request()->hasAny(['search', 'category', 'level', 'status', 'instructor']))
                    <a href="{{ route('admin.trainings.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Reset Filter
                    </a>
                @endif
            </div>

            {{-- Add Training Button --}}
            <a href="{{ route('admin.trainings.create') }}" class="inline-flex items-center px-6 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Pelatihan
            </a>
        </div>
    </form>
</div>
