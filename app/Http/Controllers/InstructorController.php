<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\View\View;

class InstructorController extends Controller
{
    /**
     * Display a listing of instructors for landing page.
     */
    public function index(): View
    {
        $internalInstructors = Instructor::with('certifications')
            ->where('instructor_type', 'internal')
            ->get();

        $vendorInstructors = Instructor::with('certifications')
            ->where('instructor_type', 'vendor')
            ->get();

        return view('pages.landing.instructor.index', compact(
            'internalInstructors',
            'vendorInstructors'
        ));
    }
}
