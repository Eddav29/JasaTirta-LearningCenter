<?php

namespace Database\Seeders;

use App\Models\Training;
use App\Models\TrainingSchedule;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TrainingScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trainings = Training::all();

        if ($trainings->isEmpty()) {
            $this->command->error('Pastikan training sudah di-seed terlebih dahulu!');

            return;
        }

        // Data spesifik berdasarkan training
        $scheduleData = [
            // Training 1: Spektrofotometri UV-Vis - Nov 20-22, 2024
            [
                'start_date' => '2024-11-20',
                'duration_days' => 3,
                'method' => 'offline',
                'location' => 'Jakarta Lab Center',
                'total_slots' => 20,
                'registered_count' => 14,
            ],
            // Training 2: Sampling Udara Ambien - Nov 25-26, 2024
            [
                'start_date' => '2024-11-25',
                'duration_days' => 2,
                'method' => 'offline',
                'location' => 'Bandung Training Center',
                'total_slots' => 16,
                'registered_count' => 8,
            ],
            // Training 3: Sampling Air Sungai - Nov 15-17, 2024
            [
                'start_date' => '2024-11-15',
                'duration_days' => 3,
                'method' => 'offline',
                'location' => 'Surabaya Field Center',
                'total_slots' => 20,
                'registered_count' => 8,
            ],
            // Training 4: Analisis Kualitas Air - Nov 20-24, 2024
            [
                'start_date' => '2024-11-20',
                'duration_days' => 5,
                'method' => 'offline',
                'location' => 'Jakarta Lab Center',
                'total_slots' => 15,
                'registered_count' => 10,
            ],
            // Training 5: Manajemen K3L - Nov 25-26, 2024
            [
                'start_date' => '2024-11-25',
                'duration_days' => 2,
                'method' => 'hybrid',
                'location' => 'Jakarta Hybrid Center',
                'total_slots' => 25,
                'registered_count' => 7,
            ],
            // Training 6: Sampling Air Tanah - Nov 28-30, 2024
            [
                'start_date' => '2024-11-28',
                'duration_days' => 3,
                'method' => 'offline',
                'location' => 'Yogyakarta Field Center',
                'total_slots' => 18,
                'registered_count' => 8,
            ],
            // Training 7: Interpretasi Data - Dec 2-3, 2024
            [
                'start_date' => '2024-12-02',
                'duration_days' => 2,
                'method' => 'online',
                'location' => 'Zoom Meeting Platform',
                'total_slots' => 30,
                'registered_count' => 8,
            ],
            // Training 8: Mikrobiologi Air - Dec 5-8, 2024
            [
                'start_date' => '2024-12-05',
                'duration_days' => 4,
                'method' => 'offline',
                'location' => 'Jakarta Lab Center',
                'total_slots' => 12,
                'registered_count' => 8,
            ],
            // Training 9: Audit Sistem Manajemen - Dec 10-12, 2024
            [
                'start_date' => '2024-12-10',
                'duration_days' => 3,
                'method' => 'hybrid',
                'location' => 'Bandung Hybrid Center',
                'total_slots' => 20,
                'registered_count' => 6,
            ],
            // Training 10: Kalibrasi Alat - Dec 15-16, 2024
            [
                'start_date' => '2024-12-15',
                'duration_days' => 2,
                'method' => 'offline',
                'location' => 'Jakarta Lab Center',
                'total_slots' => 16,
                'registered_count' => 7,
            ],
            // Training 11: Pengelolaan Limbah - Dec 18-19, 2024
            [
                'start_date' => '2024-12-18',
                'duration_days' => 2,
                'method' => 'offline',
                'location' => 'Surabaya Training Center',
                'total_slots' => 22,
                'registered_count' => 6,
            ],
        ];

        foreach ($trainings as $index => $training) {
            $data = $scheduleData[$index] ?? null;

            if ($data) {
                $startDate = Carbon::parse($data['start_date']);
                $endDate = $startDate->copy()->addDays($data['duration_days'] - 1);

                TrainingSchedule::create([
                    'training_id' => $training->id,
                    'start_date' => $startDate->format('Y-m-d'),
                    'end_date' => $endDate->format('Y-m-d'),
                    'start_time' => '09:00',
                    'end_time' => '17:00',
                    'location' => $data['location'],
                    'method' => $data['method'],
                    'total_slots' => $data['total_slots'],
                    'available_slots' => $data['total_slots'] - $data['registered_count'],
                    'registered_count' => $data['registered_count'],
                    'month' => $startDate->format('Y-m'),
                    'status' => 'buka_pendaftaran',
                ]);
            }
        }

        $this->command->info('Training schedules created successfully!');
    }
}
