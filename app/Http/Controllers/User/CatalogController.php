<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\TrainingCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CatalogController extends Controller
{
    /**
     * Display catalog of all available courses.
     */
    public function index(): View
    {
        $user = Auth::user();

        // Get all active trainings with relationships
        $trainings = Training::with(['category', 'instructor', 'schedules'])
            ->where('is_active', true)
            ->get();

        // Get categories with training count
        $categories = TrainingCategory::withCount('trainings')
            ->orderBy('name')
            ->get();

        // Get enrolled course IDs for current user
        // TODO: Replace with actual enrollment relationship when ready
        $enrolledCourseIds = $this->getEnrolledCourseIds($user);

        // Transform trainings to match frontend structure
        $courses = $trainings->map(function ($training) {
            return [
                'id' => $training->id,
                'title' => $training->title,
                'slug' => $training->id, // Use ID as slug for now (can add slug column later)
                'description' => $training->description,
                'instructor' => $training->instructor?->name ?? null,
                'category' => $training->category ? [
                    'id' => $training->category->id,
                    'name' => $training->category->name,
                ] : null,
                'category_id' => $training->category_id,
                'training_type' => $training->training_type,
                'level' => 'intermediate', // Default level (can add level column later)
                'duration' => $training->duration, // Use existing duration field
                'duration_days' => null,
                'duration_hours' => null,
                'capacity' => $training->capacity,
                'learning_hours' => $training->learning_hours,
                'rating' => $training->rating ?? 4.5,
                'review_count' => $training->review_count ?? 0,
                'thumbnail' => $training->image, // Use 'image' column as thumbnail
                'created_at' => $training->created_at,
                'schedules' => $training->schedules->map(function ($schedule) {
                    return [
                        'start_date' => $schedule->start_date,
                        'location' => $schedule->location,
                        'available_slots' => $schedule->available_slots ?? 0,
                        'total_slots' => $schedule->total_slots ?? 0,
                    ];
                }),
            ];
        });

        return view('pages.user.catalog.index', [
            'courses' => $courses,
            'categories' => $categories,
            'enrolledCourseIds' => $enrolledCourseIds,
        ]);
    }

    /**
     * Get enrolled course IDs for user.
     */
    private function getEnrolledCourseIds($user): array
    {
        // TODO: Replace with actual enrollment query
        // Example: return $user->enrolledTrainings()->pluck('training_id')->toArray();

        // Mock data for now - randomly enrolled in some courses
        return [1, 2, 3]; // These match the IDs from CourseController mock data
    }
}
