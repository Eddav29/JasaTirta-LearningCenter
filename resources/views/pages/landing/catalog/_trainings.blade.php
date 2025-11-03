{{-- Training Cards Grid Section --}}
<section class="pb-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Training Cards Grid --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
            @forelse($trainings as $training)
                @php
                // Get next schedule
                $nextSchedule = $training->schedules->where('status', 'buka_pendaftaran')->first();
                $availableSlots = $nextSchedule?->available_slots ?? 0;
                $totalSlots = $nextSchedule?->total_slots ?? $training->capacity ?? 20;
                
                // Calculate availability
                $percentage = $totalSlots > 0 ? ($availableSlots / $totalSlots) * 100 : 0;
                if ($percentage > 50) {
                    $availabilityColor = 'text-green-600';
                    $availabilityText = 'Tersedia';
                } elseif ($percentage > 20) {
                    $availabilityColor = 'text-orange-600';
                    $availabilityText = 'Terbatas';
                } else {
                    $availabilityColor = 'text-red-600';
                    $availabilityText = 'Hampir Penuh';
                }

                $typeLabels = [
                    'offline' => 'Tatap Muka',
                    'online' => 'Daring',
                    'hybrid' => 'Hybrid'
                ];

                $typeBadgeColors = [
                    'offline' => 'bg-blue-100 text-blue-800',
                    'online' => 'bg-purple-100 text-purple-800',
                    'hybrid' => 'bg-green-100 text-green-800'
                ];
                @endphp

                <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    {{-- Image --}}
                    <div class="aspect-video overflow-hidden relative bg-linear-to-br from-blue-500 to-blue-700">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="h-16 w-16 text-white/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                    </div>
                    
                    {{-- Card Header --}}
                    <div class="p-6 pb-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $training->category->name }}
                            </span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $typeBadgeColors[$training->training_type] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $typeLabels[$training->training_type] ?? 'Hybrid' }}
                            </span>
                        </div>
                        <h3 class="text-lg font-semibold leading-tight line-clamp-2 text-gray-900 mb-2">
                            {{ $training->title }}
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                            {{ $training->description }}
                        </p>
                    </div>
                    
                    {{-- Card Content --}}
                    <div class="px-6 pb-6 space-y-4">
                        {{-- Rating and Reviews --}}
                        <div class="flex items-center space-x-2 text-sm">
                            <div class="flex items-center space-x-1">
                                <svg class="h-4 w-4 fill-yellow-400 text-yellow-400" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="font-medium">{{ number_format($training->rating ?? 4.5, 1) }}</span>
                            </div>
                            <span class="text-gray-500">({{ $training->review_count ?? 0 }} ulasan)</span>
                            @if($training->learning_hours)
                                <span class="text-gray-500">•</span>
                                <span class="text-gray-500">{{ $training->learning_hours }} JP</span>
                            @endif
                        </div>

                        <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                            <div class="flex items-center space-x-2">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ $training->duration }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <span>{{ $training->capacity ?? 20 }} peserta</span>
                            </div>
                            @if($nextSchedule)
                            <div class="flex items-center space-x-2">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ \Carbon\Carbon::parse($nextSchedule->start_date)->format('d M') }}</span>
                            </div>
                            @endif
                            <div class="flex items-center space-x-2">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="truncate">{{ $nextSchedule?->location ?? 'TBA' }}</span>
                            </div>
                        </div>

                        {{-- Availability Status --}}
                        @if($nextSchedule)
                        <div class="flex items-center justify-between text-xs">
                            <span class="font-medium {{ $availabilityColor }}">
                                {{ $availabilityText }}
                            </span>
                            <span class="text-gray-500">
                                {{ $availableSlots }} dari {{ $totalSlots }} slot tersisa
                            </span>
                        </div>
                        @endif
                        
                        <div class="border-t pt-4">
                            <div class="flex flex-col space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-2xl font-bold text-blue-600">Rp {{ number_format($training->price ?? 0, 0, ',', '.') }}</span>
                                    <span class="text-sm text-gray-500">per peserta</span>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <a href="#" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                                        Detail
                                    </a>
                                    <a href="#" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition {{ $availableSlots === 0 ? 'opacity-50 cursor-not-allowed' : '' }}">
                                        {{ $availableSlots === 0 ? 'Penuh' : 'Daftar' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada pelatihan</h3>
                    <p class="mt-1 text-sm text-gray-500">Pelatihan baru akan segera ditambahkan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
