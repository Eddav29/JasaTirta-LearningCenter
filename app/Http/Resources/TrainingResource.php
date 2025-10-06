<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'category' => new TrainingCategoryResource($this->whenLoaded('category')),
            'instructor_id' => $this->instructor_id,
            'instructor' => new InstructorResource($this->whenLoaded('instructor')),
            'long_description' => $this->long_description,
            'duration' => $this->duration,
            'price' => (float) $this->price,
            'capacity' => $this->capacity,
            'image' => $this->image,
            'training_type' => $this->training_type,
            'rating' => (float) $this->rating,
            'review_count' => $this->review_count,
            'learning_hours' => $this->learning_hours,
            'training_methods' => $this->training_methods,
            'certification_note' => $this->certification_note,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
