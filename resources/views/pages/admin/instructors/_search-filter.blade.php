<div class="bg-white p-6 rounded-lg border border-gray-200">
    <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
        <div class="flex items-center gap-4 w-full md:w-auto">
            <div class="relative flex-1 md:w-80">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input
                    type="text"
                    x-model="searchQuery"
                    placeholder="Cari nama, email, atau spesialisasi..."
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                />
            </div>
        </div>
        <div class="flex items-center gap-3 w-full md:w-auto flex-shrink-0">
            <div class="flex items-center gap-2 flex-wrap">
                <select x-model="specializationFilter" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent text-sm w-48">
                    <option value="all">Semua Spesialisasi</option>
                    <option value="water quality">Water Quality</option>
                    <option value="environmental">Environmental</option>
                    <option value="microbiology">Microbiology</option>
                    <option value="chemical">Chemical Analysis</option>
                    <option value="training">Training Development</option>
                </select>
                
                <select x-model="experienceLevelFilter" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent text-sm w-40">
                    <option value="all">Semua Level</option>
                    <option value="Junior">Junior</option>
                    <option value="Senior">Senior</option>
                    <option value="Expert">Expert</option>
                    <option value="Master">Master</option>
                </select>
                
                <select x-model="statusFilter" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent text-sm w-40">
                    <option value="all">Semua Status</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                    <option value="On Leave">On Leave</option>
                    <option value="Retired">Retired</option>
                </select>
            </div>
            <a href="{{ route('admin.instructors.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors whitespace-nowrap flex-shrink-0">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Instructor
            </a>
        </div>
    </div>
</div>
