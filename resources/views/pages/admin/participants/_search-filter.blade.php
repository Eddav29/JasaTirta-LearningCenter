<div class="bg-white p-6 rounded-lg border border-gray-200">
    <div class="flex flex-col lg:flex-row gap-4 items-center justify-between">
        <div class="flex items-center gap-4 w-full lg:w-auto">
            <div class="relative flex-1 lg:w-80">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input
                    type="text"
                    x-model="searchQuery"
                    placeholder="Cari nama, email, atau perusahaan..."
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                />
            </div>
        </div>

        <div class="flex items-center gap-2 flex-wrap shrink-0">
            <select x-model="roleFilter" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                <option value="all">Semua Role</option>
                <option value="Student">Student</option>
                <option value="Corporate">Corporate</option>
                <option value="Instructor">Instructor</option>
                <option value="Admin">Admin</option>
            </select>
            
            <select x-model="statusFilter" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                <option value="all">Semua Status</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
                <option value="Suspended">Suspended</option>
                <option value="Pending">Pending</option>
            </select>

            <a href="{{ route('admin.participants.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors whitespace-nowrap shrink-0">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Peserta
            </a>
        </div>
    </div>
</div>
