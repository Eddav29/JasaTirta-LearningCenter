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
        // Instruktur 1: Dr. Sarah Wijaya - Expert Water Quality
        $instructor1 = Instructor::create([
            'name' => 'Dr. Sarah Wijaya',
            'email' => 'sarah.wijaya@jtlc.com',
            'phone' => '+62 811-2233-4455',
            'specialization' => 'Water Quality Testing',
            'education' => 'PhD Environmental Chemistry - UI',
            'experience' => '12 years',
            'bio' => 'Experienced environmental scientist with expertise in water quality analysis and laboratory management. Passionate about teaching and developing future environmental professionals.',
            'image' => 'https://ui-avatars.com/api/?name=Sarah+Wijaya&background=4F46E5&color=fff&size=200',
            'instructor_type' => 'internal',
            'company' => 'JTLC',
        ]);

        $instructor1->certifications()->createMany([
            ['certification_name' => 'ISO 17025 Lead Auditor'],
            ['certification_name' => 'Water Quality Specialist'],
            ['certification_name' => 'Environmental Consultant'],
        ]);

        // Instruktur 2: Muhammad Rizki - Senior Field Specialist
        $instructor2 = Instructor::create([
            'name' => 'Muhammad Rizki, S.T.',
            'email' => 'rizki.muhammad@jtlc.com',
            'phone' => '+62 812-3344-5566',
            'specialization' => 'Sampling Techniques',
            'education' => 'S1 Teknik Lingkungan - ITB',
            'experience' => '8 years',
            'bio' => 'Field specialist with extensive experience in sampling and testing procedures. Expert in quality control and field testing methodologies.',
            'image' => 'https://ui-avatars.com/api/?name=Muhammad+Rizki&background=10B981&color=fff&size=200',
            'instructor_type' => 'internal',
            'company' => 'JTLC',
        ]);

        $instructor2->certifications()->createMany([
            ['certification_name' => 'Sampling Technician Level II'],
            ['certification_name' => 'Quality Control Specialist'],
        ]);

        // Instruktur 3: Dr. Lisa Chen - Expert Microbiology
        $instructor3 = Instructor::create([
            'name' => 'Dr. Lisa Chen',
            'email' => 'lisa.chen@jtlc.com',
            'phone' => '+62 813-4455-6677',
            'specialization' => 'Microbiology',
            'education' => 'PhD Microbiology - NTU Singapore',
            'experience' => '15 years',
            'bio' => 'Microbiology expert specializing in pathogen detection and food safety. International experience in laboratory management and quality assurance.',
            'image' => 'https://ui-avatars.com/api/?name=Lisa+Chen&background=8B5CF6&color=fff&size=200',
            'instructor_type' => 'internal',
            'company' => 'JTLC',
        ]);

        $instructor3->certifications()->createMany([
            ['certification_name' => 'Microbiologist Certified'],
            ['certification_name' => 'Food Safety Auditor'],
            ['certification_name' => 'HACCP Lead Auditor'],
        ]);

        // Instruktur 4: Ahmad Fadli - Senior Chemist
        $instructor4 = Instructor::create([
            'name' => 'Ahmad Fadli, M.Sc.',
            'email' => 'ahmad.fadli@jtlc.com',
            'phone' => '+62 814-5566-7788',
            'specialization' => 'Chemical Analysis',
            'education' => 'M.Sc Chemistry - UGM',
            'experience' => '10 years',
            'bio' => 'Analytical chemistry specialist with focus on method development and instrumentation. Dedicated to advancing laboratory analytical capabilities.',
            'image' => 'https://ui-avatars.com/api/?name=Ahmad+Fadli&background=F59E0B&color=fff&size=200',
            'instructor_type' => 'internal',
            'company' => 'JTLC',
        ]);

        $instructor4->certifications()->createMany([
            ['certification_name' => 'Analytical Chemist'],
            ['certification_name' => 'Instrument Specialist'],
        ]);

        // Instruktur 5: Maya Sari - Junior Training Specialist
        $instructor5 = Instructor::create([
            'name' => 'Maya Sari, S.Si.',
            'email' => 'maya.sari@jtlc.com',
            'phone' => '+62 815-6677-8899',
            'specialization' => 'Training Development',
            'education' => 'S1 Pendidikan Kimia - UNJ',
            'experience' => '3 years',
            'bio' => 'Education specialist focused on training development and curriculum design. Enthusiastic about creating engaging learning experiences for adult learners.',
            'image' => 'https://ui-avatars.com/api/?name=Maya+Sari&background=EC4899&color=fff&size=200',
            'instructor_type' => 'internal',
            'company' => 'JTLC',
        ]);

        $instructor5->certifications()->createMany([
            ['certification_name' => 'Certified Trainer'],
            ['certification_name' => 'Adult Education Specialist'],
        ]);

        // Instruktur 6-10: Vendor Instructors dengan data random
        Instructor::factory()
            ->count(5)
            ->vendor()
            ->create()
            ->each(function (Instructor $instructor): void {
                // Setiap instruktur vendor memiliki 1-3 sertifikasi
                InstructorCertification::factory()
                    ->count(rand(1, 3))
                    ->create([
                        'instructor_id' => $instructor->id,
                    ]);
            });

        // Instruktur 11-15: Internal Instructors dengan data random
        Instructor::factory()
            ->count(5)
            ->internal()
            ->create()
            ->each(function (Instructor $instructor): void {
                // Setiap instruktur internal memiliki 2-4 sertifikasi
                InstructorCertification::factory()
                    ->count(rand(2, 4))
                    ->create([
                        'instructor_id' => $instructor->id,
                    ]);
            });
    }
}
