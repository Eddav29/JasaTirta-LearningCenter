<?php

namespace Tests\Feature;

use App\Models\Instructor;
use App\Models\Training;
use App\Models\TrainingCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class TrainingUpdateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'super-admin']);
        Role::create(['name' => 'user']);
        Role::create(['name' => 'instructor']);
    }

    public function test_admin_can_update_training(): void
    {
        // Create admin user
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        // Create dependencies
        $category = TrainingCategory::factory()->create();
        $instructor = Instructor::factory()->create();

        // Create training
        $training = Training::factory()->create([
            'title' => 'Old Title',
            'category_id' => $category->id,
            'instructor_id' => $instructor->id,
        ]);

        // Update data
        $updateData = [
            'title' => 'Updated Title',
            'category_id' => $category->id,
            'instructor_id' => $instructor->id,
            'description' => 'Updated description',
            'long_description' => 'Updated long description',
            'duration' => 10,
            'price' => 200000,
            'capacity' => 25,
            'training_type' => 'Intermediate',
            'learning_hours' => 8,
            'training_methods' => 'Online',
            'certification_note' => 'Certificate provided',
            'is_active' => true,
        ];

        // Send update request
        $response = $this->actingAs($admin)->put(
            route('admin.trainings.update', $training),
            $updateData
        );

        // Assert redirect
        $response->assertRedirect(route('admin.trainings.index'));
        $response->assertSessionHas('success', 'Pelatihan berhasil diperbarui');

        // Assert database
        $this->assertDatabaseHas('trainings', [
            'id' => $training->id,
            'title' => 'Updated Title',
            'training_type' => 'Intermediate',
            'price' => 200000,
        ]);
    }
}
