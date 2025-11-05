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
        // Buat super admin user
        $superAdmin = User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'superadmin@jasatirta.com',
            'phone' => '+62 813-4567-8901',
            'email_verified' => true,
            'password' => Hash::make('password'),
        ]);
        $superAdmin->assignRole(RoleEnum::SuperAdmin->value);

        // Buat admin users
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'System',
            'email' => 'admin@jasatirta.com',
            'phone' => '+62 812-3456-7890',
            'email_verified' => true,
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole(RoleEnum::Admin->value);

        // Buat instructor users (sesuai dengan instructor yang ada)
        $instructorData = [
            ['first_name' => 'Sarah', 'last_name' => 'Wijaya', 'email' => 'sarah.wijaya@jtlc.com'],
            ['first_name' => 'Muhammad', 'last_name' => 'Rizki', 'email' => 'rizki.muhammad@jtlc.com'],
            ['first_name' => 'Lisa', 'last_name' => 'Chen', 'email' => 'lisa.chen@jtlc.com'],
            ['first_name' => 'Ahmad', 'last_name' => 'Fadli', 'email' => 'ahmad.fadli@jtlc.com'],
            ['first_name' => 'Maya', 'last_name' => 'Sari', 'email' => 'maya.sari@jtlc.com'],
        ];

        foreach ($instructorData as $data) {
            $instructor = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'phone' => '+62 '.fake()->numerify('###-####-####'),
                'email_verified' => true,
                'password' => Hash::make('password'),
            ]);
            $instructor->assignRole(RoleEnum::Instructor->value);
        }

        // Buat participant users
        $participantNames = [
            ['first_name' => 'Budi', 'last_name' => 'Santoso'],
            ['first_name' => 'Ani', 'last_name' => 'Wulandari'],
            ['first_name' => 'Riko', 'last_name' => 'Pratama'],
            ['first_name' => 'Siti', 'last_name' => 'Nurhaliza'],
            ['first_name' => 'Dedi', 'last_name' => 'Kurniawan'],
            ['first_name' => 'Rina', 'last_name' => 'Susanti'],
            ['first_name' => 'Agus', 'last_name' => 'Setiawan'],
            ['first_name' => 'Dewi', 'last_name' => 'Lestari'],
            ['first_name' => 'Eko', 'last_name' => 'Prasetyo'],
            ['first_name' => 'Fitri', 'last_name' => 'Handayani'],
        ];

        foreach ($participantNames as $data) {
            $participant = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => strtolower($data['first_name'].'.'.$data['last_name']).'@participant.com',
                'phone' => '+62 '.fake()->numerify('###-####-####'),
                'email_verified' => true,
                'password' => Hash::make('password'),
            ]);
            $participant->assignRole(RoleEnum::Participant->value);
        }

        // Buat regular user untuk testing
        $user = User::create([
            'first_name' => 'User',
            'last_name' => 'Test',
            'email' => 'user@jasatirta.com',
            'phone' => '+62 898-7654-3210',
            'email_verified' => true,
            'password' => Hash::make('password'),
        ]);
        $user->assignRole(RoleEnum::User->value);

        // Buat beberapa random participants menggunakan factory
        User::factory(15)->create()->each(function (User $user): void {
            $user->assignRole(RoleEnum::Participant->value);
        });

        // Buat beberapa random instructors menggunakan factory
        User::factory(5)->create()->each(function (User $user): void {
            $user->assignRole(RoleEnum::Instructor->value);
        });
    }
}
