{{-- Statistics Cards Section --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    {{-- Total Users --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Total Pengguna</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($stats['total_users']['current']) }}</p>
                <div class="flex items-center mt-2">
                    @if($stats['total_users']['change_type'] === 'increase')
                        <svg class="w-4 h-4 text-green-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    @else
                        <svg class="w-4 h-4 text-red-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
                        </svg>
                    @endif
                    <span class="text-sm font-medium {{ $stats['total_users']['change_type'] === 'increase' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $stats['total_users']['percentage'] > 0 ? '+' : '' }}{{ $stats['total_users']['percentage'] }}%
                    </span>
                    <span class="text-sm text-gray-500 ml-1">dari bulan lalu</span>
                </div>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- Active Trainings --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Pelatihan Aktif</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($stats['active_trainings']['current']) }}</p>
                <div class="flex items-center mt-2">
                    @if($stats['active_trainings']['change_type'] === 'increase')
                        <svg class="w-4 h-4 text-green-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    @else
                        <svg class="w-4 h-4 text-red-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
                        </svg>
                    @endif
                    <span class="text-sm font-medium {{ $stats['active_trainings']['change_type'] === 'increase' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $stats['active_trainings']['change'] > 0 ? '+' : '' }}{{ $stats['active_trainings']['change'] }}
                    </span>
                    <span class="text-sm text-gray-500 ml-1">program berjalan</span>
                </div>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- Monthly Schedules --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Jadwal Bulan Ini</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($stats['monthly_schedules']['current']) }}</p>
                <div class="flex items-center mt-2">
                    @if($stats['monthly_schedules']['change_type'] === 'increase')
                        <svg class="w-4 h-4 text-green-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    @else
                        <svg class="w-4 h-4 text-red-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
                        </svg>
                    @endif
                    <span class="text-sm font-medium {{ $stats['monthly_schedules']['change_type'] === 'increase' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $stats['monthly_schedules']['change'] > 0 ? '+' : '' }}{{ $stats['monthly_schedules']['change'] }}
                    </span>
                    <span class="text-sm text-gray-500 ml-1">sesi terjadwal</span>
                </div>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- Revenue --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Pendapatan</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">
                    @if($stats['total_revenue']['current'] >= 1000000000)
                        Rp {{ number_format($stats['total_revenue']['current'] / 1000000, 0) }}M
                    @elseif($stats['total_revenue']['current'] >= 1000000)
                        Rp {{ number_format($stats['total_revenue']['current'] / 1000000, 1) }}jt
                    @else
                        Rp {{ number_format($stats['total_revenue']['current']) }}
                    @endif
                </p>
                <div class="flex items-center mt-2">
                    @if($stats['total_revenue']['change_type'] === 'increase')
                        <svg class="w-4 h-4 text-green-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    @else
                        <svg class="w-4 h-4 text-red-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
                        </svg>
                    @endif
                    <span class="text-sm font-medium {{ $stats['total_revenue']['change_type'] === 'increase' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $stats['total_revenue']['percentage'] > 0 ? '+' : '' }}{{ $stats['total_revenue']['percentage'] }}%
                    </span>
                    <span class="text-sm text-gray-500 ml-1">dari bulan lalu</span>
                </div>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>
</div>
