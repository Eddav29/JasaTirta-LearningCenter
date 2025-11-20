<?php

namespace Database\Seeders;

use App\Models\Instructor;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instructors = [
            [
                'name' => 'Dr. Sari Indrawati',
                'email' => 'sari.indrawati@jtlc.com',
                'phone' => '+62 811-2233-4455',
                'specialization' => 'Spektrofotometri & Analisis Instrumental',
                'education' => 'PhD Analytical Chemistry - UI',
                'experience' => '12 years',
                'bio' => 'Expert in instrumental analysis and spectrophotometry with extensive experience in laboratory management and analytical method development. Passionate about training future analysts.',
                'image' => null,
                'instructor_type' => 'internal',
                'company' => 'JTLC',
            ],
            [
                'name' => 'Ir. Bambang Suryanto',
                'email' => 'bambang.suryanto@jtlc.com',
                'phone' => '+62 812-3344-5566',
                'specialization' => 'Sampling Udara & Lingkungan',
                'education' => 'S1 Teknik Lingkungan - ITB',
                'experience' => '10 years',
                'bio' => 'Environmental sampling specialist with focus on air quality monitoring and ambient air sampling techniques. Expert in field instrumentation and quality control.',
                'image' => null,
                'instructor_type' => 'internal',
                'company' => 'JTLC',
            ],
            [
                'name' => 'Dr. Ahmad Hidayat',
                'email' => 'ahmad.hidayat@jtlc.com',
                'phone' => '+62 813-4455-6677',
                'specialization' => 'Sampling Air & Hidrologi',
                'education' => 'PhD Hydrology - UGM',
                'experience' => '15 years',
                'bio' => 'Water sampling and hydrology expert specializing in river and groundwater sampling according to national standards. Extensive field experience across Indonesia.',
                'image' => null,
                'instructor_type' => 'internal',
                'company' => 'JTLC',
            ],
            [
                'name' => 'Prof. Dr. Sari Wahyuni',
                'email' => 'sari.wahyuni@jtlc.com',
                'phone' => '+62 814-5566-7788',
                'specialization' => 'Water Quality Analysis',
                'education' => 'Professor of Environmental Chemistry - UI',
                'experience' => '20 years',
                'bio' => 'Professor and senior researcher in water quality analysis with expertise in physical, chemical, and biological parameters. Author of multiple research publications.',
                'image' => null,
                'instructor_type' => 'internal',
                'company' => 'JTLC',
            ],
            [
                'name' => 'Ir. Budi Santoso',
                'email' => 'budi.santoso@jtlc.com',
                'phone' => '+62 815-6677-8899',
                'specialization' => 'K3L & Manajemen Laboratorium',
                'education' => 'S1 Teknik Kimia - ITS',
                'experience' => '8 years',
                'bio' => 'Laboratory safety and environmental management specialist. Focus on implementing K3L systems and risk assessment in laboratory settings.',
                'image' => null,
                'instructor_type' => 'internal',
                'company' => 'JTLC',
            ],
            [
                'name' => 'Dr. Rina Marlina',
                'email' => 'rina.marlina@jtlc.com',
                'phone' => '+62 816-7788-9900',
                'specialization' => 'Hydrogeology & Groundwater',
                'education' => 'PhD Hydrogeology - ITB',
                'experience' => '12 years',
                'bio' => 'Hydrogeology expert with specialization in groundwater sampling and aquifer characterization. Experience in environmental impact assessment.',
                'image' => null,
                'instructor_type' => 'internal',
                'company' => 'JTLC',
            ],
            [
                'name' => 'Dr. Indra Kusuma',
                'email' => 'indra.kusuma@jtlc.com',
                'phone' => '+62 817-8899-0011',
                'specialization' => 'Data Analysis & Statistics',
                'education' => 'PhD Statistics - UGM',
                'experience' => '9 years',
                'bio' => 'Statistics and data analysis expert specializing in environmental data interpretation. Proficient in statistical software and data visualization.',
                'image' => null,
                'instructor_type' => 'internal',
                'company' => 'JTLC',
            ],
            [
                'name' => 'Dr. Maya Sari',
                'email' => 'maya.sari@jtlc.com',
                'phone' => '+62 818-9900-1122',
                'specialization' => 'Microbiology & Sanitasi',
                'education' => 'PhD Microbiology - IPB',
                'experience' => '11 years',
                'bio' => 'Microbiology specialist with expertise in water microbiology and sanitation. Experience in pathogen detection and microbiological quality control.',
                'image' => null,
                'instructor_type' => 'internal',
                'company' => 'JTLC',
            ],
            [
                'name' => 'Ir. Hendra Wijaya',
                'email' => 'hendra.wijaya@jtlc.com',
                'phone' => '+62 819-0011-2233',
                'specialization' => 'ISO 17025 & Quality Management',
                'education' => 'S1 Teknik Kimia - UI',
                'experience' => '14 years',
                'bio' => 'ISO/IEC 17025 expert and lead auditor with extensive experience in laboratory accreditation and quality management systems implementation.',
                'image' => null,
                'instructor_type' => 'internal',
                'company' => 'JTLC',
            ],
            [
                'name' => 'Ir. Joko Susilo',
                'email' => 'joko.susilo@jtlc.com',
                'phone' => '+62 820-1122-3344',
                'specialization' => 'Kalibrasi & Metrologi',
                'education' => 'S1 Teknik Fisika - ITS',
                'experience' => '13 years',
                'bio' => 'Calibration and metrology specialist with expertise in laboratory instrument calibration and uncertainty calculation. KAN certified calibration technician.',
                'image' => null,
                'instructor_type' => 'internal',
                'company' => 'JTLC',
            ],
            [
                'name' => 'Dr. Lina Hartati',
                'email' => 'lina.hartati@jtlc.com',
                'phone' => '+62 821-2233-4455',
                'specialization' => 'Waste Management & B3',
                'education' => 'PhD Environmental Engineering - ITB',
                'experience' => '10 years',
                'bio' => 'Hazardous waste management expert specializing in laboratory waste treatment and B3 regulations. Certified environmental consultant.',
                'image' => null,
                'instructor_type' => 'internal',
                'company' => 'JTLC',
            ],
        ];

        foreach ($instructors as $instructorData) {
            Instructor::create($instructorData);
        }

        $this->command->info('11 instructors created successfully!');
    }
}
