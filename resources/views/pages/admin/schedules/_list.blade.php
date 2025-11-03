{{-- Schedules List --}}
@php
    function getScheduleStatusColor($status) {
        return match($status) {
            'buka_pendaftaran' => 'bg-blue-100 text-blue-800',
            'penuh' => 'bg-yellow-100 text-yellow-800',
            'berlangsung' => 'bg-green-100 text-green-800',
            'selesai' => 'bg-gray-100 text-gray-800',
            'dibatalkan' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    function getScheduleStatusText($status) {
        return match($status) {
            'buka_pendaftaran' => 'Buka Pendaftaran',
            'penuh' => 'Penuh',
            'berlangsung' => 'Berlangsung',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
            default => ucfirst($status)
        };
    }

    function getScheduleMethodColor($method) {
        return match(strtolower($method)) {
            'online' => 'bg-green-100 text-green-800',
            'offline' => 'bg-blue-100 text-blue-800',
            'hybrid' => 'bg-purple-100 text-purple-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }
@endphp

<div class="bg-white rounded-lg border border-gray-200">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-bold text-gray-900">Daftar Jadwal</h3>
        <p class="text-sm text-gray-600 mt-1">
            @if(isset($schedules) && is_object($schedules) && method_exists($schedules, 'total'))
                {{ $schedules->total() }} jadwal ditemukan
            @else
                {{ isset($schedules) ? count($schedules) : 0 }} jadwal ditemukan
            @endif
        </p>
    </div>

    <div class="p-6">
        <div class="space-y-4">
            @forelse($schedules as $schedule)
                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start gap-3 flex-1">
                            {{-- Checkbox --}}
                            <input 
                                type="checkbox"
                                value="{{ $schedule->id }}"
                                x-model="selectedSchedules"
                                class="w-4 h-4 mt-1 text-blue-600 rounded focus:ring-blue-500"
                            />

                            <div class="space-y-2 flex-1">
                                {{-- Title and Badges --}}
                                <div class="flex items-center gap-2 flex-wrap">
                                    <h3 class="font-medium text-gray-900">{{ $schedule->training->title ?? 'Training tidak ditemukan' }}</h3>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ getScheduleStatusColor($schedule->status) }}">
                                        {{ getScheduleStatusText($schedule->status) }}
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ getScheduleMethodColor($schedule->method) }}">
                                        {{ ucfirst($schedule->method) }}
                                    </span>
                                </div>

                                {{-- Schedule Info Grid --}}
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ $schedule->formatted_date_range }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>{{ $schedule->formatted_time_range }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span>{{ $schedule->location }}</span>
                                    </div>
                                </div>

                                {{-- Additional Info --}}
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-600">Instructor:</span>
                                        <span class="ml-1 font-medium text-gray-900">{{ $schedule->training->instructor->name ?? 'N/A' }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Peserta:</span>
                                        <span class="ml-1 font-medium text-gray-900">{{ $schedule->registered_count }}/{{ $schedule->total_slots }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Harga:</span>
                                        <span class="ml-1 font-medium text-gray-900">Rp {{ number_format($schedule->training->price ?? 0, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center gap-1 ml-4">
                            <a href="{{ route('admin.schedules.show', $schedule) }}" 
                               class="p-2 hover:bg-gray-100 rounded-lg transition-colors" title="Lihat Detail">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            
                            <a href="{{ route('admin.schedules.edit', $schedule) }}" 
                               class="p-2 hover:bg-gray-100 rounded-lg transition-colors" title="Edit">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            
                            <form method="POST" action="{{ route('admin.schedules.duplicate', $schedule) }}" class="inline">
                                @csrf
                                <button type="submit" class="p-2 hover:bg-gray-100 rounded-lg transition-colors" title="Duplikat">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                </button>
                            </form>
                            
                            <form method="POST" action="{{ route('admin.schedules.destroy', $schedule) }}" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty

                {{-- Empty State --}}
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada jadwal ditemukan</h3>
                    <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat jadwal pelatihan baru.</p>
                    <div class="mt-6">
                        <a href="{{ route('admin.schedules.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Jadwal
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if(isset($schedules) && is_object($schedules) && method_exists($schedules, 'hasPages') && $schedules->hasPages())
        <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-200">
            <div class="text-sm text-gray-600">
                Menampilkan {{ $schedules->firstItem() }} - {{ $schedules->lastItem() }} dari {{ $schedules->total() }} jadwal
            </div>
            <div class="flex items-center gap-2">
                {{ $schedules->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
