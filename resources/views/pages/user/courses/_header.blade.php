{{-- Header Section --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Kursus Saya</h1>
        <p class="text-gray-600 mt-1">Kelola dan lanjutkan pembelajaran Anda</p>
    </div>
    <a href="{{ route('user.catalog') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Jelajahi Kursus Baru
    </a>
</div>
