<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Display user's enrolled courses.
     */
    public function index(): View
    {
        $user = Auth::user();

        // Mock data - replace with actual database queries
        $stats = [
            'total' => 8,
            'completed' => 3,
            'inProgress' => 5,
            'avgProgress' => 62,
        ];

        $activeCourses = [
            [
                'id' => 1,
                'title' => 'Water Quality Analysis Fundamentals',
                'instructor' => 'Dr. Sarah Johnson',
                'description' => 'Learn the fundamentals of water quality testing and analysis techniques used in environmental monitoring and management.',
                'progress' => 75,
                'totalLessons' => 12,
                'completedLessons' => 8,
                'nextLesson' => 'Lab Techniques for pH Testing',
                'status' => 'in_progress',
                'thumbnail' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=400&h=250&fit=crop',
            ],
            [
                'id' => 2,
                'title' => 'Environmental Monitoring Techniques',
                'instructor' => 'Prof. Michael Chen',
                'description' => 'Master the techniques for environmental monitoring including sampling, data collection, and analysis methods.',
                'progress' => 45,
                'totalLessons' => 10,
                'completedLessons' => 5,
                'nextLesson' => 'Sampling Methods',
                'status' => 'in_progress',
                'thumbnail' => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=400&h=250&fit=crop',
            ],
            [
                'id' => 3,
                'title' => 'Laboratory Safety Protocols',
                'instructor' => 'Dr. Lisa Wang',
                'description' => 'Essential safety protocols and best practices for working in laboratory environments.',
                'progress' => 90,
                'totalLessons' => 10,
                'completedLessons' => 9,
                'nextLesson' => 'Final Assessment',
                'status' => 'in_progress',
                'thumbnail' => 'https://images.unsplash.com/photo-1582719471384-894fbb16e074?w=400&h=250&fit=crop',
            ],
        ];

        $completedCourses = [
            [
                'id' => 4,
                'title' => 'Water Resource Management',
                'instructor' => 'Prof. John Anderson',
                'description' => 'Comprehensive course on sustainable water resource management and conservation strategies.',
                'progress' => 100,
                'totalLessons' => 15,
                'completedLessons' => 15,
                'completedDate' => '15 Okt 2025',
                'score' => 95,
                'status' => 'completed',
                'hasCertificate' => true,
                'thumbnail' => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=400&h=250&fit=crop',
            ],
            [
                'id' => 5,
                'title' => 'Introduction to Hydrology',
                'instructor' => 'Dr. Emily Zhang',
                'description' => 'Fundamental concepts of hydrology and water cycle dynamics.',
                'progress' => 100,
                'totalLessons' => 8,
                'completedLessons' => 8,
                'completedDate' => '28 Sep 2025',
                'score' => 88,
                'status' => 'completed',
                'hasCertificate' => true,
                'thumbnail' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=400&h=250&fit=crop',
            ],
            [
                'id' => 6,
                'title' => 'Water Treatment Basics',
                'instructor' => 'Ir. Ahmad Fauzi',
                'description' => 'Basic principles and processes of water treatment for drinking water supply.',
                'progress' => 100,
                'totalLessons' => 12,
                'completedLessons' => 12,
                'completedDate' => '10 Sep 2025',
                'score' => 92,
                'status' => 'completed',
                'hasCertificate' => true,
                'thumbnail' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?w=400&h=250&fit=crop',
            ],
        ];

        return view('pages.user.courses.index', compact(
            'user',
            'stats',
            'activeCourses',
            'completedCourses'
        ));
    }

    /**
     * Display course detail.
     */
    public function show(string $id): View
    {
        // Mock course detail
        $course = [
            'id' => $id,
            'title' => 'Water Quality Analysis Fundamentals',
            'instructor' => 'Dr. Sarah Johnson',
            'description' => 'Learn the fundamentals of water quality testing and analysis techniques used in environmental monitoring and management.',
            'progress' => 75,
            'totalLessons' => 12,
            'completedLessons' => 8,
            'thumbnail' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=800&h=400&fit=crop',
        ];

        return view('pages.user.courses.show', compact('course'));
    }
}
