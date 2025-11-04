<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\Training;
use App\Models\TrainingCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index(Request $request): View
    {
        $query = Training::with(['category', 'instructor', 'schedules']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('instructor', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Category filter
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category_id', $request->category);
        }

        // Level filter (based on training_type)
        if ($request->filled('level') && $request->level !== 'all') {
            $query->where('training_type', $request->level);
        }

        // Status filter
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Instructor filter
        if ($request->filled('instructor') && $request->instructor !== 'all') {
            $query->where('instructor_id', $request->instructor);
        }

        // Sorting
        $sortBy = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        $query->orderBy($sortBy, $sortDirection);

        // Pagination
        $perPage = $request->get('per_page', 10);
        $trainings = $query->paginate($perPage)->withQueryString();

        // Get categories and instructors for filters
        $categories = TrainingCategory::orderBy('name')->get();
        $instructors = Instructor::orderBy('name')->get();

        // Calculate statistics
        $stats = [
            'total' => Training::count(),
            'active' => Training::where('is_active', true)->count(),
            'totalParticipants' => Training::with('schedules')->get()->sum(function ($training) {
                return $training->schedules->sum('enrolled_count');
            }),
            'averageRating' => Training::where('rating', '>', 0)->avg('rating') ?? 0,
        ];

        return view('pages.admin.trainings.index', compact(
            'trainings',
            'categories',
            'instructors',
            'stats'
        ));
    }

    public function bulkDelete(Request $request): RedirectResponse
    {
        $request->validate([
            'ids' => 'required|json',
        ]);

        $ids = json_decode($request->ids);

        if (empty($ids)) {
            return redirect()->back()->with('error', 'Tidak ada pelatihan yang dipilih');
        }

        Training::whereIn('id', $ids)->delete();

        return redirect()->back()->with('success', count($ids).' pelatihan berhasil dihapus');
    }

    public function bulkUpdateStatus(Request $request): RedirectResponse
    {
        $request->validate([
            'ids' => 'required|json',
            'is_active' => 'required|boolean',
        ]);

        $ids = json_decode($request->ids);

        if (empty($ids)) {
            return redirect()->back()->with('error', 'Tidak ada pelatihan yang dipilih');
        }

        Training::whereIn('id', $ids)->update([
            'is_active' => $request->is_active,
        ]);

        $status = $request->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->back()->with('success', count($ids).' pelatihan berhasil '.$status);
    }
}
