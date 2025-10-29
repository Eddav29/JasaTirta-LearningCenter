@extends('layouts.app')

@section('title', 'Our Instructors')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Our Instructors</h1>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Meet our expert team of professionals</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid md:grid-cols-3 gap-8">
            @for($i = 1; $i <= 6; $i++)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                <!-- Avatar -->
                <div class="h-64 bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center">
                    <div class="w-32 h-32 bg-white dark:bg-gray-700 rounded-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                </div>

                <!-- Info -->
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-1">
                        Instructor Name {{ $i }}
                    </h3>
                    <p class="text-indigo-600 dark:text-indigo-400 text-sm mb-3">
                        Web Development Expert
                    </p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
                        15+ years of experience in full-stack development
                    </p>

                    <!-- Certifications -->
                    <div class="mb-4">
                        <h4 class="text-xs font-semibold text-gray-700 dark:text-gray-300 mb-2">Certifications:</h4>
                        <div class="flex flex-wrap gap-1">
                            <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs rounded">Laravel</span>
                            <span class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs rounded">AWS</span>
                            <span class="px-2 py-1 bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 text-xs rounded">Docker</span>
                        </div>
                    </div>

                    <button class="w-full px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition">
                        View Profile
                    </button>
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>
@endsection
