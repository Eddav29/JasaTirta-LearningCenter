<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\TrainingCategory;
use Illuminate\View\View;

class TrainingController extends Controller
{
    /**
     * Display catalog page with categories and trainings.
     */
    public function catalog(): View
    {
        // Get all categories with training count
        $categories = TrainingCategory::withCount('trainings')
            ->get();

        // Get all trainings with relationships
        $trainings = Training::with(['category', 'schedules'])
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('pages.landing.catalog.index', compact(
            'categories',
            'trainings'
        ));
    }
}
