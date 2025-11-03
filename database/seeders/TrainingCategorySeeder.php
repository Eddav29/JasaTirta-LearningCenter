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
                'name' => 'Teknik Sampling',
                'description' => 'Pelatihan tentang teknik pengambilan sampel air dan lingkungan yang sesuai dengan standar nasional dan internasional. Meliputi prosedur sampling, preservasi sampel, dan dokumentasi.',
            ],
            [
                'name' => 'Analisis Laboratorium',
                'description' => 'Pelatihan analisis kualitas air dan parameter lingkungan di laboratorium menggunakan metode standar. Meliputi analisis fisika, kimia, dan mikrobiologi.',
            ],
            [
                'name' => 'Mikrobiologi Air',
                'description' => 'Pelatihan tentang analisis mikrobiologi dalam air meliputi deteksi bakteri patogen, coliform, dan mikroorganisme indikator kualitas air lainnya.',
            ],
            [
                'name' => 'Pengolahan Air',
                'description' => 'Pelatihan sistem pengolahan air bersih dan air limbah. Meliputi proses koagulasi, flokulasi, sedimentasi, filtrasi, disinfeksi, dan teknologi pengolahan modern.',
            ],
            [
                'name' => 'Instrumentasi Lab',
                'description' => 'Pelatihan penggunaan dan kalibrasi instrumen laboratorium seperti spektrofotometer, pH meter, turbidimeter, DO meter, dan instrumen analitik lainnya.',
            ],
            [
                'name' => 'Kalibrasi Alat',
                'description' => 'Pelatihan prosedur kalibrasi alat laboratorium sesuai standar ISO 17025. Meliputi verifikasi, validasi, dan dokumentasi kalibrasi.',
            ],
            [
                'name' => 'Keselamatan Kerja Lab',
                'description' => 'Pelatihan keselamatan dan kesehatan kerja di laboratorium. Meliputi penggunaan APD, penanganan bahan kimia berbahaya, dan prosedur keadaan darurat.',
            ],
            [
                'name' => 'Manajemen Kualitas',
                'description' => 'Pelatihan sistem manajemen kualitas laboratorium ISO 17025. Meliputi dokumentasi, internal audit, dan continuous improvement.',
            ],
            [
                'name' => 'Pengelolaan Limbah',
                'description' => 'Pelatihan pengelolaan limbah laboratorium dan limbah cair. Meliputi klasifikasi, treatment, dan disposal limbah B3 sesuai regulasi.',
            ],
            [
                'name' => 'Monitoring Lingkungan',
                'description' => 'Pelatihan monitoring kualitas lingkungan meliputi air permukaan, air tanah, air limbah, dan udara ambient sesuai peraturan perundangan.',
            ],
        ];

        foreach ($categories as $category) {
            TrainingCategory::create($category);
        }

        // Create additional random categories
        TrainingCategory::factory()->count(5)->create();
    }
}
