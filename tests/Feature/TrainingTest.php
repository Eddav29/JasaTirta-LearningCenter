<?php

namespace Tests\Feature;

use App\Models\Instructor;
use App\Models\Training;
use App\Models\TrainingCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TrainingTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private TrainingCategory $category;

    private Instructor $instructor;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->category = TrainingCategory::factory()->create();
        $this->instructor = Instructor::factory()->create();

        Sanctum::actingAs($this->user);
    }

    public function test_can_list_trainings(): void
    {
        Training::factory()
            ->count(3)
            ->create([
                'category_id' => $this->category->id,
                'instructor_id' => $this->instructor->id,
            ]);

        $response = $this->getJson('/api/trainings');

        $response->assertOk()
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'description',
                        'category',
                        'instructor',
                        'duration',
                        'price',
                        'capacity',
                        'training_type',
                        'rating',
                        'review_count',
                        'is_active',
                        'created_at',
                        'updated_at',
                    ],
                ],
                'meta' => [
                    'current_page',
                    'per_page',
                    'total',
                    'last_page',
                ],
            ]);

        $this->assertEquals('success', $response->json('status'));
        $this->assertCount(3, $response->json('data'));
    }

    public function test_can_filter_trainings_by_category(): void
    {
        $otherCategory = TrainingCategory::factory()->create();

        Training::factory()
            ->count(2)
            ->create([
                'category_id' => $this->category->id,
                'instructor_id' => $this->instructor->id,
            ]);

        Training::factory()
            ->create([
                'category_id' => $otherCategory->id,
                'instructor_id' => $this->instructor->id,
            ]);

        $response = $this->getJson("/api/trainings?category_id={$this->category->id}");

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_can_filter_trainings_by_instructor(): void
    {
        $otherInstructor = Instructor::factory()->create();

        Training::factory()
            ->count(2)
            ->create([
                'category_id' => $this->category->id,
                'instructor_id' => $this->instructor->id,
            ]);

        Training::factory()
            ->create([
                'category_id' => $this->category->id,
                'instructor_id' => $otherInstructor->id,
            ]);

        $response = $this->getJson("/api/trainings?instructor_id={$this->instructor->id}");

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_can_filter_trainings_by_price_range(): void
    {
        Training::factory()
            ->create([
                'category_id' => $this->category->id,
                'instructor_id' => $this->instructor->id,
                'price' => 500000,
            ]);

        Training::factory()
            ->create([
                'category_id' => $this->category->id,
                'instructor_id' => $this->instructor->id,
                'price' => 150000,
            ]);

        Training::factory()
            ->create([
                'category_id' => $this->category->id,
                'instructor_id' => $this->instructor->id,
                'price' => 250000,
            ]);

        $response = $this->getJson('/api/trainings?min_price=100000&max_price=200000');

        $response->assertOk();
        $this->assertCount(1, $response->json('data'));
    }

    public function test_can_search_trainings(): void
    {
        Training::factory()
            ->create([
                'category_id' => $this->category->id,
                'instructor_id' => $this->instructor->id,
                'title' => 'Laravel Advanced Course',
            ]);

        Training::factory()
            ->create([
                'category_id' => $this->category->id,
                'instructor_id' => $this->instructor->id,
                'title' => 'PHP Basic Training',
            ]);

        $response = $this->getJson('/api/trainings?search=Laravel');

        $response->assertOk();
        $this->assertCount(1, $response->json('data'));
        $this->assertStringContainsString('Laravel', $response->json('data.0.title'));
    }

    public function test_can_create_training(): void
    {
        $trainingData = [
            'title' => 'New Training Course',
            'description' => 'This is a comprehensive training course',
            'category_id' => $this->category->id,
            'instructor_id' => $this->instructor->id,
            'duration' => '40 jam',
            'price' => 500000,
            'capacity' => 25,
            'training_type' => 'offline',
        ];

        $response = $this->postJson('/api/trainings', $trainingData);

        $response->assertCreated()
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'id',
                    'title',
                    'description',
                    'category',
                    'instructor',
                    'duration',
                    'price',
                    'capacity',
                    'training_type',
                    'rating',
                    'review_count',
                    'is_active',
                    'created_at',
                    'updated_at',
                ],
            ]);

        $this->assertEquals('success', $response->json('status'));
        $this->assertEquals($trainingData['title'], $response->json('data.title'));
        $this->assertDatabaseHas('trainings', [
            'title' => $trainingData['title'],
            'category_id' => $this->category->id,
            'instructor_id' => $this->instructor->id,
        ]);
    }

    public function test_validates_required_fields_when_creating_training(): void
    {
        $response = $this->postJson('/api/trainings', []);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors([
                'title',
                'description',
                'category_id',
                'instructor_id',
                'duration',
                'price',
                'capacity',
                'training_type',
            ]);
    }

    public function test_validates_foreign_keys_when_creating_training(): void
    {
        $trainingData = [
            'title' => 'Test Training',
            'description' => 'Test description',
            'category_id' => 999,
            'instructor_id' => 999,
            'duration' => '40 jam',
            'price' => 500000,
            'capacity' => 25,
            'training_type' => 'offline',
        ];

        $response = $this->postJson('/api/trainings', $trainingData);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['category_id', 'instructor_id']);
    }

    public function test_can_show_training(): void
    {
        $training = Training::factory()
            ->create([
                'category_id' => $this->category->id,
                'instructor_id' => $this->instructor->id,
            ]);

        $response = $this->getJson("/api/trainings/{$training->id}");

        $response->assertOk()
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'id',
                    'title',
                    'description',
                    'category',
                    'instructor',
                    'duration',
                    'price',
                    'capacity',
                    'training_type',
                    'rating',
                    'review_count',
                    'is_active',
                    'created_at',
                    'updated_at',
                ],
            ]);

        $this->assertEquals('success', $response->json('status'));
        $this->assertEquals($training->id, $response->json('data.id'));
    }

    public function test_returns_404_when_showing_nonexistent_training(): void
    {
        $response = $this->getJson('/api/trainings/999');

        $response->assertNotFound()
            ->assertJson([
                'status' => 'error',
                'message' => 'Training not found',
            ]);
    }

    public function test_can_update_training(): void
    {
        $training = Training::factory()
            ->create([
                'category_id' => $this->category->id,
                'instructor_id' => $this->instructor->id,
            ]);

        $updateData = [
            'title' => 'Updated Training Title',
            'price' => 200000,
        ];

        $response = $this->putJson("/api/trainings/{$training->id}", $updateData);

        $response->assertOk()
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'id',
                    'title',
                    'price',
                ],
            ]);

        $this->assertEquals('success', $response->json('status'));
        $this->assertEquals($updateData['title'], $response->json('data.title'));
        $this->assertEquals($updateData['price'], $response->json('data.price'));
        $this->assertDatabaseHas('trainings', [
            'id' => $training->id,
            'title' => $updateData['title'],
            'price' => $updateData['price'],
        ]);
    }

    public function test_can_delete_training(): void
    {
        $training = Training::factory()
            ->create([
                'category_id' => $this->category->id,
                'instructor_id' => $this->instructor->id,
            ]);

        $response = $this->deleteJson("/api/trainings/{$training->id}");

        $response->assertOk()
            ->assertJson([
                'status' => 'success',
                'message' => 'Training deleted successfully',
            ]);

        $this->assertDatabaseMissing('trainings', [
            'id' => $training->id,
        ]);
    }

    public function test_can_include_relationships(): void
    {
        $training = Training::factory()
            ->create([
                'category_id' => $this->category->id,
                'instructor_id' => $this->instructor->id,
            ]);

        $response = $this->getJson('/api/trainings?include=category,instructor');

        $response->assertOk();
        $this->assertArrayHasKey('category', $response->json('data.0'));
        $this->assertArrayHasKey('instructor', $response->json('data.0'));
    }

    public function test_can_sort_trainings(): void
    {
        Training::factory()
            ->create([
                'category_id' => $this->category->id,
                'instructor_id' => $this->instructor->id,
                'title' => 'A Training',
                'price' => 100000,
            ]);

        Training::factory()
            ->create([
                'category_id' => $this->category->id,
                'instructor_id' => $this->instructor->id,
                'title' => 'Z Training',
                'price' => 200000,
            ]);

        $response = $this->getJson('/api/trainings?sort_by=price&sort_direction=asc');

        $response->assertOk();
        $data = $response->json('data');
        $this->assertEquals(100000, $data[0]['price']);
        $this->assertEquals(200000, $data[1]['price']);
    }
}
