{{-- Search and Filter Section --}}
<div class="mt-6 bg-white p-6 rounded-lg border border-gray-200">
    <form method="GET" action="{{ route('admin.participants.index') }}" class="flex flex-col lg:flex-row gap-4 items-center justify-between" x-data="{ searchTimeout: null }">
        <div class="flex items-center gap-4 w-full lg:w-auto">
            <div class="relative flex-1 lg:w-80">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama, email, atau telepon..."
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    @input="clearTimeout(searchTimeout); searchTimeout = setTimeout(() => $el.form.submit(), 500)"
                />
            </div>
        </div>

        <div class="flex items-center gap-2 flex-wrap shrink-0">
            <select name="role" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" onchange="this.form.submit()">
                <option value="all">Semua Role</option>
                <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Student</option>
                <option value="corporate" {{ request('role') == 'corporate' ? 'selected' : '' }}>Corporate</option>
                <option value="participant" {{ request('role') == 'participant' ? 'selected' : '' }}>Participant</option>
                <option value="instructor" {{ request('role') == 'instructor' ? 'selected' : '' }}>Instructor</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            
            <select name="status" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>

            {{-- Reset Button --}}
            @if(request()->hasAny(['search', 'role', 'status']))
                <a href="{{ route('admin.participants.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Reset
                </a>
            @endif

            <a href="{{ route('admin.participants.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors whitespace-nowrap shrink-0">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Peserta
            </a>
        </div>
    </form>
</div>
