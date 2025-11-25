<?php

namespace App\Data\Training;

use Illuminate\Http\UploadedFile;

readonly class CreateTrainingData
{
    public function __construct(
        public string $title,
        public int $categoryId,
        public int $instructorId,
        public string $description,
        public ?string $longDescription,
        public int $duration,
        public float $price,
        public int $capacity,
        public ?UploadedFile $image,
        public string $trainingType,
        public ?int $learningHours,
        public ?string $trainingMethods,
        public ?string $certificationNote,
        public bool $isActive
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            title: $data['title'],
            categoryId: $data['category_id'],
            instructorId: $data['instructor_id'],
            description: $data['description'],
            longDescription: $data['long_description'] ?? null,
            duration: $data['duration'],
            price: $data['price'],
            capacity: $data['capacity'],
            image: $data['image'] ?? null,
            trainingType: $data['training_type'],
            learningHours: $data['learning_hours'] ?? null,
            trainingMethods: $data['training_methods'] ?? null,
            certificationNote: $data['certification_note'] ?? null,
            isActive: $data['is_active']
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'category_id' => $this->categoryId,
            'instructor_id' => $this->instructorId,
            'description' => $this->description,
            'long_description' => $this->longDescription,
            'duration' => $this->duration,
            'price' => $this->price,
            'capacity' => $this->capacity,
            'training_type' => $this->trainingType,
            'learning_hours' => $this->learningHours,
            'training_methods' => $this->trainingMethods,
            'certification_note' => $this->certificationNote,
            'is_active' => $this->isActive,
        ];
    }
}
