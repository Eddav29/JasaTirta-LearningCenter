<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InstructorResource extends JsonResource
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
            'name' => $this->name,
            'specialization' => $this->specialization,
            'education' => $this->education,
            'experience' => $this->experience,
            'bio' => $this->bio,
            'email' => $this->email,
            'phone' => $this->phone,
            'instructor_type' => $this->instructor_type,
            'company' => $this->company,
            'certifications' => InstructorCertificationResource::collection($this->whenLoaded('certifications')),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
