<?php

namespace App\Http\Requests\TrainingDetail;

use Illuminate\Foundation\Http\FormRequest;

class StoreLearningObjectiveRequest extends FormRequest
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
            'objective' => 'required_without:objectives|string|max:1000',
            'order_number' => 'nullable|integer|min:1',

            // Untuk bulk create
            'objectives' => 'sometimes|array',
            'objectives.*.objective' => 'required_with:objectives|string|max:1000',
            'objectives.*.order_number' => 'nullable|integer|min:1',
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
            'objective.required' => 'Tujuan pembelajaran wajib diisi.',
            'objective.max' => 'Tujuan pembelajaran maksimal 1000 karakter.',
            'order_number.min' => 'Nomor urut minimal 1.',
            'objectives.array' => 'Tujuan pembelajaran harus berupa array.',
            'objectives.*.objective.required_with' => 'Tujuan pembelajaran wajib diisi.',
            'objectives.*.objective.max' => 'Tujuan pembelajaran maksimal 1000 karakter.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'training_id' => 'Training ID',
            'objective' => 'Tujuan pembelajaran',
            'order_number' => 'Nomor urut',
        ];
    }
}
