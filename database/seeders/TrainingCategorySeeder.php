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
                'name' => 'Analisis Lab',
                'description' => 'Pelatihan analisis kualitas air dan parameter lingkungan di laboratorium menggunakan metode standar. Meliputi analisis fisika, kimia, dan mikrobiologi dengan peralatan modern.',
            ],
            [
                'name' => 'Sampling Lingkungan',
                'description' => 'Pelatihan tentang teknik pengambilan contoh uji udara ambien, air, dan lingkungan yang sesuai dengan standar nasional dan internasional.',
            ],
            [
                'name' => 'Sampling Air',
                'description' => 'Pelatihan teknik pengambilan sampel air sungai, air tanah, dan air sumur sesuai dengan SNI. Meliputi prosedur sampling, preservasi sampel, dan dokumentasi.',
            ],
            [
                'name' => 'K3L',
                'description' => 'Pelatihan keselamatan, kesehatan kerja, dan lingkungan di laboratorium. Meliputi manajemen K3L, pengelolaan limbah, dan prosedur keadaan darurat.',
            ],
            [
                'name' => 'Analisis Data',
                'description' => 'Pelatihan analisis statistik dan interpretasi hasil pengujian kualitas air untuk pengambilan keputusan yang tepat dalam pengelolaan lingkungan.',
            ],
            [
                'name' => 'Manajemen',
                'description' => 'Pelatihan sistem manajemen mutu laboratorium sesuai ISO/IEC 17025. Meliputi audit internal, dokumentasi, dan continuous improvement.',
            ],
            [
                'name' => 'Kalibrasi',
                'description' => 'Pelatihan prosedur kalibrasi dan pemeliharaan instrument analisis kualitas air untuk memastikan akurasi dan keandalan hasil pengujian.',
            ],
        ];

        foreach ($categories as $category) {
            TrainingCategory::create($category);
        }
    }
}
