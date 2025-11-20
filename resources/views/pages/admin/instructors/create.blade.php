@extends('layouts.admin')

@section('title', 'Tambah Instructor Baru')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Tambah Instructor Baru</h1>
            <p class="text-gray-600 mt-1">Tambahkan data pengajar dan instruktur pelatihan baru</p>
        </div>
        <a href="{{ route('admin.instructors.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    {{-- Form --}}
    <div class="bg-white rounded-lg border border-gray-200" x-data="instructorForm()">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Informasi Instructor</h3>
            <p class="text-sm text-gray-600 mt-1">Lengkapi data instructor dengan benar</p>
        </div>

        <form action="{{ route('admin.instructors.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            
            {{-- Basic Information --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        required
                        class="w-full px-3 py-2 border {{ $errors->has('name') ? 'border-red-300' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Masukkan nama lengkap instructor"
                    >
                    @error('name')
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
                        class="w-full px-3 py-2 border {{ $errors->has('email') ? 'border-red-300' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="instructor@example.com"
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
                        class="w-full px-3 py-2 border {{ $errors->has('phone') ? 'border-red-300' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="08123456789"
                    >
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="instructor_type" class="block text-sm font-medium text-gray-700 mb-2">
                        Tipe Instructor <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="instructor_type" 
                        name="instructor_type" 
                        required
                        class="w-full px-3 py-2 border {{ $errors->has('instructor_type') ? 'border-red-300' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <option value="">Pilih tipe instructor</option>
                        <option value="internal" {{ old('instructor_type') === 'internal' ? 'selected' : '' }}>Internal</option>
                        <option value="vendor" {{ old('instructor_type') === 'vendor' ? 'selected' : '' }}>Vendor</option>
                    </select>
                    @error('instructor_type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Professional Information --}}
            <div class="border-t border-gray-200 pt-6">
                <h4 class="text-md font-semibold text-gray-900 mb-4">Informasi Profesional</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="specialization" class="block text-sm font-medium text-gray-700 mb-2">
                            Spesialisasi <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="specialization" 
                            name="specialization" 
                            value="{{ old('specialization') }}"
                            required
                            class="w-full px-3 py-2 border {{ $errors->has('specialization') ? 'border-red-300' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Contoh: Water Quality, Environmental, Microbiology"
                        >
                        @error('specialization')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Pisahkan dengan koma untuk multiple spesialisasi</p>
                    </div>

                    <div>
                        <label for="education" class="block text-sm font-medium text-gray-700 mb-2">
                            Pendidikan <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="education" 
                            name="education" 
                            value="{{ old('education') }}"
                            required
                            class="w-full px-3 py-2 border {{ $errors->has('education') ? 'border-red-300' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Contoh: S1 Teknik Lingkungan, S2 Kimia"
                        >
                        @error('education')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="experience" class="block text-sm font-medium text-gray-700 mb-2">
                            Pengalaman <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="experience" 
                            name="experience" 
                            value="{{ old('experience') }}"
                            required
                            class="w-full px-3 py-2 border {{ $errors->has('experience') ? 'border-red-300' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Contoh: 5 tahun di bidang lingkungan"
                        >
                        @error('experience')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">
                        Bio/Profil Singkat <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="bio" 
                        name="bio" 
                        rows="4"
                        required
                        class="w-full px-3 py-2 border {{ $errors->has('bio') ? 'border-red-300' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Deskripsi singkat tentang latar belakang dan pengalaman instructor"
                    >{{ old('bio') }}</textarea>
                    @error('bio')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Certifications --}}
            <div class="border-t border-gray-200 pt-6">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-md font-semibold text-gray-900">Sertifikasi</h4>
                    <button 
                        type="button" 
                        @click="addCertification()"
                        class="inline-flex items-center px-3 py-1.5 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                    >
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Sertifikasi
                    </button>
                </div>

                <div id="certifications-container" class="space-y-3">
                    <template x-for="(certification, index) in certifications" :key="index">
                        <div class="flex items-center gap-3">
                            <input 
                                type="text" 
                                :name="'certifications[' + index + ']'"
                                x-model="certification.name"
                                class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Nama sertifikasi"
                            >
                            <button 
                                type="button" 
                                @click="removeCertification(index)"
                                class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </template>
                    
                    <div x-show="certifications.length === 0" class="text-center py-8 text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="mt-2">Belum ada sertifikasi ditambahkan</p>
                        <p class="text-sm">Klik tombol "Tambah Sertifikasi" untuk menambah</p>
                    </div>
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.instructors.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button 
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors"
                >
                    Simpan Instructor
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('instructorForm', () => ({
            certifications: [],
            
            addCertification() {
                this.certifications.push({ name: '' });
            },
            
            removeCertification(index) {
                this.certifications.splice(index, 1);
            },
            
            init() {
                // Add one empty certification field by default
                this.addCertification();
            }
        }));
    });
</script>
@endpush