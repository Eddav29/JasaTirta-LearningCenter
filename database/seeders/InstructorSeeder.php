<?php

namespace Database\Seeders;

use App\Models\Instructor;
use App\Models\InstructorCertification;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat beberapa instruktur internal dengan sertifikasi
        Instructor::factory()
            ->count(5)
            ->internal()
            ->create()
            ->each(function (Instructor $instructor): void {
                // Setiap instruktur memiliki 1-3 sertifikasi
                InstructorCertification::factory()
                    ->count(rand(1, 3))
                    ->create([
                        'instructor_id' => $instructor->id,
                    ]);
            });

        // Buat beberapa instruktur vendor dengan sertifikasi
        Instructor::factory()
            ->count(5)
            ->vendor()
            ->create()
            ->each(function (Instructor $instructor): void {
                // Setiap instruktur memiliki 1-3 sertifikasi
                InstructorCertification::factory()
                    ->count(rand(1, 3))
                    ->create([
                        'instructor_id' => $instructor->id,
                    ]);
            });

        // Buat instruktur spesifik untuk contoh
        $leadInstructor = Instructor::create([
            'name' => 'Dr. Ahmad Santoso',
            'specialization' => 'Web Development & Cloud Computing',
            'education' => 'Doctor of Computer Science',
            'experience' => 15,
            'bio' => 'Expert in full-stack web development with extensive experience in cloud architecture and DevOps practices. Specialized in Laravel, React, and AWS services.',
            'email' => 'ahmad.santoso@jasatirta.com',
            'phone' => '08123456789',
            'instructor_type' => 'internal',
            'company' => 'JTLC',
        ]);

        // Tambahkan sertifikasi untuk lead instructor
        $leadInstructor->certifications()->createMany([
            ['certification_name' => 'Laravel Certified Developer'],
            ['certification_name' => 'AWS Certified Solutions Architect'],
            ['certification_name' => 'Docker Certified Associate'],
        ]);
    }
}
