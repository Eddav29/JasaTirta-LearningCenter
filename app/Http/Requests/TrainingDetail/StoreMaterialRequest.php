<?php

namespace App\Http\Requests\TrainingDetail;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaterialRequest extends FormRequest
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
            'material' => 'required_without:materials|string|max:1000',
            'order_number' => 'nullable|integer|min:1',

            // Untuk bulk create
            'materials' => 'sometimes|array',
            'materials.*.material' => 'required_with:materials|string|max:1000',
            'materials.*.order_number' => 'nullable|integer|min:1',
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
            'material.required' => 'Materi wajib diisi.',
            'material.max' => 'Materi maksimal 1000 karakter.',
            'order_number.min' => 'Nomor urut minimal 1.',
            'materials.array' => 'Materi harus berupa array.',
            'materials.*.material.required_with' => 'Materi wajib diisi.',
            'materials.*.material.max' => 'Materi maksimal 1000 karakter.',
        ];
    }
}
