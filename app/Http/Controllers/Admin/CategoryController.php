<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrainingCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $query = TrainingCategory::withCount('trainings');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Sort
        $sortField = $request->get('sort', 'name');
        $sortDirection = $request->get('direction', 'asc');

        if (in_array($sortField, ['name', 'created_at', 'trainings_count'])) {
            if ($sortField === 'trainings_count') {
                $query->orderBy('trainings_count', $sortDirection);
            } else {
                $query->orderBy($sortField, $sortDirection);
            }
        }

        $categories = $query->paginate(10);

        return view('pages.admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('pages.admin.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:training_categories,name',
            'description' => 'nullable|string',
        ]);

        TrainingCategory::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function show(TrainingCategory $category): View
    {
        $category->load(['trainings' => function ($query) {
            $query->with(['instructor', 'schedules'])
                ->orderBy('created_at', 'desc');
        }]);

        return view('pages.admin.categories.show', compact('category'));
    }

    public function edit(TrainingCategory $category): View
    {
        return view('pages.admin.categories.edit', compact('category'));
    }

    public function update(Request $request, TrainingCategory $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:training_categories,name,'.$category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(TrainingCategory $category): RedirectResponse
    {
        // Check if category has trainings
        if ($category->trainings()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki pelatihan');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus');
    }

    public function bulkDelete(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:training_categories,id',
        ]);

        // Check if any category has trainings
        $categoriesWithTrainings = TrainingCategory::whereIn('id', $validated['ids'])
            ->has('trainings')
            ->count();

        if ($categoriesWithTrainings > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Beberapa kategori tidak dapat dihapus karena masih memiliki pelatihan');
        }

        TrainingCategory::whereIn('id', $validated['ids'])->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', count($validated['ids']).' kategori berhasil dihapus');
    }
}
