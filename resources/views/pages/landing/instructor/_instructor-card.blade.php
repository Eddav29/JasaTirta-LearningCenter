{{-- Instructor Card Component --}}
<div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
    {{-- Card Header --}}
    <div class="p-6">
        <div class="flex items-start space-x-4">
            {{-- Avatar --}}
            <div class="w-20 h-20 bg-linear-to-br from-blue-500 to-blue-700 rounded-full flex items-center justify-center text-white font-bold text-xl flex-shrink-0">
                @php
                    $initials = collect(explode(' ', $instructor['name']))
                        ->take(2)
                        ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                        ->join('');
                @endphp
                {{ $initials }}
            </div>
            
            {{-- Info --}}
            <div class="flex-1">
                <h3 class="text-lg font-semibold text-gray-900">{{ $instructor['name'] }}</h3>
                <p class="font-medium text-blue-600 mb-2">
                    {{ $instructor['specialization'] }}
                </p>
                
                @if($isVendor && isset($instructor['company']))
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-300 mb-2">
                        {{ $instructor['company'] }}
                    </span>
                @endif
                
                <div class="flex flex-wrap gap-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                        <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $instructor['experience'] }}
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                        <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        {{ $instructor['education'] }}
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Card Content --}}
    <div class="px-6 pb-6 space-y-4">
        {{-- Bio --}}
        <p class="text-sm text-gray-600 leading-relaxed">
            {{ $instructor['bio'] }}
        </p>
        
        {{-- Certifications --}}
        <div>
            <h4 class="font-medium text-sm mb-2 flex items-center text-gray-900">
                <svg class="w-4 h-4 mr-2 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                </svg>
                Sertifikasi
            </h4>
            <div class="flex flex-wrap gap-1">
                @foreach($instructor['certifications'] as $cert)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200">
                        {{ $cert }}
                    </span>
                @endforeach
            </div>
        </div>

        {{-- Courses --}}
        <div>
            <h4 class="font-medium text-sm mb-2 flex items-center text-gray-900">
                <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Program Pelatihan
            </h4>
            <div class="space-y-1">
                @foreach($instructor['courses'] as $course)
                    <div class="text-xs text-gray-600">
                        • {{ $course }}
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Contact --}}
        <div class="border-t pt-4">
            <div class="flex flex-col space-y-2 text-xs text-gray-600">
                <div class="flex items-center space-x-2">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span>{{ $instructor['email'] }}</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <span>{{ $instructor['phone'] }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
