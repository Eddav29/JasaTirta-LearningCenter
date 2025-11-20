@extends('layouts.admin')

@section('title', 'Detail Pesan - Admin')

@section('content')
<div class="space-y-6">
    {{-- Header with Back Button --}}
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a 
                href="{{ route('admin.messages.index') }}" 
                class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition"
            >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Detail Pesan</h1>
                <p class="text-gray-600 mt-1">
                    Diterima pada {{ $message->created_at->format('d M Y, H:i') }}
                </p>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-2">
            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Hapus Pesan
                </button>
            </form>
        </div>
    </div>

    {{-- Message Content --}}
    <div class="grid lg:grid-cols-3 gap-6">
        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Message Card --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="space-y-6">
                    {{-- Subject --}}
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Subjek</h3>
                        <p class="text-xl font-semibold text-gray-900">{{ $message->subject }}</p>
                    </div>

                    {{-- Message Body --}}
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Pesan</h3>
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <p class="text-gray-800 whitespace-pre-line leading-relaxed">{{ $message->message }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="lg:col-span-1 space-y-6">
            {{-- Sender Information --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pengirim</h3>
                
                <div class="space-y-4">
                    {{-- Avatar & Name --}}
                    <div class="flex items-center gap-3 pb-4 border-b border-gray-200">
                        <div class="shrink-0 h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center">
                            <span class="text-blue-600 font-medium text-lg">
                                {{ strtoupper(substr($message->user->name ?? $message->name, 0, 2)) }}
                            </span>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-900">
                                {{ $message->user->name ?? $message->name }}
                            </div>
                            @if($message->user)
                            <div class="text-xs text-gray-500">
                                User ID: #{{ $message->user->id }}
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Email --}}
                    <div>
                        <div class="text-xs font-medium text-gray-500 uppercase mb-1">Email</div>
                        <a href="mailto:{{ $message->user->email ?? $message->email }}" class="text-sm text-blue-600 hover:text-blue-800">
                            {{ $message->user->email ?? $message->email }}
                        </a>
                    </div>

                    {{-- Phone --}}
                    @if($message->phone)
                    <div>
                        <div class="text-xs font-medium text-gray-500 uppercase mb-1">Telepon</div>
                        <a href="tel:{{ $message->phone }}" class="text-sm text-blue-600 hover:text-blue-800">
                            {{ $message->phone }}
                        </a>
                    </div>
                    @endif

                    {{-- Company --}}
                    @if($message->company)
                    <div>
                        <div class="text-xs font-medium text-gray-500 uppercase mb-1">Perusahaan</div>
                        <div class="text-sm text-gray-900">{{ $message->company }}</div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Status & Actions --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Status & Tindakan</h3>
                
                <div class="space-y-4">
                    {{-- Current Status --}}
                    <div>
                        <div class="text-xs font-medium text-gray-500 uppercase mb-2">Status Saat Ini</div>
                        @if($message->status === 'unread')
                        <span class="px-3 py-1.5 inline-flex text-sm leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            Belum Dibaca
                        </span>
                        @elseif($message->status === 'read')
                        <span class="px-3 py-1.5 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Sudah Dibaca
                        </span>
                        @else
                        <span class="px-3 py-1.5 inline-flex text-sm leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                            </svg>
                            Terbalas
                        </span>
                        @endif
                    </div>

                    {{-- Change Status --}}
                    <div>
                        <div class="text-xs font-medium text-gray-500 uppercase mb-2">Ubah Status</div>
                        <form action="{{ route('admin.messages.updateStatus', $message) }}" method="POST" class="space-y-2">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm">
                                <option value="unread" {{ $message->status === 'unread' ? 'selected' : '' }}>Belum Dibaca</option>
                                <option value="read" {{ $message->status === 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
                                <option value="replied" {{ $message->status === 'replied' ? 'selected' : '' }}>Terbalas</option>
                            </select>
                            <button type="submit" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition">
                                Update Status
                            </button>
                        </form>
                    </div>

                    {{-- Timestamps --}}
                    <div class="pt-4 border-t border-gray-200 space-y-2 text-xs text-gray-600">
                        <div class="flex justify-between">
                            <span>Diterima:</span>
                            <span class="font-medium">{{ $message->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        @if($message->read_at)
                        <div class="flex justify-between">
                            <span>Dibaca:</span>
                            <span class="font-medium">{{ $message->read_at->format('d M Y, H:i') }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h4 class="text-sm font-semibold text-blue-900 mb-3">Tindakan Cepat</h4>
                <div class="space-y-2">
                    <a href="mailto:{{ $message->user->email ?? $message->email }}?subject=Re: {{ $message->subject }}" class="flex items-center text-sm text-blue-700 hover:text-blue-900">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Balas via Email
                    </a>
                    @if($message->phone)
                    <a href="tel:{{ $message->phone }}" class="flex items-center text-sm text-blue-700 hover:text-blue-900">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Hubungi via Telepon
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
    {{ session('success') }}
</div>
@endif
@endsection
