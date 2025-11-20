{{-- Header Section --}}
<div class="bg-linear-to-r from-blue-700 to-blue-800 text-white py-12 mb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold mb-2">Katalog Kursus</h1>
                <p class="text-blue-100 text-lg">
                    Jelajahi <span x-text="allCourses.length"></span> kursus berkualitas untuk pengembangan karir Anda
                </p>
            </div>
            
            {{-- View Mode Toggle --}}
            <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-lg p-1">
                <button 
                    @click="viewMode = 'grid'"
                    :class="viewMode === 'grid' ? 'bg-white text-blue-700' : 'text-white hover:bg-white/20'"
                    class="px-4 py-2 rounded-md transition-colors font-medium flex items-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                    Grid
                </button>
                <button 
                    @click="viewMode = 'list'"
                    :class="viewMode === 'list' ? 'bg-white text-blue-700' : 'text-white hover:bg-white/20'"
                    class="px-4 py-2 rounded-md transition-colors font-medium flex items-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    List
                </button>
            </div>
        </div>
    </div>
</div>
