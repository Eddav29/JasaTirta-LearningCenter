<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CatalogTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create user role for testing
        Role::create(['name' => 'user']);
    }

    /**
     * Test catalog page can be accessed by authenticated user.
     */
    public function test_catalog_page_can_be_accessed(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');

        $response = $this->actingAs($user)->get(route('user.catalog'));

        $response->assertStatus(200);
        $response->assertViewIs('pages.user.catalog.index');
        $response->assertViewHas(['courses', 'categories', 'enrolledCourseIds']);
    }

    /**
     * Test catalog page shows training data.
     */
    public function test_catalog_page_shows_training_data(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');

        $response = $this->actingAs($user)->get(route('user.catalog'));

        $response->assertStatus(200);
        $response->assertSee('Katalog Kursus');
    }
}
