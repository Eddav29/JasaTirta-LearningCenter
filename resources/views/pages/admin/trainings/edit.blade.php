@extends('layouts.admin')

@section('title', 'Edit Pelatihan')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Edit Pelatihan</h1>
            <p class="text-gray-600 mt-1">Perbarui informasi pelatihan</p>
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
            <p class="text-sm text-gray-600 mt-1">Perbarui data pelatihan dengan benar</p>
        </div>

        <form action="{{ route('admin.trainings.update', $training) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid gap-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Judul Pelatihan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title', $training->title) }}" required
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category & Instructor -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            <select name="category_id" id="category_id" required
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white @error('category_id') border-red-500 @enderror">
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $training->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="instructor_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Instruktur <span class="text-red-500">*</span>
                            </label>
                            <select name="instructor_id" id="instructor_id" required
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white @error('instructor_id') border-red-500 @enderror">
                                <option value="">Pilih Instruktur</option>
                                @foreach ($instructors as $instructor)
                                    <option value="{{ $instructor->id }}" {{ old('instructor_id', $training->instructor_id) == $instructor->id ? 'selected' : '' }}>
                                        {{ $instructor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('instructor_id')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Deskripsi Singkat <span class="text-red-500">*</span>
                        </label>
                        <textarea name="description" id="description" rows="3" required
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white @error('description') border-red-500 @enderror">{{ old('description', $training->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Long Description -->
                    <div>
                        <label for="long_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Deskripsi Lengkap
                        </label>
                        <textarea name="long_description" id="long_description" rows="5"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white @error('long_description') border-red-500 @enderror">{{ old('long_description', $training->long_description) }}</textarea>
                        @error('long_description')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Duration, Price, Capacity -->
                    <div class="grid md:grid-cols-3 gap-6">
                        <div>
                            <label for="duration" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Durasi (hari) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="duration" id="duration" value="{{ old('duration', $training->duration) }}" required min="1"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white @error('duration') border-red-500 @enderror">
                            @error('duration')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Harga (Rp) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="price" id="price" value="{{ old('price', $training->price) }}" required min="0" step="0.01"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white @error('price') border-red-500 @enderror">
                            @error('price')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="capacity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Kapasitas <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $training->capacity) }}" required min="1"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white @error('capacity') border-red-500 @enderror">
                            @error('capacity')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Training Type & Learning Hours -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="training_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Tingkat Kesulitan <span class="text-red-500">*</span>
                            </label>
                            <select name="training_type" id="training_type" required
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white @error('training_type') border-red-500 @enderror">
                                <option value="">Pilih Tingkat</option>
                                <option value="Beginner" {{ old('training_type', $training->training_type) == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                <option value="Intermediate" {{ old('training_type', $training->training_type) == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="Advanced" {{ old('training_type', $training->training_type) == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                                <option value="Expert" {{ old('training_type', $training->training_type) == 'Expert' ? 'selected' : '' }}>Expert</option>
                            </select>
                            @error('training_type')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="learning_hours" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Jam Pembelajaran
                            </label>
                            <input type="number" name="learning_hours" id="learning_hours" value="{{ old('learning_hours', $training->learning_hours) }}" min="1"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white @error('learning_hours') border-red-500 @enderror">
                            @error('learning_hours')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Training Methods -->
                    <div>
                        <label for="training_methods" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Metode Pelatihan
                        </label>
                        <input type="text" name="training_methods" id="training_methods" value="{{ old('training_methods', $training->training_methods) }}"
                            placeholder="Contoh: Online, Offline, Hybrid"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white @error('training_methods') border-red-500 @enderror">
                        @error('training_methods')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Certification Note -->
                    <div>
                        <label for="certification_note" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Catatan Sertifikasi
                        </label>
                        <textarea name="certification_note" id="certification_note" rows="2"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white @error('certification_note') border-red-500 @enderror">{{ old('certification_note', $training->certification_note) }}</textarea>
                        @error('certification_note')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-4">
                            <label class="flex items-center">
                                <input type="radio" name="is_active" value="1" {{ old('is_active', $training->is_active) == '1' ? 'checked' : '' }}
                                    class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Aktif</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="is_active" value="0" {{ old('is_active', $training->is_active) == '0' ? 'checked' : '' }}
                                    class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Tidak Aktif</span>
                            </label>
                        </div>
                        @error('is_active')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.trainings.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                        Perbarui Pelatihan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection>
        </div>
    </div>
@endsection
