@extends('layouts.user')

@section('title', 'Daftar Pelatihan - ' . $schedule->training->name)

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
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
                    <a href="{{ route('user.schedules') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Jadwal</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="ml-4 text-sm font-medium text-gray-500">Pendaftaran</span>
                </div>
            </li>
        </ol>
    </nav>

    {{-- Training Info --}}
    <div class="bg-linear-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-6 shadow-sm">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <h2 class="text-2xl font-bold text-gray-900 mb-1">{{ $schedule->training->name }}</h2>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    {{ $schedule->training->category->name ?? 'Umum' }}
                </span>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-600 mb-1">Total Biaya</p>
                <p class="text-3xl font-bold text-blue-600">Rp {{ number_format($schedule->training->price ?? 0, 0, ',', '.') }}</p>
            </div>
        </div>
        
        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="flex items-center gap-3 bg-white rounded-lg p-3 border border-gray-200">
                <div class="shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Durasi</p>
                    <p class="text-sm font-semibold text-gray-900">{{ $schedule->training->duration }} Jam</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3 bg-white rounded-lg p-3 border border-gray-200">
                <div class="shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Tanggal Mulai</p>
                    <p class="text-sm font-semibold text-gray-900">{{ \Carbon\Carbon::parse($schedule->start_date)->format('d M Y') }}</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3 bg-white rounded-lg p-3 border border-gray-200">
                <div class="shrink-0 w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Lokasi</p>
                    <p class="text-sm font-semibold text-gray-900">{{ $schedule->location ?? 'Online' }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Registration Form --}}
    <div class="bg-white border border-gray-200 rounded-xl p-8 shadow-sm">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900">Formulir Pendaftaran</h3>
                <p class="text-sm text-gray-600">Lengkapi data dan upload bukti pembayaran</p>
            </div>
        </div>
        
        <form action="{{ route('user.registrations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <input type="hidden" name="training_schedule_id" value="{{ $schedule->id }}">
            
            {{-- Payment Amount (Read-only) --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Pembayaran</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <span class="text-gray-500 text-lg font-medium">Rp</span>
                    </div>
                    <input type="hidden" name="payment_amount" value="{{ $schedule->training->price ?? 0 }}">
                    <input type="text" 
                           value="{{ number_format($schedule->training->price ?? 0, 0, ',', '.') }}"
                           readonly
                           class="block w-full pl-12 pr-4 py-3 rounded-lg bg-gray-50 border-2 border-gray-200 text-gray-900 font-bold text-lg cursor-not-allowed">
                </div>
                <p class="mt-2 text-sm text-gray-600 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Harga sudah termasuk biaya pelatihan dan sertifikat
                </p>
            </div>

            {{-- Payment Proof --}}
            <div>
                <label for="payment_proof" class="block text-sm font-semibold text-gray-700 mb-2">
                    Bukti Pembayaran <span class="text-red-500">*</span>
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-lg {{ $errors->has('payment_proof') ? 'border-red-300 bg-red-50' : 'border-gray-300 hover:border-blue-400 bg-gray-50' }} transition-colors">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="payment_proof" class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>Upload bukti transfer</span>
                                <input type="file" 
                                       name="payment_proof" 
                                       id="payment_proof" 
                                       accept=".jpg,.jpeg,.png,.pdf"
                                       required
                                       class="sr-only"
                                       onchange="displayFileName(this)">
                            </label>
                            <p class="pl-1">atau drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, JPEG atau PDF hingga 2MB</p>
                        <p id="file-name" class="text-sm text-blue-600 font-medium mt-2"></p>
                    </div>
                </div>
                @error('payment_proof')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Notes --}}
            <div>
                <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">Catatan Tambahan (Opsional)</label>
                <div class="mt-1">
                    <textarea name="notes" 
                              id="notes" 
                              rows="4" 
                              class="block w-full px-4 py-3 rounded-lg border-2 {{ $errors->has('notes') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : 'border-gray-200 focus:border-blue-500 focus:ring-blue-500' }} transition-colors"
                              placeholder="Contoh: Saya ingin duduk di bagian depan kelas">{{ old('notes') }}</textarea>
                </div>
                @error('notes')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Payment Instructions --}}
            <div class="bg-blue-50 border-2 border-blue-200 rounded-xl p-6">
                <div class="flex items-start gap-3 mb-4">
                    <div class="shrink-0 w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-blue-900 mb-1">Instruksi Pembayaran</h4>
                        <p class="text-sm text-blue-700">Ikuti langkah-langkah berikut untuk menyelesaikan pendaftaran</p>
                    </div>
                </div>
                
                <ol class="space-y-3 mb-4">
                    <li class="flex items-start gap-3">
                        <span class="shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold">1</span>
                        <span class="text-sm text-blue-900">Transfer pembayaran ke rekening yang tertera di bawah</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold">2</span>
                        <span class="text-sm text-blue-900">Simpan bukti transfer dalam format JPG, PNG, atau PDF</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold">3</span>
                        <span class="text-sm text-blue-900">Upload bukti transfer pada formulir di atas</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold">4</span>
                        <span class="text-sm text-blue-900">Klik tombol "Kirim Pendaftaran" di bawah</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold">5</span>
                        <span class="text-sm text-blue-900">Admin akan memverifikasi pembayaran dalam 1x24 jam kerja</span>
                    </li>
                </ol>
                
                <div class="bg-white rounded-lg p-4 border-2 border-blue-300">
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                        <p class="text-sm font-bold text-blue-900">Rekening Pembayaran</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm text-gray-700"><span class="font-semibold">Bank:</span> BCA</p>
                        <p class="text-sm text-gray-700"><span class="font-semibold">No. Rekening:</span> 1234567890</p>
                        <p class="text-sm text-gray-700"><span class="font-semibold">Atas Nama:</span> Jasa Tirta Learning Center</p>
                    </div>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="flex items-center justify-between gap-4 pt-4">
                <a href="{{ route('user.catalog') }}" class="px-6 py-3 border-2 border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
                <button type="submit" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 rounded-lg text-sm font-bold text-white shadow-lg shadow-blue-500/50 hover:shadow-xl hover:shadow-blue-500/50 transition-all flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Kirim Pendaftaran
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function displayFileName(input) {
    const fileName = input.files[0]?.name;
    const fileNameElement = document.getElementById('file-name');
    if (fileName) {
        fileNameElement.textContent = '✓ ' + fileName;
    } else {
        fileNameElement.textContent = '';
    }
}
</script>
@endpush
@endsection
