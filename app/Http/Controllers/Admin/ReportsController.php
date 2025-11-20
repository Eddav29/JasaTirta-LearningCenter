<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\TrainingSchedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'bulan-ini');
        $dateRange = $this->getDateRange($period);

        // Summary Statistics
        $summaryStats = $this->getSummaryStatistics($dateRange);

        // User Statistics
        $userStats = $this->getUserStatistics($dateRange);

        // Training Statistics
        $trainingStats = $this->getTrainingStatistics($dateRange);

        // Revenue Statistics (placeholder - adjust based on your payment system)
        $revenueStats = $this->getRevenueStatistics($dateRange);

        // Certificate Statistics (placeholder - adjust based on your certificate system)
        $certificateStats = $this->getCertificateStatistics($dateRange);

        return view('pages.admin.reports.index', compact(
            'summaryStats',
            'userStats',
            'trainingStats',
            'revenueStats',
            'certificateStats'
        ));
    }

    private function getDateRange(string $period): array
    {
        $now = Carbon::now();

        return match ($period) {
            'hari-ini' => [
                'start' => $now->copy()->startOfDay(),
                'end' => $now->copy()->endOfDay(),
                'compare_start' => $now->copy()->subDay()->startOfDay(),
                'compare_end' => $now->copy()->subDay()->endOfDay(),
            ],
            'minggu-ini' => [
                'start' => $now->copy()->startOfWeek(),
                'end' => $now->copy()->endOfWeek(),
                'compare_start' => $now->copy()->subWeek()->startOfWeek(),
                'compare_end' => $now->copy()->subWeek()->endOfWeek(),
            ],
            '3-bulan' => [
                'start' => $now->copy()->subMonths(3)->startOfDay(),
                'end' => $now->copy()->endOfDay(),
                'compare_start' => $now->copy()->subMonths(6)->startOfDay(),
                'compare_end' => $now->copy()->subMonths(3)->endOfDay(),
            ],
            'tahun-ini' => [
                'start' => $now->copy()->startOfYear(),
                'end' => $now->copy()->endOfYear(),
                'compare_start' => $now->copy()->subYear()->startOfYear(),
                'compare_end' => $now->copy()->subYear()->endOfYear(),
            ],
            default => [ // bulan-ini
                'start' => $now->copy()->startOfMonth(),
                'end' => $now->copy()->endOfMonth(),
                'compare_start' => $now->copy()->subMonth()->startOfMonth(),
                'compare_end' => $now->copy()->subMonth()->endOfMonth(),
            ],
        };
    }

    private function getSummaryStatistics(array $dateRange): array
    {
        // Total Users
        $totalUsers = User::whereBetween('created_at', [$dateRange['start'], $dateRange['end']])->count();
        $usersLastPeriod = User::whereBetween('created_at', [$dateRange['compare_start'], $dateRange['compare_end']])->count();
        $usersGrowth = $usersLastPeriod > 0 ? (($totalUsers - $usersLastPeriod) / $usersLastPeriod * 100) : 0;

        // Active Trainings
        $activeTrainings = Training::where('is_active', true)->count();
        $activeTrainingsLastPeriod = Training::where('is_active', true)
            ->where('created_at', '<', $dateRange['start'])
            ->count();
        $trainingsChange = $activeTrainings - $activeTrainingsLastPeriod;

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

    private function getUserStatistics(array $dateRange): array
    {
        $newUsersThisPeriod = User::whereBetween('created_at', [$dateRange['start'], $dateRange['end']])->count();
        $newUsersLastPeriod = User::whereBetween('created_at', [$dateRange['compare_start'], $dateRange['compare_end']])->count();
        $newUsersGrowth = $newUsersLastPeriod > 0 ? (($newUsersThisPeriod - $newUsersLastPeriod) / $newUsersLastPeriod * 100) : 0;

        // Active users (logged in this period)
        $activeUsersThisPeriod = User::whereBetween('updated_at', [$dateRange['start'], $dateRange['end']])->count();
        $activeUsersLastPeriod = User::whereBetween('updated_at', [$dateRange['compare_start'], $dateRange['compare_end']])->count();
        $activeUsersGrowth = $activeUsersLastPeriod > 0 ? (($activeUsersThisPeriod - $activeUsersLastPeriod) / $activeUsersLastPeriod * 100) : 0;

        $totalUsersNow = User::count();
        $totalUsersLastPeriod = User::where('created_at', '<', $dateRange['start'])->count();
        $totalUsersGrowth = $totalUsersLastPeriod > 0 ? (($totalUsersNow - $totalUsersLastPeriod) / $totalUsersLastPeriod * 100) : 0;

        return [
            [
                'category' => 'Pengguna Baru',
                'thisMonth' => $newUsersThisPeriod,
                'lastMonth' => $newUsersLastPeriod,
                'growth' => ($newUsersGrowth > 0 ? '+' : '').number_format($newUsersGrowth, 1).'%',
            ],
            [
                'category' => 'Pengguna Aktif',
                'thisMonth' => $activeUsersThisPeriod,
                'lastMonth' => $activeUsersLastPeriod,
                'growth' => ($activeUsersGrowth > 0 ? '+' : '').number_format($activeUsersGrowth, 1).'%',
            ],
            [
                'category' => 'Total Pengguna Terdaftar',
                'thisMonth' => $totalUsersNow,
                'lastMonth' => $totalUsersLastPeriod,
                'growth' => ($totalUsersGrowth > 0 ? '+' : '').number_format($totalUsersGrowth, 1).'%',
            ],
        ];
    }

    private function getTrainingStatistics(array $dateRange): array
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

    private function getRevenueStatistics(array $dateRange): array
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

    private function getCertificateStatistics(array $dateRange): array
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
