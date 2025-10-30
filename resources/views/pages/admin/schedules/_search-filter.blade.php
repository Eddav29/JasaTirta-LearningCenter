{{-- Search and Filter Section --}}
@php
    $uniqueInstructors = ['Dr. Sarah Wijaya', 'Muhammad Rizki, S.T.', 'Dr. Lisa Chen', 'Ahmad Fadli, M.Sc.'];
    $uniqueMonths = ['Oktober', 'November', 'Desember'];
@endphp

<div class="space-y-4">
    <div class="flex flex-col sm:flex-row gap-4">
        {{-- Search Box --}}
        <div class="relative flex-1">
            <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input
                type="text"
                x-model="searchQuery"
                placeholder="Cari jadwal, pelatihan, atau instructor..."
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
        </div>

        {{-- Filters --}}
        <div class="flex gap-2 flex-wrap">
            {{-- Status Filter --}}
            <select x-model="statusFilter" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="all">Semua Status</option>
                <option value="Scheduled">Terjadwal</option>
                <option value="Ongoing">Berlangsung</option>
                <option value="Completed">Selesai</option>
                <option value="Cancelled">Dibatalkan</option>
            </select>

            {{-- Method Filter --}}
            <select x-model="methodFilter" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="all">Semua Metode</option>
                <option value="Online">Online</option>
                <option value="Offline">Offline</option>
                <option value="Hybrid">Hybrid</option>
            </select>

            {{-- Instructor Filter --}}
            <select x-model="instructorFilter" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="all">Semua Instructor</option>
                @foreach($uniqueInstructors as $instructor)
                    <option value="{{ $instructor }}">{{ $instructor }}</option>
                @endforeach
            </select>

            {{-- Month Filter --}}
            <select x-model="monthFilter" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="all">Semua Bulan</option>
                @foreach($uniqueMonths as $month)
                    <option value="{{ $month }}">{{ $month }}</option>
                @endforeach
            </select>

            {{-- Add Schedule Button --}}
            <a href="{{ route('admin.schedules.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors whitespace-nowrap">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Jadwal
            </a>
        </div>
    </div>
</div>
