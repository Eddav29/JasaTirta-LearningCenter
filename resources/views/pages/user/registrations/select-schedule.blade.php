@extends('layouts.user')

@section('title', 'Pilih Jadwal - ' . $training->title)

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Pilih Jadwal Pelatihan</h1>
            <p class="mt-1 text-sm text-gray-500">Silakan pilih jadwal yang sesuai untuk pelatihan <strong>{{ $training->title }}</strong></p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('training.show', $training) }}" class="text-sm text-indigo-600 hover:text-indigo-900 font-medium">
                &larr; Kembali ke Detail Pelatihan
            </a>
        </div>
    </div>

    {{-- Training Info Card --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="flex flex-col md:flex-row gap-6">
            <div class="w-full md:w-1/4">
                <img src="{{ $training->thumbnail ? asset('storage/' . $training->thumbnail) : 'https://ui-avatars.com/api/?name='.urlencode($training->title).'&background=random' }}" 
                     alt="{{ $training->title }}" 
                     class="w-full h-32 object-cover rounded-lg">
            </div>
            <div class="w-full md:w-3/4 space-y-4">
                <div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                        {{ $training->category->name ?? 'Umum' }}
                    </span>
                    <h2 class="text-xl font-bold text-gray-900 mt-2">{{ $training->title }}</h2>
                    <p class="text-gray-600 text-sm mt-1 line-clamp-2">{{ $training->description }}</p>
                </div>
                
                <div class="flex flex-wrap gap-4 text-sm text-gray-500">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $training->duration }} Jam
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Rp {{ number_format($training->price, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Schedules Grid --}}
    @if($training->schedules->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($training->schedules as $schedule)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200 flex flex-col h-full">
                    <div class="p-6 grow">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Batch {{ \Carbon\Carbon::parse($schedule->start_date)->format('M Y') }}</h3>
                                <p class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($schedule->start_date)->format('d M Y') }} - 
                                    {{ \Carbon\Carbon::parse($schedule->end_date)->format('d M Y') }}
                                </p>
                            </div>
                            @if($schedule->quota > 0)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Tersedia
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Penuh
                                </span>
                            @endif
                        </div>

                        <div class="space-y-3 text-sm">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-gray-600">{{ $schedule->location ?? 'Online via Zoom' }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                                </svg>
                                <span class="text-gray-600">{{ ucfirst($schedule->method ?? 'Online') }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span class="text-gray-600">Sisa Kuota: {{ $schedule->quota }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-gray-50 border-t border-gray-200 rounded-b-lg">
                        @if($schedule->quota > 0)
                            <a href="{{ route('user.registrations.create', $schedule) }}" 
                               class="w-full flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Pilih Jadwal Ini
                            </a>
                        @else
                            <button disabled class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-400 bg-gray-100 cursor-not-allowed">
                                Penuh
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12 bg-white rounded-lg border border-gray-200">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada jadwal tersedia</h3>
            <p class="mt-1 text-sm text-gray-500">Saat ini belum ada jadwal pendaftaran yang dibuka untuk pelatihan ini.</p>
            <div class="mt-6">
                <a href="{{ route('catalog') }}" class="text-indigo-600 hover:text-indigo-500 font-medium">
                    Lihat Pelatihan Lain &rarr;
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
