<?php

namespace App\Http\Controllers\Admin;

use App\Data\Training\CreateTrainingData;
use App\Data\Training\UpdateTrainingData;
use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Services\Contracts\TrainingServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function __construct(
        protected TrainingServiceInterface $trainingService
    ) {}

    public function index(Request $request): View
    {
        $filters = [
            'search' => $request->search,
            'category' => $request->category,
            'level' => $request->level,
            'status' => $request->status,
            'instructor' => $request->instructor,
            'sort' => $request->get('sort', 'created_at'),
            'direction' => $request->get('direction', 'desc'),
        ];

        $perPage = $request->get('per_page', 10);

        $trainings = $this->trainingService->getPaginatedTrainings($filters, $perPage);
        $categories = $this->trainingService->getCategories();
        $instructors = $this->trainingService->getInstructors();
        $stats = $this->trainingService->getStatistics();

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

        $count = $this->trainingService->bulkDeleteTrainings($ids);

        return redirect()->back()->with('success', "{$count} pelatihan berhasil dihapus");
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

        $count = $this->trainingService->bulkUpdateStatus($ids, $request->is_active);
        $status = $request->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->back()->with('success', "{$count} pelatihan berhasil {$status}");
    }

    public function create(): View
    {
        $categories = $this->trainingService->getCategories();
        $instructors = $this->trainingService->getInstructors();

        return view('pages.admin.trainings.create', compact('categories', 'instructors'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:training_categories,id',
            'instructor_id' => 'required|exists:instructors,id',
            'description' => 'required|string',
            'long_description' => 'nullable|string',
            'duration' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'training_type' => 'required|in:offline,online,hybrid',
            'learning_hours' => 'nullable|integer|min:1',
            'training_methods' => 'nullable|string',
            'certification_note' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $data = CreateTrainingData::fromRequest($validated);
        $this->trainingService->createTraining($data);

        return redirect()->route('admin.trainings.index')->with('success', 'Pelatihan berhasil ditambahkan');
    }

    public function show(Training $training): View
    {
        $training = $this->trainingService->getTrainingById($training->id);

        return view('pages.admin.trainings.show', compact('training'));
    }

    public function edit(Training $training): View
    {
        $categories = $this->trainingService->getCategories();
        $instructors = $this->trainingService->getInstructors();

        return view('pages.admin.trainings.edit', compact('training', 'categories', 'instructors'));
    }

    public function update(Request $request, Training $training): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:training_categories,id',
            'instructor_id' => 'required|exists:instructors,id',
            'description' => 'required|string',
            'long_description' => 'nullable|string',
            'duration' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'training_type' => 'required|in:offline,online,hybrid',
            'learning_hours' => 'nullable|integer|min:1',
            'training_methods' => 'nullable|string',
            'certification_note' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $data = UpdateTrainingData::fromRequest($validated);
        $this->trainingService->updateTraining($training, $data);

        return redirect()->route('admin.trainings.index')->with('success', 'Pelatihan berhasil diperbarui');
    }

    public function destroy(Training $training): RedirectResponse
    {
        $this->trainingService->deleteTraining($training);

        return redirect()->route('admin.trainings.index')->with('success', 'Pelatihan berhasil dihapus');
    }
}
