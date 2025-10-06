<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTrainingCategoryRequest;
use App\Http\Requests\UpdateTrainingCategoryRequest;
use App\Http\Resources\TrainingCategoryResource;
use App\Models\TrainingCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TrainingCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = TrainingCategory::query();

        // Apply search filter
        if ($request->has('search')) {
            $query->search($request->search);
        }

        // NOTE: Training counts will be added when Training model is created
        // if ($request->has('include_counts') && $request->include_counts) {
        //     $query->withCount(['trainings', 'activeTrainings']);
        // }

        // Sorting
        $sortBy = $request->get('sort_by', 'name');
        $sortDirection = $request->get('sort_direction', 'asc');

        if (in_array($sortBy, ['name', 'created_at', 'updated_at'])) {
            $query->orderBy($sortBy, $sortDirection);
        }

        // Pagination
        $perPage = $request->get('per_page', 15);
        $categories = $query->paginate($perPage);

        return response()->json([
            'status' => 'success',
            'message' => 'Training categories retrieved successfully',
            'data' => TrainingCategoryResource::collection($categories->items()),
            'meta' => [
                'current_page' => $categories->currentPage(),
                'per_page' => $categories->perPage(),
                'total' => $categories->total(),
                'last_page' => $categories->lastPage(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrainingCategoryRequest $request): JsonResponse
    {
        $data = $request->validated();

        $category = TrainingCategory::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Training category created successfully',
            'data' => new TrainingCategoryResource($category),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request): JsonResponse
    {
        $query = TrainingCategory::query();

        // NOTE: Training counts will be added when Training model is created
        // if ($request->has('include_counts') && $request->include_counts) {
        //     $query->withCount(['trainings', 'activeTrainings']);
        // }

        $category = $query->find($id);

        if (! $category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Training category not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Training category retrieved successfully',
            'data' => new TrainingCategoryResource($category),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrainingCategoryRequest $request, string $id): JsonResponse
    {
        $category = TrainingCategory::find($id);

        if (! $category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Training category not found',
            ], 404);
        }

        $data = $request->validated();
        $category->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Training category updated successfully',
            'data' => new TrainingCategoryResource($category),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $category = TrainingCategory::find($id);

        if (! $category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Training category not found',
            ], 404);
        }

        // NOTE: This check will be uncommented when Training model is created
        // Check if category has associated trainings
        // $trainingsCount = $category->trainings()->count();
        //
        // if ($trainingsCount > 0) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => "Cannot delete category. It has {$trainingsCount} associated training(s).",
        //     ], 422);
        // }

        $category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Training category deleted successfully',
        ]);
    }
}
