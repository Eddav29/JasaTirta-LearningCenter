@extends('layouts.admin')

@section('title', 'Detail Pendaftaran')

@section('content')
<div class="max-w-5xl space-y-6">
    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        </div>
    @endif

    {{-- Header --}}
    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-2xl font-bold text-gray-900">Detail Pendaftaran</h1>
                    @if($registration->status === 'pending')
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            Menunggu Verifikasi
                        </span>
                    @elseif($registration->status === 'confirmed')
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Disetujui
                        </span>
                    @elseif($registration->status === 'cancelled')
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            Ditolak
                        </span>
                    @endif
                </div>
                <p class="text-sm text-gray-500">ID Pendaftaran: #{{ str_pad($registration->id, 6, '0', STR_PAD_LEFT) }}</p>
                <p class="text-xs text-gray-400 mt-1">Dibuat: {{ $registration->created_at->format('d M Y H:i') }}</p>
            </div>
            <div class="flex gap-2">
                @if($registration->status === 'pending' && $registration->payment_status === 'pending_verification')
                    <button type="button" onclick="document.getElementById('approveModal').classList.remove('hidden')" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 shadow-md hover:shadow-lg transition-all">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Setujui
                    </button>
                    <button type="button" onclick="document.getElementById('rejectModal').classList.remove('hidden')" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 shadow-md hover:shadow-lg transition-all">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Tolak
                    </button>
                @endif
                <a href="{{ route('admin.registrations.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border-2 border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Participant Information --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h2 class="text-lg font-bold text-gray-900">Informasi Peserta</h2>
            </div>
            <div class="space-y-4">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <div class="flex-1">
                        <span class="text-xs text-gray-500">Nama Lengkap</span>
                        <p class="text-sm text-gray-900 font-semibold">{{ $registration->user->name }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <div class="flex-1">
                        <span class="text-xs text-gray-500">Email</span>
                        <p class="text-sm text-gray-900 font-medium">{{ $registration->user->email }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <div class="flex-1">
                        <span class="text-xs text-gray-500">Tanggal Pendaftaran</span>
                        <p class="text-sm text-gray-900 font-medium">{{ $registration->registration_date->format('d M Y, H:i') }} WIB</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Training Information --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h2 class="text-lg font-bold text-gray-900">Informasi Pelatihan</h2>
            </div>
            <div class="space-y-4">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <div class="flex-1">
                        <span class="text-xs text-gray-500">Nama Pelatihan</span>
                        <p class="text-sm text-gray-900 font-semibold">{{ $registration->trainingSchedule->training->name }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    <div class="flex-1">
                        <span class="text-xs text-gray-500">Kategori</span>
                        <p class="text-sm text-gray-900 font-medium">{{ $registration->trainingSchedule->training->category->name ?? 'Umum' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <div class="flex-1">
                        <span class="text-xs text-gray-500">Tanggal Mulai</span>
                        <p class="text-sm text-gray-900 font-medium">{{ \Carbon\Carbon::parse($registration->trainingSchedule->start_date)->format('d M Y') }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="flex-1">
                        <span class="text-xs text-gray-500">Durasi</span>
                        <p class="text-sm text-gray-900 font-medium">{{ $registration->trainingSchedule->training->duration }} Jam</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Payment Information --}}
    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
        <div class="flex items-center gap-3 mb-5">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <h2 class="text-lg font-bold text-gray-900">Informasi Pembayaran</h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-linear-to-br from-blue-50 to-blue-100 rounded-lg p-4 border border-blue-200">
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-xs font-medium text-blue-700">Jumlah Pembayaran</span>
                </div>
                <p class="text-2xl font-bold text-blue-900">Rp {{ number_format($registration->payment_amount, 0, ',', '.') }}</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                <span class="text-xs font-medium text-gray-600 block mb-2">Status Pembayaran</span>
                @if($registration->payment_status === 'pending_verification')
                    <span class="px-3 py-1.5 inline-flex items-center gap-1.5 text-sm font-semibold rounded-lg bg-yellow-100 text-yellow-800">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        Menunggu Verifikasi
                    </span>
                @elseif($registration->payment_status === 'paid')
                    <span class="px-3 py-1.5 inline-flex items-center gap-1.5 text-sm font-semibold rounded-lg bg-green-100 text-green-800">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Lunas
                    </span>
                @elseif($registration->payment_status === 'refunded')
                    <span class="px-3 py-1.5 inline-flex items-center gap-1.5 text-sm font-semibold rounded-lg bg-red-100 text-red-800">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        Dikembalikan
                    </span>
                @else
                    <span class="px-3 py-1.5 inline-flex text-sm font-semibold rounded-lg bg-gray-100 text-gray-800">{{ ucfirst($registration->payment_status) }}</span>
                @endif
            </div>
            
            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                <span class="text-xs font-medium text-gray-600 block mb-2">Status Pendaftaran</span>
                @if($registration->status === 'pending')
                    <span class="px-3 py-1.5 inline-flex items-center gap-1.5 text-sm font-semibold rounded-lg bg-yellow-100 text-yellow-800">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        Pending
                    </span>
                @elseif($registration->status === 'confirmed')
                    <span class="px-3 py-1.5 inline-flex items-center gap-1.5 text-sm font-semibold rounded-lg bg-green-100 text-green-800">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Confirmed
                    </span>
                @elseif($registration->status === 'cancelled')
                    <span class="px-3 py-1.5 inline-flex items-center gap-1.5 text-sm font-semibold rounded-lg bg-red-100 text-red-800">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        Cancelled
                    </span>
                @endif
            </div>
        </div>

        @if($registration->payment_proof)
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Bukti Pembayaran
                </h3>
                <div class="mt-3">
                    @if(str_ends_with($registration->payment_proof, '.pdf'))
                        <a href="{{ Storage::url($registration->payment_proof) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-3 bg-blue-50 border-2 border-blue-200 rounded-lg text-blue-700 hover:bg-blue-100 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                            <span class="font-semibold">Lihat PDF Bukti Pembayaran</span>
                        </a>
                    @else
                        <div class="relative inline-block">
                            <img src="{{ Storage::url($registration->payment_proof) }}" alt="Bukti Pembayaran" class="max-w-lg rounded-lg border-2 border-gray-300 shadow-md cursor-pointer" onclick="document.getElementById('imageModal').classList.remove('hidden')">
                            <a href="{{ Storage::url($registration->payment_proof) }}" target="_blank" class="absolute top-3 right-3 p-2 bg-white rounded-lg shadow-md hover:bg-gray-100 transition-all">
                                <svg class="w-5 h-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        @if($registration->verified_at)
            <div class="mt-6 pt-6 border-t border-gray-200">
                <div class="flex items-center gap-2 text-sm text-gray-600">
                    <svg class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-medium">Diverifikasi pada {{ $registration->verified_at->format('d M Y, H:i') }} WIB</span>
                    @if($registration->verifiedBy)
                        <span>oleh <span class="font-semibold text-gray-900">{{ $registration->verifiedBy->name }}</span></span>
                    @endif
                </div>
            </div>
        @endif
    </div>

    {{-- Refund Information --}}
    @if($registration->status === 'cancelled' && $registration->payment_status === 'refunded')
        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold text-gray-900">Informasi Refund</h2>
                </div>
                @if(!$registration->refund)
                    <a href="{{ route('admin.refunds.create', $registration) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 shadow-md hover:shadow-lg transition-all">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Proses Refund
                    </a>
                @endif
            </div>

            @if($registration->refund)
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-linear-to-br from-purple-50 to-purple-100 rounded-lg p-4 border border-purple-200">
                            <div class="flex items-center gap-2 mb-2">
                                <svg class="w-5 h-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-xs font-medium text-purple-700">Jumlah Refund</span>
                            </div>
                            <p class="text-2xl font-bold text-purple-900">Rp {{ number_format($registration->refund->refund_amount, 0, ',', '.') }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <span class="text-xs font-medium text-gray-600 block mb-2">Metode Refund</span>
                            <p class="text-sm font-semibold text-gray-900">
                                @if($registration->refund->refund_method === 'bank_transfer')
                                    Transfer Bank
                                @elseif($registration->refund->refund_method === 'cash')
                                    Tunai
                                @elseif($registration->refund->refund_method === 'ewallet')
                                    E-Wallet
                                @else
                                    {{ ucfirst($registration->refund->refund_method) }}
                                @endif
                            </p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <span class="text-xs font-medium text-gray-600 block mb-2">Status Refund</span>
                            @if($registration->refund->refund_status === 'pending')
                                <span class="px-3 py-1.5 inline-flex items-center gap-1.5 text-sm font-semibold rounded-lg bg-yellow-100 text-yellow-800">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    Pending
                                </span>
                            @elseif($registration->refund->refund_status === 'processing')
                                <span class="px-3 py-1.5 inline-flex items-center gap-1.5 text-sm font-semibold rounded-lg bg-blue-100 text-blue-800">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    Diproses
                                </span>
                            @elseif($registration->refund->refund_status === 'completed')
                                <span class="px-3 py-1.5 inline-flex items-center gap-1.5 text-sm font-semibold rounded-lg bg-green-100 text-green-800">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Selesai
                                </span>
                            @elseif($registration->refund->refund_status === 'failed')
                                <span class="px-3 py-1.5 inline-flex items-center gap-1.5 text-sm font-semibold rounded-lg bg-red-100 text-red-800">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    Gagal
                                </span>
                            @endif
                        </div>
                    </div>

                    @if($registration->refund->refund_notes)
                        <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div class="flex-1">
                                    <p class="text-xs font-semibold text-blue-700 mb-1">Catatan Refund</p>
                                    <p class="text-sm text-gray-700">{{ $registration->refund->refund_notes }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($registration->refund->refund_proof)
                        <div class="border-t border-gray-200 pt-4">
                            <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Bukti Refund
                            </h3>
                            <div class="mt-3">
                                <img src="{{ Storage::url($registration->refund->refund_proof) }}" alt="Bukti Refund" class="max-w-lg rounded-lg border-2 border-gray-300 shadow-md">
                            </div>
                        </div>
                    @endif

                    @if($registration->refund->processed_at)
                        <div class="pt-4 border-t border-gray-200">
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <svg class="w-5 h-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="font-medium">Refund diproses pada {{ $registration->refund->processed_at->format('d M Y, H:i') }} WIB</span>
                                @if($registration->refund->processedBy)
                                    <span>oleh <span class="font-semibold text-gray-900">{{ $registration->refund->processedBy->name }}</span></span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="text-gray-600 font-medium mb-4">Refund belum diproses</p>
                    <a href="{{ route('admin.refunds.create', $registration) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 shadow-md hover:shadow-lg transition-all">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Proses Refund Sekarang
                    </a>
                </div>
            @endif
        </div>
    @endif

    {{-- Notes --}}
    @if($registration->notes)
        <div class="bg-white border border-gray-200 rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-2">Catatan dari Peserta</h2>
            <p class="text-sm text-gray-700">{{ $registration->notes }}</p>
        </div>
    @endif

    {{-- Rejection Reason --}}
    @if($registration->rejected_reason)
        <div class="bg-red-50 border border-red-200 rounded-lg p-6">
            <h2 class="text-lg font-semibold text-red-900 mb-2">Alasan Penolakan</h2>
            <p class="text-sm text-red-800">{{ $registration->rejected_reason }}</p>
        </div>
    @endif
</div>

{{-- Approve Modal --}}
<div id="approveModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden" onclick="if(event.target === this) this.classList.add('hidden')">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full transform transition-all" onclick="event.stopPropagation()">
            <div class="p-6">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Setujui Pendaftaran</h3>
                        <p class="text-sm text-gray-600">Konfirmasi pembayaran peserta</p>
                    </div>
                </div>
                
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                    <p class="text-sm text-green-800">
                        Dengan menyetujui pendaftaran ini, Anda mengkonfirmasi bahwa:
                    </p>
                    <ul class="mt-2 text-sm text-green-800 space-y-1 list-disc list-inside">
                        <li>Bukti pembayaran telah diverifikasi</li>
                        <li>Pembayaran telah diterima</li>
                        <li>Peserta akan mendapat notifikasi konfirmasi</li>
                        <li>Peserta dapat mengikuti pelatihan</li>
                    </ul>
                </div>
                
                <form action="{{ route('admin.registrations.approve', $registration) }}" method="POST">
                    @csrf
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="document.getElementById('approveModal').classList.add('hidden')" class="px-4 py-2 border-2 border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-all">
                            Batal
                        </button>
                        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg text-sm font-bold hover:bg-green-700 shadow-lg hover:shadow-xl transition-all">
                            Ya, Setujui Pendaftaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Reject Modal --}}
<div id="rejectModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden" onclick="if(event.target === this) this.classList.add('hidden')">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full transform transition-all" onclick="event.stopPropagation()">
            <div class="p-6">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Tolak Pendaftaran</h3>
                        <p class="text-sm text-gray-600">Berikan alasan penolakan</p>
                    </div>
                </div>
                
                <form action="{{ route('admin.registrations.reject', $registration) }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="rejected_reason" class="block text-sm font-semibold text-gray-700 mb-2">
                            Alasan Penolakan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="rejected_reason" 
                                  id="rejected_reason" 
                                  rows="4" 
                                  required 
                                  class="block w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-red-500 focus:ring-red-500 transition-colors" 
                                  placeholder="Contoh: Bukti pembayaran tidak jelas / Nominal pembayaran tidak sesuai / Dll."></textarea>
                        <p class="mt-2 text-xs text-gray-500">Alasan ini akan dikirim ke peserta via email</p>
                    </div>
                    
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                        <p class="text-sm text-red-800 font-medium">
                            ⚠️ Tindakan ini akan:
                        </p>
                        <ul class="mt-2 text-sm text-red-700 space-y-1 list-disc list-inside">
                            <li>Membatalkan pendaftaran peserta</li>
                            <li>Mengirim notifikasi penolakan</li>
                            <li>Mengubah status pembayaran menjadi "Refunded"</li>
                        </ul>
                    </div>
                    
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="document.getElementById('rejectModal').classList.add('hidden')" class="px-4 py-2 border-2 border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-all">
                            Batal
                        </button>
                        <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg text-sm font-bold hover:bg-red-700 shadow-lg hover:shadow-xl transition-all">
                            Ya, Tolak Pendaftaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Image Preview Modal --}}
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden" onclick="this.classList.add('hidden')">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative max-w-4xl w-full">
            <button onclick="document.getElementById('imageModal').classList.add('hidden')" class="absolute -top-10 right-0 text-white hover:text-gray-300 transition-colors">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            @if($registration->payment_proof && !str_ends_with($registration->payment_proof, '.pdf'))
                <img src="{{ Storage::url($registration->payment_proof) }}" alt="Bukti Pembayaran" class="w-full h-auto rounded-lg shadow-2xl" onclick="event.stopPropagation()">
            @endif
        </div>
    </div>
</div>
@endsection
