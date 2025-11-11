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
                    <div class="aspect-video bg-linear-to-br from-blue-500 to-blue-700 rounded-2xl mb-8 flex items-center justify-center">
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
                            @php
                                $badgeClass = match($training->training_type) {
                                    'Beginner' => 'bg-green-100 text-green-800',
                                    'Intermediate' => 'bg-blue-100 text-blue-800',
                                    'Advanced' => 'bg-purple-100 text-purple-800',
                                    'Expert' => 'bg-red-100 text-red-800',
                                    default => 'bg-gray-100 text-gray-800',
                                };
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $badgeClass }}">
                                {{ $training->training_type }}
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
                    <div x-data="{ 
                        activeTab: 'overview',
                        expandedSection: null,
                        toggleSection(index) {
                            this.expandedSection = this.expandedSection === index ? null : index
                        }
                    }" class="mb-12">
                        {{-- Tab Navigation --}}
                        <div class="border-b border-gray-200 mb-8">
                            <nav class="-mb-px flex flex-wrap gap-x-8">
                                <button @click="activeTab = 'overview'" 
                                        :class="activeTab === 'overview' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                                    Overview
                                </button>
                                <button @click="activeTab = 'curriculum'" 
                                        :class="activeTab === 'curriculum' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                                    Kurikulum
                                </button>
                                <button @click="activeTab = 'instructor'" 
                                        :class="activeTab === 'instructor' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                                    Pengajar
                                </button>
                                <button @click="activeTab = 'schedule'" 
                                        :class="activeTab === 'schedule' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                                    Jadwal
                                </button>
                            </nav>
                        </div>

                        {{-- Tab Content --}}
                        <div class="space-y-8">
                            {{-- Overview Tab --}}
                            <div x-show="activeTab === 'overview'" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform translate-y-4"
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 class="space-y-8">
                                
                                {{-- Description --}}
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Tentang Pelatihan</h3>
                                    <p class="text-gray-700 leading-relaxed">{{ $training->description }}</p>
                                </div>

                                {{-- Learning Objectives --}}
                                @if($training->learningObjectives->count() > 0)
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Tujuan Pembelajaran</h3>
                                    <div class="grid md:grid-cols-2 gap-4">
                                        @foreach($training->learningObjectives as $objective)
                                        <div class="flex items-start gap-3 bg-blue-50 p-4 rounded-lg">
                                            <svg class="h-6 w-6 text-blue-600 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-gray-800">{{ $objective->objective }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                {{-- Prerequisites --}}
                                @if($training->prerequisites->count() > 0)
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Persyaratan Peserta</h3>
                                    <div class="bg-amber-50 border-l-4 border-amber-400 p-4 rounded-r-lg">
                                        <ul class="space-y-2">
                                            @foreach($training->prerequisites as $prerequisite)
                                            <li class="flex items-start gap-3">
                                                <svg class="h-5 w-5 text-amber-600 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span class="text-gray-700">{{ $prerequisite->prerequisite }}</span>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endif

                                {{-- Materials --}}
                                @if($training->materials->count() > 0)
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Materi yang Diberikan</h3>
                                    <div class="grid md:grid-cols-2 gap-3">
                                        @foreach($training->materials as $material)
                                        <div class="flex items-center gap-3 bg-gray-50 p-3 rounded-lg">
                                            <svg class="h-5 w-5 text-gray-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <span class="text-gray-700">{{ $material->material }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>

                            {{-- Curriculum Tab --}}
                            <div x-show="activeTab === 'curriculum'"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform translate-y-4"
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 class="space-y-4">
                                @if($training->syllabus->count() > 0)
                                    @foreach($training->syllabus as $index => $syllabusItem)
                                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                                        <button @click="toggleSection({{ $index }})"
                                                class="w-full flex items-center justify-between p-5 bg-white hover:bg-gray-50 transition-colors">
                                            <div class="flex items-center gap-4 text-left">
                                                <div class="shrink-0 w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center font-semibold">
                                                    {{ $index + 1 }}
                                                </div>
                                                <div>
                                                    <h4 class="text-lg font-semibold text-gray-900">
                                                        {{ $syllabusItem->title }}
                                                    </h4>
                                                    @if($syllabusItem->duration)
                                                    <p class="text-sm text-gray-600 mt-1">
                                                        <svg class="inline h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        {{ $syllabusItem->duration }}
                                                    </p>
                                                    @endif
                                                </div>
                                            </div>
                                            <svg :class="{ 'rotate-180': expandedSection === {{ $index }} }"
                                                 class="h-5 w-5 text-gray-400 transition-transform duration-200" 
                                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                        
                                        <div x-show="expandedSection === {{ $index }}"
                                             x-transition:enter="transition ease-out duration-200"
                                             x-transition:enter-start="opacity-0 max-h-0"
                                             x-transition:enter-end="opacity-100 max-h-screen"
                                             x-transition:leave="transition ease-in duration-150"
                                             x-transition:leave-start="opacity-100 max-h-screen"
                                             x-transition:leave-end="opacity-0 max-h-0"
                                             class="border-t border-gray-200 bg-gray-50">
                                            <div class="p-5 space-y-4">
                                                @if($syllabusItem->description)
                                                <p class="text-gray-700">{{ $syllabusItem->description }}</p>
                                                @endif
                                                
                                                @if($syllabusItem->topics->count() > 0)
                                                <div>
                                                    <h5 class="font-medium text-gray-900 mb-3">Topik yang Dibahas:</h5>
                                                    <ul class="space-y-2">
                                                        @foreach($syllabusItem->topics as $topic)
                                                        <li class="flex items-start gap-2">
                                                            <svg class="h-5 w-5 text-blue-500 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                            </svg>
                                                            <span class="text-gray-700">{{ $topic->topic_name }}</span>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                <div class="text-center py-12 bg-gray-50 rounded-lg">
                                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <h3 class="mt-4 text-lg font-medium text-gray-900">Kurikulum belum tersedia</h3>
                                    <p class="mt-2 text-sm text-gray-500">Detail kurikulum akan segera diupdate.</p>
                                </div>
                                @endif
                            </div>

                            {{-- Instructor Tab --}}
                            <div x-show="activeTab === 'instructor'"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform translate-y-4"
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 class="space-y-6">
                                @if($training->instructor)
                                <div class="bg-linear-to-br from-blue-50 to-indigo-50 rounded-2xl p-8">
                                    <div class="flex flex-col md:flex-row items-start gap-6">
                                        <div class="shrink-0">
                                            <div class="w-32 h-32 bg-linear-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center shadow-lg">
                                                <span class="text-white font-bold text-4xl">
                                                    {{ substr($training->instructor->name, 0, 1) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $training->instructor->name }}</h3>
                                            @if($training->instructor->specialization)
                                            <p class="text-blue-600 font-semibold mb-3">{{ $training->instructor->specialization }}</p>
                                            @endif
                                            @if($training->instructor->bio)
                                            <p class="text-gray-700 leading-relaxed mb-4">{{ $training->instructor->bio }}</p>
                                            @endif
                                            
                                            @if($training->instructor->certifications->count() > 0)
                                            <div class="mt-6">
                                                <h4 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                                                    <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                                    </svg>
                                                    Sertifikasi & Keahlian
                                                </h4>
                                                <div class="grid md:grid-cols-2 gap-3">
                                                    @foreach($training->instructor->certifications as $cert)
                                                    <div class="bg-white p-4 rounded-lg shadow-sm border border-blue-100">
                                                        <div class="flex items-start gap-3">
                                                            <svg class="h-5 w-5 text-blue-500 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            <div>
                                                                <p class="font-medium text-gray-900">{{ $cert->certification_name }}</p>
                                                                @if($cert->issuing_organization)
                                                                <p class="text-sm text-gray-600 mt-1">{{ $cert->issuing_organization }}</p>
                                                                @endif
                                                                @if($cert->issue_date)
                                                                <p class="text-xs text-gray-500 mt-1">
                                                                    {{ \Carbon\Carbon::parse($cert->issue_date)->format('M Y') }}
                                                                    @if($cert->expiry_date && \Carbon\Carbon::parse($cert->expiry_date)->isFuture())
                                                                        - {{ \Carbon\Carbon::parse($cert->expiry_date)->format('M Y') }}
                                                                    @endif
                                                                </p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="text-center py-12 bg-gray-50 rounded-lg">
                                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <h3 class="mt-4 text-lg font-medium text-gray-900">Pengajar belum ditentukan</h3>
                                    <p class="mt-2 text-sm text-gray-500">Informasi pengajar akan segera diupdate.</p>
                                </div>
                                @endif
                            </div>

                            {{-- Schedule Tab --}}
                            <div x-show="activeTab === 'schedule'"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform translate-y-4"
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 class="space-y-6">
                                @if($training->schedules->count() > 0)
                                <div class="grid md:grid-cols-2 gap-4">
                                    @foreach($training->schedules as $schedule)
                                    <div class="bg-white border border-gray-200 rounded-lg p-5 hover:shadow-md transition-shadow">
                                        <div class="flex items-start justify-between mb-3">
                                            @if($schedule->batch_name)
                                            <h4 class="font-semibold text-gray-900">{{ $schedule->batch_name }}</h4>
                                            @else
                                            <h4 class="font-semibold text-gray-900">Batch {{ $loop->iteration }}</h4>
                                            @endif
                                            @php
                                                $statusBadge = match($schedule->status) {
                                                    'buka_pendaftaran' => 'bg-green-100 text-green-800',
                                                    'berlangsung' => 'bg-blue-100 text-blue-800',
                                                    'selesai' => 'bg-gray-100 text-gray-800',
                                                    'dibatalkan' => 'bg-red-100 text-red-800',
                                                    default => 'bg-gray-100 text-gray-800',
                                                };
                                                $statusText = match($schedule->status) {
                                                    'buka_pendaftaran' => 'Pendaftaran Dibuka',
                                                    'berlangsung' => 'Berlangsung',
                                                    'selesai' => 'Selesai',
                                                    'dibatalkan' => 'Dibatalkan',
                                                    default => ucfirst($schedule->status),
                                                };
                                            @endphp
                                            <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $statusBadge }}">
                                                {{ $statusText }}
                                            </span>
                                        </div>
                                        
                                        <div class="space-y-2 text-sm">
                                            <div class="flex items-center gap-2 text-gray-700">
                                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span>
                                                    {{ \Carbon\Carbon::parse($schedule->start_date)->format('d M Y') }}
                                                    @if($schedule->end_date)
                                                        - {{ \Carbon\Carbon::parse($schedule->end_date)->format('d M Y') }}
                                                    @endif
                                                </span>
                                            </div>
                                            
                                            @if($schedule->location)
                                            <div class="flex items-center gap-2 text-gray-700">
                                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                <span>{{ $schedule->location }}</span>
                                            </div>
                                            @endif
                                            
                                            @if($schedule->max_participants)
                                            <div class="flex items-center gap-2 text-gray-700">
                                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                <span>
                                                    {{ $schedule->current_participants ?? 0 }}/{{ $schedule->max_participants }} peserta
                                                </span>
                                            </div>
                                            @endif
                                        </div>

                                        @if($schedule->status === 'buka_pendaftaran')
                                        <div class="mt-4 pt-4 border-t border-gray-200">
                                            <a href="{{ route('register') }}" 
                                               class="block text-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 rounded-lg transition-colors">
                                                Daftar Batch Ini
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <div class="text-center py-12 bg-gray-50 rounded-lg">
                                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada jadwal tersedia</h3>
                                    <p class="mt-2 text-sm text-gray-500">Jadwal pelatihan akan segera diumumkan.</p>
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
                        <div class="bg-white rounded-2xl p-6 shadow-xl border border-gray-200">
                            <div class="text-center mb-6 pb-6 border-b border-gray-200">
                                <span class="text-4xl font-bold text-blue-600">
                                    Rp {{ number_format($training->price ?? 0, 0, ',', '.') }}
                                </span>
                                <span class="text-gray-500 block mt-1">per peserta</span>
                            </div>

                            {{-- Training Info --}}
                            <div class="space-y-4 mb-6">
                                <div class="flex items-center gap-3">
                                    <div class="shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Durasi</p>
                                        <p class="font-semibold text-gray-900">{{ $training->duration ?? 'TBA' }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3">
                                    <div class="shrink-0 w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <svg class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Modul</p>
                                        <p class="font-semibold text-gray-900">{{ $training->syllabus->count() }} sesi</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3">
                                    <div class="shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                        <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Kapasitas</p>
                                        <p class="font-semibold text-gray-900">{{ $training->capacity ?? 20 }} peserta</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3">
                                    <div class="shrink-0 w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                        <svg class="h-5 w-5 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Level</p>
                                        <p class="font-semibold text-gray-900">{{ $training->training_type }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Features List --}}
                            <div class="mb-6 pb-6 border-b border-gray-200">
                                <h4 class="font-semibold text-gray-900 mb-3">Yang Anda Dapatkan:</h4>
                                <ul class="space-y-2">
                                    @if($training->materials->count() > 0)
                                    <li class="flex items-center gap-2 text-sm text-gray-700">
                                        <svg class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Materi lengkap & up-to-date
                                    </li>
                                    @endif
                                    <li class="flex items-center gap-2 text-sm text-gray-700">
                                        <svg class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Sertifikat resmi
                                    </li>
                                    @if($training->instructor)
                                    <li class="flex items-center gap-2 text-sm text-gray-700">
                                        <svg class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Pengajar bersertifikat
                                    </li>
                                    @endif
                                    <li class="flex items-center gap-2 text-sm text-gray-700">
                                        <svg class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Praktik hands-on
                                    </li>
                                    <li class="flex items-center gap-2 text-sm text-gray-700">
                                        <svg class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Konsultasi gratis
                                    </li>
                                </ul>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="space-y-3">
                                <a href="{{ route('register') }}" 
                                   class="w-full bg-linear-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3.5 rounded-lg transition-all shadow-lg shadow-blue-500/50 hover:shadow-xl hover:shadow-blue-500/50 text-center block">
                                    Daftar Sekarang
                                </a>
                                <button class="w-full border-2 border-gray-300 hover:border-blue-500 hover:bg-blue-50 text-gray-700 hover:text-blue-700 font-semibold py-3 rounded-lg transition-all">
                                    Hubungi Admin
                                </button>
                            </div>
                        </div>

                        {{-- Available Schedules --}}
                        @if($training->schedules->count() > 0)
                        <div class="bg-white rounded-2xl p-6 shadow-xl border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Jadwal Tersedia
                            </h3>
                            <div class="space-y-3">
                                @foreach($training->schedules->take(3) as $schedule)
                                <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-300 hover:bg-blue-50/50 transition-all">
                                    @if($schedule->batch_name)
                                    <div class="font-medium text-gray-900 mb-2">{{ $schedule->batch_name }}</div>
                                    @endif
                                    <div class="text-sm text-gray-700 mb-1">
                                        <svg class="inline h-4 w-4 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ \Carbon\Carbon::parse($schedule->start_date)->format('d M Y') }}
                                    </div>
                                    @if($schedule->location)
                                    <div class="text-sm text-gray-600">
                                        <svg class="inline h-4 w-4 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $schedule->location }}
                                    </div>
                                    @endif
                                    @if($schedule->max_participants)
                                    <div class="text-xs text-gray-500 mt-2">
                                        {{ $schedule->current_participants ?? 0 }}/{{ $schedule->max_participants }} terdaftar
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            @if($training->schedules->count() > 3)
                            <button @click="activeTab = 'schedule'" class="text-sm text-blue-600 hover:text-blue-700 font-medium mt-3 w-full text-center">
                                Lihat semua jadwal →
                            </button>
                            @endif
                        </div>
                        @endif

                        {{-- Contact Information --}}
                        <div class="bg-linear-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                Butuh Bantuan?
                            </h3>
                            <div class="space-y-3">
                                <a href="https://wa.me/62123456789" target="_blank" class="flex items-center gap-3 text-gray-700 hover:text-green-600 transition-colors">
                                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                        <svg class="h-5 w-5 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium">WhatsApp</p>
                                        <p class="text-xs text-gray-600">+62 123 456 789</p>
                                    </div>
                                </a>
                                <a href="mailto:info@jtlc.com" class="flex items-center gap-3 text-gray-700 hover:text-blue-600 transition-colors">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium">Email</p>
                                        <p class="text-xs text-gray-600">info@jtlc.com</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Related Trainings --}}
    @if($relatedTrainings->count() > 0)
    <section class="bg-white py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Pelatihan Terkait</h2>
                <p class="text-gray-600">Pelatihan lain yang mungkin Anda minati</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($relatedTrainings as $relatedTraining)
                <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-gray-100">
                    <div class="aspect-video overflow-hidden relative bg-linear-to-br from-blue-500 to-blue-700">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="h-20 w-20 text-white/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/90 text-gray-800 backdrop-blur-sm">
                                {{ $relatedTraining->category->name }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold leading-tight line-clamp-2 text-gray-900 mb-3 hover:text-blue-600 transition-colors">
                            {{ $relatedTraining->title }}
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed line-clamp-3 mb-4">
                            {{ $relatedTraining->description }}
                        </p>
                        
                        <div class="flex items-center gap-4 mb-4 text-xs text-gray-500">
                            @if($relatedTraining->duration)
                            <div class="flex items-center gap-1">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $relatedTraining->duration }}
                            </div>
                            @endif
                            @php
                                $relatedBadgeClass = match($relatedTraining->training_type) {
                                    'Beginner' => 'bg-green-100 text-green-700',
                                    'Intermediate' => 'bg-blue-100 text-blue-700',
                                    'Advanced' => 'bg-purple-100 text-purple-700',
                                    'Expert' => 'bg-red-100 text-red-700',
                                    default => 'bg-gray-100 text-gray-700',
                                };
                            @endphp
                            <span class="px-2 py-0.5 rounded-full {{ $relatedBadgeClass }}">
                                {{ $relatedTraining->training_type }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div>
                                <span class="text-2xl font-bold text-blue-600">
                                    Rp {{ number_format($relatedTraining->price ?? 0, 0, ',', '.') }}
                                </span>
                            </div>
                            <a href="{{ route('training.show', $relatedTraining) }}" 
                               class="inline-flex items-center gap-2 px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-all shadow-md hover:shadow-lg">
                                Lihat Detail
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
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
