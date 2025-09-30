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
            'users.view',
            'users.create',
            'users.update',
            'users.delete',
        ];
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Buat roles
        $admin = Role::firstOrCreate(['name' => RoleEnum::Admin->value]);
        $user = Role::firstOrCreate(['name' => RoleEnum::User->value]);

        // Assign all permissions to admin role
        $admin->syncPermissions(Permission::all());

        // User role: (default none) - bisa ditambah sesuai kebutuhan
        $user->syncPermissions([]);
    }
}
