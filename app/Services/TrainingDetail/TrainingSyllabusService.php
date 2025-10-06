<?php

namespace App\Services\TrainingDetail;

use App\Models\TrainingSyllabus;
use App\Models\TrainingSyllabusTopic;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TrainingSyllabusService
{
    /**
     * Get all syllabus for a training with topics.
     */
    public function getByTraining(int $trainingId): Collection
    {
        return TrainingSyllabus::forTraining($trainingId)
            ->with('topics')
            ->ordered()
            ->get();
    }

    /**
     * Get a specific syllabus by ID with topics.
     */
    public function getById(int $id): ?TrainingSyllabus
    {
        return TrainingSyllabus::with('topics')->find($id);
    }

    /**
     * Create a new syllabus with topics.
     */
    public function create(array $data): TrainingSyllabus
    {
        return DB::transaction(function () use ($data) {
            // If no order_number provided, set it to the next available number
            if (!isset($data['order_number'])) {
                $data['order_number'] = $this->getNextOrderNumber($data['training_id']);
            }

            // Extract topics data
            $topicsData = $data['topics'] ?? [];
            unset($data['topics']);

            // Create syllabus
            $syllabus = TrainingSyllabus::create($data);

            // Create topics if provided
            if (!empty($topicsData)) {
                $this->createTopics($syllabus->id, $topicsData);
            }

            return $syllabus->load('topics');
        });
    }

    /**
     * Update an existing syllabus.
     */
    public function update(int $id, array $data): ?TrainingSyllabus
    {
        $syllabus = $this->getById($id);
        
        if (!$syllabus) {
            return null;
        }

        return DB::transaction(function () use ($syllabus, $data) {
            // Extract topics data
            $topicsData = $data['topics'] ?? null;
            unset($data['topics']);

            // Update syllabus
            $syllabus->update($data);

            // Update topics if provided
            if ($topicsData !== null) {
                $this->updateTopics($syllabus->id, $topicsData);
            }

            return $syllabus->fresh(['topics']);
        });
    }

    /**
     * Delete a syllabus and its topics.
     */
    public function delete(int $id): bool
    {
        $syllabus = $this->getById($id);
        
        if (!$syllabus) {
            return false;
        }

        return DB::transaction(function () use ($syllabus) {
            $trainingId = $syllabus->training_id;
            $orderNumber = $syllabus->order_number;
            
            // Delete the syllabus (topics will be deleted by cascade)
            $deleted = $syllabus->delete();
            
            if ($deleted) {
                // Reorder remaining syllabus
                $this->reorderAfterDelete($trainingId, $orderNumber);
            }
            
            return $deleted;
        });
    }

    /**
     * Bulk create syllabus with topics.
     */
    public function bulkCreate(int $trainingId, array $syllabusData): Collection
    {
        return DB::transaction(function () use ($trainingId, $syllabusData) {
            $created = collect();
            
            foreach ($syllabusData as $index => $syllabusItem) {
                $data = [
                    'training_id' => $trainingId,
                    'day' => $syllabusItem['day'],
                    'title' => $syllabusItem['title'],
                    'order_number' => $syllabusItem['order_number'] ?? ($index + 1),
                    'topics' => $syllabusItem['topics'] ?? [],
                ];
                
                $created->push($this->create($data));
            }
            
            return $created;
        });
    }

    /**
     * Update syllabus order.
     */
    public function updateOrder(int $trainingId, array $orderData): bool
    {
        return DB::transaction(function () use ($trainingId, $orderData) {
            foreach ($orderData as $item) {
                TrainingSyllabus::where('id', $item['id'])
                    ->where('training_id', $trainingId)
                    ->update(['order_number' => $item['order_number']]);
            }
            
            return true;
        });
    }

    /**
     * Delete all syllabus for a training.
     */
    public function deleteByTraining(int $trainingId): bool
    {
        return TrainingSyllabus::forTraining($trainingId)->delete();
    }

    /**
     * Add a topic to a syllabus.
     */
    public function addTopic(int $syllabusId, array $topicData): TrainingSyllabusTopic
    {
        if (!isset($topicData['order_number'])) {
            $topicData['order_number'] = $this->getNextTopicOrderNumber($syllabusId);
        }

        $topicData['syllabus_id'] = $syllabusId;
        return TrainingSyllabusTopic::create($topicData);
    }

    /**
     * Update a topic.
     */
    public function updateTopic(int $topicId, array $data): ?TrainingSyllabusTopic
    {
        $topic = TrainingSyllabusTopic::find($topicId);
        
        if (!$topic) {
            return null;
        }

        $topic->update($data);
        return $topic->fresh();
    }

    /**
     * Delete a topic.
     */
    public function deleteTopic(int $topicId): bool
    {
        $topic = TrainingSyllabusTopic::find($topicId);
        
        if (!$topic) {
            return false;
        }

        return DB::transaction(function () use ($topic) {
            $syllabusId = $topic->syllabus_id;
            $orderNumber = $topic->order_number;
            
            // Delete the topic
            $deleted = $topic->delete();
            
            if ($deleted) {
                // Reorder remaining topics
                $this->reorderTopicsAfterDelete($syllabusId, $orderNumber);
            }
            
            return $deleted;
        });
    }

    /**
     * Update topics order.
     */
    public function updateTopicsOrder(int $syllabusId, array $orderData): bool
    {
        return DB::transaction(function () use ($syllabusId, $orderData) {
            foreach ($orderData as $item) {
                TrainingSyllabusTopic::where('id', $item['id'])
                    ->where('syllabus_id', $syllabusId)
                    ->update(['order_number' => $item['order_number']]);
            }
            
            return true;
        });
    }

    /**
     * Create topics for a syllabus.
     */
    private function createTopics(int $syllabusId, array $topicsData): void
    {
        foreach ($topicsData as $index => $topicData) {
            $data = [
                'syllabus_id' => $syllabusId,
                'topic' => $topicData['topic'],
                'order_number' => $topicData['order_number'] ?? ($index + 1),
            ];
            
            TrainingSyllabusTopic::create($data);
        }
    }

    /**
     * Update topics for a syllabus.
     */
    private function updateTopics(int $syllabusId, array $topicsData): void
    {
        // Delete existing topics
        TrainingSyllabusTopic::where('syllabus_id', $syllabusId)->delete();
        
        // Create new topics
        $this->createTopics($syllabusId, $topicsData);
    }

    /**
     * Get the next order number for a training.
     */
    private function getNextOrderNumber(int $trainingId): int
    {
        $maxOrder = TrainingSyllabus::forTraining($trainingId)
            ->max('order_number');
            
        return ($maxOrder ?? 0) + 1;
    }

    /**
     * Get the next order number for topics in a syllabus.
     */
    private function getNextTopicOrderNumber(int $syllabusId): int
    {
        $maxOrder = TrainingSyllabusTopic::forSyllabus($syllabusId)
            ->max('order_number');
            
        return ($maxOrder ?? 0) + 1;
    }

    /**
     * Reorder syllabus after deletion.
     */
    private function reorderAfterDelete(int $trainingId, int $deletedOrder): void
    {
        TrainingSyllabus::forTraining($trainingId)
            ->where('order_number', '>', $deletedOrder)
            ->decrement('order_number');
    }

    /**
     * Reorder topics after deletion.
     */
    private function reorderTopicsAfterDelete(int $syllabusId, int $deletedOrder): void
    {
        TrainingSyllabusTopic::forSyllabus($syllabusId)
            ->where('order_number', '>', $deletedOrder)
            ->decrement('order_number');
    }
}