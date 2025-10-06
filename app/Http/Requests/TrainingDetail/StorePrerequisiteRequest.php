<?php

namespace App\Http\Requests\TrainingDetail;

use Illuminate\Foundation\Http\FormRequest;

class StorePrerequisiteRequest extends FormRequest
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
            'prerequisite' => 'required_without:prerequisites|string|max:1000',
            'order_number' => 'nullable|integer|min:1',
            
            // Untuk bulk create
            'prerequisites' => 'sometimes|array',
            'prerequisites.*.prerequisite' => 'required_with:prerequisites|string|max:1000',
            'prerequisites.*.order_number' => 'nullable|integer|min:1',
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
            'prerequisite.required' => 'Prasyarat wajib diisi.',
            'prerequisite.max' => 'Prasyarat maksimal 1000 karakter.',
            'order_number.min' => 'Nomor urut minimal 1.',
            'prerequisites.array' => 'Prasyarat harus berupa array.',
            'prerequisites.*.prerequisite.required_with' => 'Prasyarat wajib diisi.',
            'prerequisites.*.prerequisite.max' => 'Prasyarat maksimal 1000 karakter.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'training_id' => 'Training ID',
            'prerequisite' => 'Prasyarat',
            'order_number' => 'Nomor urut',
        ];
    }
}
