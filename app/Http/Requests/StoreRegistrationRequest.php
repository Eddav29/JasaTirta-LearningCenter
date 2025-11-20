<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'training_schedule_id' => 'required|exists:training_schedules,id',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'payment_amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'training_schedule_id.required' => 'Jadwal pelatihan harus dipilih.',
            'training_schedule_id.exists' => 'Jadwal pelatihan tidak valid.',
            'payment_proof.required' => 'Bukti pembayaran harus diunggah.',
            'payment_proof.file' => 'Bukti pembayaran harus berupa file.',
            'payment_proof.mimes' => 'Bukti pembayaran harus berformat JPG, JPEG, PNG, atau PDF.',
            'payment_proof.max' => 'Ukuran bukti pembayaran maksimal 2MB.',
            'payment_amount.required' => 'Jumlah pembayaran harus diisi.',
            'payment_amount.numeric' => 'Jumlah pembayaran harus berupa angka.',
            'payment_amount.min' => 'Jumlah pembayaran tidak valid.',
            'notes.max' => 'Catatan maksimal 1000 karakter.',
        ];
    }
}
