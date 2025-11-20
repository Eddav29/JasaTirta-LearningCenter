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
    <div class="bg-white border border-gray-200 rounded-lg p-6">
        <h2 class="text-xl font-bold text-gray-900">{{ $schedule->training->name }}</h2>
        <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
            <div>
                <span class="text-gray-500">Kategori:</span>
                <span class="ml-2 text-gray-900">{{ $schedule->training->category->name ?? 'Umum' }}</span>
            </div>
            <div>
                <span class="text-gray-500">Durasi:</span>
                <span class="ml-2 text-gray-900">{{ $schedule->training->duration }} jam</span>
            </div>
            <div>
                <span class="text-gray-500">Tanggal Mulai:</span>
                <span class="ml-2 text-gray-900">{{ \Carbon\Carbon::parse($schedule->start_date)->format('d M Y') }}</span>
            </div>
            <div>
                <span class="text-gray-500">Biaya:</span>
                <span class="ml-2 text-gray-900 font-semibold">Rp {{ number_format($schedule->training->price ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    {{-- Registration Form --}}
    <div class="bg-white border border-gray-200 rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Formulir Pendaftaran</h3>
        
        <form action="{{ route('user.registrations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <input type="hidden" name="training_schedule_id" value="{{ $schedule->id }}">
            
            {{-- Payment Amount --}}
            <div>
                <label for="payment_amount" class="block text-sm font-medium text-gray-700">Jumlah Pembayaran</label>
                <div class="mt-1">
                    <input type="number" 
                           name="payment_amount" 
                           id="payment_amount" 
                           value="{{ old('payment_amount', $schedule->training->price ?? 0) }}"
                           class="block w-full rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 {{ $errors->has('payment_amount') ? 'border-red-500' : 'border-gray-300' }}">
                </div>
                @error('payment_amount')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Biaya pelatihan: Rp {{ number_format($schedule->training->price ?? 0, 0, ',', '.') }}</p>
            </div>

            {{-- Payment Proof --}}
            <div>
                <label for="payment_proof" class="block text-sm font-medium text-gray-700">Bukti Pembayaran</label>
                <div class="mt-1">
                    <input type="file" 
                           name="payment_proof" 
                           id="payment_proof" 
                           accept=".jpg,.jpeg,.png,.pdf"
                           class="block w-full text-sm text-gray-900 border rounded-md cursor-pointer focus:outline-none {{ $errors->has('payment_proof') ? 'border-red-500' : 'border-gray-300' }}">
                </div>
                @error('payment_proof')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Format: JPG, JPEG, PNG, atau PDF (Maks. 2MB)</p>
            </div>

            {{-- Notes --}}
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700">Catatan (Opsional)</label>
                <div class="mt-1">
                    <textarea name="notes" 
                              id="notes" 
                              rows="3" 
                              class="block w-full rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 {{ $errors->has('notes') ? 'border-red-500' : 'border-gray-300' }}"
                              placeholder="Tambahkan catatan jika diperlukan">{{ old('notes') }}</textarea>
                </div>
                @error('notes')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Payment Instructions --}}
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h4 class="text-sm font-medium text-blue-900 mb-2">Instruksi Pembayaran:</h4>
                <ol class="list-decimal list-inside space-y-1 text-sm text-blue-800">
                    <li>Transfer pembayaran ke rekening yang tertera</li>
                    <li>Simpan bukti transfer</li>
                    <li>Upload bukti transfer pada formulir di atas</li>
                    <li>Admin akan memverifikasi pembayaran Anda dalam 1x24 jam</li>
                    <li>Anda akan mendapat notifikasi setelah pembayaran diverifikasi</li>
                </ol>
                <div class="mt-3 p-3 bg-white rounded border border-blue-300">
                    <p class="text-sm font-semibold text-blue-900">Rekening Pembayaran:</p>
                    <p class="text-sm text-blue-800">Bank BCA - 1234567890</p>
                    <p class="text-sm text-blue-800">a.n. Jasa Tirta Learning Center</p>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="flex justify-end gap-3">
                <a href="{{ route('user.schedules') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Daftar & Upload Bukti Bayar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
