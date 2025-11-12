<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\TrainingSchedule;
use App\Models\User;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function index()
    {
        // Summary Statistics
        $summaryStats = $this->getSummaryStatistics();

        // User Statistics
        $userStats = $this->getUserStatistics();

        // Training Statistics
        $trainingStats = $this->getTrainingStatistics();

        // Revenue Statistics (placeholder - adjust based on your payment system)
        $revenueStats = $this->getRevenueStatistics();

        // Certificate Statistics (placeholder - adjust based on your certificate system)
        $certificateStats = $this->getCertificateStatistics();

        return view('pages.admin.reports.index', compact(
            'summaryStats',
            'userStats',
            'trainingStats',
            'revenueStats',
            'certificateStats'
        ));
    }

    private function getSummaryStatistics(): array
    {
        $currentMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();

        // Total Users
        $totalUsers = User::count();
        $usersLastMonth = User::where('created_at', '<', $currentMonth)->count();
        $usersGrowth = $usersLastMonth > 0 ? (($totalUsers - $usersLastMonth) / $usersLastMonth * 100) : 0;

        // Active Trainings
        $activeTrainings = Training::where('is_active', true)->count();
        $activeTrainingsLastMonth = Training::where('is_active', true)
            ->where('created_at', '<', $currentMonth)
            ->count();
        $trainingsChange = $activeTrainings - $activeTrainingsLastMonth;

        // Total Revenue (placeholder)
        $totalRevenue = 0; // Implement based on your payment system

        // Certificates Issued (placeholder)
        $totalCertificates = 0; // Implement based on your certificate system

        return [
            [
                'title' => 'Total Pengguna',
                'value' => number_format($totalUsers),
                'change' => ($usersGrowth > 0 ? '+' : '').number_format($usersGrowth, 1).'%',
                'trend' => $usersGrowth >= 0 ? 'up' : 'down',
                'icon' => 'users',
                'color' => 'text-blue-600',
                'bgColor' => 'bg-blue-50',
            ],
            [
                'title' => 'Pelatihan Aktif',
                'value' => $activeTrainings,
                'change' => ($trainingsChange > 0 ? '+' : '').$trainingsChange.' program',
                'trend' => $trainingsChange >= 0 ? 'up' : 'down',
                'icon' => 'book-open',
                'color' => 'text-green-600',
                'bgColor' => 'bg-green-50',
            ],
            [
                'title' => 'Total Jadwal',
                'value' => TrainingSchedule::count(),
                'change' => '+0%',
                'trend' => 'up',
                'icon' => 'calendar',
                'color' => 'text-purple-600',
                'bgColor' => 'bg-purple-50',
            ],
            [
                'title' => 'Sertifikat Diterbitkan',
                'value' => $totalCertificates,
                'change' => '+0%',
                'trend' => 'up',
                'icon' => 'award',
                'color' => 'text-orange-600',
                'bgColor' => 'bg-orange-50',
            ],
        ];
    }

    private function getUserStatistics(): array
    {
        $currentMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        $newUsersThisMonth = User::where('created_at', '>=', $currentMonth)->count();
        $newUsersLastMonth = User::whereBetween('created_at', [$lastMonth, $lastMonthEnd])->count();
        $newUsersGrowth = $newUsersLastMonth > 0 ? (($newUsersThisMonth - $newUsersLastMonth) / $newUsersLastMonth * 100) : 0;

        // Active users (logged in this month)
        $activeUsersThisMonth = User::where('updated_at', '>=', $currentMonth)->count();
        $activeUsersLastMonth = User::whereBetween('updated_at', [$lastMonth, $lastMonthEnd])->count();
        $activeUsersGrowth = $activeUsersLastMonth > 0 ? (($activeUsersThisMonth - $activeUsersLastMonth) / $activeUsersLastMonth * 100) : 0;

        $totalUsersNow = User::count();
        $totalUsersLastMonth = User::where('created_at', '<', $currentMonth)->count();
        $totalUsersGrowth = $totalUsersLastMonth > 0 ? (($totalUsersNow - $totalUsersLastMonth) / $totalUsersLastMonth * 100) : 0;

        return [
            [
                'category' => 'Pengguna Baru',
                'thisMonth' => $newUsersThisMonth,
                'lastMonth' => $newUsersLastMonth,
                'growth' => ($newUsersGrowth > 0 ? '+' : '').number_format($newUsersGrowth, 1).'%',
            ],
            [
                'category' => 'Pengguna Aktif',
                'thisMonth' => $activeUsersThisMonth,
                'lastMonth' => $activeUsersLastMonth,
                'growth' => ($activeUsersGrowth > 0 ? '+' : '').number_format($activeUsersGrowth, 1).'%',
            ],
            [
                'category' => 'Total Pengguna Terdaftar',
                'thisMonth' => $totalUsersNow,
                'lastMonth' => $totalUsersLastMonth,
                'growth' => ($totalUsersGrowth > 0 ? '+' : '').number_format($totalUsersGrowth, 1).'%',
            ],
        ];
    }

    private function getTrainingStatistics(): array
    {
        return Training::with('schedules')
            ->where('is_active', true)
            ->get()
            ->map(function ($training) {
                $schedules = $training->schedules;
                $participantsCount = $schedules->sum('quota') - $schedules->sum('available_seats');

                return [
                    'name' => $training->title,
                    'participants' => $participantsCount,
                    'schedules' => $schedules->count(),
                    'status' => $training->is_active ? 'Aktif' : 'Tidak Aktif',
                    'category' => $training->category->name ?? '-',
                ];
            })
            ->sortByDesc('participants')
            ->take(10)
            ->values()
            ->toArray();
    }

    private function getRevenueStatistics(): array
    {
        // Placeholder - implement based on your payment/enrollment system
        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'];
        $stats = [];

        foreach ($months as $index => $month) {
            $stats[] = [
                'month' => $month,
                'revenue' => 0, // Implement based on your system
                'target' => 20000000,
                'achievement' => 0,
            ];
        }

        return $stats;
    }

    private function getCertificateStatistics(): array
    {
        // Placeholder - implement based on your certificate system
        return Training::with('schedules')
            ->where('is_active', true)
            ->get()
            ->map(function ($training) {
                $totalParticipants = $training->schedules->sum('quota') - $training->schedules->sum('available_seats');

                return [
                    'training' => $training->title,
                    'issued' => 0, // Implement based on certificate system
                    'pending' => 0, // Implement based on certificate system
                    'total' => $totalParticipants,
                ];
            })
            ->take(10)
            ->values()
            ->toArray();
    }
}
