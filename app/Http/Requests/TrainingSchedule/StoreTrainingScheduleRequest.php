<?php

namespace App\Http\Requests\TrainingSchedule;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrainingScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'training_id' => 'required|integer|exists:trainings,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'location' => 'required|string|max:255',
            'method' => 'required|in:offline,online,hybrid',
            'total_slots' => 'required|integer|min:1|max:1000',
            'available_slots' => 'nullable|integer|min:0|lte:total_slots',
            'registered_count' => 'nullable|integer|min:0|lte:total_slots',
            'month' => 'nullable|string|date_format:Y-m',
            'status' => 'nullable|in:buka_pendaftaran,penuh,berlangsung,selesai,dibatalkan',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'training_id.required' => 'Training harus dipilih.',
            'training_id.exists' => 'Training yang dipilih tidak valid.',
            'start_date.required' => 'Tanggal mulai harus diisi.',
            'start_date.after_or_equal' => 'Tanggal mulai tidak boleh kurang dari hari ini.',
            'end_date.required' => 'Tanggal selesai harus diisi.',
            'end_date.after_or_equal' => 'Tanggal selesai tidak boleh kurang dari tanggal mulai.',
            'start_time.required' => 'Waktu mulai harus diisi.',
            'start_time.date_format' => 'Format waktu mulai tidak valid (gunakan HH:MM).',
            'end_time.required' => 'Waktu selesai harus diisi.',
            'end_time.date_format' => 'Format waktu selesai tidak valid (gunakan HH:MM).',
            'end_time.after' => 'Waktu selesai harus lebih dari waktu mulai.',
            'location.required' => 'Lokasi harus diisi.',
            'location.max' => 'Lokasi maksimal 255 karakter.',
            'method.required' => 'Metode pelatihan harus dipilih.',
            'method.in' => 'Metode pelatihan harus salah satu dari: offline, online, hybrid.',
            'total_slots.required' => 'Jumlah slot harus diisi.',
            'total_slots.min' => 'Jumlah slot minimal 1.',
            'total_slots.max' => 'Jumlah slot maksimal 1000.',
            'available_slots.lte' => 'Slot tersedia tidak boleh lebih dari total slot.',
            'registered_count.lte' => 'Jumlah terdaftar tidak boleh lebih dari total slot.',
            'month.date_format' => 'Format bulan tidak valid (gunakan YYYY-MM).',
            'status.in' => 'Status harus salah satu dari: buka_pendaftaran, penuh, berlangsung, selesai, dibatalkan.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Auto-set available_slots to total_slots if not provided
        if (! $this->has('available_slots') && $this->has('total_slots')) {
            $this->merge([
                'available_slots' => $this->total_slots,
            ]);
        }

        // Auto-set registered_count to 0 if not provided
        if (! $this->has('registered_count')) {
            $this->merge([
                'registered_count' => 0,
            ]);
        }

        // Auto-generate month from start_date if not provided
        if (! $this->has('month') && $this->has('start_date')) {
            $this->merge([
                'month' => date('Y-m', strtotime($this->start_date)),
            ]);
        }

        // Default status to 'buka_pendaftaran' if not provided
        if (! $this->has('status')) {
            $this->merge([
                'status' => 'buka_pendaftaran',
            ]);
        }
    }
}
