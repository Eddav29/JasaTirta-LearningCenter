<?php

namespace Database\Seeders;

use App\Domain\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Bersihkan cache permission Spatie
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat permissions
        $permissions = [
            // User management
            'users.view',
            'users.create',
            'users.update',
            'users.delete',

            // Training management
            'trainings.view',
            'trainings.create',
            'trainings.update',
            'trainings.delete',

            // Schedule management
            'schedules.view',
            'schedules.create',
            'schedules.update',
            'schedules.delete',

            // Category management
            'categories.view',
            'categories.create',
            'categories.update',
            'categories.delete',

            // Instructor management
            'instructors.view',
            'instructors.create',
            'instructors.update',
            'instructors.delete',

            // Participant management
            'participants.view',
            'participants.create',
            'participants.update',
            'participants.delete',

            // Registration management
            'registrations.view',
            'registrations.create',
            'registrations.update',
            'registrations.delete',

            // Reports
            'reports.view',
            'reports.export',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Buat roles
        $admin = Role::firstOrCreate(['name' => RoleEnum::Admin->value]);
        $instructor = Role::firstOrCreate(['name' => RoleEnum::Instructor->value]);
        $participant = Role::firstOrCreate(['name' => RoleEnum::Participant->value]);
        $corporate = Role::firstOrCreate(['name' => RoleEnum::Corporate->value]);
        $student = Role::firstOrCreate(['name' => RoleEnum::Student->value]);
        $user = Role::firstOrCreate(['name' => RoleEnum::User->value]);

        // Admin: semua permissions
        $admin->syncPermissions(Permission::all());

        // Instructor: bisa view trainings, schedules, participants, dan manage materials
        $instructor->syncPermissions([
            'trainings.view',
            'schedules.view',
            'participants.view',
            'registrations.view',
            'reports.view',
        ]);

        // Participant: bisa view trainings, schedules, dan manage own registrations
        $participant->syncPermissions([
            'trainings.view',
            'schedules.view',
            'registrations.view',
            'registrations.create',
        ]);

        // Corporate: sama seperti participant tapi untuk perusahaan
        $corporate->syncPermissions([
            'trainings.view',
            'schedules.view',
            'registrations.view',
            'registrations.create',
        ]);

        // Student: sama seperti participant untuk pelajar/mahasiswa
        $student->syncPermissions([
            'trainings.view',
            'schedules.view',
            'registrations.view',
            'registrations.create',
        ]);

        // User: basic permissions
        $user->syncPermissions([
            'trainings.view',
            'schedules.view',
        ]);
    }
}
