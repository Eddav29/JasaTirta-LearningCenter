<?php

namespace Tests\Feature;

use App\Models\TrainingCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TrainingCategoryApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
    }

    public function test_can_get_all_training_categories(): void
    {
        // Create test categories
        TrainingCategory::factory()->count(3)->create();

        $response = $this->getJson('/api/training-categories');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'description',
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
            ])
            ->assertJson([
                'status' => 'success',
                'message' => 'Training categories retrieved successfully',
            ]);
    }

    public function test_can_search_training_categories(): void
    {
        TrainingCategory::factory()->create(['name' => 'Web Development']);
        TrainingCategory::factory()->create(['name' => 'Mobile Development']);

        $response = $this->getJson('/api/training-categories?search=Web');

        $response->assertStatus(200);
        $data = $response->json('data');

        $this->assertCount(1, $data);
        $this->assertStringContainsString('Web', $data[0]['name']);
    }

    public function test_can_sort_training_categories(): void
    {
        TrainingCategory::factory()->create(['name' => 'Zebra Category']);
        TrainingCategory::factory()->create(['name' => 'Alpha Category']);

        $response = $this->getJson('/api/training-categories?sort_by=name&sort_direction=asc');

        $response->assertStatus(200);
        $data = $response->json('data');

        $this->assertEquals('Alpha Category', $data[0]['name']);
        $this->assertEquals('Zebra Category', $data[1]['name']);
    }

    // NOTE: This test will be uncommented when Training model is created
    // public function test_can_include_training_counts(): void
    // {
    //     $category = TrainingCategory::factory()->create();

    //     $response = $this->getJson('/api/training-categories?include_counts=1');

    //     $response->assertStatus(200)
    //         ->assertJsonStructure([
    //             'data' => [
    //                 '*' => [
    //                     'trainings_count',
    //                     'active_trainings_count',
    //                 ]
    //             ]
    //         ]);
    // }

    public function test_can_create_training_category(): void
    {
        $categoryData = [
            'name' => 'New Category',
            'description' => 'This is a new training category',
        ];

        $response = $this->postJson('/api/training-categories', $categoryData);

        $response->assertStatus(201)
            ->assertJson([
                'status' => 'success',
                'message' => 'Training category created successfully',
            ])
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'description',
                    'created_at',
                    'updated_at',
                ],
            ]);

        $this->assertDatabaseHas('training_categories', [
            'name' => 'New Category',
            'description' => 'This is a new training category',
        ]);
    }

    public function test_can_create_training_category_without_description(): void
    {
        $categoryData = [
            'name' => 'Category Without Description',
        ];

        $response = $this->postJson('/api/training-categories', $categoryData);

        $response->assertStatus(201);

        $this->assertDatabaseHas('training_categories', [
            'name' => 'Category Without Description',
            'description' => null,
        ]);
    }

    public function test_can_show_training_category(): void
    {
        $category = TrainingCategory::factory()->create();

        $response = $this->getJson("/api/training-categories/{$category->id}");

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Training category retrieved successfully',
            ])
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'description',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }

    public function test_can_update_training_category(): void
    {
        $category = TrainingCategory::factory()->create();

        $updateData = [
            'name' => 'Updated Category Name',
            'description' => 'Updated description',
        ];

        $response = $this->putJson("/api/training-categories/{$category->id}", $updateData);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Training category updated successfully',
            ]);

        $this->assertDatabaseHas('training_categories', [
            'id' => $category->id,
            'name' => 'Updated Category Name',
            'description' => 'Updated description',
        ]);
    }

    public function test_can_partially_update_training_category(): void
    {
        $category = TrainingCategory::factory()->create([
            'name' => 'Original Name',
            'description' => 'Original Description',
        ]);

        $updateData = [
            'description' => 'Updated description only',
        ];

        $response = $this->putJson("/api/training-categories/{$category->id}", $updateData);

        $response->assertStatus(200);

        $this->assertDatabaseHas('training_categories', [
            'id' => $category->id,
            'name' => 'Original Name', // Should remain unchanged
            'description' => 'Updated description only',
        ]);
    }

    public function test_can_delete_training_category(): void
    {
        $category = TrainingCategory::factory()->create();

        $response = $this->deleteJson("/api/training-categories/{$category->id}");

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Training category deleted successfully',
            ]);

        $this->assertDatabaseMissing('training_categories', [
            'id' => $category->id,
        ]);
    }

    public function test_returns_404_for_non_existent_category(): void
    {
        $response = $this->getJson('/api/training-categories/999');

        $response->assertStatus(404)
            ->assertJson([
                'status' => 'error',
                'message' => 'Training category not found',
            ]);
    }

    public function test_validation_fails_for_invalid_data(): void
    {
        $invalidData = [
            'name' => '', // Required field
            'description' => str_repeat('a', 1001), // Too long
        ];

        $response = $this->postJson('/api/training-categories', $invalidData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'description']);
    }

    public function test_validation_fails_for_duplicate_name(): void
    {
        TrainingCategory::factory()->create(['name' => 'Existing Category']);

        $duplicateData = [
            'name' => 'Existing Category',
            'description' => 'This should fail due to duplicate name',
        ];

        $response = $this->postJson('/api/training-categories', $duplicateData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name']);
    }

    public function test_can_update_with_same_name(): void
    {
        $category = TrainingCategory::factory()->create(['name' => 'Original Name']);

        $updateData = [
            'name' => 'Original Name', // Same name should be allowed
            'description' => 'Updated description',
        ];

        $response = $this->putJson("/api/training-categories/{$category->id}", $updateData);

        $response->assertStatus(200);
    }

    public function test_requires_authentication(): void
    {
        // Clear Sanctum authentication
        $this->refreshApplication();

        $response = $this->getJson('/api/training-categories');

        $response->assertStatus(401);
    }
}
