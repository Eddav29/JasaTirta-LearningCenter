<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Instructor\StoreInstructorRequest;
use App\Http\Requests\Instructor\UpdateInstructorRequest;
use App\Http\Resources\InstructorResource;
use App\Models\Instructor;
use App\Models\InstructorCertification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Instructor::query()->with('certifications');

        // Apply filters
        if ($request->has('instructor_type')) {
            $query->where('instructor_type', $request->instructor_type);
        }

        if ($request->has('specialization')) {
            $query->where('specialization', 'like', '%'.$request->specialization.'%');
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhere('specialization', 'like', '%'.$search.'%');
            });
        }

        // Pagination
        $perPage = $request->get('per_page', 15);
        $instructors = $query->paginate($perPage);

        return response()->json([
            'status' => 'success',
            'message' => 'Instructors retrieved successfully',
            'data' => InstructorResource::collection($instructors->items()),
            'meta' => [
                'current_page' => $instructors->currentPage(),
                'per_page' => $instructors->perPage(),
                'total' => $instructors->total(),
                'last_page' => $instructors->lastPage(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInstructorRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Extract certifications from data
        $certifications = $data['certifications'] ?? [];
        unset($data['certifications']);

        // Create instructor
        $instructor = Instructor::create($data);

        // Create certifications if provided
        if (! empty($certifications)) {
            foreach ($certifications as $certificationName) {
                InstructorCertification::create([
                    'instructor_id' => $instructor->id,
                    'certification_name' => $certificationName,
                ]);
            }
        }

        // Load relationships for response
        $instructor->load('certifications');

        return response()->json([
            'status' => 'success',
            'message' => 'Instructor created successfully',
            'data' => new InstructorResource($instructor),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $instructor = Instructor::with('certifications')->find($id);

        if (! $instructor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Instructor not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Instructor retrieved successfully',
            'data' => new InstructorResource($instructor),
        ]);
    }

    /**  
     * Update the specified resource in storage.
     */
    public function update(UpdateInstructorRequest $request, string $id): JsonResponse
    {
        $instructor = Instructor::find($id);

        if (! $instructor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Instructor not found',
            ], 404);
        }

        $data = $request->validated();

        // Extract certifications from data
        $certifications = $data['certifications'] ?? null;
        unset($data['certifications']);

        // Update instructor
        $instructor->update($data);

        // Handle certifications update if provided
        if ($certifications !== null) {
            // Delete existing certifications
            $instructor->certifications()->delete();

            // Create new certifications
            foreach ($certifications as $certificationName) {
                InstructorCertification::create([
                    'instructor_id' => $instructor->id,
                    'certification_name' => $certificationName,
                ]);
            }
        }

        // Load relationships for response
        $instructor->load('certifications');

        return response()->json([
            'status' => 'success',
            'message' => 'Instructor updated successfully',
            'data' => new InstructorResource($instructor),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $instructor = Instructor::find($id);

        if (! $instructor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Instructor not found',
            ], 404);
        }

        // Delete related certifications
        $instructor->certifications()->delete();

        // Delete instructor
        $instructor->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Instructor deleted successfully',
        ]);
    }
}
