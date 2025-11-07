<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\TrainingCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrainingController extends Controller
{
    /**
     * Display catalog page with categories and trainings.
     */
    public function catalog(Request $request): View
    {
        // Get all categories with training count
        $categories = TrainingCategory::withCount('trainings')
            ->get();

        // Start query for trainings
        $query = Training::with(['category', 'schedules', 'instructor'])
            ->where('is_active', true);

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('instructor', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Apply category filter
        if ($request->filled('category') && $request->input('category') !== 'semua') {
            $query->where('category_id', $request->input('category'));
        }

        // Apply type filter
        if ($request->filled('type') && $request->input('type') !== 'semua') {
            $query->where('training_type', $request->input('type'));
        }

        // Apply price filter
        if ($request->filled('price') && $request->input('price') !== 'semua') {
            $priceRange = $request->input('price');
            if ($priceRange === '1-5') {
                $query->whereBetween('price', [0, 5000000]);
            } elseif ($priceRange === '5-10') {
                $query->whereBetween('price', [5000000, 10000000]);
            } elseif ($priceRange === '10+') {
                $query->where('price', '>', 10000000);
            }
        }

        // Apply sorting
        $sortBy = $request->input('sort', 'terbaru');
        switch ($sortBy) {
            case 'terpopuler':
                $query->orderByDesc('rating')
                    ->orderByDesc('review_count');
                break;
            case 'harga-rendah':
                $query->orderBy('price', 'asc');
                break;
            case 'harga-tinggi':
                $query->orderByDesc('price');
                break;
            case 'nama':
                $query->orderBy('title', 'asc');
                break;
            default: // terbaru
                $query->latest();
                break;
        }

        $trainings = $query->get();

        return view('pages.landing.catalog.index', compact(
            'categories',
            'trainings'
        ));
    }

    /**
     * Display training detail page.
     */
    public function show(Training $training): View
    {
        // Load related data for the training
        $training->load([
            'category',
            'instructor.certifications',
            'schedules' => function ($query) {
                $query->whereIn('status', ['buka_pendaftaran', 'berlangsung'])
                    ->orderBy('start_date', 'asc');
            },
            'materials',
            'prerequisites',
            'learningObjectives',
            'syllabus.topics',
        ]);

        // Get related trainings (same category, different training)
        $relatedTrainings = Training::with(['category', 'schedules', 'instructor'])
            ->where('category_id', $training->category_id)
            ->where('id', '!=', $training->id)
            ->where('is_active', true)
            ->limit(3)
            ->get();

        return view('pages.landing.training.show', compact(
            'training',
            'relatedTrainings'
        ));
    }
}
