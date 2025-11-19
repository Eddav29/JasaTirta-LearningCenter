@extends('layouts.admin')

@section('title', 'Tambah Pelatihan Baru')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Tambah Pelatihan Baru</h1>
            <p class="text-gray-600 mt-1">Tambahkan data pelatihan baru ke sistem</p>
        </div>
        <a href="{{ route('admin.trainings.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    {{-- Form --}}
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Informasi Pelatihan</h3>
            <p class="text-sm text-gray-600 mt-1">Lengkapi data pelatihan dengan benar</p>
        </div>

        <form action="{{ route('admin.trainings.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            
            {{-- Basic Information --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Pelatihan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                        class="w-full px-3 py-2 border {{ $errors->has('title') ? 'border-red-300' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Masukkan judul pelatihan">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select id="category_id" name="category_id" required
                        class="w-full px-3 py-2 border {{ $errors->has('category_id') ? 'border-red-300' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="instructor_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Instruktur <span class="text-red-500">*</span>
                    </label>
                    <select id="instructor_id" name="instructor_id" required
                        class="w-full px-3 py-2 border {{ $errors->has('instructor_id') ? 'border-red-300' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Pilih Instruktur</option>
                        @foreach ($instructors as $instructor)
                            <option value="{{ $instructor->id }}" {{ old('instructor_id') == $instructor->id ? 'selected' : '' }}>
                                {{ $instructor->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('instructor_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="training_type" class="block text-sm font-medium text-gray-700 mb-2">
                        Tipe Pelatihan <span class="text-red-500">*</span>
                    </label>
                    <select id="training_type" name="training_type" required
                        class="w-full px-3 py-2 border {{ $errors->has('training_type') ? 'border-red-300' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Pilih Tipe</option>
                        <option value="Beginner" {{ old('training_type') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                        <option value="Intermediate" {{ old('training_type') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                        <option value="Advanced" {{ old('training_type') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                        <option value="Expert" {{ old('training_type') == 'Expert' ? 'selected' : '' }}>Expert</option>
                    </select>
                    @error('training_type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Deskripsi Singkat <span class="text-red-500">*</span>
                </label>
                <textarea id="description" name="description" rows="3" required
                    class="w-full px-3 py-2 border {{ $errors->has('description') ? 'border-red-300' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Masukkan deskripsi singkat pelatihan">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="long_description" class="block text-sm font-medium text-gray-700 mb-2">
                    Deskripsi Lengkap
                </label>
                <textarea id="long_description" name="long_description" rows="5"
                    class="w-full px-3 py-2 border {{ $errors->has('long_description') ? 'border-red-300' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Masukkan deskripsi lengkap pelatihan">{{ old('long_description') }}</textarea>
                @error('long_description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Image Upload --}}
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                    Gambar Pelatihan <span class="text-gray-400">(Opsional)</span>
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors">
                    <div class="space-y-1 text-center">
                        <div class="flex text-sm text-gray-600">
                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>Upload gambar</span>
                                <input id="image" name="image" type="file" class="sr-only" accept="image/*" onchange="previewImage(event)">
                            </label>
                            <p class="pl-1">atau drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, JPEG, GIF hingga 2MB</p>
                        <div id="image-preview" class="mt-4 hidden">
                            <img id="preview-img" src="#" alt="Preview" class="mx-auto h-32 w-auto rounded-lg">
                            <button type="button" onclick="removeImage()" class="mt-2 text-sm text-red-600 hover:text-red-500">Hapus gambar</button>
                        </div>
                    </div>
                </div>
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Training Details --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">
                        Durasi (hari) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="duration" name="duration" value="{{ old('duration') }}" required min="1"
                        class="w-full px-3 py-2 border {{ $errors->has('duration') ? 'border-red-300' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="0">
                    @error('duration')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                        Harga (Rp) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="price" name="price" value="{{ old('price') }}" required min="0" step="0.01"
                        class="w-full px-3 py-2 border {{ $errors->has('price') ? 'border-red-300' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="0">
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="capacity" class="block text-sm font-medium text-gray-700 mb-2">
                        Kapasitas <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="capacity" name="capacity" value="{{ old('capacity') }}" required min="1"
                        class="w-full px-3 py-2 border {{ $errors->has('capacity') ? 'border-red-300' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="0">
                    @error('capacity')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="learning_hours" class="block text-sm font-medium text-gray-700 mb-2">
                        Jam Pembelajaran
                    </label>
                    <input type="number" id="learning_hours" name="learning_hours" value="{{ old('learning_hours') }}" min="1"
                        class="w-full px-3 py-2 border {{ $errors->has('learning_hours') ? 'border-red-300' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="0">
                    @error('learning_hours')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="training_methods" class="block text-sm font-medium text-gray-700 mb-2">
                        Metode Pelatihan
                    </label>
                    <select id="training_methods" name="training_methods"
                        class="w-full px-3 py-2 border {{ $errors->has('training_methods') ? 'border-red-300' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Pilih Metode</option>
                        <option value="Presentasi" {{ old('training_methods') == 'Presentasi' ? 'selected' : '' }}>Presentasi</option>
                        <option value="Workshop" {{ old('training_methods') == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                        <option value="Simulasi" {{ old('training_methods') == 'Simulasi' ? 'selected' : '' }}>Simulasi</option>
                        <option value="Studi Kasus" {{ old('training_methods') == 'Studi Kasus' ? 'selected' : '' }}>Studi Kasus</option>
                        <option value="Diskusi Kelompok" {{ old('training_methods') == 'Diskusi Kelompok' ? 'selected' : '' }}>Diskusi Kelompok</option>
                        <option value="Praktik Lapangan" {{ old('training_methods') == 'Praktik Lapangan' ? 'selected' : '' }}>Praktik Lapangan</option>
                    </select>
                    @error('training_methods')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="certification_note" class="block text-sm font-medium text-gray-700 mb-2">
                    Catatan Sertifikasi
                </label>
                <textarea id="certification_note" name="certification_note" rows="2"
                    class="w-full px-3 py-2 border {{ $errors->has('certification_note') ? 'border-red-300' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Masukkan catatan sertifikasi">{{ old('certification_note') }}</textarea>
                @error('certification_note')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <div class="flex gap-4">
                    <label class="flex items-center">
                        <input type="radio" name="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }}
                            class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Aktif</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="is_active" value="0" {{ old('is_active') == '0' ? 'checked' : '' }}
                            class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Tidak Aktif</span>
                    </label>
                </div>
                @error('is_active')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Action Buttons --}}
            <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.trainings.index') }}"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                    Simpan Pelatihan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('image-preview');
            const img = document.getElementById('preview-img');
            img.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
}

function removeImage() {
    document.getElementById('image').value = '';
    document.getElementById('image-preview').classList.add('hidden');
}
</script>
@endsection
