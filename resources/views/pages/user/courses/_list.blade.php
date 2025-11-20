{{-- Course List with Tabs --}}
<div class="bg-white rounded-lg border border-gray-200" x-data="{ activeTab: 'active' }">
    {{-- Tab Headers --}}
    <div class="border-b border-gray-200">
        <nav class="flex gap-1 p-4" aria-label="Tabs">
            <button 
                @click="activeTab = 'active'"
                :class="activeTab === 'active' ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50'"
                class="px-4 py-2 text-sm font-medium rounded-lg transition-colors"
            >
                Sedang Berjalan ({{ count($activeCourses) }})
            </button>
            <button 
                @click="activeTab = 'completed'"
                :class="activeTab === 'completed' ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50'"
                class="px-4 py-2 text-sm font-medium rounded-lg transition-colors"
            >
                Selesai ({{ count($completedCourses) }})
            </button>
            <button 
                @click="activeTab = 'all'"
                :class="activeTab === 'all' ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50'"
                class="px-4 py-2 text-sm font-medium rounded-lg transition-colors"
            >
                Semua Kursus ({{ count($activeCourses) + count($completedCourses) }})
            </button>
        </nav>
    </div>

    {{-- Tab Content --}}
    <div class="p-6">
        {{-- Active Courses Tab --}}
        <div x-show="activeTab === 'active'" class="space-y-4">
            @forelse($activeCourses as $course)
                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                    <div class="flex flex-col lg:flex-row gap-4">
                        {{-- Thumbnail --}}
                        <div class="lg:w-48 shrink-0">
                            <img 
                                src="{{ $course['thumbnail'] }}" 
                                alt="{{ $course['title'] }}"
                                class="w-full h-32 lg:h-full object-cover rounded-lg"
                            />
                        </div>

                        {{-- Content --}}
                        <div class="flex-1">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <a href="{{ route('user.courses.show', $course['id']) }}" class="text-lg font-semibold text-gray-900 hover:text-blue-600 cursor-pointer">
                                        {{ $course['title'] }}
                                    </a>
                                    <p class="text-sm text-gray-600 mt-1">{{ $course['instructor'] }}</p>
                                </div>
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full shrink-0">
                                    In Progress
                                </span>
                            </div>

                            <p class="text-sm text-gray-600 mt-2 line-clamp-2">
                                {{ $course['description'] }}
                            </p>

                            {{-- Progress --}}
                            <div class="mt-4">
                                <div class="flex items-center justify-between text-sm mb-2">
                                    <span class="text-gray-600">Progress</span>
                                    <span class="font-semibold text-gray-900">{{ $course['progress'] }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 rounded-full h-2 transition-all duration-300" style="width: {{ $course['progress'] }}%"></div>
                                </div>
                            </div>

                            {{-- Meta Info & Actions --}}
                            <div class="flex flex-wrap items-center justify-between gap-4 mt-4">
                                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>{{ $course['completedLessons'] }} dari {{ $course['totalLessons'] }} pelajaran</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                        <span>Next: {{ $course['nextLesson'] }}</span>
                                    </div>
                                </div>

                                <a href="{{ route('user.courses.show', $course['id']) }}" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                    Lanjutkan Belajar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada kursus yang sedang berjalan</h3>
                    <p class="text-gray-500 mb-4">Mulai belajar dengan mengikuti kursus baru</p>
                    <a href="{{ route('user.catalog') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        Jelajahi Katalog Kursus
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Completed Courses Tab --}}
        <div x-show="activeTab === 'completed'" class="space-y-4" style="display: none;">
            @forelse($completedCourses as $course)
                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow bg-green-50/30">
                    <div class="flex flex-col lg:flex-row gap-4">
                        <div class="lg:w-48 shrink-0">
                            <img 
                                src="{{ $course['thumbnail'] }}" 
                                alt="{{ $course['title'] }}"
                                class="w-full h-32 lg:h-full object-cover rounded-lg"
                            />
                        </div>

                        <div class="flex-1">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <a href="{{ route('user.courses.show', $course['id']) }}" class="text-lg font-semibold text-gray-900 hover:text-blue-600 cursor-pointer">
                                        {{ $course['title'] }}
                                    </a>
                                    <p class="text-sm text-gray-600 mt-1">{{ $course['instructor'] }}</p>
                                </div>
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full shrink-0">
                                    Completed
                                </span>
                            </div>

                            <p class="text-sm text-gray-600 mt-2 line-clamp-2">
                                {{ $course['description'] }}
                            </p>

                            <div class="mt-4">
                                <div class="flex items-center justify-between text-sm mb-2">
                                    <span class="text-gray-600">Progress</span>
                                    <span class="font-semibold text-green-600">{{ $course['progress'] }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-600 rounded-full h-2 transition-all duration-300" style="width: {{ $course['progress'] }}%"></div>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center justify-between gap-4 mt-4">
                                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-green-600 font-medium">Selesai pada {{ $course['completedDate'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        <span>Score: {{ $course['score'] }}/100</span>
                                    </div>
                                </div>

                                <div class="flex gap-2">
                                    @if($course['hasCertificate'])
                                        <button class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                                            Lihat Sertifikat
                                        </button>
                                    @endif
                                    <a href="{{ route('user.courses.show', $course['id']) }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                                        Review Materi
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada kursus yang diselesaikan</h3>
                    <p class="text-gray-500">Selesaikan kursus Anda untuk mendapatkan sertifikat</p>
                </div>
            @endforelse
        </div>

        {{-- All Courses Tab --}}
        <div x-show="activeTab === 'all'" class="space-y-4" style="display: none;">
            <div class="space-y-6">
                @if(count($activeCourses) > 0)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Sedang Berjalan</h3>
                        <div class="space-y-4">
                            @foreach($activeCourses as $course)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                    {{-- Same structure as active tab --}}
                                    <div class="flex flex-col lg:flex-row gap-4">
                                        <div class="lg:w-48 shrink-0">
                                            <img 
                                                src="{{ $course['thumbnail'] }}" 
                                                alt="{{ $course['title'] }}"
                                                class="w-full h-32 lg:h-full object-cover rounded-lg"
                                            />
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-start justify-between gap-4">
                                                <div>
                                                    <a href="{{ route('user.courses.show', $course['id']) }}" class="text-lg font-semibold text-gray-900 hover:text-blue-600">
                                                        {{ $course['title'] }}
                                                    </a>
                                                    <p class="text-sm text-gray-600 mt-1">{{ $course['instructor'] }}</p>
                                                </div>
                                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full shrink-0">In Progress</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(count($completedCourses) > 0)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Selesai</h3>
                        <div class="space-y-4">
                            @foreach($completedCourses as $course)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow bg-green-50/30">
                                    <div class="flex flex-col lg:flex-row gap-4">
                                        <div class="lg:w-48 shrink-0">
                                            <img 
                                                src="{{ $course['thumbnail'] }}" 
                                                alt="{{ $course['title'] }}"
                                                class="w-full h-32 lg:h-full object-cover rounded-lg"
                                            />
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-start justify-between gap-4">
                                                <div>
                                                    <a href="{{ route('user.courses.show', $course['id']) }}" class="text-lg font-semibold text-gray-900 hover:text-blue-600">
                                                        {{ $course['title'] }}
                                                    </a>
                                                    <p class="text-sm text-gray-600 mt-1">{{ $course['instructor'] }}</p>
                                                </div>
                                                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full shrink-0">Completed</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
