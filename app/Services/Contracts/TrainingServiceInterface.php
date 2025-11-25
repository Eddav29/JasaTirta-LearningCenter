<?php

namespace App\Services\Contracts;

use App\Data\Training\CreateTrainingData;
use App\Data\Training\UpdateTrainingData;
use App\Models\Training;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface TrainingServiceInterface
{
    /**
     * Get paginated trainings with filters.
     */
    public function getPaginatedTrainings(array $filters, int $perPage = 10): LengthAwarePaginator;

    /**
     * Get training by ID with all relations.
     */
    public function getTrainingById(int $id): ?Training;

    /**
     * Create new training with image handling.
     */
    public function createTraining(CreateTrainingData $data): Training;

    /**
     * Update training with image handling.
     */
    public function updateTraining(Training $training, UpdateTrainingData $data): Training;

    /**
     * Delete training.
     */
    public function deleteTraining(Training $training): bool;

    /**
     * Bulk delete trainings.
     */
    public function bulkDeleteTrainings(array $ids): int;

    /**
     * Bulk update training status.
     */
    public function bulkUpdateStatus(array $ids, bool $isActive): int;

    /**
     * Get training statistics for dashboard.
     */
    public function getStatistics(): array;

    /**
     * Get categories for dropdown.
     */
    public function getCategories(): Collection;

    /**
     * Get instructors for dropdown.
     */
    public function getInstructors(): Collection;
}
