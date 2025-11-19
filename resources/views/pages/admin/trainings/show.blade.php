@extends('layouts.admin')

@section('title', 'Detail Pelatihan')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Detail Pelatihan</h1>
            <p class="text-gray-600 mt-1">Informasi lengkap pelatihan dan jadwal</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.trainings.edit', $training) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit
            </a>
            <a href="{{ route('admin.trainings.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Jadwal Aktif</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $training->schedules->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="bg-green-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Peserta</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($training->schedules->sum('enrolled_count')) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="bg-yellow-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Rating</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $training->rating > 0 ? number_format($training->rating, 1) : '-' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="bg-purple-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Jumlah Review</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $training->review_count }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Basic Information --}}
            <div class="bg-white rounded-lg border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Dasar</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $training->title }}</h3>
                        <div class="flex items-center gap-2">
                            <span class="px-3 py-1 text-sm rounded-full {{ $training->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $training->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                            <span class="px-3 py-1 text-sm bg-blue-100 text-blue-800 rounded-full">
                                {{ $training->training_type }}
                            </span>
                        </div>
                    </div>

                    {{-- Training Image --}}
                    @if($training->image)
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Gambar Pelatihan</label>
                            <div class="mt-2">
                                <img src="{{ Storage::url($training->image) }}" alt="{{ $training->title }}" class="h-48 w-auto rounded-lg border border-gray-300 object-cover">
                            </div>
                        </div>
                    @endif

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Kategori</label>
                            <p class="text-gray-900">{{ $training->category->name ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Instruktur</label>
                            <p class="text-gray-900">{{ $training->instructor->name ?? '-' }}</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Deskripsi Singkat</label>
                        <p class="text-gray-900">{{ $training->description }}</p>
                    </div>

                    @if ($training->long_description)
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Deskripsi Lengkap</label>
                            <p class="text-gray-900 whitespace-pre-line">{{ $training->long_description }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Training Details --}}
            <div class="bg-white rounded-lg border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Detail Pelatihan</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Durasi</label>
                            <p class="text-gray-900">{{ $training->duration }} hari</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Harga</label>
                            <p class="text-gray-900">Rp {{ number_format($training->price, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Kapasitas</label>
                            <p class="text-gray-900">{{ $training->capacity }} peserta</p>
                        </div>
                        @if ($training->learning_hours)
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Jam Pembelajaran</label>
                                <p class="text-gray-900">{{ $training->learning_hours }} jam</p>
                            </div>
                        @endif
                        @if ($training->training_methods)
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-600 mb-1">Metode Pelatihan</label>
                                <p class="text-gray-900">{{ $training->training_methods }}</p>
                            </div>
                        @endif
                        @if ($training->certification_note)
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-600 mb-1">Catatan Sertifikasi</label>
                                <p class="text-gray-900">{{ $training->certification_note }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Schedules --}}
            @if ($training->schedules->count() > 0)
                <div class="bg-white rounded-lg border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Jadwal Pelatihan</h3>
                    </div>
                    <div class="p-6 space-y-3">
                        @foreach ($training->schedules as $schedule)
                            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($schedule->start_date)->format('d M Y') }} -
                                            {{ \Carbon\Carbon::parse($schedule->end_date)->format('d M Y') }}
                                        </p>
                                        <p class="text-sm text-gray-600 mt-1">{{ $schedule->location }}</p>
                                    </div>
                                    <span class="px-3 py-1 text-sm rounded-full {{ $schedule->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $schedule->enrolled_count }}/{{ $schedule->max_participants }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Kurikulum / Syllabus --}}
            <div class="bg-white rounded-lg border border-gray-200">
                <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Kurikulum Pelatihan</h3>
                    <a href="{{ route('admin.trainings.syllabus.create', $training) }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Tambah Kurikulum
                    </a>
                </div>
                <div class="p-6">
                    @if ($training->syllabus->count() > 0)
                        <div class="space-y-4">
                            @foreach ($training->syllabus as $syllabus)
                                <div class="border border-gray-200 rounded-lg p-5 hover:border-blue-300 transition-colors">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center font-semibold">
                                                {{ $syllabus->day }}
                                            </div>
                                            <div>
                                                <h4 class="text-lg font-semibold text-gray-900">{{ $syllabus->title }}</h4>
                                                <p class="text-sm text-gray-500">Hari ke-{{ $syllabus->day }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('admin.trainings.syllabus.edit', [$training, $syllabus]) }}" 
                                               class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg text-sm font-medium hover:bg-blue-100 transition-colors">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.trainings.syllabus.destroy', [$training, $syllabus]) }}" 
                                                  method="POST" 
                                                  class="inline"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus kurikulum ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 rounded-lg text-sm font-medium hover:bg-red-100 transition-colors">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    @if ($syllabus->topics->count() > 0)
                                        <div class="mt-4 pl-15">
                                            <h5 class="text-sm font-medium text-gray-700 mb-2">Topik yang Dibahas:</h5>
                                            <ul class="space-y-1.5">
                                                @foreach ($syllabus->topics as $topic)
                                                    <li class="flex items-start gap-2 text-gray-600 text-sm">
                                                        <svg class="w-4 h-4 text-blue-500 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                        </svg>
                                                        {{ $topic->topic }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada kurikulum</h3>
                            <p class="mt-2 text-sm text-gray-500">Mulai tambahkan kurikulum untuk pelatihan ini.</p>
                            <div class="mt-6">
                                <a href="{{ route('admin.trainings.syllabus.create', $training) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    Tambah Kurikulum
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">
            {{-- Account Information --}}
            <div class="bg-white rounded-lg border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Sistem</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">ID</label>
                        <p class="text-gray-900 font-mono text-sm">{{ $training->id }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Dibuat</label>
                        <p class="text-gray-900">{{ $training->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Diperbarui</label>
                        <p class="text-gray-900">{{ $training->updated_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="bg-white rounded-lg border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Aksi</h3>
                </div>
                <div class="p-6 space-y-3">
                    <a href="{{ route('admin.trainings.edit', $training) }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Pelatihan
                    </a>
                    <form action="{{ route('admin.trainings.destroy', $training) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelatihan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Hapus Pelatihan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
