<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Instructor\StoreInstructorRequest;
use App\Http\Requests\Instructor\UpdateInstructorRequest;
use App\Models\Instructor;
use App\Models\InstructorCertification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstructorController extends Controller
{
    public function index(Request $request)
    {
        $query = Instructor::leftJoin('trainings', 'trainings.instructor_id', '=', 'instructors.id')
            ->select('instructors.*', DB::raw('COUNT(trainings.id) as trainings_count'))
            ->groupBy('instructors.id');

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('instructors.name', 'like', '%'.$search.'%')
                    ->orWhere('instructors.email', 'like', '%'.$search.'%')
                    ->orWhere('instructors.specialization', 'like', '%'.$search.'%');
            });
        }

        if ($request->filled('instructor_type')) {
            $query->where('instructors.instructor_type', $request->instructor_type);
        }

        if ($request->filled('specialization')) {
            $query->where('instructors.specialization', 'like', '%'.$request->specialization.'%');
        }

        $instructors = $query->orderBy('instructors.name', 'asc')->get();

        $stats = [
            'total' => Instructor::count(),
            'internal' => Instructor::where('instructor_type', 'internal')->count(),
            'vendor' => Instructor::where('instructor_type', 'vendor')->count(),
            'totalTrainings' => DB::table('trainings')->count(),
        ];

        return view('pages.admin.instructors.index', compact('instructors', 'stats'));
    }

    public function create()
    {
        return view('pages.admin.instructors.create');
    }

    public function store(StoreInstructorRequest $request)
    {
        $data = $request->validated();

        // Extract certifications from data
        $certifications = $data['certifications'] ?? [];
        unset($data['certifications']);

        DB::transaction(function () use ($data, $certifications) {
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
        });

        return redirect()->route('admin.instructors.index')
            ->with('success', 'Instructor berhasil ditambahkan.');
    }

    public function show(Instructor $instructor)
    {
        $instructor->load(['certifications', 'trainings' => function ($query) {
            $query->with(['category', 'schedules'])->orderBy('created_at', 'desc');
        }]);

        // Calculate total participants safely
        $totalParticipants = 0;
        foreach ($instructor->trainings as $training) {
            if ($training->schedules) {
                $totalParticipants += $training->schedules->sum('max_participants');
            }
        }

        $stats = [
            'totalTrainings' => $instructor->trainings->count(),
            'totalParticipants' => $totalParticipants,
            'certificationsCount' => $instructor->certifications->count(),
            'joinDate' => $instructor->created_at->format('d M Y'),
        ];

        return view('pages.admin.instructors.show', compact('instructor', 'stats'));
    }

    public function edit(Instructor $instructor)
    {
        $instructor->load('certifications');

        return view('pages.admin.instructors.edit', compact('instructor'));
    }

    public function update(UpdateInstructorRequest $request, Instructor $instructor)
    {
        $data = $request->validated();

        // Extract certifications from data
        $certifications = $data['certifications'] ?? null;
        unset($data['certifications']);

        DB::transaction(function () use ($instructor, $data, $certifications) {
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
        });

        return redirect()->route('admin.instructors.index')
            ->with('success', 'Instructor berhasil diperbarui.');
    }

    public function destroy(Instructor $instructor)
    {
        DB::transaction(function () use ($instructor) {
            // Delete related certifications
            $instructor->certifications()->delete();

            // Check if instructor has trainings
            if ($instructor->trainings()->exists()) {
                // Don't actually delete, just mark as inactive or throw error
                throw new \Exception('Cannot delete instructor with existing trainings. Please reassign or remove trainings first.');
            }

            // Delete instructor
            $instructor->delete();
        });

        return redirect()->route('admin.instructors.index')
            ->with('success', 'Instructor berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'instructor_ids' => 'required|array',
            'instructor_ids.*' => 'exists:instructors,id',
        ]);

        DB::transaction(function () use ($request) {
            $instructors = Instructor::whereIn('id', $request->instructor_ids)->get();

            foreach ($instructors as $instructor) {
                // Check if instructor has trainings
                if ($instructor->trainings()->exists()) {
                    continue; // Skip instructors with trainings
                }

                // Delete certifications
                $instructor->certifications()->delete();

                // Delete instructor
                $instructor->delete();
            }
        });

        return redirect()->route('admin.instructors.index')
            ->with('success', 'Selected instructors berhasil dihapus.');
    }

    public function duplicate(Instructor $instructor)
    {
        DB::transaction(function () use ($instructor) {
            // Create duplicate instructor
            $newInstructor = $instructor->replicate();
            $newInstructor->name = $instructor->name.' (Copy)';
            $newInstructor->email = 'copy_'.$instructor->email;
            $newInstructor->save();

            // Duplicate certifications
            foreach ($instructor->certifications as $certification) {
                InstructorCertification::create([
                    'instructor_id' => $newInstructor->id,
                    'certification_name' => $certification->certification_name,
                ]);
            }
        });

        return redirect()->route('admin.instructors.edit', $instructor)
            ->with('success', 'Instructor berhasil diduplikasi.');
    }
}
