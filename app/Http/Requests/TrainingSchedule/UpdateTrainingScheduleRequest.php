<?php

namespace App\Http\Requests\TrainingSchedule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTrainingScheduleRequest extends FormRequest
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
            'training_id' => 'sometimes|required|integer|exists:trainings,id',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'sometimes|required|date|after_or_equal:start_date',
            'start_time' => 'sometimes|required|date_format:H:i',
            'end_time' => 'sometimes|required|date_format:H:i|after:start_time',
            'location' => 'sometimes|required|string|max:255',
            'method' => 'sometimes|required|in:offline,online,hybrid',
            'total_slots' => 'sometimes|required|integer|min:1|max:1000',
            'available_slots' => 'sometimes|integer|min:0|lte:total_slots',
            'registered_count' => 'sometimes|integer|min:0|lte:total_slots',
            'month' => 'sometimes|string|date_format:Y-m',
            'status' => 'sometimes|in:buka_pendaftaran,penuh,berlangsung,selesai,dibatalkan',
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
        // Auto-generate month from start_date if start_date is being updated
        if ($this->has('start_date') && ! $this->has('month')) {
            $this->merge([
                'month' => date('Y-m', strtotime($this->start_date)),
            ]);
        }
    }
}
