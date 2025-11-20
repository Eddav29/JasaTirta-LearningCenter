<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainingScheduleResource extends JsonResource
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
            'training_id' => $this->training_id,
            'training' => new TrainingResource($this->whenLoaded('training')),
            'start_date' => $this->start_date?->format('Y-m-d'),
            'end_date' => $this->end_date?->format('Y-m-d'),
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'location' => $this->location,
            'method' => $this->method,
            'total_slots' => $this->total_slots,
            'available_slots' => $this->available_slots,
            'registered_count' => $this->registered_count,
            'month' => $this->month,
            'status' => $this->status,
            'is_full' => $this->is_full,
            'can_register' => $this->can_register,
            'formatted_date_range' => $this->formatted_date_range,
            'formatted_time_range' => $this->formatted_time_range,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
