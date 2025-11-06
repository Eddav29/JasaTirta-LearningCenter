@extends('layouts.user')

@section('content')
<div class="space-y-6">
    {{-- Breadcrumb --}}
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('user.dashboard') }}" class="text-gray-600 hover:text-blue-600">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('user.courses') }}" class="ml-1 text-gray-600 hover:text-blue-600 md:ml-2">Kursus Saya</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-gray-500 md:ml-2">Detail Kursus</span>
                </div>
            </li>
        </ol>
    </nav>

    {{-- Course Header --}}
    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <div class="aspect-video w-full">
            <img 
                src="{{ $course['thumbnail'] }}" 
                alt="{{ $course['title'] }}"
                class="w-full h-full object-cover"
            />
        </div>
        
        <div class="p-6">
            <div class="flex items-start justify-between gap-4">
                <div class="flex-1">
                    <h1 class="text-2xl font-bold text-gray-900">{{ $course['title'] }}</h1>
                    <p class="text-gray-600 mt-2">Instructor: {{ $course['instructor'] }}</p>
                </div>
                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-medium rounded-full shrink-0">
                    In Progress
                </span>
            </div>

            <p class="text-gray-700 mt-4">{{ $course['description'] }}</p>

            {{-- Progress --}}
            <div class="mt-6">
                <div class="flex items-center justify-between text-sm mb-2">
                    <span class="text-gray-600 font-medium">Progress Keseluruhan</span>
                    <span class="font-semibold text-gray-900">{{ $course['completedLessons'] }}/{{ $course['totalLessons'] }} Pelajaran ({{ $course['progress'] }}%)</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-blue-600 rounded-full h-3 transition-all duration-300" style="width: {{ $course['progress'] }}%"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Course Content --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Konten Kursus</h2>

        <div class="space-y-4">
            {{-- Module 1 --}}
            <div class="border border-gray-200 rounded-lg" x-data="{ open: true }">
                <button 
                    @click="open = !open"
                    class="w-full px-4 py-3 flex items-center justify-between hover:bg-gray-50 transition-colors"
                >
                    <div class="flex items-center gap-3">
                        <svg 
                            class="w-5 h-5 text-gray-500 transition-transform"
                            :class="{ 'rotate-90': open }"
                            fill="none" 
                            stroke="currentColor" 
                            viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <div class="text-left">
                            <h3 class="font-semibold text-gray-900">Module 1: Introduction to Water Quality</h3>
                            <p class="text-sm text-gray-500">4 pelajaran • 45 menit</p>
                        </div>
                    </div>
                    <span class="text-sm text-green-600 font-medium">4/4 selesai</span>
                </button>

                <div x-show="open" class="border-t border-gray-200">
                    <div class="divide-y divide-gray-100">
                        {{-- Lesson 1 --}}
                        <div class="px-4 py-3 flex items-center justify-between hover:bg-gray-50">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">1. What is Water Quality?</p>
                                    <p class="text-xs text-gray-500">Video • 10 min</p>
                                </div>
                            </div>
                            <button class="text-sm text-blue-600 hover:text-blue-700 font-medium">Review</button>
                        </div>

                        {{-- More lessons... --}}
                        <div class="px-4 py-3 flex items-center justify-between hover:bg-gray-50">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">2. Parameters of Water Quality</p>
                                    <p class="text-xs text-gray-500">Reading • 15 min</p>
                                </div>
                            </div>
                            <button class="text-sm text-blue-600 hover:text-blue-700 font-medium">Review</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Module 2 --}}
            <div class="border border-gray-200 rounded-lg" x-data="{ open: true }">
                <button 
                    @click="open = !open"
                    class="w-full px-4 py-3 flex items-center justify-between hover:bg-gray-50 transition-colors"
                >
                    <div class="flex items-center gap-3">
                        <svg 
                            class="w-5 h-5 text-gray-500 transition-transform"
                            :class="{ 'rotate-90': open }"
                            fill="none" 
                            stroke="currentColor" 
                            viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <div class="text-left">
                            <h3 class="font-semibold text-gray-900">Module 2: Testing Methods</h3>
                            <p class="text-sm text-gray-500">4 pelajaran • 1 jam</p>
                        </div>
                    </div>
                    <span class="text-sm text-blue-600 font-medium">4/4 selesai</span>
                </button>

                <div x-show="open" class="border-t border-gray-200">
                    <div class="divide-y divide-gray-100">
                        <div class="px-4 py-3 flex items-center justify-between hover:bg-gray-50">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">1. pH Testing Basics</p>
                                    <p class="text-xs text-gray-500">Video • 12 min</p>
                                </div>
                            </div>
                            <button class="text-sm text-blue-600 hover:text-blue-700 font-medium">Review</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Module 3 - Current --}}
            <div class="border border-blue-200 bg-blue-50/30 rounded-lg" x-data="{ open: true }">
                <button 
                    @click="open = !open"
                    class="w-full px-4 py-3 flex items-center justify-between hover:bg-blue-100/50 transition-colors"
                >
                    <div class="flex items-center gap-3">
                        <svg 
                            class="w-5 h-5 text-blue-600 transition-transform"
                            :class="{ 'rotate-90': open }"
                            fill="none" 
                            stroke="currentColor" 
                            viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <div class="text-left">
                            <h3 class="font-semibold text-gray-900">Module 3: Lab Techniques</h3>
                            <p class="text-sm text-gray-500">4 pelajaran • 50 menit</p>
                        </div>
                    </div>
                    <span class="text-sm text-yellow-600 font-medium">0/4 selesai</span>
                </button>

                <div x-show="open" class="border-t border-blue-200">
                    <div class="divide-y divide-blue-100">
                        {{-- Current Lesson --}}
                        <div class="px-4 py-3 flex items-center justify-between bg-blue-100/50">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">1. Lab Techniques for pH Testing</p>
                                    <p class="text-xs text-gray-500">Video • 15 min</p>
                                </div>
                            </div>
                            <button class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                Mulai Belajar
                            </button>
                        </div>

                        {{-- Locked Lessons --}}
                        <div class="px-4 py-3 flex items-center justify-between opacity-60">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">2. Advanced Testing Procedures</p>
                                    <p class="text-xs text-gray-500">Video • 18 min</p>
                                </div>
                            </div>
                            <span class="text-xs text-gray-500">Terkunci</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
