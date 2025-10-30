<?php

namespace App\Http\Requests\TrainingDetail;

use Illuminate\Foundation\Http\FormRequest;

class StoreSyllabusRequest extends FormRequest
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
            'day' => 'required|string|max:20',
            'title' => 'required|string|max:255',
            'order_number' => 'nullable|integer|min:1',

            // Topics (optional)
            'topics' => 'sometimes|array',
            'topics.*.topic' => 'required_with:topics|string|max:500',
            'topics.*.duration_minutes' => 'required_with:topics|integer|min:1',
            'topics.*.order_number' => 'nullable|integer|min:1',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'training_id.required' => 'Training ID wajib diisi.',
            'training_id.exists' => 'Training tidak ditemukan.',
            'day.required' => 'Hari silabus wajib diisi.',
            'day.max' => 'Hari silabus maksimal 20 karakter.',
            'title.required' => 'Judul silabus wajib diisi.',
            'title.max' => 'Judul silabus maksimal 255 karakter.',
            'order_number.min' => 'Nomor urut minimal 1.',
            'topics.array' => 'Topik harus berupa array.',
            'topics.*.topic.required_with' => 'Nama topik wajib diisi.',
            'topics.*.topic.max' => 'Nama topik maksimal 500 karakter.',
            'topics.*.duration_minutes.required_with' => 'Durasi topik wajib diisi.',
            'topics.*.duration_minutes.min' => 'Durasi topik minimal 1 menit.',
        ];
    }
}
