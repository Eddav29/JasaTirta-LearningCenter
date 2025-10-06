<?php

namespace Tests\Feature;

use App\Models\Instructor;
use App\Models\InstructorCertification;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class InstructorApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
    }

    public function test_can_get_all_instructors(): void
    {
        // Create test instructors
        $instructors = Instructor::factory()->count(3)->create();

        $response = $this->getJson('/api/instructors');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'specialization',
                        'education',
                        'experience',
                        'bio',
                        'email',
                        'phone',
                        'instructor_type',
                        'company',
                        'certifications',
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
                'message' => 'Instructors retrieved successfully',
            ]);
    }

    public function test_can_filter_instructors_by_type(): void
    {
        Instructor::factory()->create(['instructor_type' => 'internal']);
        Instructor::factory()->create(['instructor_type' => 'vendor']);

        $response = $this->getJson('/api/instructors?instructor_type=internal');

        $response->assertStatus(200);
        $data = $response->json('data');

        foreach ($data as $instructor) {
            $this->assertEquals('internal', $instructor['instructor_type']);
        }
    }

    public function test_can_search_instructors(): void
    {
        Instructor::factory()->create(['name' => 'John Doe']);
        Instructor::factory()->create(['name' => 'Jane Smith']);

        $response = $this->getJson('/api/instructors?search=John');

        $response->assertStatus(200);
        $data = $response->json('data');

        $this->assertCount(1, $data);
        $this->assertStringContainsString('John', $data[0]['name']);
    }

    public function test_can_create_instructor(): void
    {
        $instructorData = [
            'name' => 'John Doe',
            'specialization' => 'Web Development',
            'education' => 'Bachelor of Computer Science',
            'experience' => 5,
            'bio' => 'Experienced web developer with expertise in Laravel',
            'email' => 'john.doe@example.com',
            'phone' => '+1234567890',
            'instructor_type' => 'internal',
            'company' => 'JTLC',
            'certifications' => ['Laravel Certified', 'PHP Expert'],
        ];

        $response = $this->postJson('/api/instructors', $instructorData);

        $response->assertStatus(201)
            ->assertJson([
                'status' => 'success',
                'message' => 'Instructor created successfully',
            ])
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'specialization',
                    'education',
                    'experience',
                    'bio',
                    'email',
                    'phone',
                    'instructor_type',
                    'company',
                    'certifications' => [
                        '*' => [
                            'id',
                            'instructor_id',
                            'certification_name',
                            'created_at',
                            'updated_at',
                        ],
                    ],
                ],
            ]);

        $this->assertDatabaseHas('instructors', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
        ]);

        $this->assertDatabaseHas('instructor_certifications', [
            'certification_name' => 'Laravel Certified',
        ]);
    }

    public function test_can_show_instructor(): void
    {
        $instructor = Instructor::factory()->create();
        InstructorCertification::factory()->create([
            'instructor_id' => $instructor->id,
            'certification_name' => 'Test Certification',
        ]);

        $response = $this->getJson("/api/instructors/{$instructor->id}");

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Instructor retrieved successfully',
            ])
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'certifications' => [
                        '*' => [
                            'certification_name',
                        ],
                    ],
                ],
            ]);
    }

    public function test_can_update_instructor(): void
    {
        $instructor = Instructor::factory()->create();

        $updateData = [
            'name' => 'Updated Name',
            'specialization' => 'Updated Specialization',
            'certifications' => ['New Certification 1', 'New Certification 2'],
        ];

        $response = $this->putJson("/api/instructors/{$instructor->id}", $updateData);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Instructor updated successfully',
            ]);

        $this->assertDatabaseHas('instructors', [
            'id' => $instructor->id,
            'name' => 'Updated Name',
            'specialization' => 'Updated Specialization',
        ]);

        $this->assertDatabaseHas('instructor_certifications', [
            'instructor_id' => $instructor->id,
            'certification_name' => 'New Certification 1',
        ]);
    }

    public function test_can_delete_instructor(): void
    {
        $instructor = Instructor::factory()->create();
        InstructorCertification::factory()->create(['instructor_id' => $instructor->id]);

        $response = $this->deleteJson("/api/instructors/{$instructor->id}");

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Instructor deleted successfully',
            ]);

        $this->assertDatabaseMissing('instructors', [
            'id' => $instructor->id,
        ]);

        $this->assertDatabaseMissing('instructor_certifications', [
            'instructor_id' => $instructor->id,
        ]);
    }

    public function test_returns_404_for_non_existent_instructor(): void
    {
        $response = $this->getJson('/api/instructors/999');

        $response->assertStatus(404)
            ->assertJson([
                'status' => 'error',
                'message' => 'Instructor not found',
            ]);
    }

    public function test_validation_fails_for_invalid_data(): void
    {
        $invalidData = [
            'name' => '', // Required field
            'email' => 'invalid-email', // Invalid email format
            'instructor_type' => 'invalid_type', // Invalid enum value
        ];

        $response = $this->postJson('/api/instructors', $invalidData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'instructor_type']);
    }

    public function test_requires_authentication(): void
    {
        // Clear Sanctum authentication by creating fresh app instance
        $this->refreshApplication();

        $response = $this->getJson('/api/instructors');

        $response->assertStatus(401);
    }
}
