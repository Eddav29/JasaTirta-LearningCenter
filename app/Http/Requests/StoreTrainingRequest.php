<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrainingRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:training_categories,id',
            'instructor_id' => 'required|integer|exists:instructors,id',
            'description' => 'required|string',
            'long_description' => 'nullable|string',
            'duration' => 'required|string|max:50',
            'price' => 'required|numeric|min:0|max:999999.99',
            'capacity' => 'required|integer|min:1|max:1000',
            'image' => 'nullable|string|max:255',
            'training_type' => 'required|in:offline,online,hybrid',
            'rating' => 'nullable|numeric|min:0|max:5',
            'review_count' => 'nullable|integer|min:0',
            'learning_hours' => 'nullable|string|max:10',
            'training_methods' => 'nullable|string',
            'certification_note' => 'nullable|string',
            'is_active' => 'nullable|boolean',
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
            'title.required' => 'Judul training wajib diisi.',
            'title.string' => 'Judul training harus berupa teks.',
            'title.max' => 'Judul training maksimal 255 karakter.',
            'category_id.required' => 'Kategori training wajib dipilih.',
            'category_id.exists' => 'Kategori training yang dipilih tidak valid.',
            'instructor_id.required' => 'Instructor wajib dipilih.',
            'instructor_id.exists' => 'Instructor yang dipilih tidak valid.',
            'description.required' => 'Deskripsi training wajib diisi.',
            'duration.required' => 'Durasi training wajib diisi.',
            'duration.max' => 'Durasi training maksimal 50 karakter.',
            'price.required' => 'Harga training wajib diisi.',
            'price.numeric' => 'Harga training harus berupa angka.',
            'price.min' => 'Harga training tidak boleh kurang dari 0.',
            'price.max' => 'Harga training maksimal 999999.99.',
            'capacity.required' => 'Kapasitas training wajib diisi.',
            'capacity.integer' => 'Kapasitas training harus berupa angka.',
            'capacity.min' => 'Kapasitas training minimal 1 orang.',
            'capacity.max' => 'Kapasitas training maksimal 1000 orang.',
            'training_type.required' => 'Tipe training wajib dipilih.',
            'training_type.in' => 'Tipe training harus salah satu dari: offline, online, hybrid.',
            'rating.numeric' => 'Rating harus berupa angka.',
            'rating.min' => 'Rating minimal 0.',
            'rating.max' => 'Rating maksimal 5.',
            'review_count.integer' => 'Jumlah review harus berupa angka.',
            'review_count.min' => 'Jumlah review tidak boleh kurang dari 0.',
            'learning_hours.max' => 'Jam belajar maksimal 10 karakter.',
        ];
    }
}
