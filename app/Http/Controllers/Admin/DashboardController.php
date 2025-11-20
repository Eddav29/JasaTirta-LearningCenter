<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\TrainingSchedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard with statistics and data.
     */
    public function index(): View
    {
        // Get current month start and end
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        // Statistics
        $stats = [
            'total_users' => [
                'current' => User::count(),
                'previous' => User::where('created_at', '<', $currentMonthStart)->count(),
            ],
            'active_trainings' => [
                'current' => Training::where('is_active', true)->count(),
                'previous' => Training::where('is_active', true)
                    ->where('created_at', '<', $currentMonthStart)->count(),
            ],
            'monthly_schedules' => [
                'current' => TrainingSchedule::whereBetween('start_date', [$currentMonthStart, $currentMonthEnd])->count(),
                'previous' => TrainingSchedule::whereBetween('start_date', [$lastMonthStart, $lastMonthEnd])->count(),
            ],
            'total_revenue' => [
                'current' => $this->calculateMonthlyRevenue($currentMonthStart, $currentMonthEnd),
                'previous' => $this->calculateMonthlyRevenue($lastMonthStart, $lastMonthEnd),
            ],
        ];

        // Calculate percentage changes
        foreach ($stats as $key => $stat) {
            $change = $stat['current'] - $stat['previous'];
            $percentage = $stat['previous'] > 0
                ? round(($change / $stat['previous']) * 100, 1)
                : ($stat['current'] > 0 ? 100 : 0);

            $stats[$key]['change'] = $change;
            $stats[$key]['percentage'] = $percentage;
            $stats[$key]['change_type'] = $change >= 0 ? 'increase' : 'decrease';
        }

        // Upcoming schedules (next 7 days)
        $upcomingSchedules = TrainingSchedule::with(['training.instructor'])
            ->where('start_date', '>=', Carbon::now())
            ->where('start_date', '<=', Carbon::now()->addDays(7))
            ->orderBy('start_date', 'asc')
            ->limit(5)
            ->get();

        // Popular trainings (most registered)
        $popularTrainings = Training::with(['category', 'schedules'])
            ->where('is_active', true)
            ->withCount(['schedules as total_registered' => function ($query) {
                $query->selectRaw('SUM(registered_count)');
            }])
            ->orderBy('total_registered', 'desc')
            ->limit(5)
            ->get();

        // Recent activities (latest schedules created/updated)
        $recentActivities = TrainingSchedule::with(['training'])
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();

        return view('pages.admin.dashboard.index', compact(
            'stats',
            'upcomingSchedules',
            'popularTrainings',
            'recentActivities'
        ));
    }

    /**
     * Calculate total revenue for a given month.
     */
    private function calculateMonthlyRevenue(Carbon $startDate, Carbon $endDate): int
    {
        return TrainingSchedule::with('training')
            ->whereBetween('start_date', [$startDate, $endDate])
            ->get()
            ->sum(function ($schedule) {
                return $schedule->registered_count * ($schedule->training->price ?? 0);
            });
    }
}
