<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTrainingRequest;
use App\Http\Requests\UpdateTrainingRequest;
use App\Http\Resources\TrainingResource;
use App\Models\Training;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Training::query();

        // Include relationships by default
        $query->with(['category', 'instructor']);

        // Include additional relationships if requested
        if ($request->has('include')) {
            $includes = explode(',', $request->include);
            $validIncludes = ['category', 'instructor'];
            $includes = array_intersect($includes, $validIncludes);
            if (! empty($includes)) {
                $query->with($includes);
            }
        }

        // Apply filters
        if ($request->has('is_active')) {
            $query->where('is_active', $request->boolean('is_active'));
        }

        if ($request->has('category_id')) {
            $query->byCategory($request->category_id);
        }

        if ($request->has('instructor_id')) {
            $query->byInstructor($request->instructor_id);
        }

        if ($request->has('training_type')) {
            $query->byType($request->training_type);
        }

        // Price range filter
        if ($request->has('min_price') || $request->has('max_price')) {
            $query->byPriceRange(
                $request->filled('min_price') ? (float) $request->min_price : null,
                $request->filled('max_price') ? (float) $request->max_price : null
            );
        }

        // Search filter
        if ($request->has('search')) {
            $query->search($request->search);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');

        if ($sortBy === 'popularity') {
            $query->byPopularity();
        } elseif (in_array($sortBy, ['title', 'price', 'rating', 'created_at', 'updated_at'])) {
            $query->orderBy($sortBy, $sortDirection);
        }

        // Pagination
        $perPage = $request->get('per_page', 15);
        $trainings = $query->paginate($perPage);

        return response()->json([
            'status' => 'success',
            'message' => 'Trainings retrieved successfully',
            'data' => TrainingResource::collection($trainings->items()),
            'meta' => [
                'current_page' => $trainings->currentPage(),
                'per_page' => $trainings->perPage(),
                'total' => $trainings->total(),
                'last_page' => $trainings->lastPage(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrainingRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Set default values
        $data['rating'] = $data['rating'] ?? 0;
        $data['review_count'] = $data['review_count'] ?? 0;
        $data['is_active'] = $data['is_active'] ?? true;

        $training = Training::create($data);

        // Load relationships for response
        $training->load(['category', 'instructor']);

        return response()->json([
            'status' => 'success',
            'message' => 'Training created successfully',
            'data' => new TrainingResource($training),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request): JsonResponse
    {
        $query = Training::query();

        // Include relationships by default for show method
        $includes = ['category', 'instructor'];
        if ($request->has('include')) {
            $requestedIncludes = explode(',', $request->include);
            $validIncludes = ['category', 'instructor'];
            $includes = array_intersect($requestedIncludes, $validIncludes);
        }

        $training = $query->with($includes)->find($id);

        if (! $training) {
            return response()->json([
                'status' => 'error',
                'message' => 'Training not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Training retrieved successfully',
            'data' => new TrainingResource($training),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrainingRequest $request, string $id): JsonResponse
    {
        $training = Training::find($id);

        if (! $training) {
            return response()->json([
                'status' => 'error',
                'message' => 'Training not found',
            ], 404);
        }

        $data = $request->validated();
        $training->update($data);

        // Load relationships for response
        $training->load(['category', 'instructor']);

        return response()->json([
            'status' => 'success',
            'message' => 'Training updated successfully',
            'data' => new TrainingResource($training),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $training = Training::find($id);

        if (! $training) {
            return response()->json([
                'status' => 'error',
                'message' => 'Training not found',
            ], 404);
        }

        $training->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Training deleted successfully',
        ]);
    }
}
