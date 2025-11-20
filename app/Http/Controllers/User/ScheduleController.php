<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\TrainingCategory;
use App\Models\TrainingSchedule;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request): View
    {
        $query = TrainingSchedule::with(['training.category', 'training.instructor'])
            ->where('status', 'buka_pendaftaran')
            ->where('start_date', '>=', Carbon::today());

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('training', function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })->orWhere('location', 'like', "%{$search}%");
        }

        // Category filter
        if ($request->filled('category') && $request->category !== 'all') {
            $query->whereHas('training', function ($q) use ($request) {
                $q->where('category_id', $request->category);
            });
        }

        // Method filter
        if ($request->filled('method') && $request->method !== 'all') {
            $query->where('method', $request->method);
        }

        // Training level filter (based on training_type)
        if ($request->filled('level') && $request->level !== 'all') {
            $query->whereHas('training', function ($q) use ($request) {
                $q->where('training_type', $request->level);
            });
        }

        // Instructor filter
        if ($request->filled('instructor') && $request->instructor !== 'all') {
            $query->whereHas('training', function ($q) use ($request) {
                $q->where('instructor_id', $request->instructor);
            });
        }

        // Month filter
        if ($request->filled('month') && $request->month !== 'all') {
            $query->where('month', $request->month);
        }

        // Date range filter
        if ($request->filled('start_date')) {
            $query->where('start_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->where('end_date', '<=', $request->end_date);
        }

        // Price range filter
        if ($request->filled('min_price')) {
            $query->whereHas('training', function ($q) use ($request) {
                $q->where('price', '>=', $request->min_price);
            });
        }

        if ($request->filled('max_price')) {
            $query->whereHas('training', function ($q) use ($request) {
                $q->where('price', '<=', $request->max_price);
            });
        }

        // Sorting
        $sortBy = $request->get('sort', 'start_date');
        $sortDirection = $request->get('direction', 'asc');

        if ($sortBy === 'price') {
            $query->join('trainings', 'training_schedules.training_id', '=', 'trainings.id')
                ->orderBy('trainings.price', $sortDirection)
                ->select('training_schedules.*');
        } elseif ($sortBy === 'title') {
            $query->join('trainings', 'training_schedules.training_id', '=', 'trainings.id')
                ->orderBy('trainings.title', $sortDirection)
                ->select('training_schedules.*');
        } else {
            $query->orderBy($sortBy, $sortDirection);
        }

        // View mode
        $viewMode = $request->get('view', 'grid'); // grid or list

        // Pagination
        $perPage = $request->get('per_page', 12);
        $schedules = $query->paginate($perPage)->withQueryString();

        // Get data for filters
        $categories = TrainingCategory::whereHas('trainings.schedules', function ($q) {
            $q->where('status', 'buka_pendaftaran')
                ->where('start_date', '>=', Carbon::today());
        })->orderBy('name')->get();

        $instructors = Instructor::whereHas('trainings.schedules', function ($q) {
            $q->where('status', 'buka_pendaftaran')
                ->where('start_date', '>=', Carbon::today());
        })->orderBy('name')->get();

        // Get available months
        $availableMonths = TrainingSchedule::where('status', 'buka_pendaftaran')
            ->where('start_date', '>=', Carbon::today())
            ->selectRaw('DISTINCT month')
            ->orderBy('month')
            ->pluck('month')
            ->map(function ($month) {
                return [
                    'value' => $month,
                    'label' => Carbon::createFromFormat('Y-m', $month)->format('F Y'),
                ];
            });

        // Calculate statistics
        $totalSchedules = TrainingSchedule::where('status', 'buka_pendaftaran')
            ->where('start_date', '>=', Carbon::today())
            ->count();

        $availableSlots = TrainingSchedule::where('status', 'buka_pendaftaran')
            ->where('start_date', '>=', Carbon::today())
            ->sum('available_slots');

        $upcomingThisWeek = TrainingSchedule::where('status', 'buka_pendaftaran')
            ->whereBetween('start_date', [
                Carbon::today(),
                Carbon::today()->addWeek(),
            ])->count();

        $stats = [
            'total_schedules' => $totalSchedules,
            'available_slots' => $availableSlots,
            'upcoming_week' => $upcomingThisWeek,
        ];

        return view('pages.user.schedules.index', compact(
            'schedules',
            'categories',
            'instructors',
            'availableMonths',
            'viewMode',
            'stats'
        ));
    }

    public function show(TrainingSchedule $schedule): View
    {
        $schedule->load([
            'training.category',
            'training.instructor',
            'training.learningObjectives',
            'training.prerequisites',
            'training.materials',
            'training.syllabus.topics',
        ]);

        // Get other schedules for the same training
        $otherSchedules = TrainingSchedule::where('training_id', $schedule->training_id)
            ->where('id', '!=', $schedule->id)
            ->where('status', 'buka_pendaftaran')
            ->where('start_date', '>=', Carbon::today())
            ->orderBy('start_date')
            ->take(3)
            ->get();

        // Get related trainings (same category)
        $relatedSchedules = TrainingSchedule::whereHas('training', function ($q) use ($schedule) {
            $q->where('category_id', $schedule->training->category_id)
                ->where('id', '!=', $schedule->training_id);
        })
            ->where('status', 'buka_pendaftaran')
            ->where('start_date', '>=', Carbon::today())
            ->with(['training'])
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('pages.user.schedules.show', compact(
            'schedule',
            'otherSchedules',
            'relatedSchedules'
        ));
    }
}
