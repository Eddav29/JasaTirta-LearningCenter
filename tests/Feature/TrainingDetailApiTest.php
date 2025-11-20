<?php

namespace Tests\Feature;

use App\Models\Training;
use App\Models\TrainingCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrainingDetailApiTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private Training $training;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $category = TrainingCategory::factory()->create();
        $this->training = Training::factory()->create([
            'category_id' => $category->id,
        ]);
    }

    public function test_can_create_learning_objective(): void
    {
        $response = $this->actingAs($this->user)
            ->postJson('/api/trainings/learning-objectives', [
                'training_id' => $this->training->id,
                'objective' => 'Test learning objective',
            ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'id',
                    'training_id',
                    'objective',
                    'order_index',
                ],
            ]);

        $this->assertDatabaseHas('training_learning_objectives', [
            'training_id' => $this->training->id,
            'objective' => 'Test learning objective',
        ]);
    }

    public function test_can_get_learning_objectives(): void
    {
        // Create some learning objectives
        $createResponse = $this->actingAs($this->user)
            ->postJson('/api/trainings/learning-objectives', [
                'training_id' => $this->training->id,
                'objectives' => [
                    ['objective' => 'First objective'],
                    ['objective' => 'Second objective'],
                ],
            ]);

        // Debug response
        $createResponse->assertStatus(201);

        $response = $this->actingAs($this->user)
            ->getJson("/api/trainings/{$this->training->id}/learning-objectives");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    '*' => [
                        'id',
                        'training_id',
                        'objective',
                        'order_index',
                    ],
                ],
            ]);

        $this->assertCount(2, $response->json('data'));
    }

    public function test_can_create_prerequisite(): void
    {
        $response = $this->actingAs($this->user)
            ->postJson('/api/trainings/prerequisites', [
                'training_id' => $this->training->id,
                'prerequisite' => 'Test prerequisite',
            ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'id',
                    'training_id',
                    'prerequisite',
                    'order_index',
                ],
            ]);

        $this->assertDatabaseHas('training_prerequisites', [
            'training_id' => $this->training->id,
            'prerequisite' => 'Test prerequisite',
        ]);
    }

    public function test_can_create_material(): void
    {
        $response = $this->actingAs($this->user)
            ->postJson('/api/trainings/materials', [
                'training_id' => $this->training->id,
                'material' => 'Test material',
            ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('training_materials', [
            'training_id' => $this->training->id,
            'material' => 'Test material',
        ]);
    }

    public function test_can_create_syllabus(): void
    {
        $response = $this->actingAs($this->user)
            ->postJson('/api/trainings/syllabus', [
                'training_id' => $this->training->id,
                'day' => 'Day 1',
                'title' => 'Test syllabus',
            ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('training_syllabus', [
            'training_id' => $this->training->id,
            'day' => 'Day 1',
            'title' => 'Test syllabus',
        ]);
    }

    public function test_can_get_training_details(): void
    {
        // Create some data first
        $this->actingAs($this->user)
            ->postJson('/api/trainings/learning-objectives', [
                'training_id' => $this->training->id,
                'objective' => 'Test objective',
            ]);

        $this->actingAs($this->user)
            ->postJson('/api/trainings/prerequisites', [
                'training_id' => $this->training->id,
                'prerequisite' => 'Test prerequisite',
            ]);

        $response = $this->actingAs($this->user)
            ->getJson("/api/trainings/{$this->training->id}/details");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'learning_objectives',
                    'prerequisites',
                    'materials',
                    'syllabus',
                ],
            ]);
    }

    public function test_requires_authentication(): void
    {
        $response = $this->getJson("/api/trainings/{$this->training->id}/learning-objectives");
        $response->assertStatus(401);
    }
}
