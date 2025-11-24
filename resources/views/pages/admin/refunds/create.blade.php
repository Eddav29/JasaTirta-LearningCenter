@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-linear-to-br from-slate-50 via-blue-50 to-slate-100 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <a href="{{ route('admin.registrations.show', $registration) }}" 
                   class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-white shadow-sm hover:shadow-md transition-all duration-200 group">
                    <svg class="w-5 h-5 text-gray-600 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Proses Refund</h1>
                    <p class="text-gray-600 mt-1">Proses pengembalian dana untuk pendaftaran yang ditolak</p>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.refunds.store', $registration) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Registration Information Card -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                <div class="bg-linear-to-r from-blue-600 to-blue-700 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Informasi Pendaftaran
                    </h2>
                </div>
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-500 mb-1">Peserta</p>
                                <p class="font-semibold text-gray-900">{{ $registration->user->name }}</p>
                                <p class="text-sm text-gray-600">{{ $registration->user->email }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-500 mb-1">Pelatihan</p>
                                <p class="font-semibold text-gray-900">{{ $registration->trainingSchedule->training->name }}</p>
                                <p class="text-sm text-gray-600">Batch {{ $registration->trainingSchedule->batch }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-500 mb-1">Jumlah Pembayaran</p>
                                <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($registration->payment_amount, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-500 mb-1">Alasan Penolakan</p>
                                <p class="text-gray-900">{{ $registration->rejected_reason ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Refund Form Card -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                <div class="bg-linear-to-r from-purple-600 to-purple-700 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Detail Refund
                    </h2>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Refund Amount -->
                    <div>
                        <label for="refund_amount" class="block text-sm font-semibold text-gray-700 mb-2">
                            Jumlah Refund <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                            <input type="number" 
                                   id="refund_amount" 
                                   name="refund_amount" 
                                   value="{{ old('refund_amount', $registration->payment_amount) }}"
                                   min="0"
                                   max="{{ $registration->payment_amount }}"
                                   step="0.01"
                                   required
                                   class="w-full pl-12 pr-4 py-3 border @error('refund_amount') border-red-500 @else border-gray-300 @enderror rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200">
                        </div>
                        @error('refund_amount')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-sm text-gray-600">Maksimal: Rp {{ number_format($registration->payment_amount, 0, ',', '.') }}</p>
                    </div>

                    <!-- Refund Method -->
                    <div>
                        <label for="refund_method" class="block text-sm font-semibold text-gray-700 mb-2">
                            Metode Refund <span class="text-red-500">*</span>
                        </label>
                        <select id="refund_method" 
                                name="refund_method" 
                                required
                                class="w-full px-4 py-3 border @error('refund_method') border-red-500 @else border-gray-300 @enderror rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200">
                            <option value="">Pilih Metode Refund</option>
                            <option value="bank_transfer" {{ old('refund_method') == 'bank_transfer' ? 'selected' : '' }}>Transfer Bank</option>
                            <option value="cash" {{ old('refund_method') == 'cash' ? 'selected' : '' }}>Tunai</option>
                            <option value="ewallet" {{ old('refund_method') == 'ewallet' ? 'selected' : '' }}>E-Wallet</option>
                            <option value="other" {{ old('refund_method') == 'other' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('refund_method')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Refund Proof -->
                    <div>
                        <label for="refund_proof" class="block text-sm font-semibold text-gray-700 mb-2">
                            Bukti Refund (Opsional)
                        </label>
                        <div class="relative">
                            <input type="file" 
                                   id="refund_proof" 
                                   name="refund_proof" 
                                   accept="image/jpeg,image/png,image/jpg"
                                   onchange="displayRefundProof(this)"
                                   class="hidden">
                            <label for="refund_proof" 
                                   class="flex items-center justify-center w-full px-6 py-8 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-all duration-200 group">
                                <div class="text-center">
                                    <svg class="w-12 h-12 mx-auto text-gray-400 group-hover:text-purple-500 transition-colors mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                    <p class="text-sm text-gray-600 mb-1">
                                        <span class="font-semibold text-purple-600">Klik untuk upload</span>
                                        atau drag & drop
                                    </p>
                                    <p class="text-xs text-gray-500">PNG, JPG hingga 2MB</p>
                                    <p id="refund_proof_name" class="mt-2 text-sm font-medium text-gray-700"></p>
                                </div>
                            </label>
                        </div>
                        @error('refund_proof')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Refund Notes -->
                    <div>
                        <label for="refund_notes" class="block text-sm font-semibold text-gray-700 mb-2">
                            Catatan Refund (Opsional)
                        </label>
                        <textarea id="refund_notes" 
                                  name="refund_notes" 
                                  rows="4"
                                  placeholder="Tambahkan catatan mengenai proses refund..."
                                  class="w-full px-4 py-3 border @error('refund_notes') border-red-500 @else border-gray-300 @enderror rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 resize-none">{{ old('refund_notes') }}</textarea>
                        @error('refund_notes')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('admin.registrations.show', $registration) }}" 
                   class="px-6 py-3 bg-white border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-200 font-medium shadow-sm">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-linear-to-r from-purple-600 to-purple-700 text-white rounded-xl hover:from-purple-700 hover:to-purple-800 transition-all duration-200 font-medium shadow-lg hover:shadow-xl flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Proses Refund
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function displayRefundProof(input) {
    const fileNameElement = document.getElementById('refund_proof_name');
    if (input.files && input.files[0]) {
        fileNameElement.textContent = '📎 ' + input.files[0].name;
    } else {
        fileNameElement.textContent = '';
    }
}
</script>
@endsection
