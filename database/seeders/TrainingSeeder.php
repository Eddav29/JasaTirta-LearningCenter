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
        // Ambil kategori dan instruktur
        $categories = TrainingCategory::all()->keyBy('name');
        $instructors = Instructor::all()->keyBy('name');

        // Pastikan ada data kategori dan instruktur
        if ($categories->isEmpty() || $instructors->isEmpty()) {
            $this->command->error('Pastikan kategori dan instruktur sudah di-seed terlebih dahulu!');

            return;
        }

        $trainings = [
            [
                'title' => 'Pelatihan Spektrofotometri UV-Vis',
                'category_id' => $categories->get('Analisis Lab')?->id,
                'instructor_id' => $instructors->get('Dr. Sari Indrawati')?->id,
                'description' => 'Pelatihan komprehensif penggunaan spektrofotometer UV-Vis untuk analisis kualitatif dan kuantitatif. Mencakup teori dasar, kalibrasi instrumen, dan teknik analisis sesuai standar.',
                'long_description' => 'Pelatihan komprehensif penggunaan spektrofotometer UV-Vis untuk analisis kualitatif dan kuantitatif. Mencakup teori dasar spektroskopi, kalibrasi instrumen, preparasi sampel, pembuatan kurva kalibrasi, validasi metode, dan teknik analisis sesuai standar. Peserta akan mendapatkan hands-on experience dengan instrumen UV-Vis terkini dan berbagai aplikasi analisis.',
                'duration' => '3 Hari',
                'price' => 3500000,
                'capacity' => 20,
                'training_type' => 'offline',
                'rating' => 4.8,
                'review_count' => 95,
                'learning_hours' => 24,
                'training_methods' => 'Lecture, Hands-on Lab, Case Study, Practice Session',
                'certification_note' => 'Sertifikat kompetensi akan diberikan setelah menyelesaikan ujian praktik',
                'is_active' => true,
            ],
            [
                'title' => 'Pelatihan Petugas Pengambilan Contoh Uji Udara Ambien / Sampling Udara Ambien',
                'category_id' => $categories->get('Sampling Lingkungan')?->id,
                'instructor_id' => $instructors->get('Ir. Bambang Suryanto')?->id,
                'description' => 'Pelatihan khusus untuk petugas pengambilan contoh uji udara ambien dengan metode sampling yang sesuai dengan peraturan dan standar nasional.',
                'long_description' => 'Pelatihan khusus untuk petugas pengambilan contoh uji udara ambien dengan metode sampling yang sesuai dengan peraturan dan standar nasional. Mencakup pemahaman tentang parameter udara ambien, teknik sampling, penggunaan alat, chain of custody, dan dokumentasi. Peserta akan dilatih langsung di lapangan dengan berbagai kondisi.',
                'duration' => '2 Hari',
                'price' => 2800000,
                'capacity' => 16,
                'training_type' => 'offline',
                'rating' => 4.7,
                'review_count' => 68,
                'learning_hours' => 14,
                'training_methods' => 'Theory, Field Practice, Equipment Operation, Documentation',
                'certification_note' => 'Sertifikat petugas sampling udara ambien sesuai standar nasional',
                'is_active' => true,
            ],
            [
                'title' => 'Teknik Sampling Air Sungai Sesuai SNI',
                'category_id' => $categories->get('Sampling Air')?->id,
                'instructor_id' => $instructors->get('Dr. Ahmad Hidayat')?->id,
                'description' => 'Pelatihan komprehensif teknik pengambilan contoh air sungai yang tepat sesuai dengan standar SNI 6989.57:2008. Mencakup teori dasar, praktik lapangan, dan sertifikasi kompetensi.',
                'long_description' => 'Pelatihan komprehensif teknik pengambilan contoh air sungai yang tepat sesuai dengan standar SNI 6989.57:2008. Mencakup teori dasar sampling air, pemilihan titik sampling, teknik pengambilan sampel komposit dan grab sample, preservasi sampel, chain of custody, praktik lapangan langsung di sungai, dan dokumentasi sesuai standar.',
                'duration' => '3 Hari',
                'price' => 2500000,
                'capacity' => 20,
                'training_type' => 'offline',
                'rating' => 4.6,
                'review_count' => 78,
                'learning_hours' => 21,
                'training_methods' => 'Classroom Session, Field Practice, Documentation Training',
                'certification_note' => 'Sertifikat kompetensi sampling air sungai SNI',
                'is_active' => true,
            ],
            [
                'title' => 'Analisis Kualitas Air Laboratorium',
                'category_id' => $categories->get('Analisis Lab')?->id,
                'instructor_id' => $instructors->get('Prof. Dr. Sari Wahyuni')?->id,
                'description' => 'Metode analisis parameter fisik, kimia, dan biologi air menggunakan peralatan laboratorium modern. Pelatihan hands-on dengan instrumen terkini.',
                'long_description' => 'Metode analisis parameter fisik, kimia, dan biologi air menggunakan peralatan laboratorium modern. Mencakup analisis pH, turbidity, TDS, TSS, DO, BOD, COD, ammonia, nitrat, nitrit, fosfat, logam berat, dan parameter mikrobiologi. Pelatihan hands-on dengan instrumen terkini seperti spektrofotometer, ion chromatography, AAS, dan mikroskop.',
                'duration' => '5 Hari',
                'price' => 4200000,
                'capacity' => 15,
                'training_type' => 'offline',
                'rating' => 4.9,
                'review_count' => 112,
                'learning_hours' => 40,
                'training_methods' => 'Theory, Laboratory Practice, Instrument Training, Data Analysis',
                'certification_note' => 'Sertifikat analis kualitas air laboratorium',
                'is_active' => true,
            ],
            [
                'title' => 'Manajemen K3L Laboratorium Air',
                'category_id' => $categories->get('K3L')?->id,
                'instructor_id' => $instructors->get('Ir. Budi Santoso')?->id,
                'description' => 'Sistem manajemen keselamatan, kesehatan kerja, dan lingkungan khusus untuk laboratorium analisis air. Includes risk assessment dan emergency procedures.',
                'long_description' => 'Sistem manajemen keselamatan, kesehatan kerja, dan lingkungan khusus untuk laboratorium analisis air. Mencakup identifikasi bahaya, risk assessment, penggunaan APD, penanganan bahan kimia berbahaya, MSDS, prosedur emergency, pertolongan pertama, pengelolaan limbah B3, dan sistem dokumentasi K3L. Includes praktik simulasi emergency procedures.',
                'duration' => '2 Hari',
                'price' => 1800000,
                'capacity' => 25,
                'training_type' => 'hybrid',
                'rating' => 4.5,
                'review_count' => 89,
                'learning_hours' => 16,
                'training_methods' => 'Lecture, Case Study, Emergency Drill, Risk Assessment Workshop',
                'certification_note' => 'Sertifikat K3L laboratorium',
                'is_active' => true,
            ],
            [
                'title' => 'Sampling Air Tanah dan Sumur',
                'category_id' => $categories->get('Sampling Air')?->id,
                'instructor_id' => $instructors->get('Dr. Rina Marlina')?->id,
                'description' => 'Teknik khusus pengambilan sampel air tanah dan air sumur untuk berbagai keperluan analisis lingkungan dan monitoring kualitas.',
                'long_description' => 'Teknik khusus pengambilan sampel air tanah dan air sumur untuk berbagai keperluan analisis lingkungan dan monitoring kualitas. Mencakup pemahaman hidrogeologi dasar, karakteristik akuifer, teknik purging, penggunaan well bailer dan pump sampler, parameter field measurement, preservasi sampel, dan quality assurance. Praktik langsung di lapangan dengan berbagai jenis sumur.',
                'duration' => '3 Hari',
                'price' => 2800000,
                'capacity' => 18,
                'training_type' => 'offline',
                'rating' => 4.7,
                'review_count' => 65,
                'learning_hours' => 24,
                'training_methods' => 'Theory, Field Practice, Equipment Operation, QA/QC Training',
                'certification_note' => 'Sertifikat petugas sampling air tanah',
                'is_active' => true,
            ],
            [
                'title' => 'Interpretasi Data Kualitas Air',
                'category_id' => $categories->get('Analisis Data')?->id,
                'instructor_id' => $instructors->get('Dr. Indra Kusuma')?->id,
                'description' => 'Analisis statistik dan interpretasi hasil pengujian kualitas air untuk pengambilan keputusan yang tepat dalam pengelolaan lingkungan.',
                'long_description' => 'Analisis statistik dan interpretasi hasil pengujian kualitas air untuk pengambilan keputusan yang tepat dalam pengelolaan lingkungan. Mencakup dasar statistik, uji validitas data, analisis trend, korelasi parameter, perbandingan dengan baku mutu, penyusunan laporan teknis, dan visualisasi data menggunakan software statistik dan Excel. Studi kasus real dari berbagai sumber air.',
                'duration' => '2 Hari',
                'price' => 1500000,
                'capacity' => 30,
                'training_type' => 'online',
                'rating' => 4.4,
                'review_count' => 45,
                'learning_hours' => 14,
                'training_methods' => 'Online Lecture, Software Tutorial, Case Study, Data Exercise',
                'certification_note' => 'Sertifikat digital interpretasi data kualitas air',
                'is_active' => true,
            ],
            [
                'title' => 'Mikrobiologi Air dan Sanitasi',
                'category_id' => $categories->get('Analisis Lab')?->id,
                'instructor_id' => $instructors->get('Dr. Maya Sari')?->id,
                'description' => 'Analisis mikrobiologi air minum, air limbah, dan air permukaan. Mencakup identifikasi bakteri patogen dan indikator sanitasi.',
                'long_description' => 'Analisis mikrobiologi air minum, air limbah, dan air permukaan. Mencakup teknik aseptik, preparasi media kultur, metode MPN dan membrane filtration, identifikasi E.coli dan coliform, deteksi Salmonella, kultur bakteri patogen, uji konfirmasi, interpretasi hasil, dan quality control. Praktik intensif di laboratorium mikrobiologi dengan berbagai jenis sampel air.',
                'duration' => '4 Hari',
                'price' => 3500000,
                'capacity' => 12,
                'training_type' => 'offline',
                'rating' => 4.8,
                'review_count' => 73,
                'learning_hours' => 32,
                'training_methods' => 'Laboratory Practice, Microorganism Identification, Culture Technique',
                'certification_note' => 'Sertifikat analis mikrobiologi air',
                'is_active' => true,
            ],
            [
                'title' => 'Audit Sistem Manajemen Laboratorium',
                'category_id' => $categories->get('Manajemen')?->id,
                'instructor_id' => $instructors->get('Ir. Hendra Wijaya')?->id,
                'description' => 'Pelatihan auditor internal untuk sistem manajemen mutu laboratorium sesuai ISO/IEC 17025. Teknik audit dan pelaporan yang efektif.',
                'long_description' => 'Pelatihan auditor internal untuk sistem manajemen mutu laboratorium sesuai ISO/IEC 17025:2017. Mencakup pemahaman requirement ISO 17025, teknik audit planning, pelaksanaan audit, interviewing technique, evidence gathering, penulisan temuan audit, non-conformity grading, corrective action review, dan pelaporan audit. Role play audit simulation dan studi kasus.',
                'duration' => '3 Hari',
                'price' => 3200000,
                'capacity' => 20,
                'training_type' => 'hybrid',
                'rating' => 4.6,
                'review_count' => 57,
                'learning_hours' => 24,
                'training_methods' => 'Lecture, Audit Simulation, Role Play, Case Study',
                'certification_note' => 'Sertifikat auditor internal ISO/IEC 17025',
                'is_active' => true,
            ],
            [
                'title' => 'Kalibrasi Alat Uji Kualitas Air',
                'category_id' => $categories->get('Kalibrasi')?->id,
                'instructor_id' => $instructors->get('Ir. Joko Susilo')?->id,
                'description' => 'Prosedur kalibrasi dan pemeliharaan instrument analisis kualitas air untuk memastikan akurasi dan keandalan hasil pengujian.',
                'long_description' => 'Prosedur kalibrasi dan pemeliharaan instrument analisis kualitas air untuk memastikan akurasi dan keandalan hasil pengujian. Mencakup konsep metrologi, kalibrasi pH meter, DO meter, turbidimeter, conductivity meter, spektrofotometer, timbangan analitik, pipet, glassware, pembuatan standar kalibrasi, curve fitting, uncertainty calculation, dan dokumentasi kalibrasi. Praktik kalibrasi berbagai instrumen.',
                'duration' => '2 Hari',
                'price' => 2200000,
                'capacity' => 16,
                'training_type' => 'offline',
                'rating' => 4.5,
                'review_count' => 41,
                'learning_hours' => 16,
                'training_methods' => 'Theory, Calibration Practice, Uncertainty Calculation, Documentation',
                'certification_note' => 'Sertifikat teknisi kalibrasi alat laboratorium',
                'is_active' => true,
            ],
            [
                'title' => 'Pengelolaan Limbah Laboratorium',
                'category_id' => $categories->get('K3L')?->id,
                'instructor_id' => $instructors->get('Dr. Lina Hartati')?->id,
                'description' => 'Manajemen limbah kimia dan biologi laboratorium sesuai peraturan lingkungan. Treatment dan disposal yang aman dan bertanggung jawab.',
                'long_description' => 'Manajemen limbah kimia dan biologi laboratorium sesuai peraturan lingkungan PP No. 22 Tahun 2021. Mencakup klasifikasi limbah B3, karakteristik limbah laboratorium, teknik minimisasi limbah, segregasi dan labeling, penyimpanan sementara, treatment limbah cair dan padat, prosedur disposal, manifest system, dokumentasi, dan pelaporan. Studi kasus pengelolaan limbah laboratorium yang effective.',
                'duration' => '2 Hari',
                'price' => 1900000,
                'capacity' => 22,
                'training_type' => 'offline',
                'rating' => 4.4,
                'review_count' => 36,
                'learning_hours' => 16,
                'training_methods' => 'Lecture, Site Visit, Practical Exercise, Regulation Study',
                'certification_note' => 'Sertifikat pengelolaan limbah B3 laboratorium',
                'is_active' => true,
            ],
        ];

        foreach ($trainings as $training) {
            Training::create($training);
        }

        $this->command->info('11 trainings created successfully!');
    }
}
