@extends('layouts.admin')

@section('title', 'Tambah Peserta Baru')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Tambah Peserta Baru</h1>
            <p class="text-gray-600 mt-1">Tambahkan data peserta pelatihan baru</p>
        </div>
        <a href="{{ route('admin.participants.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    {{-- Form --}}
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Informasi Peserta</h3>
            <p class="text-sm text-gray-600 mt-1">Lengkapi data peserta dengan benar</p>
        </div>

        <form action="{{ route('admin.participants.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            
            {{-- Basic Information --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Depan <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="first_name" 
                        name="first_name" 
                        value="{{ old('first_name') }}"
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('first_name') border-red-300 @enderror"
                        placeholder="Masukkan nama depan"
                    >
                    @error('first_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Belakang
                    </label>
                    <input 
                        type="text" 
                        id="last_name" 
                        name="last_name" 
                        value="{{ old('last_name') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('last_name') border-red-300 @enderror"
                        placeholder="Masukkan nama belakang"
                    >
                    @error('last_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-300 @enderror"
                        placeholder="peserta@example.com"
                    >
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                        Nomor Telepon
                    </label>
                    <input 
                        type="text" 
                        id="phone" 
                        name="phone" 
                        value="{{ old('phone') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('phone') border-red-300 @enderror"
                        placeholder="+62 812-3456-7890"
                    >
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-300 @enderror"
                        placeholder="Minimal 8 karakter"
                    >
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Konfirmasi Password <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Ulangi password"
                    >
                </div>

                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                        Role <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="role" 
                        name="role" 
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('role') border-red-300 @enderror"
                    >
                        <option value="">Pilih role</option>
                        <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>Student</option>
                        <option value="corporate" {{ old('role') === 'corporate' ? 'selected' : '' }}>Corporate</option>
                        <option value="participant" {{ old('role') === 'participant' ? 'selected' : '' }}>Participant</option>
                        <option value="instructor" {{ old('role') === 'instructor' ? 'selected' : '' }}>Instructor</option>
                    </select>
                    @error('role')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status
                    </label>
                    <select 
                        id="status" 
                        name="status" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-300 @enderror"
                    >
                        <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Additional Information --}}
            <div class="border-t border-gray-200 pt-6">
                <h4 class="text-md font-semibold text-gray-900 mb-4">Informasi Tambahan</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="company_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Perusahaan/Institusi
                        </label>
                        <input 
                            type="text" 
                            id="company_name" 
                            name="company_name" 
                            value="{{ old('company_name') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('company_name') border-red-300 @enderror"
                            placeholder="PT/CV/Universitas"
                        >
                        @error('company_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="position" class="block text-sm font-medium text-gray-700 mb-2">
                            Jabatan/Posisi
                        </label>
                        <input 
                            type="text" 
                            id="position" 
                            name="position" 
                            value="{{ old('position') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('position') border-red-300 @enderror"
                            placeholder="Staff, Manager, Mahasiswa, dll"
                        >
                        @error('position')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat
                        </label>
                        <textarea 
                            id="address" 
                            name="address" 
                            rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('address') border-red-300 @enderror"
                            placeholder="Alamat lengkap"
                        >{{ old('address') }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.participants.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button 
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors"
                >
                    Simpan Peserta
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
