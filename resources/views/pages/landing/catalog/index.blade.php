@extends('layouts.app')

@section('title', 'Training Catalog')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Training Catalog</h1>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Explore our comprehensive training programs</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid md:grid-cols-4 gap-8">
            <!-- Filters Sidebar -->
            <div class="md:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-4">Filters</h3>
                    
                    <!-- Category Filter -->
                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600">
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Web Development</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600">
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Mobile Dev</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600">
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Data Science</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600">
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Cloud Computing</span>
                            </label>
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Price Range</h4>
                        <input type="range" min="0" max="10000000" class="w-full">
                        <div class="flex justify-between text-xs text-gray-600 dark:text-gray-400 mt-1">
                            <span>Rp 0</span>
                            <span>Rp 10M</span>
                        </div>
                    </div>

                    <!-- Training Type -->
                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Training Type</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="type" class="border-gray-300 text-indigo-600">
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Online</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="type" class="border-gray-300 text-indigo-600">
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Offline</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="type" class="border-gray-300 text-indigo-600">
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Hybrid</span>
                            </label>
                        </div>
                    </div>

                    <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg transition">
                        Apply Filters
                    </button>
                </div>
            </div>

            <!-- Training Cards -->
            <div class="md:col-span-3">
                <!-- Search & Sort -->
                <div class="flex flex-col md:flex-row gap-4 mb-6">
                    <div class="flex-1">
                        <input type="search" placeholder="Search trainings..." 
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white">
                    </div>
                    <select class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white">
                        <option>Sort by: Popular</option>
                        <option>Sort by: Price (Low to High)</option>
                        <option>Sort by: Price (High to Low)</option>
                        <option>Sort by: Newest</option>
                    </select>
                </div>

                <!-- Training Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @for($i = 1; $i <= 6; $i++)
                    <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow hover:shadow-xl transition">
                        <div class="h-40 bg-gradient-to-br from-indigo-500 to-purple-500"></div>
                        <div class="p-4">
                            <span class="inline-block px-2 py-1 text-xs font-semibold text-indigo-600 dark:text-indigo-400 bg-indigo-100 dark:bg-indigo-900 rounded">
                                Web Development
                            </span>
                            <h3 class="mt-2 text-lg font-semibold text-gray-900 dark:text-white">
                                Training Title {{ $i }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
                                Learn advanced techniques and best practices for modern development
                            </p>
                            <div class="mt-4 flex items-center justify-between">
                                <div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">⭐ 4.8 (120)</div>
                                    <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">Rp 3.5M</div>
                                </div>
                                <a href="#" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded transition">
                                    View
                                </a>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>

                <!-- Pagination -->
                <div class="mt-8 flex justify-center">
                    <nav class="flex gap-2">
                        <button class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded hover:bg-gray-50 dark:hover:bg-gray-700">Previous</button>
                        <button class="px-3 py-1 bg-indigo-600 text-white rounded">1</button>
                        <button class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded hover:bg-gray-50 dark:hover:bg-gray-700">2</button>
                        <button class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded hover:bg-gray-50 dark:hover:bg-gray-700">3</button>
                        <button class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded hover:bg-gray-50 dark:hover:bg-gray-700">Next</button>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
