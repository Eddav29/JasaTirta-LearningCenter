@extends('layouts.admin')

@section('title', 'Detail Jadwal Pelatihan')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Detail Jadwal Pelatihan</h1>
            <p class="text-gray-600 mt-1">Informasi lengkap jadwal dan status pelatihan</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.schedules.edit', $schedule) }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Jadwal
            </a>
            <form method="POST" action="{{ route('admin.schedules.duplicate', $schedule) }}" class="inline">
                @csrf
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    Duplikat
                </button>
            </form>
            <a href="{{ route('admin.schedules.index') }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            {{ session('success') }}
        </div>
    </div>
    @endif

    @php
        function getScheduleStatusColor($status) {
            return match($status) {
                'buka_pendaftaran' => 'bg-blue-100 text-blue-800 border-blue-200',
                'penuh' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                'berlangsung' => 'bg-green-100 text-green-800 border-green-200',
                'selesai' => 'bg-gray-100 text-gray-800 border-gray-200',
                'dibatalkan' => 'bg-red-100 text-red-800 border-red-200',
                default => 'bg-gray-100 text-gray-800 border-gray-200'
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
                'online' => 'bg-green-100 text-green-800 border-green-200',
                'offline' => 'bg-blue-100 text-blue-800 border-blue-200',
                'hybrid' => 'bg-purple-100 text-purple-800 border-purple-200',
                default => 'bg-gray-100 text-gray-800 border-gray-200'
            };
        }
    @endphp

    {{-- Main Content --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Main Info --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Schedule Overview --}}
            <div class="bg-white rounded-lg border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-start justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 mb-2">
                                {{ $schedule->training->title ?? 'Training tidak ditemukan' }}
                            </h2>
                            <div class="flex items-center gap-3 flex-wrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border {{ getScheduleStatusColor($schedule->status) }}">
                                    {{ getScheduleStatusText($schedule->status) }}
                                </span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border {{ getScheduleMethodColor($schedule->method) }}">
                                    {{ ucfirst($schedule->method) }}
                                </span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-gray-900">
                                Rp {{ number_format($schedule->training->price ?? 0, 0, ',', '.') }}
                            </div>
                            <div class="text-sm text-gray-600">per peserta</div>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    {{-- Schedule Details --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Date & Time --}}
                        <div class="space-y-4">
                            <h3 class="font-medium text-gray-900 border-b border-gray-200 pb-2">Waktu Pelaksanaan</h3>
                            <div class="space-y-3">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $schedule->formatted_date_range }}</div>
                                        <div class="text-sm text-gray-600">{{ $schedule->duration }} hari</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $schedule->formatted_time_range }}</div>
                                        <div class="text-sm text-gray-600">
                                            @php
                                                $start = \Carbon\Carbon::parse($schedule->start_time);
                                                $end = \Carbon\Carbon::parse($schedule->end_time);
                                                $duration = $start->diffInHours($end) . ' jam ' . $start->diffInMinutes($end) % 60 . ' menit';
                                            @endphp
                                            {{ $duration }} per hari
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Location --}}
                        <div class="space-y-4">
                            <h3 class="font-medium text-gray-900 border-b border-gray-200 pb-2">Lokasi & Metode</h3>
                            <div class="space-y-3">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $schedule->location }}</div>
                                        <div class="text-sm text-gray-600">Lokasi pelatihan</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <div>
                                        <div class="font-medium text-gray-900">{{ ucfirst($schedule->method) }}</div>
                                        <div class="text-sm text-gray-600">Metode pelatihan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Instructor Info --}}
                    @if($schedule->training && $schedule->training->instructor)
                    <div class="space-y-4">
                        <h3 class="font-medium text-gray-900 border-b border-gray-200 pb-2">Instruktur</h3>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold">
                                {{ substr($schedule->training->instructor->name, 0, 2) }}
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">{{ $schedule->training->instructor->name }}</h4>
                                <p class="text-sm text-gray-600">{{ $schedule->training->instructor->specialization ?? 'Spesialis Pelatihan' }}</p>
                                @if($schedule->training->instructor->experience)
                                    <p class="text-sm text-gray-500 mt-1">{{ $schedule->training->instructor->experience }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Training Description --}}
            @if($schedule->training && $schedule->training->description)
            <div class="bg-white rounded-lg border border-gray-200">
                <div class="p-6">
                    <h3 class="font-medium text-gray-900 mb-4">Deskripsi Pelatihan</h3>
                    <div class="prose prose-gray max-w-none">
                        <p class="text-gray-700 leading-relaxed">{{ $schedule->training->description }}</p>
                    </div>
                </div>
            </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">
            {{-- Registration Stats --}}
            <div class="bg-white rounded-lg border border-gray-200">
                <div class="p-6">
                    <h3 class="font-medium text-gray-900 mb-4">Statistik Pendaftaran</h3>
                    
                    {{-- Progress Bar --}}
                    <div class="mb-4">
                        @php
                            $percentage = $schedule->total_slots > 0 ? ($schedule->registered_count / $schedule->total_slots) * 100 : 0;
                        @endphp
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-600">Terisi</span>
                            <span class="font-medium">{{ round($percentage) }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>

                    {{-- Stats Grid --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center p-3 bg-blue-50 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600">{{ $schedule->registered_count }}</div>
                            <div class="text-sm text-blue-700">Terdaftar</div>
                        </div>
                        <div class="text-center p-3 bg-gray-50 rounded-lg">
                            <div class="text-2xl font-bold text-gray-600">{{ $schedule->available_slots }}</div>
                            <div class="text-sm text-gray-700">Tersisa</div>
                        </div>
                        <div class="text-center p-3 bg-green-50 rounded-lg">
                            <div class="text-2xl font-bold text-green-600">{{ $schedule->total_slots }}</div>
                            <div class="text-sm text-green-700">Total Slot</div>
                        </div>
                        <div class="text-center p-3 bg-purple-50 rounded-lg">
                            <div class="text-2xl font-bold text-purple-600">
                                Rp {{ number_format(($schedule->training->price ?? 0) * $schedule->registered_count, 0, ',', '.') }}
                            </div>
                            <div class="text-sm text-purple-700">Total Revenue</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="bg-white rounded-lg border border-gray-200">
                <div class="p-6">
                    <h3 class="font-medium text-gray-900 mb-4">Aksi Cepat</h3>
                    <div class="space-y-3">
                        <a href="{{ route('admin.schedules.edit', $schedule) }}" 
                           class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit Jadwal
                        </a>
                        
                        <form method="POST" action="{{ route('admin.schedules.duplicate', $schedule) }}" class="w-full">
                            @csrf
                            <button type="submit" 
                                    class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                                Duplikat Jadwal
                            </button>
                        </form>

                        @if($schedule->registered_count == 0)
                        <form method="POST" action="{{ route('admin.schedules.destroy', $schedule) }}" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')" class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full inline-flex items-center justify-center px-4 py-2 border border-red-300 rounded-lg shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus Jadwal
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Meta Info --}}
            <div class="bg-white rounded-lg border border-gray-200">
                <div class="p-6">
                    <h3 class="font-medium text-gray-900 mb-4">Informasi Tambahan</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">ID Jadwal:</span>
                            <span class="font-medium">#{{ $schedule->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Dibuat:</span>
                            <span class="font-medium">{{ $schedule->created_at->format('d M Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Diperbarui:</span>
                            <span class="font-medium">{{ $schedule->updated_at->format('d M Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Bulan:</span>
                            <span class="font-medium">{{ \Carbon\Carbon::parse($schedule->month . '-01')->format('F Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection