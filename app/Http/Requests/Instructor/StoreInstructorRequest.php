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
            'specialization' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'experience' => 'required|integer|min:0|max:50',
            'bio' => 'required|string',
            'email' => 'required|string|email|max:255|unique:instructors',
            'phone' => 'required|string|max:20',
            'image' => 'nullable|string|max:255',
            'instructor_type' => 'required|in:internal,vendor',
            'company' => 'nullable|string|max:255',
            'certifications' => 'nullable|array',
            'certifications.*' => 'string|max:255',
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
            'specialization.required' => 'Spesialisasi instruktur wajib diisi.',
            'education.required' => 'Pendidikan instruktur wajib diisi.',
            'experience.required' => 'Pengalaman instruktur wajib diisi.',
            'bio.required' => 'Bio instruktur wajib diisi.',
            'email.required' => 'Email instruktur wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh instruktur lain.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'instructor_type.required' => 'Tipe instruktur wajib dipilih.',
            'instructor_type.in' => 'Tipe instruktur harus internal atau vendor.',
        ];
    }
}