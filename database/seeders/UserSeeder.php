<?php

namespace Database\Seeders;

use App\Domain\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat admin user
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'System',
            'email' => 'admin@jasatirta.com',
            'phone' => '08123456789',
            'email_verified' => true,
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole(RoleEnum::Admin->value);

        // Buat regular user untuk testing
        $user = User::create([
            'first_name' => 'User',
            'last_name' => 'Test',
            'email' => 'user@jasatirta.com',
            'phone' => '08987654321',
            'email_verified' => true,
            'password' => Hash::make('password'),
        ]);
        $user->assignRole(RoleEnum::User->value);

        // Buat beberapa dummy users menggunakan factory
        User::factory(10)->create()->each(function (User $user): void {
            $user->assignRole(RoleEnum::User->value);
        });
    }
}
