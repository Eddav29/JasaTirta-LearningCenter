<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrainingDetail\StoreLearningObjectiveRequest;
use App\Http\Requests\TrainingDetail\StorePrerequisiteRequest;
use App\Http\Requests\TrainingDetail\StoreMaterialRequest;
use App\Http\Requests\TrainingDetail\StoreSyllabusRequest;
use App\Http\Resources\TrainingLearningObjectiveResource;
use App\Http\Resources\TrainingPrerequisiteResource;
use App\Http\Resources\TrainingMaterialResource;
use App\Http\Resources\TrainingSyllabusResource;
use App\Services\TrainingDetail\TrainingLearningObjectiveService;
use App\Services\TrainingDetail\TrainingMaterialService;
use App\Services\TrainingDetail\TrainingPrerequisiteService;
use App\Services\TrainingDetail\TrainingSyllabusService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TrainingDetailController extends Controller
{
    public function __construct(
        private TrainingLearningObjectiveService $learningObjectiveService,
        private TrainingPrerequisiteService $prerequisiteService,
        private TrainingMaterialService $materialService,
        private TrainingSyllabusService $syllabusService
    ) {}

    // ==================== LEARNING OBJECTIVES ====================
    
    /**
     * Get all learning objectives for a training.
     */
    public function getLearningObjectives(int $trainingId): JsonResponse
    {
        $objectives = $this->learningObjectiveService->getByTraining($trainingId);

        return response()->json([
            'status' => 'success',
            'message' => 'Learning objectives retrieved successfully',
            'data' => TrainingLearningObjectiveResource::collection($objectives),
        ]);
    }

    /**
     * Create a learning objective.
     */
    public function storeLearningObjective(StoreLearningObjectiveRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Check if it's bulk create
        if (isset($data['objectives'])) {
            $objectives = $this->learningObjectiveService->bulkCreate(
                $data['training_id'],
                $data['objectives']
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Learning objectives created successfully',
                'data' => TrainingLearningObjectiveResource::collection($objectives),
            ], 201);
        }

        // Single create
        $objective = $this->learningObjectiveService->create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Learning objective created successfully',
            'data' => new TrainingLearningObjectiveResource($objective),
        ], 201);
    }

    /**
     * Update a learning objective.
     */
    public function updateLearningObjective(Request $request, int $id): JsonResponse
    {
        $data = $request->validate([
            'objective' => 'sometimes|string|max:1000',
            'order_number' => 'sometimes|integer|min:1',
        ]);

        $objective = $this->learningObjectiveService->update($id, $data);

        if (!$objective) {
            return response()->json([
                'status' => 'error',
                'message' => 'Learning objective not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Learning objective updated successfully',
            'data' => new TrainingLearningObjectiveResource($objective),
        ]);
    }

    /**
     * Delete a learning objective.
     */
    public function deleteLearningObjective(int $id): JsonResponse
    {
        $deleted = $this->learningObjectiveService->delete($id);

        if (!$deleted) {
            return response()->json([
                'status' => 'error',
                'message' => 'Learning objective not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Learning objective deleted successfully',
        ]);
    }

    /**
     * Update learning objectives order.
     */
    public function updateLearningObjectivesOrder(Request $request, int $trainingId): JsonResponse
    {
        $data = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|integer',
            'items.*.order_number' => 'required|integer|min:1',
        ]);

        $this->learningObjectiveService->updateOrder($trainingId, $data['items']);

        return response()->json([
            'status' => 'success',
            'message' => 'Learning objectives order updated successfully',
        ]);
    }

    // ==================== PREREQUISITES ====================
    
    /**
     * Get all prerequisites for a training.
     */
    public function getPrerequisites(int $trainingId): JsonResponse
    {
        $prerequisites = $this->prerequisiteService->getByTraining($trainingId);

        return response()->json([
            'status' => 'success',
            'message' => 'Prerequisites retrieved successfully',
            'data' => TrainingPrerequisiteResource::collection($prerequisites),
        ]);
    }

    /**
     * Create a prerequisite.
     */
    public function storePrerequisite(StorePrerequisiteRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Check if it's bulk create
        if (isset($data['prerequisites'])) {
            $prerequisites = $this->prerequisiteService->bulkCreate(
                $data['training_id'],
                $data['prerequisites']
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Prerequisites created successfully',
                'data' => TrainingPrerequisiteResource::collection($prerequisites),
            ], 201);
        }

        // Single create
        $prerequisite = $this->prerequisiteService->create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Prerequisite created successfully',
            'data' => new TrainingPrerequisiteResource($prerequisite),
        ], 201);
    }

    /**
     * Update a prerequisite.
     */
    public function updatePrerequisite(Request $request, int $id): JsonResponse
    {
        $data = $request->validate([
            'prerequisite' => 'sometimes|string|max:1000',
            'order_number' => 'sometimes|integer|min:1',
        ]);

        $prerequisite = $this->prerequisiteService->update($id, $data);

        if (!$prerequisite) {
            return response()->json([
                'status' => 'error',
                'message' => 'Prerequisite not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Prerequisite updated successfully',
            'data' => $prerequisite,
        ]);
    }

    /**
     * Delete a prerequisite.
     */
    public function deletePrerequisite(int $id): JsonResponse
    {
        $deleted = $this->prerequisiteService->delete($id);

        if (!$deleted) {
            return response()->json([
                'status' => 'error',
                'message' => 'Prerequisite not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Prerequisite deleted successfully',
        ]);
    }

    // ==================== MATERIALS ====================
    
    /**
     * Get all materials for a training.
     */
    public function getMaterials(int $trainingId): JsonResponse
    {
        $materials = $this->materialService->getByTraining($trainingId);

        return response()->json([
            'status' => 'success',
            'message' => 'Materials retrieved successfully',
            'data' => $materials,
        ]);
    }

    /**
     * Create a material.
     */
    public function storeMaterial(StoreMaterialRequest $request): JsonResponse
    {
        $data = $request->validated();

        if (isset($data['materials'])) {
            $materials = $this->materialService->bulkCreate(
                $data['training_id'],
                $data['materials']
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Materials created successfully',
                'data' => $materials,
            ], 201);
        }

        $material = $this->materialService->create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Material created successfully',
            'data' => $material,
        ], 201);
    }

    // ==================== SYLLABUS ====================
    
    /**
     * Get all syllabus for a training.
     */
    public function getSyllabus(int $trainingId): JsonResponse
    {
        $syllabus = $this->syllabusService->getByTraining($trainingId);

        return response()->json([
            'status' => 'success',
            'message' => 'Syllabus retrieved successfully',
            'data' => $syllabus,
        ]);
    }

    /**
     * Create a syllabus.
     */
    public function storeSyllabus(StoreSyllabusRequest $request): JsonResponse
    {
        $data = $request->validated();

        $syllabus = $this->syllabusService->create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Syllabus created successfully',
            'data' => $syllabus,
        ], 201);
    }

    /**
     * Get all training details at once.
     */
    public function getTrainingDetails(int $trainingId): JsonResponse
    {
        $details = [
            'learning_objectives' => $this->learningObjectiveService->getByTraining($trainingId),
            'prerequisites' => $this->prerequisiteService->getByTraining($trainingId),
            'materials' => $this->materialService->getByTraining($trainingId),
            'syllabus' => $this->syllabusService->getByTraining($trainingId),
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Training details retrieved successfully',
            'data' => $details,
        ]);
    }
}
