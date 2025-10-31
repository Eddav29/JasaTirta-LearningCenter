@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="min-h-screen bg-linear-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800">
    <div class="flex flex-col items-center justify-center min-h-screen px-4">
        <div class="text-center">
            <!-- Logo/Icon -->
            <div class="mb-8">
                <svg class="w-20 h-20 mx-auto text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>

            <!-- Title -->
            <h1 class="text-5xl font-bold text-gray-900 dark:text-white mb-4">
                Jasa Tirta Learning Center
            </h1>

            <!-- Subtitle -->
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8">
                Platform pelatihan profesional untuk pengembangan kompetensi
            </p>

            <!-- Features -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto mb-12">
                <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-lg">
                    <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900 rounded-lg flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Expert Instructors</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Instruktur berpengalaman dan tersertifikasi</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-lg">
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Comprehensive Curriculum</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Kurikulum lengkap dan terstruktur</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-lg">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Certified Programs</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Sertifikat resmi setelah penyelesaian</p>
                </div>
            </div>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/api/trainings" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    Browse Trainings (API)
                </a>
                <a href="/api/documentation" class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-900 dark:text-white font-semibold rounded-lg shadow-md border border-gray-300 dark:border-gray-700 transition duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    API Documentation
                </a>
            </div>

            <!-- Tech Stack Badge -->
            <div class="mt-12 text-sm text-gray-500 dark:text-gray-400">
                <p class="mb-2">Built with</p>
                <div class="flex flex-wrap gap-2 justify-center">
                    <span class="px-3 py-1 bg-white dark:bg-gray-800 rounded-full border border-gray-200 dark:border-gray-700">Laravel 12</span>
                    <span class="px-3 py-1 bg-white dark:bg-gray-800 rounded-full border border-gray-200 dark:border-gray-700">Vite</span>
                    <span class="px-3 py-1 bg-white dark:bg-gray-800 rounded-full border border-gray-200 dark:border-gray-700">Tailwind CSS v4</span>
                    <span class="px-3 py-1 bg-white dark:bg-gray-800 rounded-full border border-gray-200 dark:border-gray-700">MySQL</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
