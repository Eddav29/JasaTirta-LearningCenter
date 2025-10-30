<?php

namespace App\Services\TrainingDetail;

use App\Models\TrainingMaterial;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TrainingMaterialService
{
    /**
     * Get all materials for a training.
     */
    public function getByTraining(int $trainingId): Collection
    {
        return TrainingMaterial::forTraining($trainingId)
            ->ordered()
            ->get();
    }

    /**
     * Get a specific material by ID.
     */
    public function getById(int $id): ?TrainingMaterial
    {
        return TrainingMaterial::find($id);
    }

    /**
     * Create a new material.
     */
    public function create(array $data): TrainingMaterial
    {
        // If no order_number provided, set it to the next available number
        if (! isset($data['order_number'])) {
            $data['order_number'] = $this->getNextOrderNumber($data['training_id']);
        }

        return TrainingMaterial::create($data);
    }

    /**
     * Update an existing material.
     */
    public function update(int $id, array $data): ?TrainingMaterial
    {
        $material = $this->getById($id);

        if (! $material) {
            return null;
        }

        $material->update($data);

        return $material->fresh();
    }

    /**
     * Delete a material.
     */
    public function delete(int $id): bool
    {
        $material = $this->getById($id);

        if (! $material) {
            return false;
        }

        return DB::transaction(function () use ($material) {
            $trainingId = $material->training_id;
            $orderNumber = $material->order_number;

            // Delete the material
            $deleted = $material->delete();

            if ($deleted) {
                // Reorder remaining materials
                $this->reorderAfterDelete($trainingId, $orderNumber);
            }

            return $deleted;
        });
    }

    /**
     * Bulk create materials.
     */
    public function bulkCreate(int $trainingId, array $materials): Collection
    {
        return DB::transaction(function () use ($trainingId, $materials) {
            $created = collect();

            foreach ($materials as $index => $materialData) {
                $data = [
                    'training_id' => $trainingId,
                    'material' => $materialData['material'],
                    'order_number' => $materialData['order_number'] ?? ($index + 1),
                ];

                $created->push($this->create($data));
            }

            return $created;
        });
    }

    /**
     * Bulk update materials order.
     */
    public function updateOrder(int $trainingId, array $orderData): bool
    {
        return DB::transaction(function () use ($trainingId, $orderData) {
            foreach ($orderData as $item) {
                TrainingMaterial::where('id', $item['id'])
                    ->where('training_id', $trainingId)
                    ->update(['order_number' => $item['order_number']]);
            }

            return true;
        });
    }

    /**
     * Delete all materials for a training.
     */
    public function deleteByTraining(int $trainingId): bool
    {
        return TrainingMaterial::forTraining($trainingId)->delete();
    }

    /**
     * Get the next order number for a training.
     */
    private function getNextOrderNumber(int $trainingId): int
    {
        $maxOrder = TrainingMaterial::forTraining($trainingId)
            ->max('order_number');

        return ($maxOrder ?? 0) + 1;
    }

    /**
     * Reorder materials after deletion.
     */
    private function reorderAfterDelete(int $trainingId, int $deletedOrder): void
    {
        TrainingMaterial::forTraining($trainingId)
            ->where('order_number', '>', $deletedOrder)
            ->decrement('order_number');
    }
}
