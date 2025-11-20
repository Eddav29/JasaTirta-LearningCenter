<?php

namespace App\Http\Requests\Training;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTrainingRequest extends FormRequest
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
            'title' => 'sometimes|required|string|max:255',
            'category_id' => 'sometimes|required|integer|exists:training_categories,id',
            'instructor_id' => 'sometimes|required|integer|exists:instructors,id',
            'description' => 'sometimes|required|string',
            'long_description' => 'sometimes|nullable|string',
            'duration' => 'sometimes|required|string|max:50',
            'price' => 'sometimes|required|numeric|min:0|max:999999.99',
            'capacity' => 'sometimes|required|integer|min:1|max:1000',
            'image' => 'sometimes|nullable|string|max:255',
            'training_type' => 'sometimes|required|in:offline,online,hybrid',
            'rating' => 'sometimes|nullable|numeric|min:0|max:5',
            'review_count' => 'sometimes|nullable|integer|min:0',
            'learning_hours' => 'sometimes|nullable|string|max:10',
            'training_methods' => 'sometimes|nullable|string',
            'certification_note' => 'sometimes|nullable|string',
            'is_active' => 'sometimes|nullable|boolean',
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
            'title.max' => 'Judul training maksimal 255 karakter.',
            'category_id.required' => 'Kategori training wajib dipilih.',
            'category_id.exists' => 'Kategori training tidak valid.',
            'instructor_id.required' => 'Instruktur wajib dipilih.',
            'instructor_id.exists' => 'Instruktur tidak valid.',
            'description.required' => 'Deskripsi training wajib diisi.',
            'duration.required' => 'Durasi training wajib diisi.',
            'duration.max' => 'Durasi training maksimal 50 karakter.',
            'price.required' => 'Harga training wajib diisi.',
            'price.numeric' => 'Harga training harus berupa angka.',
            'price.min' => 'Harga training tidak boleh negatif.',
            'price.max' => 'Harga training maksimal 999999.99.',
            'capacity.required' => 'Kapasitas training wajib diisi.',
            'capacity.integer' => 'Kapasitas training harus berupa angka bulat.',
            'capacity.min' => 'Kapasitas training minimal 1 orang.',
            'capacity.max' => 'Kapasitas training maksimal 1000 orang.',
            'training_type.required' => 'Tipe training wajib dipilih.',
            'training_type.in' => 'Tipe training harus offline, online, atau hybrid.',
            'rating.numeric' => 'Rating harus berupa angka.',
            'rating.min' => 'Rating minimal 0.',
            'rating.max' => 'Rating maksimal 5.',
            'review_count.integer' => 'Jumlah review harus berupa angka bulat.',
            'review_count.min' => 'Jumlah review tidak boleh negatif.',
        ];
    }
}
