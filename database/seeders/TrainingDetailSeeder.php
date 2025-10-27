<?php

namespace Database\Seeders;

use App\Models\Training;
use App\Models\TrainingLearningObjective;
use App\Models\TrainingMaterial;
use App\Models\TrainingPrerequisite;
use App\Models\TrainingSyllabus;
use App\Models\TrainingSyllabusTopic;
use Illuminate\Database\Seeder;

class TrainingDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trainings = Training::all();

        if ($trainings->isEmpty()) {
            $this->command->error('Pastikan training sudah di-seed terlebih dahulu!');

            return;
        }

        // Detail untuk Laravel Advanced Development
        $laravelTraining = Training::where('title', 'Laravel Advanced Development')->first();
        if ($laravelTraining) {
            $this->seedLaravelTrainingDetails($laravelTraining);
        }

        // Detail untuk Flutter Mobile App Development
        $flutterTraining = Training::where('title', 'Flutter Mobile App Development')->first();
        if ($flutterTraining) {
            $this->seedFlutterTrainingDetails($flutterTraining);
        }

        // Detail untuk Data Science with Python
        $datascienceTraining = Training::where('title', 'Data Science with Python')->first();
        if ($datascienceTraining) {
            $this->seedDataScienceTrainingDetails($datascienceTraining);
        }

        // Tambahkan detail dasar untuk training lainnya
        foreach ($trainings as $training) {
            if (! $training->learningObjectives()->exists()) {
                $this->seedBasicTrainingDetails($training);
            }
        }
    }

    private function seedLaravelTrainingDetails(Training $training): void
    {
        // Learning Objectives
        $objectives = [
            'Menguasai konsep Service Container dan Dependency Injection dalam Laravel',
            'Memahami dan mengimplementasikan Service Providers dan Facades',
            'Membuat custom middleware dan policy untuk authorization',
            'Mengimplementasikan Queue, Jobs, dan Event Broadcasting',
            'Membangun REST API yang scalable dengan Laravel Resources',
            'Menerapkan best practices dalam pengembangan Laravel aplikasi',
        ];

        foreach ($objectives as $index => $objective) {
            TrainingLearningObjective::create([
                'training_id' => $training->id,
                'objective' => $objective,
                'order_number' => $index + 1,
            ]);
        }

        // Prerequisites
        $prerequisites = [
            'Pemahaman dasar PHP dan OOP',
            'Pengalaman dengan Laravel basic (routing, controller, blade)',
            'Familiar dengan database dan Eloquent ORM',
            'Memahami konsep MVC',
        ];

        foreach ($prerequisites as $index => $prerequisite) {
            TrainingPrerequisite::create([
                'training_id' => $training->id,
                'prerequisite' => $prerequisite,
                'order_number' => $index + 1,
            ]);
        }

        // Materials
        $materials = [
            'Modul lengkap Laravel Advanced Development (PDF)',
            'Source code project examples',
            'Video tutorial recorded sessions',
            'Akses ke Laravel documentation premium',
            'Studi kasus real-world projects',
        ];

        foreach ($materials as $index => $material) {
            TrainingMaterial::create([
                'training_id' => $training->id,
                'material' => $material,
                'order_number' => $index + 1,
            ]);
        }

        // Syllabus
        $syllabusData = [
            [
                'day' => 1,
                'title' => 'Service Container & Dependency Injection',
                'topics' => [
                    'Pengenalan Service Container',
                    'Binding & Resolving Dependencies',
                    'Contextual Binding',
                    'Container Events',
                ],
            ],
            [
                'day' => 2,
                'title' => 'Service Providers & Facades',
                'topics' => [
                    'Creating Custom Service Providers',
                    'Deferred Providers',
                    'Building Custom Facades',
                    'Real-time Facades',
                ],
            ],
            [
                'day' => 3,
                'title' => 'Advanced Middleware & Authorization',
                'topics' => [
                    'Custom Middleware Development',
                    'Middleware Parameters',
                    'Gates and Policies',
                    'Authorization Strategies',
                ],
            ],
            [
                'day' => 4,
                'title' => 'Queues & Jobs',
                'topics' => [
                    'Queue Configuration',
                    'Creating Jobs',
                    'Job Middleware',
                    'Queue Workers & Horizon',
                ],
            ],
            [
                'day' => 5,
                'title' => 'Events & Broadcasting',
                'topics' => [
                    'Event System',
                    'Event Listeners',
                    'Broadcasting Events',
                    'Laravel Echo & WebSockets',
                ],
            ],
        ];

        foreach ($syllabusData as $index => $syllabus) {
            $trainingSyllabus = TrainingSyllabus::create([
                'training_id' => $training->id,
                'day' => $syllabus['day'],
                'title' => $syllabus['title'],
                'order_number' => $index + 1,
            ]);

            foreach ($syllabus['topics'] as $topicIndex => $topic) {
                TrainingSyllabusTopic::create([
                    'syllabus_id' => $trainingSyllabus->id,
                    'topic' => $topic,
                    'order_number' => $topicIndex + 1,
                ]);
            }
        }
    }

    private function seedFlutterTrainingDetails(Training $training): void
    {
        // Learning Objectives
        $objectives = [
            'Menguasai dasar-dasar Flutter dan Dart programming',
            'Membangun UI yang responsive dengan Flutter widgets',
            'Mengimplementasikan state management (Provider, Bloc)',
            'Integrasi dengan REST API dan Firebase',
            'Memahami navigasi dan routing dalam Flutter',
            'Deploy aplikasi ke Google Play Store dan App Store',
        ];

        foreach ($objectives as $index => $objective) {
            TrainingLearningObjective::create([
                'training_id' => $training->id,
                'objective' => $objective,
                'order_number' => $index + 1,
            ]);
        }

        // Prerequisites
        $prerequisites = [
            'Pemahaman dasar programming (any language)',
            'Familiar dengan konsep OOP',
            'Memiliki laptop dengan spesifikasi minimal 8GB RAM',
            'Sudah install Flutter SDK dan IDE (VS Code/Android Studio)',
        ];

        foreach ($prerequisites as $index => $prerequisite) {
            TrainingPrerequisite::create([
                'training_id' => $training->id,
                'prerequisite' => $prerequisite,
                'order_number' => $index + 1,
            ]);
        }

        // Materials
        $materials = [
            'E-book Flutter Development Guidebook',
            'Starter project templates',
            'Video tutorials setiap sesi',
            'Akses ke private Discord community',
            'Sample apps source code',
        ];

        foreach ($materials as $index => $material) {
            TrainingMaterial::create([
                'training_id' => $training->id,
                'material' => $material,
                'order_number' => $index + 1,
            ]);
        }

        // Syllabus (simplified for brevity)
        $syllabusData = [
            [
                'day' => 1,
                'title' => 'Dart Programming Fundamentals',
                'topics' => [
                    'Dart syntax dan data types',
                    'Functions dan Classes',
                    'Async programming dengan Future dan Stream',
                ],
            ],
            [
                'day' => 2,
                'title' => 'Flutter Widgets & Layouts',
                'topics' => [
                    'Stateless vs Stateful widgets',
                    'Layout widgets (Container, Row, Column)',
                    'Material Design widgets',
                ],
            ],
            [
                'day' => 3,
                'title' => 'State Management',
                'topics' => [
                    'Provider pattern',
                    'BLoC pattern',
                    'Riverpod introduction',
                ],
            ],
            [
                'day' => 4,
                'title' => 'API Integration & Firebase',
                'topics' => [
                    'HTTP requests dengan Dio',
                    'Firebase Authentication',
                    'Cloud Firestore database',
                ],
            ],
            [
                'day' => 5,
                'title' => 'Deployment & Publishing',
                'topics' => [
                    'Build APK dan App Bundle',
                    'iOS build configuration',
                    'Publishing to stores',
                ],
            ],
        ];

        foreach ($syllabusData as $index => $syllabus) {
            $trainingSyllabus = TrainingSyllabus::create([
                'training_id' => $training->id,
                'day' => $syllabus['day'],
                'title' => $syllabus['title'],
                'order_number' => $index + 1,
            ]);

            foreach ($syllabus['topics'] as $topicIndex => $topic) {
                TrainingSyllabusTopic::create([
                    'syllabus_id' => $trainingSyllabus->id,
                    'topic' => $topic,
                    'order_number' => $topicIndex + 1,
                ]);
            }
        }
    }

    private function seedDataScienceTrainingDetails(Training $training): void
    {
        // Learning Objectives
        $objectives = [
            'Menguasai fundamental Python untuk data science',
            'Melakukan data cleaning dan preprocessing',
            'Membuat visualisasi data yang informatif',
            'Menerapkan statistical analysis pada dataset',
            'Membangun model machine learning dasar',
            'Mengkomunikasikan hasil analisis data secara efektif',
        ];

        foreach ($objectives as $index => $objective) {
            TrainingLearningObjective::create([
                'training_id' => $training->id,
                'objective' => $objective,
                'order_number' => $index + 1,
            ]);
        }

        // Prerequisites
        $prerequisites = [
            'Pemahaman dasar programming',
            'Matematika dasar (statistik dan aljabar linear)',
            'Laptop dengan Python 3.8+ terinstall',
            'Motivasi untuk belajar data science',
        ];

        foreach ($prerequisites as $index => $prerequisite) {
            TrainingPrerequisite::create([
                'training_id' => $training->id,
                'prerequisite' => $prerequisite,
                'order_number' => $index + 1,
            ]);
        }

        // Materials
        $materials = [
            'Python Data Science Handbook (E-book)',
            'Jupyter Notebooks untuk setiap sesi',
            'Real-world datasets untuk praktik',
            'Akses ke online learning platform',
            'Certificate of completion',
        ];

        foreach ($materials as $index => $material) {
            TrainingMaterial::create([
                'training_id' => $training->id,
                'material' => $material,
                'order_number' => $index + 1,
            ]);
        }
    }

    private function seedBasicTrainingDetails(Training $training): void
    {
        // Basic Learning Objectives
        $objectives = [
            'Memahami konsep fundamental dari '.$training->title,
            'Menerapkan best practices dalam pengembangan',
            'Menyelesaikan project praktis',
            'Mendapatkan sertifikat kompetensi',
        ];

        foreach ($objectives as $index => $objective) {
            TrainingLearningObjective::create([
                'training_id' => $training->id,
                'objective' => $objective,
                'order_number' => $index + 1,
            ]);
        }

        // Basic Prerequisites
        $prerequisites = [
            'Pemahaman dasar programming',
            'Motivasi untuk belajar teknologi baru',
            'Laptop/komputer untuk praktik',
        ];

        foreach ($prerequisites as $index => $prerequisite) {
            TrainingPrerequisite::create([
                'training_id' => $training->id,
                'prerequisite' => $prerequisite,
                'order_number' => $index + 1,
            ]);
        }

        // Basic Materials
        $materials = [
            'Modul pelatihan digital',
            'Source code dan template',
            'Video recording sesi training',
            'Sertifikat digital',
        ];

        foreach ($materials as $index => $material) {
            TrainingMaterial::create([
                'training_id' => $training->id,
                'material' => $material,
                'order_number' => $index + 1,
            ]);
        }
    }
}
