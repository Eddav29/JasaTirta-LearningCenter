{{-- Certificates Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Sertifikat Saya</h1>
        <p class="text-gray-600 mt-1">
            Kelola dan akses semua sertifikat pembelajaran Anda
        </p>
    </div>
    
    <div class="flex items-center gap-3">
        {{-- Verification Link --}}
        <a href="#" 
           @click="$event.preventDefault(); alert('Fitur verifikasi sertifikat akan segera tersedia!')"
           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
            Verifikasi Sertifikat
        </a>
        
        {{-- Browse Courses Link --}}
        <a href="{{ route('user.catalog') }}" 
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Ikuti Kursus Baru
        </a>
    </div>
</div>