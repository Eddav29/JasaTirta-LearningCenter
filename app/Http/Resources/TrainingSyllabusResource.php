<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainingSyllabusResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'order_index' => $this->order_index,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'training' => $this->whenLoaded('training', function () {
                return [
                    'id' => $this->training->id,
                    'name' => $this->training->name,
                ];
            }),
            'topics' => $this->whenLoaded('topics', function () {
                return TrainingSyllabusTopicResource::collection($this->topics);
            }),
        ];
    }
}
