<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleSeeder::class);
    }

    private function actingAsAdmin(): string
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
        ]);
        $admin->assignRole('admin');

        return $admin->createToken('api')->plainTextToken;
    }

    public function test_admin_can_create_and_update_user_with_roles(): void
    {
        $token = $this->actingAsAdmin();

        $create = $this->postJson('/api/users', [
            'name' => 'User B',
            'email' => 'userb@example.com',
            'password' => 'password123',
            'roles' => ['user'],
        ], ['Authorization' => 'Bearer '.$token])->assertCreated();

        $id = $create->json('data.id');

        $this->putJson('/api/users/'.$id, [
            'name' => 'User B Updated',
            'email' => 'userb@example.com',
            'roles' => ['user'],
        ], ['Authorization' => 'Bearer '.$token])->assertOk()->assertJsonPath('data.name', 'User B Updated');
    }

    public function test_user_without_permission_cannot_list_users(): void
    {
        $user = User::factory()->create(['email' => 'viewer@example.com']);
        $user->assignRole('user');
        $token = $user->createToken('api')->plainTextToken;

        $this->getJson('/api/users', [
            'Authorization' => 'Bearer '.$token,
        ])->assertForbidden();
    }

    public function test_user_with_view_permission_can_list_users(): void
    {
        $user = User::factory()->create(['email' => 'viewer2@example.com']);
        $user->assignRole('user');
        $user->givePermissionTo('users.view');
        $token = $user->createToken('api')->plainTextToken;

        $this->getJson('/api/users', [
            'Authorization' => 'Bearer '.$token,
        ])->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'email', 'roles', 'created_at', 'updated_at'],
                ],
                'links' => ['first', 'last', 'prev', 'next'],
                'meta' => ['current_page', 'from', 'last_page', 'path', 'per_page', 'to', 'total'],
            ]);
    }
}
