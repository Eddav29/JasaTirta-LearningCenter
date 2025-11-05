<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index(): View
    {
        $user = Auth::user();
        
        // Mock data - replace with actual database queries
        $userStats = [
            'coursesEnrolled' => 8,
            'coursesCompleted' => 3,
            'totalHours' => 45,
            'currentStreak' => 7,
            'certificates' => 3,
            'achievements' => 12,
        ];

        $activeCourses = [
            [
                'id' => 1,
                'title' => 'Water Quality Analysis Fundamentals',
                'instructor' => 'Dr. Sarah Johnson',
                'progress' => 75,
                'nextLesson' => 'Lab Techniques for pH Testing',
                'duration' => '45 min',
                'type' => 'video',
                'thumbnail' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=300&h=200&fit=crop',
            ],
            [
                'id' => 2,
                'title' => 'Environmental Monitoring Techniques',
                'instructor' => 'Prof. Michael Chen',
                'progress' => 45,
                'nextLesson' => 'Sampling Methods',
                'duration' => '30 min',
                'type' => 'reading',
                'thumbnail' => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=300&h=200&fit=crop',
            ],
            [
                'id' => 3,
                'title' => 'Laboratory Safety Protocols',
                'instructor' => 'Dr. Lisa Wang',
                'progress' => 90,
                'nextLesson' => 'Final Assessment',
                'duration' => '20 min',
                'type' => 'quiz',
                'thumbnail' => 'https://images.unsplash.com/photo-1582719471384-894fbb16e074?w=300&h=200&fit=crop',
            ],
        ];

        $upcomingClasses = [
            [
                'id' => 1,
                'title' => 'Live Lab Session: Water Testing',
                'instructor' => 'Dr. Sarah Johnson',
                'time' => '14:00 - 16:00',
                'date' => 'Hari ini',
                'participants' => 24,
                'type' => 'lab',
            ],
            [
                'id' => 2,
                'title' => 'Q&A Session: Environmental Regulations',
                'instructor' => 'Prof. Michael Chen',
                'time' => '10:00 - 11:00',
                'date' => 'Besok',
                'participants' => 18,
                'type' => 'discussion',
            ],
        ];

        $recentAchievements = [
            [
                'id' => 1,
                'title' => 'Quick Learner',
                'description' => 'Completed 3 lessons in one day',
                'date' => '2 hari lalu',
                'type' => 'badge',
            ],
            [
                'id' => 2,
                'title' => 'Lab Expert',
                'description' => 'Scored 95% on lab techniques quiz',
                'date' => '1 minggu lalu',
                'type' => 'certificate',
            ],
        ];

        return view('pages.user.dashboard', compact(
            'user',
            'userStats',
            'activeCourses',
            'upcomingClasses',
            'recentAchievements'
        ));
    }
}
