@extends('layouts.user')

@section('content')
<div class="space-y-6">
    {{-- Welcome Section --}}
    <div class="bg-linear-to-r from-blue-700 to-blue-800 rounded-lg p-6 text-white shadow-xl">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            {{-- Left Content --}}
            <div class="flex-1">
                <h1 class="text-2xl lg:text-3xl font-bold mb-3 text-white">
                    Selamat datang kembali, {{ auth()->user()->name ?? 'John' }}! 👋
                </h1>
                <p class="text-blue-100 mb-4 text-lg">
                    Anda telah belajar selama <span class="font-semibold text-white">45 jam</span> minggu ini. Tetap semangat!
                </p>
                
                {{-- Stats Row --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex items-center gap-2 bg-white/15 rounded-lg p-3 backdrop-blur-sm">
                        <div class="w-8 h-8 rounded-full bg-white/25 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-white">Streak 7 hari</div>
                            <div class="text-sm text-blue-100">Learning streak</div>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2 bg-white/15 rounded-lg p-3 backdrop-blur-sm">
                        <div class="w-8 h-8 rounded-full bg-white/25 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-white">Target mingguan: 75%</div>
                            <div class="text-sm text-blue-100">Weekly goal</div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Right Content - Course Progress --}}
            <div class="lg:text-right">
                <div class="bg-white/15 rounded-lg p-4 lg:p-6 backdrop-blur-sm border border-white/20">
                    <div class="text-3xl lg:text-4xl font-bold mb-1 text-white">
                        3/8
                    </div>
                    <div class="text-blue-100 mb-2">Kursus Selesai</div>
                    <div class="w-full bg-white/25 rounded-full h-2">
                        <div 
                            class="bg-white rounded-full h-2 transition-all duration-300 shadow-sm" 
                            style="width: 37.5%"
                        ></div>
                    </div>
                    <div class="text-sm text-blue-100 mt-1">
                        37% complete
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold">8</p>
                    <p class="text-sm text-gray-500">Kursus Aktif</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold">3</p>
                    <p class="text-sm text-gray-500">Sertifikat</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold">45h</p>
                    <p class="text-sm text-gray-500">Total Belajar</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-orange-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold">12</p>
                    <p class="text-sm text-gray-500">Pencapaian</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Training History --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg border border-gray-200">
                <div class="border-b border-gray-200 p-6">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h2 class="text-lg font-semibold text-gray-900">Riwayat Pelatihan</h2>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Pelatihan yang pernah Anda ikuti</p>
                </div>
                <div class="p-6 space-y-3">
                    {{-- Training 1 --}}
                    <div class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="flex items-start justify-between mb-2">
                            <h4 class="font-medium text-gray-900">Water Quality Analysis Fundamentals</h4>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 shrink-0">
                                Selesai
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mb-3">Dr. Sarah Johnson</p>
                        <div class="flex items-center gap-4 text-xs text-gray-500">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>15-17 Nov 2024</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>3 Hari</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                <span>Jakarta Lab Center</span>
                            </div>
                        </div>
                    </div>

                    {{-- Training 2 --}}
                    <div class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="flex items-start justify-between mb-2">
                            <h4 class="font-medium text-gray-900">Environmental Monitoring Techniques</h4>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 shrink-0">
                                Berlangsung
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mb-3">Prof. Michael Chen</p>
                        <div class="flex items-center gap-4 text-xs text-gray-500">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>20-22 Nov 2024</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>3 Hari</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                </svg>
                                <span>Online</span>
                            </div>
                        </div>
                    </div>

                    {{-- Training 3 --}}
                    <div class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="flex items-start justify-between mb-2">
                            <h4 class="font-medium text-gray-900">Laboratory Safety Protocols</h4>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 shrink-0">
                                Terdaftar
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mb-3">Dr. Lisa Wang</p>
                        <div class="flex items-center gap-4 text-xs text-gray-500">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>25-26 Nov 2024</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>2 Hari</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                <span>Bandung Training Center</span>
                            </div>
                        </div>
                    </div>
                                </svg>
                                Lanjut
                            </div>
                        </button>
                    </div>

                    <button class="w-full px-4 py-2 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                            Lihat Semua Kursus
                        </div>
                    </button>
                </div>
            </div>
        </div>

        {{-- Right Column --}}
        <div class="space-y-6">
            {{-- Upcoming Classes --}}
            <div class="bg-white rounded-lg border border-gray-200">
                <div class="border-b border-gray-200 p-6">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <h2 class="text-lg font-semibold text-gray-900">Kelas Mendatang</h2>
                    </div>
                </div>
                <div class="p-6 space-y-3">
                    {{-- Class 1 --}}
                    <div class="p-3 border border-gray-200 rounded-lg">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h4 class="font-medium text-sm">Live Lab Session: Water Testing</h4>
                                <p class="text-xs text-gray-500 mt-1">Dr. Sarah Johnson</p>
                                <div class="flex items-center gap-2 mt-2 text-xs text-gray-500">
                                    <span>Hari ini</span>
                                    <span>•</span>
                                    <span>14:00 - 16:00</span>
                                </div>
                                <div class="flex items-center gap-1 mt-1">
                                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                    <span class="text-xs text-gray-500">24 peserta</span>
                                </div>
                            </div>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded">Lab</span>
                        </div>
                    </div>

                    {{-- Class 2 --}}
                    <div class="p-3 border border-gray-200 rounded-lg">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h4 class="font-medium text-sm">Q&A Session: Environmental Regulations</h4>
                                <p class="text-xs text-gray-500 mt-1">Prof. Michael Chen</p>
                                <div class="flex items-center gap-2 mt-2 text-xs text-gray-500">
                                    <span>Besok</span>
                                    <span>•</span>
                                    <span>10:00 - 11:00</span>
                                </div>
                                <div class="flex items-center gap-1 mt-1">
                                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                    <span class="text-xs text-gray-500">18 peserta</span>
                                </div>
                            </div>
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded">Diskusi</span>
                        </div>
                    </div>

                    <button class="w-full px-4 py-2 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                        Lihat Jadwal Lengkap
                    </button>
                </div>
            </div>

            {{-- Recent Achievements --}}
            <div class="bg-white rounded-lg border border-gray-200">
                <div class="border-b border-gray-200 p-6">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                        <h2 class="text-lg font-semibold text-gray-900">Pencapaian Terbaru</h2>
                    </div>
                </div>
                <div class="p-6 space-y-3">
                    {{-- Achievement 1 --}}
                    <div class="flex items-start gap-3 p-3 bg-yellow-50 rounded-lg">
                        <div class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-medium text-sm">Quick Learner</h4>
                            <p class="text-xs text-gray-600 mt-1">Completed 3 lessons in one day</p>
                            <p class="text-xs text-gray-500 mt-1">2 hari lalu</p>
                        </div>
                        <span class="px-2 py-1 bg-white border border-yellow-200 text-yellow-700 text-xs font-medium rounded">Badge</span>
                    </div>

                    {{-- Achievement 2 --}}
                    <div class="flex items-start gap-3 p-3 bg-yellow-50 rounded-lg">
                        <div class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-medium text-sm">Lab Expert</h4>
                            <p class="text-xs text-gray-600 mt-1">Scored 95% on lab techniques quiz</p>
                            <p class="text-xs text-gray-500 mt-1">1 minggu lalu</p>
                        </div>
                        <span class="px-2 py-1 bg-white border border-yellow-200 text-yellow-700 text-xs font-medium rounded">Sertifikat</span>
                    </div>

                    <button class="w-full px-4 py-2 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                            Lihat Semua Pencapaian
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="border-b border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900">Quick Actions</h2>
            <p class="text-sm text-gray-500 mt-1">Akses cepat ke fitur yang sering digunakan</p>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <button class="h-20 flex flex-col items-center justify-center gap-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">Katalog Kursus</span>
                </button>
                <button class="h-20 flex flex-col items-center justify-center gap-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">Jadwal Kelas</span>
                </button>
                <button class="h-20 flex flex-col items-center justify-center gap-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">Forum Diskusi</span>
                </button>
                <button class="h-20 flex flex-col items-center justify-center gap-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">Sertifikat</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
