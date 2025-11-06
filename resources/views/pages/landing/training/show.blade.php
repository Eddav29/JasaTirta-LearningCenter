@extends('layouts.app')

@section('title', $training->title . ' - Jasa Tirta Learning Center')

@section('content')
<div class="min-h-screen bg-gray-50 pt-20">
    {{-- Hero Section --}}
    <section class="bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                {{-- Main Content --}}
                <div class="lg:col-span-2">
                    {{-- Training Image --}}
                    <div class="aspect-video bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl mb-8 flex items-center justify-center">
                        <svg class="h-24 w-24 text-white/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>

                    {{-- Training Header --}}
                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                {{ $training->category->name }}
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if($training->training_type === 'offline')
                                @elseif($training->training_type === 'online')
                                @else bg-green-100 text-green-800 @endif">
                                @if($training->training_type === 'offline')
                                    Tatap Muka
                                @elseif($training->training_type === 'online')
                                    Daring
                                @else
                                    Hybrid
                                @endif
                            </span>
                        </div>
                        
                        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $training->title }}</h1>
                        
                        <div class="flex items-center space-x-6 text-sm text-gray-600 mb-6">
                            <div class="flex items-center space-x-2">
                                <svg class="h-5 w-5 fill-yellow-400 text-yellow-400" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="font-semibold">{{ number_format($training->rating ?? 4.5, 1) }}</span>
                                <span>({{ $training->review_count ?? 0 }} ulasan)</span>
                            </div>
                            
                            @if($training->learning_hours)
                            <div class="flex items-center space-x-2">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ $training->learning_hours }} JP</span>
                            </div>
                            @endif
                            
                            <div class="flex items-center space-x-2">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <span>{{ $training->capacity ?? 20 }} peserta</span>
                            </div>
                        </div>
                        
                        <p class="text-lg text-gray-700 leading-relaxed">{{ $training->description }}</p>
                    </div>

                    {{-- Training Details Tabs --}}
                    <div x-data="{ activeTab: 'overview' }" class="mb-12">
                        {{-- Tab Navigation --}}
                        <div class="border-b border-gray-200 mb-8">
                            <nav class="-mb-px flex space-x-8">
                                <button @click="activeTab = 'overview'" 
                                        :class="activeTab === 'overview' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                                    Deskripsi
                                </button>
                                <button @click="activeTab = 'instructor'" 
                                        :class="activeTab === 'instructor' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                                    Pengajar
                                </button>
                            </nav>
                        </div>

                        {{-- Tab Content --}}
                        <div class="space-y-8">
                            {{-- Overview Tab --}}
                            <div x-show="activeTab === 'overview'" class="space-y-8">
                                {{-- Learning Objectives --}}
                                @if($training->learningObjectives->count() > 0)
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Tujuan Pembelajaran</h3>
                                    <ul class="space-y-3">
                                        @foreach($training->learningObjectives as $objective)
                                        <li class="flex items-start space-x-3">
                                            <svg class="h-6 w-6 text-green-500 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="text-gray-700">{{ $objective->objective }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>

                            {{-- Curriculum Tab --}}
                            <div x-show="activeTab === 'curriculum'" class="space-y-6">
                                @if($training->syllabus->count() > 0)
                                    @foreach($training->syllabus as $index => $syllabusItem)
                                    <div class="border border-gray-200 rounded-lg p-6">
                                        <h4 class="text-lg font-semibold text-gray-900 mb-2">
                                            Sesi {{ $index + 1 }}: {{ $syllabusItem->session_title }}
                                        </h4>
                                        @if($syllabusItem->duration)
                                        <p class="text-sm text-gray-600 mb-4">Durasi: {{ $syllabusItem->duration }}</p>
                                        @endif
                                        <p class="text-gray-700 mb-4">{{ $syllabusItem->description }}</p>
                                        
                                        @if($syllabusItem->topics->count() > 0)
                                        <div>
                                            <h5 class="font-medium text-gray-900 mb-2">Topik yang Dibahas:</h5>
                                            <ul class="list-disc list-inside space-y-1 text-gray-700">
                                                @foreach($syllabusItem->topics as $topic)
                                                <li>{{ $topic->topic_name }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                @else
                                <div class="text-center py-8">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">Kurikulum belum tersedia</h3>
                                    <p class="mt-1 text-sm text-gray-500">Detail kurikulum akan segera diupdate.</p>
                                </div>
                                @endif
                            </div>

                            {{-- Instructor Tab --}}
                            <div x-show="activeTab === 'instructor'" class="space-y-6">
                                @if($training->instructor)
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-16 h-16 bg-linear-to-br from-blue-500 to-blue-700 rounded-full flex items-center justify-center">
                                            <span class="text-white font-semibold text-lg">
                                                {{ substr($training->instructor->name, 0, 1) }}
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="text-xl font-semibold text-gray-900">{{ $training->instructor->name }}</h4>
                                            @if($training->instructor->specialization)
                                            <p class="text-blue-600 font-medium">{{ $training->instructor->specialization }}</p>
                                            @endif
                                            @if($training->instructor->bio)
                                            <p class="text-gray-700 mt-2">{{ $training->instructor->bio }}</p>
                                            @endif
                                            
                                            @if($training->instructor->certifications->count() > 0)
                                            <div class="mt-4">
                                                <h5 class="font-medium text-gray-900 mb-2">Sertifikasi:</h5>
                                                <ul class="space-y-1">
                                                    @foreach($training->instructor->certifications as $cert)
                                                    <li class="text-sm text-gray-600">• {{ $cert->certification_name }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="text-center py-8">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">Pengajar belum ditentukan</h3>
                                    <p class="mt-1 text-sm text-gray-500">Informasi pengajar akan segera diupdate.</p>
                                </div>
                                @endif
                            </div>

                            {{-- Requirements Tab --}}
                            <div x-show="activeTab === 'requirements'" class="space-y-6">
                                @if($training->prerequisites->count() > 0)
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Persyaratan Peserta</h3>
                                    <ul class="space-y-3">
                                        @foreach($training->prerequisites as $prerequisite)
                                        <li class="flex items-start space-x-3">
                                            <svg class="h-6 w-6 text-amber-500 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                            </svg>
                                            <span class="text-gray-700">{{ $prerequisite->prerequisite }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @else
                                <div class="text-center py-8">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada persyaratan khusus</h3>
                                    <p class="mt-1 text-sm text-gray-500">Pelatihan ini terbuka untuk semua peserta.</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="lg:col-span-1">
                    <div class="sticky top-24 space-y-6">
                        {{-- Price Card --}}
                        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
                            <div class="text-center mb-6">
                                <span class="text-3xl font-bold text-blue-600">
                                    Rp {{ number_format($training->price ?? 0, 0, ',', '.') }}
                                </span>
                                <span class="text-gray-500 block">per peserta</span>
                            </div>

                            {{-- Training Info --}}
                            <div class="space-y-4 mb-6">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Durasi</span>
                                    <span class="font-semibold">{{ $training->duration ?? 'TBA' }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Kapasitas</span>
                                    <span class="font-semibold">{{ $training->capacity ?? 20 }} peserta</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Tipe</span>
                                    <span class="font-semibold">
                                        @if($training->training_type === 'offline')
                                            Tatap Muka
                                        @elseif($training->training_type === 'online')
                                            Daring
                                        @else
                                            Hybrid
                                        @endif
                                    </span>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="space-y-3">
                                <a href="{{ route('register') }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition-colors text-center block">
                                    Daftar Sekarang
                                </a>
                                <button class="w-full border border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold py-3 rounded-lg transition-colors">
                                    Hubungi Admin
                                </button>
                            </div>
                        </div>

                        {{-- Available Schedules --}}
                        @if($training->schedules->count() > 0)
                        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Jadwal Tersedia</h3>
                            <div class="space-y-4">
                                @foreach($training->schedules->take(3) as $schedule)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($schedule->start_date)->format('d M Y') }}
                                        </span>
                                        <span class="text-sm text-gray-500">
                                            @if($schedule->available_slots)
                                                {{ $schedule->available_slots }} slot tersisa
                                            @endif
                                        </span>
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        <p>{{ $schedule->location ?? 'TBA' }}</p>
                                        @if($schedule->start_time && $schedule->end_time)
                                        <p>{{ $schedule->start_time }} - {{ $schedule->end_time }}</p>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        {{-- Contact Information --}}
                        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Butuh Bantuan?</h3>
                            <div class="space-y-3">
                                <div class="flex items-center space-x-3">
                                    <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <span class="text-gray-700">+62 123 456 789</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <svg class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-gray-700">info@jtlc.com</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Related Trainings --}}
    @if($relatedTrainings->count() > 0)
    <section class="bg-gray-50 py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Pelatihan Terkait</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($relatedTrainings as $relatedTraining)
                <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="aspect-video overflow-hidden relative bg-linear-to-br from-blue-500 to-blue-700">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="h-16 w-16 text-white/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $relatedTraining->category->name }}
                            </span>
                        </div>
                        <h3 class="text-lg font-semibold leading-tight line-clamp-2 text-gray-900 mb-2">
                            {{ $relatedTraining->title }}
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed line-clamp-3 mb-4">
                            {{ $relatedTraining->description }}
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-blue-600">
                                Rp {{ number_format($relatedTraining->price ?? 0, 0, ',', '.') }}
                            </span>
                            <a href="{{ route('training.show', $relatedTraining) }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>
@endsection