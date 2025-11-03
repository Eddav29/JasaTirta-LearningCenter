<?php

namespace App\Http\Controllers;

use App\Models\TrainingCategory;
use App\Models\TrainingSchedule;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScheduleController extends Controller
{
    /**
     * Display schedule page with all training schedules.
     */
    public function index(Request $request): View
    {
        // Get all categories for filter
        $categories = TrainingCategory::withCount('trainings')->get();

        // Start query for schedules
        $query = TrainingSchedule::with(['training.category', 'training.instructor'])
            ->where('status', 'buka_pendaftaran')
            ->orderBy('start_date', 'asc');

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('training', function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhereHas('instructor', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Apply category filter
        if ($request->filled('category') && $request->input('category') !== 'semua') {
            $query->whereHas('training', function ($q) use ($request) {
                $q->where('category_id', $request->input('category'));
            });
        }

        // Apply method filter
        if ($request->filled('method') && $request->input('method') !== 'semua') {
            $query->where('method', $request->input('method'));
        }

        // Apply month filter
        if ($request->filled('month') && $request->input('month') !== 'semua') {
            $query->where('month', $request->input('month'));
        }

        // Apply availability filter
        if ($request->filled('availability')) {
            $availability = $request->input('availability');
            if ($availability === 'available') {
                $query->where('available_slots', '>', 0);
            } elseif ($availability === 'full') {
                $query->where('available_slots', '=', 0);
            }
        }

        // Get all schedules (client-side filtering will handle display)
        $schedules = $query->get();

        return view('pages.landing.schedule.index', compact(
            'schedules',
            'categories'
        ));
    }
}
