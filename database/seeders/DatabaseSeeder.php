<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan seeder dengan urutan yang benar
        // Role harus dibuat terlebih dahulu sebelum User
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            InstructorSeeder::class,
        ]);
    }
}
