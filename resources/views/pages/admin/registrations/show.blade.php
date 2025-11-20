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
    <div class="bg-white border border-gray-200 rounded-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail Pendaftaran</h1>
                <p class="mt-1 text-sm text-gray-500">ID: #{{ $registration->id }}</p>
            </div>
            <div class="flex gap-2">
                @if($registration->status === 'pending' && $registration->payment_status === 'pending_verification')
                    <form action="{{ route('admin.registrations.approve', $registration) }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                            Setujui
                        </button>
                    </form>
                    <button type="button" onclick="document.getElementById('rejectModal').classList.remove('hidden')" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                        Tolak
                    </button>
                @endif
                <a href="{{ route('admin.registrations.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Participant Information --}}
        <div class="bg-white border border-gray-200 rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Peserta</h2>
            <div class="space-y-3 text-sm">
                <div>
                    <span class="text-gray-500">Nama:</span>
                    <p class="mt-1 text-gray-900 font-medium">{{ $registration->user->name }}</p>
                </div>
                <div>
                    <span class="text-gray-500">Email:</span>
                    <p class="mt-1 text-gray-900">{{ $registration->user->email }}</p>
                </div>
                <div>
                    <span class="text-gray-500">Tanggal Daftar:</span>
                    <p class="mt-1 text-gray-900">{{ $registration->registration_date->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>

        {{-- Training Information --}}
        <div class="bg-white border border-gray-200 rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pelatihan</h2>
            <div class="space-y-3 text-sm">
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
    </div>

    {{-- Payment Information --}}
    <div class="bg-white border border-gray-200 rounded-lg p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pembayaran</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
            <div>
                <span class="text-gray-500">Jumlah Pembayaran:</span>
                <p class="mt-1 text-gray-900 font-semibold text-lg">Rp {{ number_format($registration->payment_amount, 0, ',', '.') }}</p>
            </div>
            <div>
                <span class="text-gray-500">Status Pembayaran:</span>
                <div class="mt-1">
                    @if($registration->payment_status === 'pending_verification')
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu Verifikasi</span>
                    @elseif($registration->payment_status === 'paid')
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">Lunas</span>
                    @elseif($registration->payment_status === 'refunded')
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">Dikembalikan</span>
                    @else
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">{{ ucfirst($registration->payment_status) }}</span>
                    @endif
                </div>
            </div>
            <div>
                <span class="text-gray-500">Status Pendaftaran:</span>
                <div class="mt-1">
                    @if($registration->status === 'pending')
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                    @elseif($registration->status === 'confirmed')
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">Confirmed</span>
                    @elseif($registration->status === 'cancelled')
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
                    @endif
                </div>
            </div>
        </div>

        @if($registration->payment_proof)
            <div class="mt-6">
                <span class="text-sm text-gray-500">Bukti Pembayaran:</span>
                <div class="mt-2">
                    @if(str_ends_with($registration->payment_proof, '.pdf'))
                        <a href="{{ Storage::url($registration->payment_proof) }}" target="_blank" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            <svg class="shrink-0 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                            Lihat PDF Bukti Pembayaran
                        </a>
                    @else
                        <img src="{{ Storage::url($registration->payment_proof) }}" alt="Bukti Pembayaran" class="max-w-md border border-gray-300 rounded-lg">
                    @endif
                </div>
            </div>
        @endif

        @if($registration->verified_at)
            <div class="mt-4 pt-4 border-t border-gray-200">
                <span class="text-sm text-gray-500">Diverifikasi:</span>
                <p class="mt-1 text-sm text-gray-900">
                    {{ $registration->verified_at->format('d M Y H:i') }}
                    @if($registration->verifiedBy)
                        oleh <span class="font-medium">{{ $registration->verifiedBy->name }}</span>
                    @endif
                </p>
            </div>
        @endif
    </div>

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

{{-- Reject Modal --}}
<div id="rejectModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tolak Pendaftaran</h3>
            <form action="{{ route('admin.registrations.reject', $registration) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="rejected_reason" class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan</label>
                    <textarea name="rejected_reason" id="rejected_reason" rows="4" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500" placeholder="Jelaskan alasan penolakan..."></textarea>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('rejectModal').classList.add('hidden')" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                        Tolak Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
