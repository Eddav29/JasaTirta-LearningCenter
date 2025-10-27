<?php

namespace Database\Seeders;

use App\Models\TrainingCategory;
use Illuminate\Database\Seeder;

class TrainingCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Web Development',
                'description' => 'Pelajari pengembangan web modern termasuk frontend, backend, dan full-stack development menggunakan teknologi terkini seperti Laravel, React, Vue.js, dan Node.js.',
            ],
            [
                'name' => 'Mobile Development',
                'description' => 'Kuasai pengembangan aplikasi mobile untuk platform Android dan iOS menggunakan Flutter, React Native, dan teknologi mobile development terbaru.',
            ],
            [
                'name' => 'Data Science',
                'description' => 'Eksplorasi dunia data science, machine learning, dan analitik data menggunakan Python, R, dan tools modern untuk mengubah data menjadi insight yang berharga.',
            ],
            [
                'name' => 'Cybersecurity',
                'description' => 'Pelajari konsep keamanan siber, ethical hacking, penetration testing, dan best practices untuk melindungi sistem dan data dari ancaman cyber.',
            ],
            [
                'name' => 'Cloud Computing',
                'description' => 'Menguasai teknologi cloud computing dengan AWS, Google Cloud, dan Azure. Pelajari arsitektur cloud, deployment, dan manajemen infrastruktur modern.',
            ],
            [
                'name' => 'DevOps',
                'description' => 'Pelajari praktik DevOps, CI/CD, containerization dengan Docker, orchestration dengan Kubernetes, dan automation tools untuk meningkatkan efisiensi development.',
            ],
            [
                'name' => 'AI & Machine Learning',
                'description' => 'Jelajahi kecerdasan buatan dan machine learning. Pelajari deep learning, neural networks, dan implementasi AI dalam aplikasi nyata.',
            ],
            [
                'name' => 'UI/UX Design',
                'description' => 'Kuasai prinsip desain user interface dan user experience. Pelajari tools seperti Figma, Adobe XD, dan metodologi design thinking.',
            ],
            [
                'name' => 'Digital Marketing',
                'description' => 'Pelajari strategi digital marketing, SEO, SEM, social media marketing, content marketing, dan analytics untuk mengembangkan bisnis online.',
            ],
            [
                'name' => 'Project Management',
                'description' => 'Kuasai metodologi project management seperti Agile, Scrum, dan Waterfall. Pelajari tools dan best practices untuk mengelola proyek IT.',
            ],
        ];

        foreach ($categories as $category) {
            TrainingCategory::create($category);
        }
    }
}
