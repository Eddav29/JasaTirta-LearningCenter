<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleSeeder::class);
    }

    public function test_user_can_register_and_login(): void
    {
        $register = $this->postJson('/api/auth/register', [
            'name' => 'User A',
            'email' => 'usera@example.com',
            'password' => 'password123',
        ])->assertCreated();

        $this->assertDatabaseHas('users', ['email' => 'usera@example.com']);

        $login = $this->postJson('/api/auth/login', [
            'email' => 'usera@example.com',
            'password' => 'password123',
        ])->assertOk();

        $token = $login->json('token');
        $this->assertIsString($token);
    }

    public function test_admin_route_blocked_for_non_admin(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $token = $user->createToken('api')->plainTextToken;

        $this->getJson('/api/admin/dashboard', [
            'Authorization' => 'Bearer '.$token,
        ])->assertForbidden();
    }

    public function test_old_tokens_revoked_on_new_login(): void
    {
        $user = User::factory()->create([
            'email' => 'revoker@example.com',
            'password' => 'password123',
        ]);
        $user->assignRole('user');

        // first login
        $first = $this->postJson('/api/auth/login', [
            'email' => 'revoker@example.com',
            'password' => 'password123',
        ])->assertOk();
        $firstToken = $first->json('token');

        // second login (should revoke first)
        $second = $this->postJson('/api/auth/login', [
            'email' => 'revoker@example.com',
            'password' => 'password123',
        ])->assertOk();
        $secondToken = $second->json('token');
        $this->assertNotSame($firstToken, $secondToken);

        // old token should now be invalid
        $this->getJson('/api/auth/me', [
            'Authorization' => 'Bearer '.$firstToken,
        ])->assertUnauthorized();

        // new token valid
        $this->getJson('/api/auth/me', [
            'Authorization' => 'Bearer '.$secondToken,
        ])->assertOk();
    }
}
