{{-- Recent Activities and Popular Trainings Section --}}

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    {{-- Recent Activities Card --}}
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Aktivitas Terbaru</h3>
                    <p class="text-sm text-gray-600 mt-1">Aktivitas sistem dalam 24 jam terakhir</p>
                </div>
                <button class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="p-6">
            @if($recentActivities->count() > 0)
                <div class="space-y-4">
                    @foreach($recentActivities as $schedule)
                        @php
                            $activityConfig = match($schedule->status) {
                                'scheduled' => [
                                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
                                    'color' => 'text-blue-600',
                                    'title' => 'Jadwal Terbaru'
                                ],
                                'ongoing' => [
                                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                                    'color' => 'text-green-600',
                                    'title' => 'Sedang Berlangsung'
                                ],
                                'completed' => [
                                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>',
                                    'color' => 'text-purple-600',
                                    'title' => 'Pelatihan Selesai'
                                ],
                                'cancelled' => [
                                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>',
                                    'color' => 'text-red-600',
                                    'title' => 'Dibatalkan'
                                ],
                                default => [
                                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                                    'color' => 'text-gray-600',
                                    'title' => 'Update Jadwal'
                                ]
                            };
                        @endphp
                        <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="p-2 rounded-full bg-gray-100 {{ $activityConfig['color'] }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    {!! $activityConfig['icon'] !!}
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-sm text-gray-900">{{ $activityConfig['title'] }}</p>
                                <p class="text-sm text-gray-600 truncate">{{ $schedule->training->title }} - {{ $schedule->start_date->format('d M Y') }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $schedule->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <p class="mt-2 text-sm text-gray-600">Belum ada aktivitas terbaru</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Popular Trainings Card --}}
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-900">Pelatihan Terpopuler</h3>
            <p class="text-sm text-gray-600 mt-1">Program dengan pendaftaran tertinggi bulan ini</p>
        </div>
        <div class="p-6">
            @if($popularTrainings->count() > 0)
                <div class="space-y-4">
                    @foreach($popularTrainings as $training)
                        @php
                            $totalRegistered = $training->total_registered ?? 0;
                            $totalCapacity = $training->schedules->sum('total_slots');
                            $percentage = $totalCapacity > 0 ? ($totalRegistered / $totalCapacity) * 100 : 0;
                            $revenue = $totalRegistered * $training->price;
                            $formattedRevenue = $revenue >= 1000000 
                                ? 'Rp ' . number_format($revenue / 1000000, 1) . ($revenue >= 1000000000 ? 'M' : 'jt')
                                : 'Rp ' . number_format($revenue, 0, ',', '.');
                            
                            $status = $percentage >= 100 ? 'full' : ($percentage >= 80 ? 'almost_full' : 'active');
                        @endphp
                        <div class="p-4 rounded-lg border border-gray-200 hover:border-blue-200 transition-colors">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="font-medium text-gray-900 text-sm">{{ $training->title }}</h4>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ match($status) {
                                    'full' => 'bg-red-100 text-red-800',
                                    'almost_full' => 'bg-yellow-100 text-yellow-800',
                                    default => 'bg-green-100 text-green-800'
                                } }}">
                                    {{ match($status) {
                                        'full' => 'Penuh',
                                        'almost_full' => 'Hampir Penuh',
                                        default => 'Aktif'
                                    } }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between text-sm text-gray-600 mb-3">
                                <span>{{ $totalRegistered }}/{{ $totalCapacity }} peserta</span>
                                <span class="font-medium text-blue-600">{{ $training->schedules->count() }} jadwal</span>
                            </div>
                            {{-- Progress Bar --}}
                            <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ min($percentage, 100) }}%"></div>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Pendapatan</span>
                                <span class="font-medium text-gray-900">{{ $formattedRevenue }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <p class="mt-2 text-sm text-gray-600">Belum ada data pelatihan</p>
                </div>
            @endif
        </div>
    </div>
</div>
