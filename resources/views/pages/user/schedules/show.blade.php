@extends('layouts.user')

@section('title', $schedule->training->title . ' - Detail Jadwal')

@section('content')
<div class="space-y-8" x-data="scheduleDetail()">
    {{-- Breadcrumb --}}
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-4">
            <li>
                <a href="{{ route('user.dashboard') }}" class="text-gray-400 hover:text-gray-500">
                    <svg class="flex-shrink-0 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-9 9a1 1 0 001.414 1.414L8 5.414V17a1 1 0 102 0V5.414l6.293 6.293a1 1 0 001.414-1.414l-9-9z"/>
                    </svg>
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <a href="{{ route('user.schedules') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Jadwal</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="ml-4 text-sm font-medium text-gray-500">{{ $schedule->training->title }}</span>
                </div>
            </li>
        </ol>
    </nav>

    {{-- Main Content --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left Column - Main Content --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Hero Section --}}
            <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                {{-- Training Image --}}
                <div class="relative h-64 bg-gradient-to-br from-blue-500 to-purple-600">
                    @if($schedule->training->image)
                        <img src="{{ Storage::url($schedule->training->image) }}" 
                             alt="{{ $schedule->training->title }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-20 h-20 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h1a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                    @endif

                    {{-- Badges Overlay --}}
                    <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                        <div class="space-y-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ getMethodColor($schedule->method) }}">
                                {{ ucfirst($schedule->method) }}
                            </span>
                            @if($schedule->training->training_type)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ getLevelColor($schedule->training->training_type) }}">
                                    {{ $schedule->training->training_type }}
                                </span>
                            @endif
                        </div>
                        
                        <div class="bg-white bg-opacity-90 rounded-lg px-3 py-2 text-center">
                            <div class="text-sm font-medium text-gray-700">{{ $schedule->available_slots }}/{{ $schedule->total_slots }}</div>
                            <div class="text-xs text-gray-500">slot tersedia</div>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    {{-- Title and Category --}}
                    <div class="mb-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mb-2">
                            {{ $schedule->training->category->name }}
                        </span>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $schedule->training->title }}</h1>
                    </div>

                    {{-- Instructor --}}
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900">{{ $schedule->training->instructor->name }}</h3>
                            <p class="text-sm text-gray-600">Instruktur</p>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="prose prose-sm max-w-none text-gray-600">
                        {!! nl2br(e($schedule->training->description)) !!}
                    </div>
                </div>
            </div>

            {{-- Schedule Details --}}
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Detail Jadwal</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Date & Time --}}
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pelatihan</label>
                            <div class="flex items-center text-gray-900">
                                <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $schedule->formatted_date_range }}
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Waktu</label>
                            <div class="flex items-center text-gray-900">
                                <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $schedule->formatted_time_range }}
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Durasi</label>
                            <div class="flex items-center text-gray-900">
                                <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                {{ $schedule->duration }} hari
                            </div>
                        </div>
                    </div>

                    {{-- Location & Capacity --}}
                    <div class="space-y-4">
                        @if($schedule->method !== 'online')
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                                <div class="flex items-start text-gray-900">
                                    <svg class="w-5 h-5 mr-2 mt-0.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $schedule->location }}
                                </div>
                            </div>
                        @endif

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kapasitas</label>
                            <div class="flex items-center text-gray-900">
                                <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857m0 0a5.002 5.002 0 009.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                {{ $schedule->total_slots }} peserta maksimal
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tersisa</label>
                            <div class="flex items-center">
                                <div class="flex items-center text-gray-900 mr-3">
                                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                    </svg>
                                    {{ $schedule->available_slots }} slot
                                </div>
                                @if($schedule->available_slots < 5)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Hampir penuh!
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Learning Objectives --}}
            @if($schedule->training->learningObjectives->count() > 0)
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Tujuan Pembelajaran</h2>
                    <ul class="space-y-2">
                        @foreach($schedule->training->learningObjectives as $objective)
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-700">{{ $objective->objective }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Prerequisites --}}
            @if($schedule->training->prerequisites->count() > 0)
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Prasyarat</h2>
                    <ul class="space-y-2">
                        @foreach($schedule->training->prerequisites as $prerequisite)
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <span class="text-gray-700">{{ $prerequisite->prerequisite }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Syllabus --}}
            @if($schedule->training->syllabus->count() > 0)
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Silabus</h2>
                    <div class="space-y-4">
                        @foreach($schedule->training->syllabus as $syllabus)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <h3 class="font-medium text-gray-900 mb-2">{{ $syllabus->title }}</h3>
                                @if($syllabus->description)
                                    <p class="text-sm text-gray-600 mb-3">{{ $syllabus->description }}</p>
                                @endif
                                
                                @if($syllabus->topics->count() > 0)
                                    <ul class="space-y-1">
                                        @foreach($syllabus->topics as $topic)
                                            <li class="flex items-center text-sm text-gray-700">
                                                <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                                {{ $topic->topic }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- Right Column - Sidebar --}}
        <div class="space-y-6">
            {{-- Registration Card --}}
            <div class="bg-white rounded-lg border border-gray-200 p-6 sticky top-6">
                <div class="text-center mb-6">
                    <div class="text-3xl font-bold text-gray-900 mb-2">
                        @if($schedule->training->price > 0)
                            Rp {{ number_format($schedule->training->price, 0, ',', '.') }}
                        @else
                            <span class="text-green-600">Gratis</span>
                        @endif
                    </div>
                    <p class="text-gray-600">Per peserta</p>
                </div>

                @if($schedule->can_register)
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition-colors mb-4">
                        Daftar Sekarang
                    </button>
                @else
                    <button disabled class="w-full bg-gray-300 text-gray-500 font-medium py-3 px-4 rounded-lg cursor-not-allowed mb-4">
                        @if($schedule->is_full)
                            Jadwal Penuh
                        @else
                            Pendaftaran Ditutup
                        @endif
                    </button>
                @endif

                <div class="text-center">
                    <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        Simpan ke Favorit
                    </button>
                </div>

                {{-- Quick Info --}}
                <div class="mt-6 pt-6 border-t border-gray-200 space-y-3">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Metode</span>
                        <span class="font-medium">{{ ucfirst($schedule->method) }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Durasi</span>
                        <span class="font-medium">{{ $schedule->duration }} hari</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Level</span>
                        <span class="font-medium">{{ $schedule->training->training_type ?? 'Semua Level' }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Tersisa</span>
                        <span class="font-medium">{{ $schedule->available_slots }} slot</span>
                    </div>
                </div>
            </div>

            {{-- Other Schedules --}}
            @if($otherSchedules->count() > 0)
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Jadwal Lainnya</h3>
                    <div class="space-y-3">
                        @foreach($otherSchedules as $otherSchedule)
                            <a href="{{ route('user.schedules.show', $otherSchedule) }}" 
                               class="block p-3 border border-gray-200 rounded-lg hover:border-gray-300 hover:bg-gray-50 transition-colors">
                                <div class="text-sm font-medium text-gray-900 mb-1">
                                    {{ $otherSchedule->formatted_date_range }}
                                </div>
                                <div class="text-sm text-gray-600 mb-2">
                                    {{ $otherSchedule->formatted_time_range }}
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-gray-500">{{ $otherSchedule->available_slots }} slot tersisa</span>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ getMethodColor($otherSchedule->method) }}">
                                        {{ ucfirst($otherSchedule->method) }}
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Related Trainings --}}
            @if($relatedSchedules->count() > 0)
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Pelatihan Terkait</h3>
                    <div class="space-y-4">
                        @foreach($relatedSchedules as $relatedSchedule)
                            <a href="{{ route('user.schedules.show', $relatedSchedule) }}" 
                               class="block border border-gray-200 rounded-lg hover:border-gray-300 hover:bg-gray-50 transition-colors overflow-hidden">
                                <div class="relative h-20 bg-gradient-to-br from-blue-500 to-purple-600">
                                    @if($relatedSchedule->training->image)
                                        <img src="{{ Storage::url($relatedSchedule->training->image) }}" 
                                             alt="{{ $relatedSchedule->training->title }}"
                                             class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div class="p-3">
                                    <h4 class="font-medium text-sm text-gray-900 line-clamp-2 mb-1">
                                        {{ $relatedSchedule->training->title }}
                                    </h4>
                                    <p class="text-xs text-gray-600 mb-2">{{ $relatedSchedule->formatted_date_range }}</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-medium text-gray-900">
                                            @if($relatedSchedule->training->price > 0)
                                                Rp {{ number_format($relatedSchedule->training->price, 0, ',', '.') }}
                                            @else
                                                Gratis
                                            @endif
                                        </span>
                                        <span class="text-xs text-gray-500">{{ $relatedSchedule->available_slots }} slot</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@php
    use Illuminate\Support\Facades\Storage;
    
    function getMethodColor($method) {
        return match(strtolower($method)) {
            'online' => 'bg-green-100 text-green-800',
            'offline' => 'bg-blue-100 text-blue-800',
            'hybrid' => 'bg-purple-100 text-purple-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    function getLevelColor($level) {
        return match($level) {
            'Beginner' => 'bg-green-100 text-green-800',
            'Intermediate' => 'bg-yellow-100 text-yellow-800',
            'Advanced' => 'bg-orange-100 text-orange-800',
            'Expert' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }
@endphp
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('scheduleDetail', () => ({
            showFullDescription: false,
            
            formatPrice(price) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(price);
            }
        }));
    });
</script>
@endpush