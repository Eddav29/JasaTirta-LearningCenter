<?php

namespace Tests\Feature;

use App\Models\Instructor;
use App\Models\Training;
use App\Models\TrainingCategory;
use App\Models\TrainingSchedule;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TrainingScheduleTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private TrainingCategory $category;

    private Instructor $instructor;

    private Training $training;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->category = TrainingCategory::factory()->create();
        $this->instructor = Instructor::factory()->create();
        $this->training = Training::factory()->create([
            'category_id' => $this->category->id,
            'instructor_id' => $this->instructor->id,
        ]);

        Sanctum::actingAs($this->user);
    }

    public function test_can_list_training_schedules(): void
    {
        TrainingSchedule::factory()
            ->count(3)
            ->create([
                'training_id' => $this->training->id,
            ]);

        $response = $this->getJson('/api/training-schedules');

        $response->assertOk()
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    '*' => [
                        'id',
                        'training_id',
                        'training',
                        'start_date',
                        'end_date',
                        'start_time',
                        'end_time',
                        'location',
                        'method',
                        'total_slots',
                        'available_slots',
                        'registered_count',
                        'month',
                        'status',
                        'is_full',
                        'can_register',
                        'formatted_date_range',
                        'formatted_time_range',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ])
            ->assertJsonPath('status', 'success');
    }

    public function test_can_create_training_schedule(): void
    {
        $scheduleData = [
            'training_id' => $this->training->id,
            'start_date' => '2025-12-01',
            'end_date' => '2025-12-03',
            'start_time' => '09:00',
            'end_time' => '17:00',
            'location' => 'Jakarta Training Center',
            'method' => 'offline',
            'total_slots' => 30,
        ];

        $response = $this->postJson('/api/training-schedules', $scheduleData);

        $response->assertCreated()
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'id',
                    'training_id',
                    'training',
                    'start_date',
                    'end_date',
                    'start_time',
                    'end_time',
                    'location',
                    'method',
                    'total_slots',
                    'available_slots',
                    'registered_count',
                    'month',
                    'status',
                ],
            ])
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('data.training_id', $this->training->id)
            ->assertJsonPath('data.location', 'Jakarta Training Center')
            ->assertJsonPath('data.total_slots', 30)
            ->assertJsonPath('data.available_slots', 30)
            ->assertJsonPath('data.registered_count', 0)
            ->assertJsonPath('data.status', 'buka_pendaftaran')
            ->assertJsonPath('data.month', '2025-12');

        $this->assertDatabaseHas('training_schedules', [
            'training_id' => $this->training->id,
            'location' => 'Jakarta Training Center',
            'total_slots' => 30,
            'available_slots' => 30,
            'registered_count' => 0,
            'status' => 'buka_pendaftaran',
        ]);
    }

    public function test_can_show_training_schedule(): void
    {
        $schedule = TrainingSchedule::factory()->create([
            'training_id' => $this->training->id,
        ]);

        $response = $this->getJson("/api/training-schedules/{$schedule->id}");

        $response->assertOk()
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'id',
                    'training_id',
                    'training',
                    'start_date',
                    'end_date',
                    'location',
                    'method',
                    'total_slots',
                    'available_slots',
                    'status',
                ],
            ])
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('data.id', $schedule->id);
    }

    public function test_can_update_training_schedule(): void
    {
        $schedule = TrainingSchedule::factory()->create([
            'training_id' => $this->training->id,
            'location' => 'Old Location',
            'total_slots' => 20,
        ]);

        $updateData = [
            'location' => 'New Jakarta Training Center',
            'total_slots' => 50,
            'method' => 'hybrid',
        ];

        $response = $this->putJson("/api/training-schedules/{$schedule->id}", $updateData);

        $response->assertOk()
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('data.location', 'New Jakarta Training Center')
            ->assertJsonPath('data.total_slots', 50)
            ->assertJsonPath('data.method', 'hybrid');

        $this->assertDatabaseHas('training_schedules', [
            'id' => $schedule->id,
            'location' => 'New Jakarta Training Center',
            'total_slots' => 50,
            'method' => 'hybrid',
        ]);
    }

    public function test_can_delete_training_schedule(): void
    {
        $schedule = TrainingSchedule::factory()->create([
            'training_id' => $this->training->id,
            'registered_count' => 0,
        ]);

        $response = $this->deleteJson("/api/training-schedules/{$schedule->id}");

        $response->assertOk()
            ->assertJsonPath('status', 'success');

        $this->assertDatabaseMissing('training_schedules', [
            'id' => $schedule->id,
        ]);
    }

    public function test_cannot_delete_schedule_with_registrations(): void
    {
        $schedule = TrainingSchedule::factory()->create([
            'training_id' => $this->training->id,
            'registered_count' => 5,
        ]);

        $response = $this->deleteJson("/api/training-schedules/{$schedule->id}");

        $response->assertStatus(400)
            ->assertJsonPath('status', 'error');

        $this->assertDatabaseHas('training_schedules', [
            'id' => $schedule->id,
        ]);
    }

    public function test_returns_404_for_non_existent_schedule(): void
    {
        $response = $this->getJson('/api/training-schedules/999');

        $response->assertNotFound()
            ->assertJsonPath('status', 'error')
            ->assertJsonPath('message', 'Training schedule not found');
    }

    public function test_can_filter_schedules_by_training(): void
    {
        $otherTraining = Training::factory()->create([
            'category_id' => $this->category->id,
            'instructor_id' => $this->instructor->id,
        ]);

        TrainingSchedule::factory()->count(2)->create([
            'training_id' => $this->training->id,
        ]);

        TrainingSchedule::factory()->create([
            'training_id' => $otherTraining->id,
        ]);

        $response = $this->getJson("/api/training-schedules?training_id={$this->training->id}");

        $response->assertOk()
            ->assertJsonCount(2, 'data')
            ->assertJsonPath('data.0.training_id', $this->training->id)
            ->assertJsonPath('data.1.training_id', $this->training->id);
    }

    public function test_can_filter_schedules_by_status(): void
    {
        TrainingSchedule::factory()->create([
            'training_id' => $this->training->id,
            'status' => 'buka_pendaftaran',
        ]);

        TrainingSchedule::factory()->create([
            'training_id' => $this->training->id,
            'status' => 'penuh',
        ]);

        TrainingSchedule::factory()->create([
            'training_id' => $this->training->id,
            'status' => 'berlangsung',
        ]);

        $response = $this->getJson('/api/training-schedules?status=buka_pendaftaran');

        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.status', 'buka_pendaftaran');
    }

    public function test_can_filter_schedules_by_method(): void
    {
        TrainingSchedule::factory()->create([
            'training_id' => $this->training->id,
            'method' => 'online',
        ]);

        TrainingSchedule::factory()->create([
            'training_id' => $this->training->id,
            'method' => 'offline',
        ]);

        $response = $this->getJson('/api/training-schedules?method=online');

        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.method', 'online');
    }

    public function test_can_get_available_schedules(): void
    {
        TrainingSchedule::factory()->create([
            'training_id' => $this->training->id,
            'status' => 'buka_pendaftaran',
            'available_slots' => 10,
        ]);

        TrainingSchedule::factory()->create([
            'training_id' => $this->training->id,
            'status' => 'penuh',
            'available_slots' => 0,
        ]);

        $response = $this->getJson('/api/training-schedules/available');

        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.status', 'buka_pendaftaran');
    }

    public function test_can_get_upcoming_schedules(): void
    {
        TrainingSchedule::factory()->create([
            'training_id' => $this->training->id,
            'start_date' => now()->addDays(5)->toDateString(),
            'status' => 'buka_pendaftaran',
        ]);

        TrainingSchedule::factory()->create([
            'training_id' => $this->training->id,
            'start_date' => now()->subDays(5)->toDateString(),
            'status' => 'selesai',
        ]);

        $response = $this->getJson('/api/training-schedules/upcoming');

        $response->assertOk()
            ->assertJsonCount(1, 'data');
    }

    public function test_can_get_schedules_by_month(): void
    {
        TrainingSchedule::factory()->create([
            'training_id' => $this->training->id,
            'start_date' => '2025-12-15',
            'month' => '2025-12',
        ]);

        TrainingSchedule::factory()->create([
            'training_id' => $this->training->id,
            'start_date' => '2025-11-15',
            'month' => '2025-11',
        ]);

        $response = $this->getJson('/api/training-schedules/by-month?month=2025-12');

        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.month', '2025-12');
    }

    public function test_can_change_schedule_status(): void
    {
        $schedule = TrainingSchedule::factory()->create([
            'training_id' => $this->training->id,
            'status' => 'buka_pendaftaran',
        ]);

        $response = $this->patchJson("/api/training-schedules/{$schedule->id}/status", [
            'status' => 'berlangsung',
        ]);

        $response->assertOk()
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('data.status', 'berlangsung');

        $this->assertDatabaseHas('training_schedules', [
            'id' => $schedule->id,
            'status' => 'berlangsung',
        ]);
    }

    public function test_can_duplicate_schedule(): void
    {
        $originalSchedule = TrainingSchedule::factory()->create([
            'training_id' => $this->training->id,
            'location' => 'Original Location',
            'total_slots' => 25,
            'start_date' => '2025-11-01',
            'end_date' => '2025-11-03',
        ]);

        $overrides = [
            'start_date' => '2025-12-01',
            'end_date' => '2025-12-03',
            'location' => 'New Location',
        ];

        $response = $this->postJson("/api/training-schedules/{$originalSchedule->id}/duplicate", $overrides);

        $response->assertCreated()
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('data.training_id', $this->training->id)
            ->assertJsonPath('data.location', 'New Location')
            ->assertJsonPath('data.total_slots', 25)
            ->assertJsonPath('data.start_date', '2025-12-01')
            ->assertJsonPath('data.end_date', '2025-12-03')
            ->assertJsonPath('data.registered_count', 0)
            ->assertJsonPath('data.status', 'buka_pendaftaran');

        $this->assertDatabaseCount('training_schedules', 2);
    }

    public function test_can_get_schedule_statistics(): void
    {
        TrainingSchedule::factory()->create([
            'training_id' => $this->training->id,
            'status' => 'buka_pendaftaran',
            'total_slots' => 30,
            'registered_count' => 15,
            'available_slots' => 15,
        ]);

        TrainingSchedule::factory()->create([
            'training_id' => $this->training->id,
            'status' => 'penuh',
            'total_slots' => 20,
            'registered_count' => 20,
            'available_slots' => 0,
        ]);

        $response = $this->getJson('/api/training-schedules/statistics');

        $response->assertOk()
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'total_schedules',
                    'available_schedules',
                    'full_schedules',
                    'ongoing_schedules',
                    'completed_schedules',
                    'total_slots',
                    'total_registered',
                    'total_available_slots',
                    'utilization_rate',
                ],
            ])
            ->assertJsonPath('data.total_schedules', 2)
            ->assertJsonPath('data.available_schedules', 1)
            ->assertJsonPath('data.full_schedules', 1)
            ->assertJsonPath('data.total_slots', 50)
            ->assertJsonPath('data.total_registered', 35)
            ->assertJsonPath('data.total_available_slots', 15);

        // Check utilization rate is approximately 70 (either 70 or 70.0)
        $utilizationRate = $response->json('data.utilization_rate');
        $this->assertEquals(70, $utilizationRate);
    }

    public function test_can_get_schedules_by_training(): void
    {
        $otherTraining = Training::factory()->create([
            'category_id' => $this->category->id,
            'instructor_id' => $this->instructor->id,
        ]);

        TrainingSchedule::factory()->count(2)->create([
            'training_id' => $this->training->id,
        ]);

        TrainingSchedule::factory()->create([
            'training_id' => $otherTraining->id,
        ]);

        $response = $this->getJson("/api/training-schedules/training/{$this->training->id}");

        $response->assertOk()
            ->assertJsonCount(2, 'data');

        foreach ($response->json('data') as $schedule) {
            $this->assertEquals($this->training->id, $schedule['training_id']);
        }
    }

    public function test_validates_required_fields_when_creating_schedule(): void
    {
        $response = $this->postJson('/api/training-schedules', []);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors([
                'training_id',
                'start_date',
                'end_date',
                'start_time',
                'end_time',
                'location',
                'method',
                'total_slots',
            ]);
    }

    public function test_validates_foreign_keys_when_creating_schedule(): void
    {
        $scheduleData = [
            'training_id' => 999, // Non-existent training
            'start_date' => '2025-12-01',
            'end_date' => '2025-12-03',
            'start_time' => '09:00',
            'end_time' => '17:00',
            'location' => 'Jakarta Training Center',
            'method' => 'offline',
            'total_slots' => 30,
        ];

        $response = $this->postJson('/api/training-schedules', $scheduleData);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['training_id']);
    }

    public function test_validates_date_ranges(): void
    {
        $scheduleData = [
            'training_id' => $this->training->id,
            'start_date' => '2025-12-05',
            'end_date' => '2025-12-01', // End date before start date
            'start_time' => '17:00',
            'end_time' => '09:00', // End time before start time
            'location' => 'Jakarta Training Center',
            'method' => 'offline',
            'total_slots' => 30,
        ];

        $response = $this->postJson('/api/training-schedules', $scheduleData);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['end_date', 'end_time']);
    }

    public function test_validates_enum_values(): void
    {
        $scheduleData = [
            'training_id' => $this->training->id,
            'start_date' => '2025-12-01',
            'end_date' => '2025-12-03',
            'start_time' => '09:00',
            'end_time' => '17:00',
            'location' => 'Jakarta Training Center',
            'method' => 'invalid_method',
            'total_slots' => 30,
            'status' => 'invalid_status',
        ];

        $response = $this->postJson('/api/training-schedules', $scheduleData);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['method', 'status']);
    }

    public function test_can_paginate_schedules(): void
    {
        TrainingSchedule::factory()->count(25)->create([
            'training_id' => $this->training->id,
        ]);

        $response = $this->getJson('/api/training-schedules?paginate=true&per_page=10');

        $response->assertOk()
            ->assertJsonStructure([
                'status',
                'message',
                'data',
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'per_page',
                    'to',
                    'total',
                ],
            ])
            ->assertJsonCount(10, 'data')
            ->assertJsonPath('meta.per_page', 10)
            ->assertJsonPath('meta.total', 25);
    }

    public function test_requires_authentication(): void
    {
        // Clear authentication
        $this->app['auth']->forgetGuards();

        $response = $this->getJson('/api/training-schedules');

        $response->assertUnauthorized();
    }
}
