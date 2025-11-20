<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrainingSchedule\StoreTrainingScheduleRequest;
use App\Http\Requests\TrainingSchedule\UpdateTrainingScheduleRequest;
use App\Http\Resources\TrainingScheduleResource;
use App\Services\TrainingSchedule\TrainingScheduleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TrainingScheduleController extends Controller
{
    public function __construct(
        private readonly TrainingScheduleService $scheduleService
    ) {}

    /**
     * Display a listing of training schedules.
     */
    public function index(Request $request): JsonResponse
    {
        $filters = $request->only([
            'training_id',
            'status',
            'method',
            'month',
            'start_date',
            'end_date',
            'available_only',
        ]);

        if ($request->has('paginate') && $request->boolean('paginate')) {
            $perPage = $request->integer('per_page', 15);
            $schedules = $this->scheduleService->getPaginated($filters, $perPage);

            return response()->json([
                'status' => 'success',
                'message' => 'Training schedules retrieved successfully',
                'data' => TrainingScheduleResource::collection($schedules->items()),
                'meta' => [
                    'current_page' => $schedules->currentPage(),
                    'from' => $schedules->firstItem(),
                    'last_page' => $schedules->lastPage(),
                    'per_page' => $schedules->perPage(),
                    'to' => $schedules->lastItem(),
                    'total' => $schedules->total(),
                ],
            ]);
        }

        $schedules = $this->scheduleService->getAll($filters);

        return response()->json([
            'status' => 'success',
            'message' => 'Training schedules retrieved successfully',
            'data' => TrainingScheduleResource::collection($schedules),
        ]);
    }

    /**
     * Store a newly created training schedule.
     */
    public function store(StoreTrainingScheduleRequest $request): JsonResponse
    {
        try {
            $schedule = $this->scheduleService->create($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Training schedule created successfully',
                'data' => new TrainingScheduleResource($schedule->load(['training'])),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create training schedule',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified training schedule.
     */
    public function show(int $id): JsonResponse
    {
        $schedule = $this->scheduleService->getById($id);

        if (! $schedule) {
            return response()->json([
                'status' => 'error',
                'message' => 'Training schedule not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Training schedule retrieved successfully',
            'data' => new TrainingScheduleResource($schedule),
        ]);
    }

    /**
     * Update the specified training schedule.
     */
    public function update(UpdateTrainingScheduleRequest $request, int $id): JsonResponse
    {
        try {
            $schedule = $this->scheduleService->update($id, $request->validated());

            if (! $schedule) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Training schedule not found',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Training schedule updated successfully',
                'data' => new TrainingScheduleResource($schedule),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update training schedule',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified training schedule.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $deleted = $this->scheduleService->delete($id);

            if (! $deleted) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Training schedule not found',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Training schedule deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete training schedule',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Get schedules for a specific training.
     */
    public function byTraining(int $trainingId): JsonResponse
    {
        $schedules = $this->scheduleService->getByTraining($trainingId);

        return response()->json([
            'status' => 'success',
            'message' => 'Training schedules retrieved successfully',
            'data' => TrainingScheduleResource::collection($schedules),
        ]);
    }

    /**
     * Get available schedules for registration.
     */
    public function available(): JsonResponse
    {
        $schedules = $this->scheduleService->getAvailable();

        return response()->json([
            'status' => 'success',
            'message' => 'Available training schedules retrieved successfully',
            'data' => TrainingScheduleResource::collection($schedules),
        ]);
    }

    /**
     * Get upcoming schedules.
     */
    public function upcoming(Request $request): JsonResponse
    {
        $limit = $request->integer('limit', 10);
        $schedules = $this->scheduleService->getUpcoming($limit);

        return response()->json([
            'status' => 'success',
            'message' => 'Upcoming training schedules retrieved successfully',
            'data' => TrainingScheduleResource::collection($schedules),
        ]);
    }

    /**
     * Get schedules by month for calendar view.
     */
    public function byMonth(Request $request): JsonResponse
    {
        $month = $request->input('month', now()->format('Y-m'));

        if (! preg_match('/^\d{4}-\d{2}$/', $month)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid month format. Use YYYY-MM format.',
            ], 400);
        }

        $schedules = $this->scheduleService->getByMonth($month);

        return response()->json([
            'status' => 'success',
            'message' => 'Training schedules for month retrieved successfully',
            'data' => TrainingScheduleResource::collection($schedules),
        ]);
    }

    /**
     * Change schedule status.
     */
    public function changeStatus(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'status' => 'required|in:buka_pendaftaran,penuh,berlangsung,selesai,dibatalkan',
        ]);

        try {
            $schedule = $this->scheduleService->changeStatus($id, $request->status);

            if (! $schedule) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Training schedule not found',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Training schedule status updated successfully',
                'data' => new TrainingScheduleResource($schedule),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update schedule status',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Duplicate a schedule.
     */
    public function duplicate(Request $request, int $id): JsonResponse
    {
        $overrides = $request->only([
            'start_date',
            'end_date',
            'start_time',
            'end_time',
            'location',
            'total_slots',
        ]);

        try {
            $schedule = $this->scheduleService->duplicate($id, $overrides);

            if (! $schedule) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Original training schedule not found',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Training schedule duplicated successfully',
                'data' => new TrainingScheduleResource($schedule->load(['training'])),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to duplicate training schedule',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get schedule statistics.
     */
    public function statistics(Request $request): JsonResponse
    {
        $filters = $request->only(['training_id', 'month']);
        $stats = $this->scheduleService->getStatistics($filters);

        return response()->json([
            'status' => 'success',
            'message' => 'Training schedule statistics retrieved successfully',
            'data' => $stats,
        ]);
    }
}
