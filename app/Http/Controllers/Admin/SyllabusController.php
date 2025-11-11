<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\TrainingSyllabus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SyllabusController extends Controller
{
    /**
     * Display a listing of the syllabus for a specific training.
     */
    public function index(Training $training): View
    {
        $syllabi = $training->syllabus()->with('topics')->ordered()->get();

        return view('pages.admin.trainings.syllabus.index', compact('training', 'syllabi'));
    }

    /**
     * Show the form for creating a new syllabus.
     */
    public function create(Training $training): View
    {
        return view('pages.admin.trainings.syllabus.create', compact('training'));
    }

    /**
     * Store a newly created syllabus in storage.
     */
    public function store(Request $request, Training $training): RedirectResponse
    {
        $validated = $request->validate([
            'day' => 'required|integer|min:1',
            'title' => 'required|string|max:255',
            'topics' => 'required|array|min:1',
            'topics.*' => 'required|string|max:255',
        ]);

        // Get the next order number for this training
        $orderNumber = $training->syllabus()->max('order_number') + 1;

        // Create the syllabus
        $syllabus = $training->syllabus()->create([
            'day' => $validated['day'],
            'title' => $validated['title'],
            'order_number' => $orderNumber,
        ]);

        // Create topics with auto-increment order
        foreach ($validated['topics'] as $index => $topicName) {
            $syllabus->topics()->create([
                'topic' => $topicName,
                'order_number' => $index + 1,
            ]);
        }

        return redirect()
            ->route('admin.trainings.show', $training)
            ->with('success', 'Kurikulum berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified syllabus.
     */
    public function edit(Training $training, TrainingSyllabus $syllabus): View
    {
        // Ensure the syllabus belongs to this training
        if ($syllabus->training_id !== $training->id) {
            abort(404);
        }

        $syllabus->load('topics');

        return view('pages.admin.trainings.syllabus.edit', compact('training', 'syllabus'));
    }

    /**
     * Update the specified syllabus in storage.
     */
    public function update(Request $request, Training $training, TrainingSyllabus $syllabus): RedirectResponse
    {
        // Ensure the syllabus belongs to this training
        if ($syllabus->training_id !== $training->id) {
            abort(404);
        }

        $validated = $request->validate([
            'day' => 'required|integer|min:1',
            'title' => 'required|string|max:255',
            'topics' => 'required|array|min:1',
            'topics.*' => 'required|string|max:255',
        ]);

        // Update the syllabus
        $syllabus->update([
            'day' => $validated['day'],
            'title' => $validated['title'],
        ]);

        // Delete existing topics and recreate them
        $syllabus->topics()->delete();

        // Recreate topics with auto-increment order
        foreach ($validated['topics'] as $index => $topicName) {
            $syllabus->topics()->create([
                'topic' => $topicName,
                'order_number' => $index + 1,
            ]);
        }

        return redirect()
            ->route('admin.trainings.show', $training)
            ->with('success', 'Kurikulum berhasil diperbarui.');
    }

    /**
     * Remove the specified syllabus from storage.
     */
    public function destroy(Training $training, TrainingSyllabus $syllabus): RedirectResponse
    {
        // Ensure the syllabus belongs to this training
        if ($syllabus->training_id !== $training->id) {
            abort(404);
        }

        $syllabus->delete();

        return redirect()
            ->route('admin.trainings.show', $training)
            ->with('success', 'Kurikulum berhasil dihapus.');
    }
}
