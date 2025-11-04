<?php

namespace App\Http\Requests\Instructor;

use Illuminate\Foundation\Http\FormRequest;

class StoreInstructorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // You can add authorization logic here
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:instructors',
            'phone' => 'nullable|string|max:20',
            'instructor_type' => 'required|in:internal,vendor',
            'specialization' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'experience' => 'required|string|max:50',
            'bio' => 'required|string',
            'certifications' => 'nullable|array',
            'certifications.*' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama instruktur wajib diisi.',
            'email.required' => 'Email instruktur wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh instruktur lain.',
            'instructor_type.required' => 'Tipe instruktur wajib dipilih.',
            'instructor_type.in' => 'Tipe instruktur harus internal atau vendor.',
            'specialization.required' => 'Spesialisasi instruktur wajib diisi.',
            'education.required' => 'Pendidikan instruktur wajib diisi.',
            'experience.required' => 'Pengalaman instruktur wajib diisi.',
            'bio.required' => 'Bio instruktur wajib diisi.',
        ];
    }
}
