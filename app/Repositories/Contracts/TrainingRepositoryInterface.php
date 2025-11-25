<?php

namespace App\Repositories\Contracts;

use App\Models\Training;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface TrainingRepositoryInterface
{
    /**
     * Get all trainings with optional filters and pagination.
     */
    public function getAllWithFilters(array $filters, int $perPage = 10): LengthAwarePaginator;

    /**
     * Find training by ID with relationships.
     */
    public function findWithRelations(int $id, array $relations = []): ?Training;

    /**
     * Create a new training.
     */
    public function create(array $data): Training;

    /**
     * Update existing training.
     */
    public function update(Training $training, array $data): Training;

    /**
     * Delete training.
     */
    public function delete(Training $training): bool;

    /**
     * Bulk delete trainings by IDs.
     */
    public function bulkDelete(array $ids): int;

    /**
     * Bulk update status.
     */
    public function bulkUpdateStatus(array $ids, bool $isActive): int;

    /**
     * Get all active trainings.
     */
    public function getActive(): Collection;

    /**
     * Get training statistics.
     */
    public function getStatistics(): array;

    /**
     * Get all categories.
     */
    public function getAllCategories(): Collection;

    /**
     * Get all instructors.
     */
    public function getAllInstructors(): Collection;
}
