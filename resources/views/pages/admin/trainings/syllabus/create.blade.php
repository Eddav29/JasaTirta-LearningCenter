@extends('layouts.admin')

@section('title', 'Tambah Kurikulum')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Tambah Kurikulum</h1>
            <p class="text-gray-600 mt-1">Tambahkan kurikulum untuk pelatihan: <span class="font-semibold">{{ $training->title }}</span></p>
        </div>
        <a href="{{ route('admin.trainings.show', $training) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    {{-- Form --}}
    <div class="bg-white rounded-lg border border-gray-200">
        <form action="{{ route('admin.trainings.syllabus.store', $training) }}" method="POST" 
              x-data="{
                  topics: [''],
                  addTopic() {
                      this.topics.push('');
                  },
                  removeTopic(index) {
                      if (this.topics.length > 1) {
                          this.topics.splice(index, 1);
                      }
                  }
              }">
            @csrf

            <div class="p-6 space-y-6">
                {{-- Day --}}
                <div>
                    <label for="day" class="block text-sm font-medium text-gray-700 mb-2">
                        Hari Ke <span class="text-red-500">*</span>
                    </label>
                    @php
                        $dayInputClass = $errors->has('day') ? 'border-red-500' : 'border-gray-300';
                    @endphp
                    <input type="number" 
                           name="day" 
                           id="day" 
                           min="1"
                           value="{{ old('day', 1) }}"
                           class="w-full px-4 py-2 border {{ $dayInputClass }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                           required>
                    @error('day')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Masukkan urutan hari pembelajaran (contoh: 1, 2, 3)</p>
                </div>

                {{-- Title --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Sesi <span class="text-red-500">*</span>
                    </label>
                    @php
                        $titleInputClass = $errors->has('title') ? 'border-red-500' : 'border-gray-300';
                    @endphp
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title') }}"
                           placeholder="Contoh: Service Container & Dependency Injection"
                           class="w-full px-4 py-2 border {{ $titleInputClass }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                           required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Topics --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Topik yang Dibahas <span class="text-red-500">*</span>
                    </label>
                    <p class="text-sm text-gray-500 mb-3">Tambahkan topik-topik yang akan dibahas dalam sesi ini</p>

                    @php
                        $topicInputClass = $errors->has('topics.*') ? 'border-red-500' : 'border-gray-300';
                    @endphp

                    <div class="space-y-3">
                        <template x-for="(topic, index) in topics" :key="index">
                            <div class="flex items-start gap-2">
                                <div class="shrink-0 w-8 h-10 flex items-center justify-center">
                                    <span class="text-sm font-medium text-gray-500" x-text="index + 1 + '.'"></span>
                                </div>
                                <div class="flex-1">
                                    <input type="text" 
                                           :name="'topics[' + index + ']'" 
                                           x-model="topics[index]"
                                           placeholder="Masukkan topik pembelajaran"
                                           class="w-full px-4 py-2 border {{ $topicInputClass }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                           required>
                                </div>
                                <button type="button" 
                                        @click="removeTopic(index)"
                                        x-show="topics.length > 1"
                                        class="shrink-0 p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </template>
                    </div>

                    @error('topics')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                    @error('topics.*')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror

                    <button type="button" 
                            @click="addTopic()"
                            class="mt-3 inline-flex items-center px-4 py-2 border-2 border-dashed border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:border-blue-500 hover:text-blue-600 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Tambah Topik
                    </button>
                </div>
            </div>

            {{-- Actions --}}
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-end gap-3 rounded-b-lg">
                <a href="{{ route('admin.trainings.show', $training) }}" 
                   class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                    Simpan Kurikulum
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
