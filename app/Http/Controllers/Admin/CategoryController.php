<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrainingCategory;

class CategoryController extends Controller
{
    public function index()
    {
        // Get all categories with trainings count
        $categories = TrainingCategory::withCount('trainings')
            ->orderBy('name', 'asc')
            ->get();

        // Calculate statistics
        $stats = [
            'total' => $categories->count(),
            'active' => $categories->where('is_active', true)->count(),
            'inactive' => $categories->where('is_active', false)->count(),
            'totalTrainings' => $categories->sum('trainings_count'),
        ];

        return view('pages.admin.categories.index', compact('categories', 'stats'));
    }
}
