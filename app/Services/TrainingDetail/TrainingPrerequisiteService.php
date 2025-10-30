<?php

namespace App\Services\TrainingDetail;

use App\Models\TrainingPrerequisite;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TrainingPrerequisiteService
{
    /**
     * Get all prerequisites for a training.
     */
    public function getByTraining(int $trainingId): Collection
    {
        return TrainingPrerequisite::forTraining($trainingId)
            ->ordered()
            ->get();
    }

    /**
     * Get a specific prerequisite by ID.
     */
    public function getById(int $id): ?TrainingPrerequisite
    {
        return TrainingPrerequisite::find($id);
    }

    /**
     * Create a new prerequisite.
     */
    public function create(array $data): TrainingPrerequisite
    {
        // If no order_number provided, set it to the next available number
        if (! isset($data['order_number'])) {
            $data['order_number'] = $this->getNextOrderNumber($data['training_id']);
        }

        return TrainingPrerequisite::create($data);
    }

    /**
     * Update an existing prerequisite.
     */
    public function update(int $id, array $data): ?TrainingPrerequisite
    {
        $prerequisite = $this->getById($id);

        if (! $prerequisite) {
            return null;
        }

        $prerequisite->update($data);

        return $prerequisite->fresh();
    }

    /**
     * Delete a prerequisite.
     */
    public function delete(int $id): bool
    {
        $prerequisite = $this->getById($id);

        if (! $prerequisite) {
            return false;
        }

        return DB::transaction(function () use ($prerequisite) {
            $trainingId = $prerequisite->training_id;
            $orderNumber = $prerequisite->order_number;

            // Delete the prerequisite
            $deleted = $prerequisite->delete();

            if ($deleted) {
                // Reorder remaining prerequisites
                $this->reorderAfterDelete($trainingId, $orderNumber);
            }

            return $deleted;
        });
    }

    /**
     * Bulk create prerequisites.
     */
    public function bulkCreate(int $trainingId, array $prerequisites): Collection
    {
        return DB::transaction(function () use ($trainingId, $prerequisites) {
            $created = collect();

            foreach ($prerequisites as $index => $prerequisiteData) {
                $data = [
                    'training_id' => $trainingId,
                    'prerequisite' => $prerequisiteData['prerequisite'],
                    'order_number' => $prerequisiteData['order_number'] ?? ($index + 1),
                ];

                $created->push($this->create($data));
            }

            return $created;
        });
    }

    /**
     * Bulk update prerequisites order.
     */
    public function updateOrder(int $trainingId, array $orderData): bool
    {
        return DB::transaction(function () use ($trainingId, $orderData) {
            foreach ($orderData as $item) {
                TrainingPrerequisite::where('id', $item['id'])
                    ->where('training_id', $trainingId)
                    ->update(['order_number' => $item['order_number']]);
            }

            return true;
        });
    }

    /**
     * Delete all prerequisites for a training.
     */
    public function deleteByTraining(int $trainingId): bool
    {
        return TrainingPrerequisite::forTraining($trainingId)->delete();
    }

    /**
     * Get the next order number for a training.
     */
    private function getNextOrderNumber(int $trainingId): int
    {
        $maxOrder = TrainingPrerequisite::forTraining($trainingId)
            ->max('order_number');

        return ($maxOrder ?? 0) + 1;
    }

    /**
     * Reorder prerequisites after deletion.
     */
    private function reorderAfterDelete(int $trainingId, int $deletedOrder): void
    {
        TrainingPrerequisite::forTraining($trainingId)
            ->where('order_number', '>', $deletedOrder)
            ->decrement('order_number');
    }
}
