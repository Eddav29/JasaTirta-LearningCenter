<?php

namespace Database\Seeders;

use App\Models\Instructor;
use App\Models\Training;
use App\Models\TrainingCategory;
use Illuminate\Database\Seeder;

class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua kategori dan instruktur yang sudah ada
        $categories = TrainingCategory::all();
        $instructors = Instructor::all();

        // Pastikan ada data kategori dan instruktur
        if ($categories->isEmpty() || $instructors->isEmpty()) {
            $this->command->error('Pastikan kategori dan instruktur sudah di-seed terlebih dahulu!');

            return;
        }

        // Buat beberapa training spesifik untuk setiap kategori
        $specificTrainings = [
            [
                'title' => 'Laravel Advanced Development',
                'category' => 'Web Development',
                'description' => 'Kuasai teknik advanced Laravel development termasuk service container, facades, packages development, dan best practices.',
                'long_description' => 'Pelatihan intensif untuk menguasai Laravel framework pada level advanced. Anda akan mempelajari konsep-konsep mendalam seperti service container, service providers, facades, middleware, events, queues, dan broadcasting. Cocok untuk developer yang ingin meningkatkan skill Laravel ke level expert.',
                'duration' => '40 jam',
                'price' => 3500000,
                'capacity' => 20,
                'training_type' => 'hybrid',
                'rating' => 4.8,
                'review_count' => 125,
                'learning_hours' => 40,
                'training_methods' => 'Lecture, Hands-on Lab, Case Study, Project',
                'certification_note' => 'Peserta akan mendapatkan sertifikat resmi setelah menyelesaikan pelatihan dan project akhir',
                'is_active' => true,
            ],
            [
                'title' => 'Flutter Mobile App Development',
                'category' => 'Mobile Development',
                'description' => 'Belajar membuat aplikasi mobile cross-platform dengan Flutter dan Dart dari dasar hingga advanced.',
                'long_description' => 'Pelatihan komprehensif pengembangan aplikasi mobile menggunakan Flutter. Mulai dari dasar Dart programming, widget, state management, hingga integrasi API, database lokal, dan deployment ke App Store dan Play Store.',
                'duration' => '40 jam',
                'price' => 3000000,
                'capacity' => 25,
                'training_type' => 'online',
                'rating' => 4.7,
                'review_count' => 98,
                'learning_hours' => 40,
                'training_methods' => 'Video Tutorial, Live Coding, Project-based Learning',
                'certification_note' => 'Sertifikat digital akan diberikan setelah project final disetujui',
                'is_active' => true,
            ],
            [
                'title' => 'Data Science with Python',
                'category' => 'Data Science',
                'description' => 'Pelajari data science menggunakan Python, pandas, numpy, dan machine learning libraries.',
                'long_description' => 'Pelatihan lengkap data science dari fundamental hingga advanced. Mencakup data cleaning, exploratory data analysis, statistical analysis, data visualization, dan introduction to machine learning menggunakan Python ecosystem.',
                'duration' => '80 jam',
                'price' => 5000000,
                'capacity' => 15,
                'training_type' => 'hybrid',
                'rating' => 4.9,
                'review_count' => 156,
                'learning_hours' => 80,
                'training_methods' => 'Interactive Lecture, Lab Session, Real Dataset Analysis',
                'certification_note' => 'Sertifikat profesional data science setelah menyelesaikan capstone project',
                'is_active' => true,
            ],
            [
                'title' => 'AWS Cloud Practitioner',
                'category' => 'Cloud Computing',
                'description' => 'Persiapan sertifikasi AWS Cloud Practitioner dan hands-on practice dengan AWS services.',
                'long_description' => 'Pelatihan persiapan sertifikasi AWS Cloud Practitioner yang mencakup fundamental cloud computing, core AWS services, security, pricing, dan best practices. Termasuk hands-on lab menggunakan AWS Free Tier.',
                'duration' => '24 jam',
                'price' => 2500000,
                'capacity' => 30,
                'training_type' => 'online',
                'rating' => 4.6,
                'review_count' => 87,
                'learning_hours' => 24,
                'training_methods' => 'Online Class, Hands-on AWS Lab, Practice Exam',
                'certification_note' => 'Peserta mendapat voucher diskon untuk exam AWS Cloud Practitioner',
                'is_active' => true,
            ],
            [
                'title' => 'Cybersecurity Fundamentals',
                'category' => 'Cybersecurity',
                'description' => 'Fundamental keamanan siber, ethical hacking, dan penetration testing untuk pemula.',
                'long_description' => 'Pelatihan dasar cybersecurity yang mencakup network security, cryptography, secure coding, vulnerability assessment, dan ethical hacking. Cocok untuk IT professionals yang ingin memulai karir di bidang security.',
                'duration' => '40 jam',
                'price' => 4000000,
                'capacity' => 20,
                'training_type' => 'offline',
                'rating' => 4.8,
                'review_count' => 112,
                'learning_hours' => 40,
                'training_methods' => 'Theory, Lab Practice, Capture The Flag (CTF)',
                'certification_note' => 'Sertifikat Cybersecurity Fundamentals setelah lulus final exam',
                'is_active' => true,
            ],
        ];

        foreach ($specificTrainings as $trainingData) {
            $category = $categories->where('name', $trainingData['category'])->first();
            $instructor = $instructors->random();

            if ($category) {
                unset($trainingData['category']);
                Training::create(array_merge($trainingData, [
                    'category_id' => $category->id,
                    'instructor_id' => $instructor->id,
                ]));
            }
        }

        // Buat training tambahan menggunakan factory untuk variasi
        Training::factory()
            ->count(15)
            ->create([
                'category_id' => fn () => $categories->random()->id,
                'instructor_id' => fn () => $instructors->random()->id,
            ]);
    }
}
