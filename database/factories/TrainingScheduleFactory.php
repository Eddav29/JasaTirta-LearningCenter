<?php

namespace Database\Factories;

use App\Models\Training;
use App\Models\TrainingSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TrainingSchedule>
 */
class TrainingScheduleFactory extends Factory
{
    protected $model = TrainingSchedule::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $methods = ['offline', 'online', 'hybrid'];
        $statuses = ['buka_pendaftaran', 'tutup_pendaftaran', 'berlangsung', 'penuh', 'selesai'];
        $locations = [
            'Jakarta Lab Center',
            'Surabaya Training Center',
            'Bandung Lab Center',
            'Yogyakarta Training Center',
            'Semarang Lab Facility',
            'Online Platform',
            'Zoom Meeting',
            'Google Meet',
        ];

        $startDate = fake()->dateTimeBetween('now', '+6 months');
        $endDate = (clone $startDate)->modify('+'.fake()->numberBetween(1, 5).' days');

        $startTime = fake()->time('H:i', '08:00');
        $endTime = fake()->time('H:i', '17:00');

        $totalSlots = fake()->numberBetween(10, 100);
        $registeredCount = fake()->numberBetween(0, $totalSlots);
        $availableSlots = $totalSlots - $registeredCount;

        return [
            'training_id' => Training::factory(),
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'location' => fake()->randomElement($locations),
            'method' => fake()->randomElement($methods),
            'total_slots' => $totalSlots,
            'available_slots' => $availableSlots,
            'registered_count' => $registeredCount,
            'month' => $startDate->format('Y-m'),
            'status' => fake()->randomElement($statuses),
        ];
    }

    /**
     * Indicate that the schedule is available for registration.
     */
    public function available(): static
    {
        return $this->state(function (array $attributes) {
            $totalSlots = $attributes['total_slots'] ?? 30;
            $registeredCount = fake()->numberBetween(0, $totalSlots - 1);

            return [
                'status' => 'buka_pendaftaran',
                'registered_count' => $registeredCount,
                'available_slots' => $totalSlots - $registeredCount,
            ];
        });
    }

    /**
     * Indicate that the schedule is full.
     */
    public function full(): static
    {
        return $this->state(function (array $attributes) {
            $totalSlots = $attributes['total_slots'] ?? 30;

            return [
                'status' => 'penuh',
                'registered_count' => $totalSlots,
                'available_slots' => 0,
            ];
        });
    }

    /**
     * Indicate that the schedule is ongoing.
     */
    public function ongoing(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'berlangsung',
                'start_date' => now()->subDays(1)->format('Y-m-d'),
                'end_date' => now()->addDays(2)->format('Y-m-d'),
            ];
        });
    }

    /**
     * Indicate that the schedule is completed.
     */
    public function completed(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'selesai',
                'start_date' => now()->subDays(10)->format('Y-m-d'),
                'end_date' => now()->subDays(7)->format('Y-m-d'),
            ];
        });
    }

    /**
     * Indicate that the registration is closed.
     */
    public function registrationClosed(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'tutup_pendaftaran',
                'start_date' => now()->addDays(1)->format('Y-m-d'),
                'end_date' => now()->addDays(3)->format('Y-m-d'),
            ];
        });
    }

    /**
     * Indicate that the schedule is upcoming.
     */
    public function upcoming(): static
    {
        return $this->state(function (array $attributes) {
            $startDate = fake()->dateTimeBetween('+1 day', '+3 months');
            $endDate = (clone $startDate)->modify('+'.fake()->numberBetween(1, 3).' days');

            return [
                'start_date' => $startDate->format('Y-m-d'),
                'end_date' => $endDate->format('Y-m-d'),
                'month' => $startDate->format('Y-m'),
                'status' => fake()->randomElement(['buka_pendaftaran', 'berlangsung']),
            ];
        });
    }

    /**
     * Indicate that the schedule is for online method.
     */
    public function online(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'method' => 'online',
                'location' => 'Online Platform - Zoom Meeting',
            ];
        });
    }

    /**
     * Indicate that the schedule is for offline method.
     */
    public function offline(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'method' => 'offline',
                'location' => fake()->randomElement([
                    'Jakarta Training Center - Room A',
                    'Bandung Training Center - Room B',
                    'Surabaya Training Center - Main Hall',
                ]),
            ];
        });
    }

    /**
     * Indicate that the schedule is for hybrid method.
     */
    public function hybrid(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'method' => 'hybrid',
                'location' => 'Hybrid Learning Center + Online Platform',
            ];
        });
    }
}
