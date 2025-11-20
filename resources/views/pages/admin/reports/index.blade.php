@extends('layouts.admin')

@section('title', 'Laporan Lengkap')

@section('content')
<div class="space-y-6" x-data="{ 
    activeTab: 'users',
    periodFilter: '{{ request('period', 'bulan-ini') }}',
    
    applyFilter() {
        const url = new URL(window.location.href);
        url.searchParams.set('period', this.periodFilter);
        window.location.href = url.toString();
    }
}">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Laporan Lengkap</h1>
            <p class="text-gray-600 mt-1">
                Analisis dan statistik lengkap sistem pembelajaran
            </p>
        </div>
        
        <div class="flex items-center gap-3">
            <select 
                x-model="periodFilter"
                @change="applyFilter()"
                class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >
                <option value="hari-ini">Hari Ini</option>
                <option value="minggu-ini">Minggu Ini</option>
                <option value="bulan-ini">Bulan Ini</option>
                <option value="3-bulan">3 Bulan Terakhir</option>
                <option value="tahun-ini">Tahun Ini</option>
            </select>
            
            <button class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Export PDF
            </button>
        </div>
    </div>

    {{-- Summary Cards --}}
    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        @foreach($summaryStats as $stat)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600">{{ $stat['title'] }}</p>
                    <p class="text-2xl font-bold text-gray-900 mt-2">{{ $stat['value'] }}</p>
                    <div class="flex items-center gap-1 mt-2">
                        @if($stat['trend'] === 'up')
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        @else
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                        </svg>
                        @endif
                        <span class="text-sm font-medium {{ $stat['trend'] === 'up' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $stat['change'] }}
                        </span>
                    </div>
                </div>
                <div class="{{ $stat['bgColor'] }} p-3 rounded-lg">
                    @if($stat['icon'] === 'users')
                    <svg class="w-6 h-6 {{ $stat['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    @elseif($stat['icon'] === 'book-open')
                    <svg class="w-6 h-6 {{ $stat['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    @elseif($stat['icon'] === 'calendar')
                    <svg class="w-6 h-6 {{ $stat['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    @elseif($stat['icon'] === 'award')
                    <svg class="w-6 h-6 {{ $stat['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Detailed Reports Tabs --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        {{-- Tabs Navigation --}}
        <div class="border-b border-gray-200">
            <nav class="flex -mb-px overflow-x-auto">
                <button 
                    @click="activeTab = 'users'" 
                    :class="activeTab === 'users' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-300'"
                    class="flex items-center gap-2 px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap transition-colors"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    Pengguna
                </button>
                <button 
                    @click="activeTab = 'trainings'" 
                    :class="activeTab === 'trainings' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-300'"
                    class="flex items-center gap-2 px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap transition-colors"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    Pelatihan
                </button>
                <button 
                    @click="activeTab = 'revenue'" 
                    :class="activeTab === 'revenue' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-300'"
                    class="flex items-center gap-2 px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap transition-colors"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Pendapatan
                </button>
                <button 
                    @click="activeTab = 'certificates'" 
                    :class="activeTab === 'certificates' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-300'"
                    class="flex items-center gap-2 px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap transition-colors"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                    Sertifikat
                </button>
            </nav>
        </div>

        {{-- Tab Contents --}}
        <div class="p-6">
            {{-- Users Report --}}
            <div x-show="activeTab === 'users'" x-transition>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Laporan Pengguna</h2>
                    <button class="inline-flex items-center px-3 py-2 text-sm border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Export
                    </button>
                </div>

                <div class="rounded-lg border border-gray-200 overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-900">Kategori</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-900">Bulan Ini</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-900">Bulan Lalu</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-900">Pertumbuhan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($userStats as $stat)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $stat['category'] }}</td>
                                <td class="px-4 py-3 text-center font-semibold text-gray-900">{{ number_format($stat['thisMonth']) }}</td>
                                <td class="px-4 py-3 text-center text-gray-600">{{ number_format($stat['lastMonth']) }}</td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{ $stat['growth'] }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Training Report --}}
            <div x-show="activeTab === 'trainings'" x-transition x-cloak>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Laporan Pelatihan</h2>
                    <button class="inline-flex items-center px-3 py-2 text-sm border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Export
                    </button>
                </div>

                <div class="rounded-lg border border-gray-200 overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-900">Nama Pelatihan</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-900">Peserta</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-900">Jadwal</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-900">Kategori</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-900">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($trainingStats as $training)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $training['name'] }}</td>
                                <td class="px-4 py-3 text-center text-gray-900">{{ $training['participants'] }}</td>
                                <td class="px-4 py-3 text-center text-gray-900">{{ $training['schedules'] }}</td>
                                <td class="px-4 py-3 text-center text-gray-600">{{ $training['category'] }}</td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $training['status'] === 'Aktif' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $training['status'] }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                    Tidak ada data pelatihan
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Revenue Report --}}
            <div x-show="activeTab === 'revenue'" x-transition x-cloak>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Laporan Pendapatan</h2>
                    <button class="inline-flex items-center px-3 py-2 text-sm border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Export
                    </button>
                </div>

                <div class="rounded-lg border border-gray-200 overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-900">Bulan</th>
                                <th class="px-4 py-3 text-right text-sm font-semibold text-gray-900">Pendapatan</th>
                                <th class="px-4 py-3 text-right text-sm font-semibold text-gray-900">Target</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-900">Pencapaian</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($revenueStats as $stat)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $stat['month'] }}</td>
                                <td class="px-4 py-3 text-right font-semibold text-gray-900">
                                    Rp {{ number_format($stat['revenue'], 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-right text-gray-600">
                                    Rp {{ number_format($stat['target'], 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $stat['achievement'] >= 100 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ number_format($stat['achievement'], 1) }}%
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Revenue Summary --}}
                <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Total Pendapatan</p>
                            <p class="text-xl font-bold text-gray-900 mt-1">
                                Rp {{ number_format(array_sum(array_column($revenueStats, 'revenue')), 0, ',', '.') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Target</p>
                            <p class="text-xl font-bold text-gray-900 mt-1">
                                Rp {{ number_format(array_sum(array_column($revenueStats, 'target')), 0, ',', '.') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Rata-rata Pencapaian</p>
                            <p class="text-xl font-bold text-gray-900 mt-1">
                                {{ number_format(array_sum(array_column($revenueStats, 'achievement')) / count($revenueStats), 1) }}%
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Certificate Report --}}
            <div x-show="activeTab === 'certificates'" x-transition x-cloak>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Laporan Sertifikat</h2>
                    <button class="inline-flex items-center px-3 py-2 text-sm border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Export
                    </button>
                </div>

                <div class="rounded-lg border border-gray-200 overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-900">Pelatihan</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-900">Diterbitkan</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-900">Pending</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-900">Total Peserta</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-900">Progress</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($certificateStats as $stat)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $stat['training'] }}</td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{ $stat['issued'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        {{ $stat['pending'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center font-medium text-gray-900">{{ $stat['total'] }}</td>
                                <td class="px-4 py-3 text-center">
                                    <span class="text-sm font-semibold text-gray-900">
                                        {{ $stat['total'] > 0 ? number_format(($stat['issued'] / $stat['total']) * 100, 0) : 0 }}%
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                    Tidak ada data sertifikat
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Certificate Summary --}}
                <div class="mt-6 grid grid-cols-3 gap-4">
                    <div class="bg-white p-4 rounded-lg border border-gray-200">
                        <p class="text-sm text-gray-600">Total Sertifikat Diterbitkan</p>
                        <p class="text-2xl font-bold text-gray-900 mt-2">
                            {{ number_format(array_sum(array_column($certificateStats, 'issued'))) }}
                        </p>
                    </div>
                    <div class="bg-white p-4 rounded-lg border border-gray-200">
                        <p class="text-sm text-gray-600">Total Pending</p>
                        <p class="text-2xl font-bold text-gray-900 mt-2">
                            {{ number_format(array_sum(array_column($certificateStats, 'pending'))) }}
                        </p>
                    </div>
                    <div class="bg-white p-4 rounded-lg border border-gray-200">
                        <p class="text-sm text-gray-600">Tingkat Penerbitan</p>
                        <p class="text-2xl font-bold text-gray-900 mt-2">
                            @php
                                $totalIssued = array_sum(array_column($certificateStats, 'issued'));
                                $totalParticipants = array_sum(array_column($certificateStats, 'total'));
                                $issuanceRate = $totalParticipants > 0 ? ($totalIssued / $totalParticipants) * 100 : 0;
                            @endphp
                            {{ number_format($issuanceRate, 1) }}%
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
