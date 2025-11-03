<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use Illuminate\Support\Facades\DB;

class InstructorController extends Controller
{
    public function index()
    {
        // Fetch instructors with trainings count (left join)
        $instructors = Instructor::leftJoin('trainings', 'trainings.instructor_id', '=', 'instructors.id')
            ->select('instructors.*', DB::raw('COUNT(trainings.id) as trainings_count'))
            ->groupBy('instructors.id')
            ->orderBy('instructors.name', 'asc')
            ->get();

        $stats = [
            'total' => $instructors->count(),
            'internal' => $instructors->where('instructor_type', 'internal')->count(),
            'vendor' => $instructors->where('instructor_type', 'vendor')->count(),
            'totalTrainings' => $instructors->sum('trainings_count'),
        ];

        return view('pages.admin.instructors.index', compact('instructors', 'stats'));
    }
}
