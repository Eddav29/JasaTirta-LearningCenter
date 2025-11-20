@extends('layouts.app')

@section('title', 'Home - Jasa Tirta Learning Center')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-900 dark:to-purple-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                Tingkatkan Kompetensi Anda
            </h1>
            <p class="text-xl text-indigo-100 mb-8 max-w-2xl mx-auto">
                Platform pelatihan profesional untuk pengembangan skill di bidang teknologi dan manajemen
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#trainings" class="inline-flex items-center px-6 py-3 bg-white text-indigo-600 font-semibold rounded-lg hover:bg-indigo-50 transition">
                    Browse Trainings
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
                <a href="#about" class="inline-flex items-center px-6 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-indigo-600 transition">
                    Learn More
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="bg-white dark:bg-gray-800 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold text-indigo-600 dark:text-indigo-400">1000+</div>
                <div class="text-gray-600 dark:text-gray-400 mt-2">Students</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-indigo-600 dark:text-indigo-400">50+</div>
                <div class="text-gray-600 dark:text-gray-400 mt-2">Trainings</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-indigo-600 dark:text-indigo-400">20+</div>
                <div class="text-gray-600 dark:text-gray-400 mt-2">Instructors</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-indigo-600 dark:text-indigo-400">95%</div>
                <div class="text-gray-600 dark:text-gray-400 mt-2">Success Rate</div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div id="about" class="py-16 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Why Choose Us?</h2>
            <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                We provide comprehensive training programs with experienced instructors
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-lg">
                <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Expert Instructors</h3>
                <p class="text-gray-600 dark:text-gray-400">
                    Learn from industry professionals with years of real-world experience
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-lg">
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Certified Programs</h3>
                <p class="text-gray-600 dark:text-gray-400">
                    Receive industry-recognized certificates upon completion
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-lg">
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Flexible Schedule</h3>
                <p class="text-gray-600 dark:text-gray-400">
                    Choose from online, offline, or hybrid learning options
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Popular Trainings Section -->
<div id="trainings" class="py-16 bg-white dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Popular Trainings</h2>
            <p class="text-gray-600 dark:text-gray-400">
                Explore our most sought-after training programs
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @for($i = 1; $i <= 3; $i++)
            <div class="bg-gray-50 dark:bg-gray-900 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition">
                <div class="h-48 bg-gradient-to-br from-indigo-500 to-purple-500"></div>
                <div class="p-6">
                    <div class="text-sm text-indigo-600 dark:text-indigo-400 mb-2">Web Development</div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                        Laravel Advanced Development
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Master Laravel framework with advanced techniques
                    </p>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">Rp 3.500.000</span>
                        <a href="#" class="text-indigo-600 hover:text-indigo-700 font-semibold">
                            View Details →
                        </a>
                    </div>
                </div>
            </div>
            @endfor
        </div>

        <div class="text-center mt-12">
            <a href="/catalog" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition">
                View All Trainings
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-indigo-600 dark:bg-indigo-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Ready to Start Learning?</h2>
        <p class="text-indigo-100 mb-8 max-w-2xl mx-auto">
            Join thousands of professionals who have advanced their careers with our training programs
        </p>
        <a href="/register" class="inline-flex items-center px-8 py-3 bg-white text-indigo-600 font-semibold rounded-lg hover:bg-indigo-50 transition">
            Get Started Today
        </a>
    </div>
</div>
@endsection
