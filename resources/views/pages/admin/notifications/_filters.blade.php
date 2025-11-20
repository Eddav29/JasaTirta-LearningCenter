{{-- Notifications Filters --}}
<div class="bg-white rounded-lg border border-gray-200 p-6" x-data="notificationsPageManager()">
    <div class="flex flex-col lg:flex-row gap-4">
        {{-- Search --}}
        <div class="relative flex-1">
            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input 
                type="text" 
                x-model="searchQuery"
                placeholder="Cari notifikasi, pesan, atau pembuat..." 
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
        </div>

        <div class="flex flex-wrap gap-2">
            {{-- Type Filter --}}
            <select 
                x-model="typeFilter"
                class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            >
                <option value="all">Semua Tipe</option>
                <option value="Info">Info</option>
                <option value="Warning">Warning</option>
                <option value="Success">Success</option>
                <option value="Error">Error</option>
                <option value="Announcement">Announcement</option>
            </select>

            {{-- Status Filter --}}
            <select 
                x-model="statusFilter"
                class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            >
                <option value="all">Semua Status</option>
                <option value="Draft">Draft</option>
                <option value="Scheduled">Terjadwal</option>
                <option value="Sent">Terkirim</option>
                <option value="Failed">Gagal</option>
            </select>

            {{-- Priority Filter --}}
            <select 
                x-model="priorityFilter"
                class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            >
                <option value="all">Semua Prioritas</option>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
                <option value="Urgent">Urgent</option>
            </select>

            {{-- Channel Filter --}}
            <select 
                x-model="channelFilter"
                class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            >
                <option value="all">Semua Channel</option>
                <option value="Email">Email</option>
                <option value="SMS">SMS</option>
                <option value="In-App">In-App</option>
                <option value="Push">Push</option>
                <option value="All Channels">All Channels</option>
            </select>

            {{-- Add Button --}}
            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors whitespace-nowrap">
                <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Buat Notifikasi
            </button>
        </div>
    </div>
</div>
