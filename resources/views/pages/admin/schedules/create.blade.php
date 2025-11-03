@extends('layouts.admin')

@section('title', 'Tambah Jadwal Pelatihan')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Tambah Jadwal Pelatihan</h1>
            <p class="text-gray-600 mt-1">Buat jadwal baru untuk pelatihan yang tersedia</p>
        </div>
        <a href="{{ route('admin.schedules.index') }}" 
           class="inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            {{ session('success') }}
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            {{ session('error') }}
        </div>
    </div>
    @endif

    {{-- Form --}}
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="p-6">
            <form method="POST" action="{{ route('admin.schedules.store') }}" class="space-y-6">
                @csrf
                
                {{-- Training Selection --}}
                <div>
                    <label for="training_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Pelatihan <span class="text-red-500">*</span>
                    </label>
                    <select name="training_id" id="training_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('training_id') border-red-500 @enderror">
                        <option value="">Pilih Pelatihan</option>
                        @foreach($trainings as $training)
                            <option value="{{ $training->id }}" {{ old('training_id') == $training->id ? 'selected' : '' }}>
                                {{ $training->title }} - {{ $training->instructor->name ?? 'N/A' }}
                            </option>
                        @endforeach
                    </select>
                    @error('training_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Date Range --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Mulai <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="start_date" id="start_date" required 
                               value="{{ old('start_date') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('start_date') border-red-500 @enderror">
                        @error('start_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Selesai <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="end_date" id="end_date" required 
                               value="{{ old('end_date') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('end_date') border-red-500 @enderror">
                        @error('end_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Time Range --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="start_time" class="block text-sm font-medium text-gray-700 mb-2">
                            Waktu Mulai <span class="text-red-500">*</span>
                        </label>
                        <input type="time" name="start_time" id="start_time" required 
                               value="{{ old('start_time', '09:00') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('start_time') border-red-500 @enderror">
                        @error('start_time')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="end_time" class="block text-sm font-medium text-gray-700 mb-2">
                            Waktu Selesai <span class="text-red-500">*</span>
                        </label>
                        <input type="time" name="end_time" id="end_time" required 
                               value="{{ old('end_time', '17:00') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('end_time') border-red-500 @enderror">
                        @error('end_time')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Location and Method --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                            Lokasi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="location" id="location" required 
                               value="{{ old('location') }}"
                               placeholder="Contoh: Jakarta Training Center"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('location') border-red-500 @enderror">
                        @error('location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="method" class="block text-sm font-medium text-gray-700 mb-2">
                            Metode <span class="text-red-500">*</span>
                        </label>
                        <select name="method" id="method" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('method') border-red-500 @enderror">
                            <option value="">Pilih Metode</option>
                            <option value="online" {{ old('method') == 'online' ? 'selected' : '' }}>Online</option>
                            <option value="offline" {{ old('method') == 'offline' ? 'selected' : '' }}>Offline</option>
                            <option value="hybrid" {{ old('method') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                        @error('method')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Capacity and Status --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="total_slots" class="block text-sm font-medium text-gray-700 mb-2">
                            Kapasitas Peserta <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="total_slots" id="total_slots" required 
                               value="{{ old('total_slots', 20) }}" min="1" max="100"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('total_slots') border-red-500 @enderror">
                        @error('total_slots')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="status" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-500 @enderror">
                            <option value="buka_pendaftaran" {{ old('status', 'buka_pendaftaran') == 'buka_pendaftaran' ? 'selected' : '' }}>Buka Pendaftaran</option>
                            <option value="penuh" {{ old('status') == 'penuh' ? 'selected' : '' }}>Penuh</option>
                            <option value="berlangsung" {{ old('status') == 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                            <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="dibatalkan" {{ old('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Submit Buttons --}}
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.schedules.index') }}" 
                       class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Jadwal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Auto-set end date when start date is selected
    document.getElementById('start_date').addEventListener('change', function() {
        const startDate = new Date(this.value);
        const endDateInput = document.getElementById('end_date');
        
        if (!endDateInput.value) {
            // Default to same day if end date is not set
            endDateInput.value = this.value;
        }
    });
    
    // Validate that end date is not before start date
    document.getElementById('end_date').addEventListener('change', function() {
        const startDate = new Date(document.getElementById('start_date').value);
        const endDate = new Date(this.value);
        
        if (endDate < startDate) {
            alert('Tanggal selesai tidak boleh lebih awal dari tanggal mulai');
            this.value = document.getElementById('start_date').value;
        }
    });
    
    // Validate that end time is after start time (for same day)
    document.getElementById('end_time').addEventListener('change', function() {
        const startTime = document.getElementById('start_time').value;
        const endTime = this.value;
        const startDate = document.getElementById('start_date').value;
        const endDate = document.getElementById('end_date').value;
        
        // Only validate if it's the same day
        if (startDate === endDate && endTime <= startTime) {
            alert('Waktu selesai harus lebih lambat dari waktu mulai untuk hari yang sama');
            this.value = '';
        }
    });
</script>
@endsection