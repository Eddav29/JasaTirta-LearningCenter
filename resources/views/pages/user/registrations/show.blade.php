@extends('layouts.user')

@section('title', 'Detail Pendaftaran')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    {{-- Breadcrumb --}}
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-4">
            <li>
                <a href="{{ route('user.dashboard') }}" class="text-gray-400 hover:text-gray-500">
                    <svg class="shrink-0 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-9 9a1 1 0 001.414 1.414L8 5.414V17a1 1 0 102 0V5.414l6.293 6.293a1 1 0 001.414-1.414l-9-9z"/>
                    </svg>
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <a href="{{ route('user.registrations.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Pendaftaran</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="ml-4 text-sm font-medium text-gray-500">Detail</span>
                </div>
            </li>
        </ol>
    </nav>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex">
                <div class="shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    {{-- Registration Status --}}
    <div class="bg-white border border-gray-200 rounded-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail Pendaftaran</h1>
                <p class="mt-1 text-sm text-gray-500">ID: #{{ $registration->id }}</p>
            </div>
            <div class="text-right">
                @if($registration->status === 'pending')
                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu Verifikasi</span>
                @elseif($registration->status === 'confirmed')
                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">Dikonfirmasi</span>
                @elseif($registration->status === 'cancelled')
                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">Dibatalkan</span>
                @endif
                <p class="mt-1 text-xs text-gray-500">Tgl Daftar: {{ $registration->registration_date->format('d M Y') }}</p>
            </div>
        </div>
    </div>

    {{-- Training Information --}}
    <div class="bg-white border border-gray-200 rounded-lg p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pelatihan</h2>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <span class="text-gray-500">Nama Pelatihan:</span>
                <p class="mt-1 text-gray-900 font-medium">{{ $registration->trainingSchedule->training->name }}</p>
            </div>
            <div>
                <span class="text-gray-500">Kategori:</span>
                <p class="mt-1 text-gray-900">{{ $registration->trainingSchedule->training->category->name ?? 'Umum' }}</p>
            </div>
            <div>
                <span class="text-gray-500">Tanggal Mulai:</span>
                <p class="mt-1 text-gray-900">{{ \Carbon\Carbon::parse($registration->trainingSchedule->start_date)->format('d M Y') }}</p>
            </div>
            <div>
                <span class="text-gray-500">Durasi:</span>
                <p class="mt-1 text-gray-900">{{ $registration->trainingSchedule->training->duration }} jam</p>
            </div>
        </div>
    </div>

    {{-- Payment Information --}}
    <div class="bg-white border border-gray-200 rounded-lg p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pembayaran</h2>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <span class="text-gray-500">Jumlah Pembayaran:</span>
                <p class="mt-1 text-gray-900 font-semibold">Rp {{ number_format($registration->payment_amount, 0, ',', '.') }}</p>
            </div>
            <div>
                <span class="text-gray-500">Status Pembayaran:</span>
                <div class="mt-1">
                    @if($registration->payment_status === 'unpaid')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Belum Bayar</span>
                    @elseif($registration->payment_status === 'pending_verification')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu Verifikasi</span>
                    @elseif($registration->payment_status === 'paid')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Lunas</span>
                    @elseif($registration->payment_status === 'refunded')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Dikembalikan</span>
                    @endif
                </div>
            </div>
            @if($registration->payment_proof)
                <div class="col-span-2">
                    <span class="text-gray-500">Bukti Pembayaran:</span>
                    <div class="mt-2">
                        <a href="{{ Storage::url($registration->payment_proof) }}" target="_blank" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            <svg class="shrink-0 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Lihat Bukti Pembayaran
                        </a>
                    </div>
                </div>
            @endif
            @if($registration->verified_at)
                <div class="col-span-2">
                    <span class="text-gray-500">Diverifikasi:</span>
                    <p class="mt-1 text-gray-900">
                        {{ $registration->verified_at->format('d M Y H:i') }}
                        @if($registration->verifiedBy)
                            oleh {{ $registration->verifiedBy->name }}
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>

    {{-- Notes --}}
    @if($registration->notes)
        <div class="bg-white border border-gray-200 rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-2">Catatan</h2>
            <p class="text-sm text-gray-700">{{ $registration->notes }}</p>
        </div>
    @endif

    {{-- Rejected Reason --}}
    @if($registration->rejected_reason)
        <div class="bg-red-50 border border-red-200 rounded-lg p-6">
            <h2 class="text-lg font-semibold text-red-900 mb-2">Alasan Penolakan</h2>
            <p class="text-sm text-red-800">{{ $registration->rejected_reason }}</p>
        </div>
    @endif

    {{-- Actions --}}
    @if($registration->status === 'pending' && $registration->payment_status === 'pending_verification')
        <div class="bg-white border border-gray-200 rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Aksi</h2>
            <form action="{{ route('user.registrations.cancel', $registration) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pendaftaran ini?')">
                @csrf
                <button type="submit" class="px-4 py-2 border border-red-300 rounded-md text-sm font-medium text-red-700 hover:bg-red-50">
                    Batalkan Pendaftaran
                </button>
            </form>
        </div>
    @endif

    {{-- Back Button --}}
    <div class="flex justify-start">
        <a href="{{ route('user.registrations.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
            <svg class="mr-2 shrink-0 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Pendaftaran
        </a>
    </div>
</div>
@endsection
