<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\Instructor;
use App\Models\TrainingSchedule;
use App\Http\Requests\TrainingSchedule\StoreTrainingScheduleRequest;
use App\Http\Requests\TrainingSchedule\UpdateTrainingScheduleRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = TrainingSchedule::with(['training.category', 'training.instructor']);

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('training', function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('instructor', function ($instructorQ) use ($search) {
                      $instructorQ->where('name', 'like', "%{$search}%");
                  });
            })->orWhere('location', 'like', "%{$search}%");
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('method')) {
            $query->where('method', $request->get('method'));
        }

        if ($request->filled('instructor_id')) {
            $query->whereHas('training', function ($q) use ($request) {
                $q->where('instructor_id', $request->instructor_id);
            });
        }

        if ($request->filled('month')) {
            $query->where('month', $request->month);
        }

        $schedules = $query->orderByDesc('created_at')->paginate(10);

        // Get data for filters
        $trainings = Training::active()->with('instructor')->get();
        $instructors = Instructor::all();

        return view('pages.admin.schedules.index', compact('schedules', 'trainings', 'instructors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $trainings = Training::active()->with('instructor')->get();
        
        return view('pages.admin.schedules.create', compact('trainings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrainingScheduleRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();
            
            // Auto-calculate month from start_date
            $validated['month'] = date('Y-m', strtotime($validated['start_date']));
            
            // Set initial values
            $validated['available_slots'] = $validated['total_slots'];
            $validated['registered_count'] = 0;
            
            TrainingSchedule::create($validated);

            return redirect()->route('admin.schedules.index')
                           ->with('success', 'Jadwal berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Gagal menambahkan jadwal: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TrainingSchedule $schedule): View
    {
        $schedule->load(['training.category', 'training.instructor']);
        
        return view('pages.admin.schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrainingSchedule $schedule): View
    {
        $trainings = Training::active()->with('instructor')->get();
        $schedule->load(['training']);
        
        return view('pages.admin.schedules.edit', compact('schedule', 'trainings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrainingScheduleRequest $request, TrainingSchedule $schedule): RedirectResponse
    {
        try {
            $validated = $request->validated();
            
            // Auto-calculate month from start_date
            $validated['month'] = date('Y-m', strtotime($validated['start_date']));
            
            // Update available slots if total slots changed
            if (isset($validated['total_slots']) && $validated['total_slots'] != $schedule->total_slots) {
                $validated['available_slots'] = $validated['total_slots'] - $schedule->registered_count;
            }
            
            $schedule->update($validated);

            return redirect()->route('admin.schedules.index')
                           ->with('success', 'Jadwal berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Gagal memperbarui jadwal: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainingSchedule $schedule): RedirectResponse
    {
        try {
            if ($schedule->registered_count > 0) {
                return redirect()->back()
                               ->with('error', 'Tidak dapat menghapus jadwal yang sudah memiliki peserta terdaftar!');
            }
            
            $schedule->delete();
            
            return redirect()->route('admin.schedules.index')
                           ->with('success', 'Jadwal berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Gagal menghapus jadwal: ' . $e->getMessage());
        }
    }

    /**
     * Bulk delete schedules.
     */
    public function bulkDestroy(Request $request): JsonResponse
    {
        try {
            $ids = $request->input('ids', []);
            
            if (empty($ids)) {
                return response()->json(['error' => 'Tidak ada jadwal yang dipilih'], 400);
            }
            
            // Check if any selected schedule has registered participants
            $schedulesWithParticipants = TrainingSchedule::whereIn('id', $ids)
                                                       ->where('registered_count', '>', 0)
                                                       ->count();
            
            if ($schedulesWithParticipants > 0) {
                return response()->json([
                    'error' => 'Tidak dapat menghapus jadwal yang sudah memiliki peserta terdaftar!'
                ], 400);
            }
            
            $deleted = TrainingSchedule::whereIn('id', $ids)->delete();
            
            return response()->json([
                'success' => true,
                'message' => "{$deleted} jadwal berhasil dihapus!"
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus jadwal: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Bulk update status for schedules.
     */
    public function bulkUpdateStatus(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'ids' => 'required|array',
                'status' => 'required|in:buka_pendaftaran,penuh,berlangsung,selesai,dibatalkan'
            ]);
            
            $ids = $request->input('ids', []);
            $status = $request->input('status');
            
            if (empty($ids)) {
                return response()->json(['error' => 'Tidak ada jadwal yang dipilih'], 400);
            }
            
            $updated = TrainingSchedule::whereIn('id', $ids)->update(['status' => $status]);
            
            return response()->json([
                'success' => true,
                'message' => "{$updated} jadwal berhasil diperbarui statusnya!"
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal memperbarui status: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Duplicate a schedule.
     */
    public function duplicate(TrainingSchedule $schedule): RedirectResponse
    {
        try {
            $newSchedule = $schedule->replicate();
            
            // Reset some fields for the duplicate
            $newSchedule->registered_count = 0;
            $newSchedule->available_slots = $newSchedule->total_slots;
            $newSchedule->status = 'buka_pendaftaran';
            
            // Increment dates by 1 week as default
            $newSchedule->start_date = date('Y-m-d', strtotime($schedule->start_date . ' +1 week'));
            $newSchedule->end_date = date('Y-m-d', strtotime($schedule->end_date . ' +1 week'));
            $newSchedule->month = date('Y-m', strtotime($newSchedule->start_date));
            
            $newSchedule->save();
            
            return redirect()->route('admin.schedules.edit', $newSchedule)
                           ->with('success', 'Jadwal berhasil diduplikasi! Silakan sesuaikan detailnya.');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Gagal menduplikasi jadwal: ' . $e->getMessage());
        }
    }
}
