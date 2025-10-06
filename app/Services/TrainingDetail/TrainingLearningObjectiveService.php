<?php

namespace App\Services\TrainingDetail;

use App\Models\TrainingLearningObjective;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TrainingLearningObjectiveService
{
    /**
     * Get all learning objectives for a training.
     */
    public function getByTraining(int $trainingId): Collection
    {
        return TrainingLearningObjective::forTraining($trainingId)
            ->ordered()
            ->get();
    }

    /**
     * Get a specific learning objective by ID.
     */
    public function getById(int $id): ?TrainingLearningObjective
    {
        return TrainingLearningObjective::find($id);
    }

    /**
     * Create a new learning objective.
     */
    public function create(array $data): TrainingLearningObjective
    {
        // If no order_number provided, set it to the next available number
        if (!isset($data['order_number'])) {
            $data['order_number'] = $this->getNextOrderNumber($data['training_id']);
        }

        return TrainingLearningObjective::create($data);
    }

    /**
     * Update an existing learning objective.
     */
    public function update(int $id, array $data): ?TrainingLearningObjective
    {
        $objective = $this->getById($id);
        
        if (!$objective) {
            return null;
        }

        $objective->update($data);
        return $objective->fresh();
    }

    /**
     * Delete a learning objective.
     */
    public function delete(int $id): bool
    {
        $objective = $this->getById($id);
        
        if (!$objective) {
            return false;
        }

        return DB::transaction(function () use ($objective) {
            $trainingId = $objective->training_id;
            $orderNumber = $objective->order_number;
            
            // Delete the objective
            $deleted = $objective->delete();
            
            if ($deleted) {
                // Reorder remaining objectives
                $this->reorderAfterDelete($trainingId, $orderNumber);
            }
            
            return $deleted;
        });
    }

    /**
     * Bulk create learning objectives.
     */
    public function bulkCreate(int $trainingId, array $objectives): mixed
    {
        return DB::transaction(function () use ($trainingId, $objectives) {
            $created = [];
            
            foreach ($objectives as $index => $objectiveData) {
                $data = [
                    'training_id' => $trainingId,
                    'objective' => $objectiveData['objective'],
                    'order_number' => $objectiveData['order_number'] ?? ($index + 1),
                ];
                
                $created[] = $this->create($data);
            }
            
            return TrainingLearningObjective::whereIn('id', collect($created)->pluck('id'))->get();
        });
    }

    /**
     * Bulk update learning objectives order.
     */
    public function updateOrder(int $trainingId, array $orderData): bool
    {
        return DB::transaction(function () use ($trainingId, $orderData) {
            foreach ($orderData as $item) {
                TrainingLearningObjective::where('id', $item['id'])
                    ->where('training_id', $trainingId)
                    ->update(['order_number' => $item['order_number']]);
            }
            
            return true;
        });
    }

    /**
     * Delete all learning objectives for a training.
     */
    public function deleteByTraining(int $trainingId): bool
    {
        return TrainingLearningObjective::forTraining($trainingId)->delete();
    }

    /**
     * Get the next order number for a training.
     */
    private function getNextOrderNumber(int $trainingId): int
    {
        $maxOrder = TrainingLearningObjective::forTraining($trainingId)
            ->max('order_number');
            
        return ($maxOrder ?? 0) + 1;
    }

    /**
     * Reorder objectives after deletion.
     */
    private function reorderAfterDelete(int $trainingId, int $deletedOrder): void
    {
        TrainingLearningObjective::forTraining($trainingId)
            ->where('order_number', '>', $deletedOrder)
            ->decrement('order_number');
    }
}