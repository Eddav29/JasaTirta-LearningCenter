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

        // Buat jadwal spesifik untuk training populer
        $laravelTraining = Training::where('title', 'Laravel Advanced Development')->first();
        if ($laravelTraining) {
            $this->createSchedulesForTraining($laravelTraining, 'hybrid');
        }

        $flutterTraining = Training::where('title', 'Flutter Mobile App Development')->first();
        if ($flutterTraining) {
            $this->createSchedulesForTraining($flutterTraining, 'online');
        }

        $datascienceTraining = Training::where('title', 'Data Science with Python')->first();
        if ($datascienceTraining) {
            $this->createSchedulesForTraining($datascienceTraining, 'hybrid');
        }

        $awsTraining = Training::where('title', 'AWS Cloud Practitioner')->first();
        if ($awsTraining) {
            $this->createSchedulesForTraining($awsTraining, 'online');
        }

        $cyberTraining = Training::where('title', 'Cybersecurity Fundamentals')->first();
        if ($cyberTraining) {
            $this->createSchedulesForTraining($cyberTraining, 'offline');
        }

        // Buat jadwal untuk training lainnya
        foreach ($trainings as $training) {
            if (! $training->schedules()->exists()) {
                $method = $training->training_type ?? 'hybrid';
                $this->createSchedulesForTraining($training, $method, 2);
            }
        }
    }

    /**
     * Create multiple schedules for a training.
     */
    private function createSchedulesForTraining(Training $training, string $method = 'hybrid', int $count = 3): void
    {
        $locations = [
            'offline' => ['Jakarta Training Center', 'Bandung Training Center', 'Surabaya Training Center'],
            'online' => ['Zoom Meeting Platform', 'Google Meet Platform', 'Microsoft Teams Platform'],
            'hybrid' => ['Jakarta Hybrid Center', 'Bandung Hybrid Center', 'Online Platform'],
        ];

        $location = $locations[$method] ?? $locations['hybrid'];

        // Jadwal bulan ini (sedang berlangsung atau buka pendaftaran)
        $startDate1 = Carbon::now()->addDays(5);
        $endDate1 = (clone $startDate1)->addDays(4);

        TrainingSchedule::create([
            'training_id' => $training->id,
            'start_date' => $startDate1->format('Y-m-d'),
            'end_date' => $endDate1->format('Y-m-d'),
            'start_time' => '09:00',
            'end_time' => '17:00',
            'location' => $location[array_rand($location)],
            'method' => $method,
            'total_slots' => $training->capacity ?? 30,
            'available_slots' => rand(5, 20),
            'registered_count' => rand(10, 25),
            'month' => $startDate1->format('Y-m'),
            'status' => 'buka_pendaftaran',
        ]);

        // Jadwal bulan depan (buka pendaftaran)
        $startDate2 = Carbon::now()->addMonth()->startOfMonth()->addDays(10);
        $endDate2 = (clone $startDate2)->addDays(4);

        TrainingSchedule::create([
            'training_id' => $training->id,
            'start_date' => $startDate2->format('Y-m-d'),
            'end_date' => $endDate2->format('Y-m-d'),
            'start_time' => '09:00',
            'end_time' => '17:00',
            'location' => $location[array_rand($location)],
            'method' => $method,
            'total_slots' => $training->capacity ?? 30,
            'available_slots' => rand(20, 30),
            'registered_count' => rand(0, 10),
            'month' => $startDate2->format('Y-m'),
            'status' => 'buka_pendaftaran',
        ]);

        // Jadwal 2 bulan ke depan (buka pendaftaran)
        if ($count >= 3) {
            $startDate3 = Carbon::now()->addMonths(2)->startOfMonth()->addDays(15);
            $endDate3 = (clone $startDate3)->addDays(4);

            TrainingSchedule::create([
                'training_id' => $training->id,
                'start_date' => $startDate3->format('Y-m-d'),
                'end_date' => $endDate3->format('Y-m-d'),
                'start_time' => '09:00',
                'end_time' => '17:00',
                'location' => $location[array_rand($location)],
                'method' => $method,
                'total_slots' => $training->capacity ?? 30,
                'available_slots' => $training->capacity ?? 30,
                'registered_count' => 0,
                'month' => $startDate3->format('Y-m'),
                'status' => 'buka_pendaftaran',
            ]);
        }

        // Jadwal yang sudah selesai (untuk history)
        $startDatePast = Carbon::now()->subMonths(1)->startOfMonth()->addDays(5);
        $endDatePast = (clone $startDatePast)->addDays(4);

        TrainingSchedule::create([
            'training_id' => $training->id,
            'start_date' => $startDatePast->format('Y-m-d'),
            'end_date' => $endDatePast->format('Y-m-d'),
            'start_time' => '09:00',
            'end_time' => '17:00',
            'location' => $location[array_rand($location)],
            'method' => $method,
            'total_slots' => $training->capacity ?? 30,
            'available_slots' => 0,
            'registered_count' => $training->capacity ?? 30,
            'month' => $startDatePast->format('Y-m'),
            'status' => 'selesai',
        ]);
    }
}
