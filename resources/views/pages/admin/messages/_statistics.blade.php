<div x-init="messages = []" class="grid gap-4 md:grid-cols-2 lg:grid-cols-5">
    <!-- Total Messages -->
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-sm font-medium text-gray-600">Total Pesan</h3>
            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
            </div>
        </div>
        <div class="text-2xl font-bold text-gray-900" x-text="stats.totalMessages"></div>
        <p class="text-xs text-gray-500 mt-1">Semua pesan masuk</p>
    </div>

    <!-- New Messages -->
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-sm font-medium text-gray-600">Pesan Baru</h3>
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>
        <div class="text-2xl font-bold text-blue-600" x-text="stats.newCount"></div>
        <p class="text-xs text-gray-500 mt-1">Belum dibaca</p>
    </div>

    <!-- Replied Messages -->
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-sm font-medium text-gray-600">Dibalas</h3>
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                </svg>
            </div>
        </div>
        <div class="text-2xl font-bold text-purple-600" x-text="stats.repliedCount"></div>
        <p class="text-xs text-gray-500 mt-1">Sudah direspon</p>
    </div>

    <!-- Resolved Messages -->
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-sm font-medium text-gray-600">Diselesaikan</h3>
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <div class="text-2xl font-bold text-green-600" x-text="stats.resolvedCount"></div>
        <p class="text-xs text-gray-500 mt-1">Kasus tertutup</p>
    </div>

    <!-- Average Response Time -->
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-sm font-medium text-gray-600">Avg Response</h3>
            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <div class="text-2xl font-bold text-gray-900">
            <span x-text="stats.avgResponseTime"></span><span class="text-lg">h</span>
        </div>
        <p class="text-xs text-gray-500 mt-1">Waktu respons rata-rata</p>
    </div>
</div>
