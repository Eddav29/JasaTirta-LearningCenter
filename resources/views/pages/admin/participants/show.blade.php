@extends('layouts.admin')

@section('title', 'Detail Peserta')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Detail Peserta</h1>
            <p class="text-gray-600 mt-1">Informasi lengkap peserta pelatihan</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.participants.edit', $user) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit
            </a>
            <a href="{{ route('admin.participants.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Basic Information --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-lg border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Dasar</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Nama Lengkap</p>
                            <p class="text-gray-900 mt-1">{{ $user->first_name }} {{ $user->last_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Email</p>
                            <p class="text-gray-900 mt-1">{{ $user->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Nomor Telepon</p>
                            <p class="text-gray-900 mt-1">{{ $user->phone ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Role</p>
                            <p class="text-gray-900 mt-1">
                                @php
                                    $role = $user->getRoleNames()->first() ?? 'user';
                                    $roleColor = match($role) {
                                        'admin' => 'bg-indigo-100 text-indigo-800',
                                        'instructor' => 'bg-purple-100 text-purple-800',
                                        'corporate' => 'bg-blue-100 text-blue-800',
                                        'participant' => 'bg-green-100 text-green-800',
                                        default => 'bg-gray-100 text-gray-800'
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $roleColor }}">
                                    {{ ucfirst($role) }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Status</p>
                            <p class="text-gray-900 mt-1">
                                @if($user->email_verified_at)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Inactive
                                    </span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Bergabung Sejak</p>
                            <p class="text-gray-900 mt-1">{{ $user->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Additional Information --}}
            @if($user->company_name || $user->position || $user->address)
                <div class="bg-white rounded-lg border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Informasi Tambahan</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Perusahaan/Institusi</p>
                                <p class="text-gray-900 mt-1">{{ $user->company_name ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Jabatan/Posisi</p>
                                <p class="text-gray-900 mt-1">{{ $user->position ?? '-' }}</p>
                            </div>
                            @if($user->address)
                                <div class="md:col-span-2">
                                    <p class="text-sm font-medium text-gray-600">Alamat</p>
                                    <p class="text-gray-900 mt-1">{{ $user->address }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Profile Card --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-blue-600 rounded-full text-white text-3xl font-bold">
                        {{ strtoupper(substr($user->first_name, 0, 1) . substr($user->last_name ?? '', 0, 1)) }}
                    </div>
                    <h3 class="mt-4 text-xl font-bold text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</h3>
                    <p class="text-gray-600 mt-1">{{ $user->email }}</p>
                    
                    @if($user->email_verified_at)
                        <div class="mt-4 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Email Terverifikasi
                        </div>
                    @else
                        <div class="mt-4 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Belum Terverifikasi
                        </div>
                    @endif
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h4 class="text-sm font-semibold text-gray-900 mb-3">Informasi Akun</h4>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">ID</span>
                            <span class="font-medium text-gray-900">#{{ $user->id }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Dibuat</span>
                            <span class="font-medium text-gray-900">{{ $user->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Terakhir Update</span>
                            <span class="font-medium text-gray-900">{{ $user->updated_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 space-y-2">
                    <a href="{{ route('admin.participants.edit', $user) }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Peserta
                    </a>
                    <form action="{{ route('admin.participants.destroy', $user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus peserta ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-red-300 text-red-700 rounded-lg text-sm font-medium hover:bg-red-50 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Hapus Peserta
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
