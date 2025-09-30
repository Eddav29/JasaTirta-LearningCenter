# Database Structure - JTLC Learning Center

## Overview
Struktur database ini dirancang berdasarkan analisis komprehensif dari semua pages yang ada dalam aplikasi JTLC Learning Center, meliputi: Register, Login, ForgotPassword, Pengajar, Kontak, Katalog, Jadwal, dan DetailPelatihan.

## Entitas dan Tabel Database

### 1. **users** (Tabel Pengguna)
Menyimpan data pengguna yang mendaftar melalui form register dan login.

| Field | Type | Constraint | Description |
|-------|------|------------|-------------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT | ID unik pengguna |
| first_name | VARCHAR(100) | NOT NULL | Nama depan |
| last_name | VARCHAR(100) | NOT NULL | Nama belakang |
| email | VARCHAR(255) | UNIQUE, NOT NULL | Email pengguna |
| phone | VARCHAR(20) | NULL | Nomor telepon |
| password | VARCHAR(255) | NOT NULL | Password terenkripsi |
| email_verified | BOOLEAN | DEFAULT FALSE | Status verifikasi email |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Waktu pembuatan akun |
| updated_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | Waktu update terakhir |

### 2. **instructors** (Tabel Pengajar)
Menyimpan data pengajar internal dan vendor berdasarkan data dari page Pengajar.

| Field | Type | Constraint | Description |
|-------|------|------------|-------------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT | ID unik pengajar |
| name | VARCHAR(255) | NOT NULL | Nama lengkap pengajar |
| specialization | VARCHAR(255) | NOT NULL | Spesialisasi bidang keahlian |
| education | VARCHAR(255) | NOT NULL | Riwayat pendidikan |
| experience | VARCHAR(50) | NOT NULL | Pengalaman kerja (contoh: "15+ tahun") |
| bio | TEXT | NOT NULL | Biografi singkat |
| email | VARCHAR(255) | NOT NULL | Email pengajar |
| phone | VARCHAR(20) | NOT NULL | Nomor telepon |
| image | VARCHAR(255) | NULL | URL foto pengajar |
| instructor_type | ENUM('internal', 'vendor') | NOT NULL | Tipe pengajar |
| company | VARCHAR(255) | NULL | Nama perusahaan (untuk vendor) |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Waktu pembuatan data |
| updated_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | Waktu update terakhir |

### 3. **instructor_certifications** (Tabel Sertifikasi Pengajar)
Menyimpan sertifikasi yang dimiliki oleh setiap pengajar.

| Field | Type | Constraint | Description |
|-------|------|------------|-------------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT | ID unik sertifikasi |
| instructor_id | INT | NOT NULL, FOREIGN KEY | Referensi ke tabel instructors |
| certification_name | VARCHAR(255) | NOT NULL | Nama sertifikasi |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Waktu pembuatan data |

**Relasi: One-to-Many**
- Satu instructor dapat memiliki banyak certifications
- `instructors(id) -> instructor_certifications(instructor_id)`

### 4. **training_categories** (Tabel Kategori Pelatihan)
Menyimpan kategori pelatihan yang tersedia.

| Field | Type | Constraint | Description |
|-------|------|------------|-------------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT | ID unik kategori |
| name | VARCHAR(100) | UNIQUE, NOT NULL | Nama kategori |
| description | TEXT | NULL | Deskripsi kategori |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Waktu pembuatan data |

### 5. **trainings** (Tabel Pelatihan)
Menyimpan data pelatihan berdasarkan informasi dari Katalog dan DetailPelatihan.

| Field | Type | Constraint | Description |
|-------|------|------------|-------------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT | ID unik pelatihan |
| title | VARCHAR(255) | NOT NULL | Judul pelatihan |
| category_id | INT | NOT NULL, FOREIGN KEY | Referensi ke training_categories |
| instructor_id | INT | NOT NULL, FOREIGN KEY | Referensi ke instructors |
| description | TEXT | NOT NULL | Deskripsi singkat |
| long_description | TEXT | NULL | Deskripsi detail |
| duration | VARCHAR(50) | NOT NULL | Durasi pelatihan (contoh: "3 Hari") |
| price | DECIMAL(10,2) | NOT NULL | Harga pelatihan |
| capacity | INT | NOT NULL | Kapasitas peserta |
| image | VARCHAR(255) | NULL | URL gambar pelatihan |
| training_type | ENUM('offline', 'online', 'hybrid') | NOT NULL | Tipe pelatihan |
| rating | DECIMAL(2,1) | DEFAULT 0 | Rating rata-rata |
| review_count | INT | DEFAULT 0 | Jumlah review |
| learning_hours | VARCHAR(10) | NULL | Jam pelajaran (contoh: "14 JP") |
| training_methods | TEXT | NULL | Metode pelatihan |
| certification_note | TEXT | NULL | Catatan sertifikasi |
| is_active | BOOLEAN | DEFAULT TRUE | Status aktif pelatihan |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Waktu pembuatan data |
| updated_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | Waktu update terakhir |

**Relasi: Many-to-One**
- Banyak trainings dapat memiliki satu category
- `training_categories(id) -> trainings(category_id)`
- Banyak trainings dapat memiliki satu instructor utama
- `instructors(id) -> trainings(instructor_id)`

### 6. **training_learning_objectives** (Tabel Tujuan Pembelajaran)
Menyimpan tujuan pembelajaran untuk setiap pelatihan.

| Field | Type | Constraint | Description |
|-------|------|------------|-------------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT | ID unik tujuan |
| training_id | INT | NOT NULL, FOREIGN KEY | Referensi ke tabel trainings |
| objective | TEXT | NOT NULL | Tujuan pembelajaran |
| order_number | INT | NOT NULL | Urutan tujuan |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Waktu pembuatan data |

**Relasi: One-to-Many**
- Satu training dapat memiliki banyak learning objectives
- `trainings(id) -> training_learning_objectives(training_id)`

### 7. **training_prerequisites** (Tabel Prasyarat Pelatihan)
Menyimpan prasyarat untuk mengikuti pelatihan.

| Field | Type | Constraint | Description |
|-------|------|------------|-------------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT | ID unik prasyarat |
| training_id | INT | NOT NULL, FOREIGN KEY | Referensi ke tabel trainings |
| prerequisite | TEXT | NOT NULL | Prasyarat |
| order_number | INT | NOT NULL | Urutan prasyarat |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Waktu pembuatan data |

**Relasi: One-to-Many**
- Satu training dapat memiliki banyak prerequisites
- `trainings(id) -> training_prerequisites(training_id)`

### 8. **training_materials** (Tabel Materi Pelatihan)
Menyimpan daftar materi yang disediakan dalam pelatihan.

| Field | Type | Constraint | Description |
|-------|------|------------|-------------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT | ID unik materi |
| training_id | INT | NOT NULL, FOREIGN KEY | Referensi ke tabel trainings |
| material | VARCHAR(255) | NOT NULL | Nama materi |
| order_number | INT | NOT NULL | Urutan materi |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Waktu pembuatan data |

**Relasi: One-to-Many**
- Satu training dapat memiliki banyak materials
- `trainings(id) -> training_materials(training_id)`

### 9. **training_target_audience** (Tabel Target Peserta)
Menyimpan target audiens untuk setiap pelatihan.

| Field | Type | Constraint | Description |
|-------|------|------------|-------------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT | ID unik target |
| training_id | INT | NOT NULL, FOREIGN KEY | Referensi ke tabel trainings |
| audience | VARCHAR(255) | NOT NULL | Target audiens |
| order_number | INT | NOT NULL | Urutan target |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Waktu pembuatan data |

**Relasi: One-to-Many**
- Satu training dapat memiliki banyak target audience
- `trainings(id) -> training_target_audience(training_id)`

### 10. **training_evaluation_methods** (Tabel Metode Evaluasi)
Menyimpan metode evaluasi untuk setiap pelatihan.

| Field | Type | Constraint | Description |
|-------|------|------------|-------------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT | ID unik evaluasi |
| training_id | INT | NOT NULL, FOREIGN KEY | Referensi ke tabel trainings |
| method | VARCHAR(255) | NOT NULL | Metode evaluasi |
| order_number | INT | NOT NULL | Urutan metode |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Waktu pembuatan data |

**Relasi: One-to-Many**
- Satu training dapat memiliki banyak evaluation methods
- `trainings(id) -> training_evaluation_methods(training_id)`

### 11. **training_schedules** (Tabel Jadwal Pelatihan)
Menyimpan jadwal pelaksanaan pelatihan berdasarkan data dari Jadwal dan DetailPelatihan.

| Field | Type | Constraint | Description |
|-------|------|------------|-------------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT | ID unik jadwal |
| training_id | INT | NOT NULL, FOREIGN KEY | Referensi ke tabel trainings |
| start_date | DATE | NOT NULL | Tanggal mulai |
| end_date | DATE | NOT NULL | Tanggal selesai |
| start_time | TIME | NOT NULL | Waktu mulai |
| end_time | TIME | NOT NULL | Waktu selesai |
| location | VARCHAR(255) | NOT NULL | Lokasi pelatihan |
| method | ENUM('offline', 'online', 'hybrid') | NOT NULL | Metode pelaksanaan |
| total_slots | INT | NOT NULL | Total slot peserta |
| available_slots | INT | NOT NULL | Slot tersedia |
| registered_count | INT | DEFAULT 0 | Jumlah peserta terdaftar |
| month | VARCHAR(20) | NOT NULL | Bulan pelaksanaan |
| status | ENUM('buka_pendaftaran', 'tutup_pendaftaran', 'berlangsung', 'penuh', 'selesai') | NOT NULL | Status jadwal |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Waktu pembuatan data |
| updated_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | Waktu update terakhir |

**Relasi: One-to-Many**
- Satu training dapat memiliki banyak schedules
- `trainings(id) -> training_schedules(training_id)`

### 12. **training_syllabus** (Tabel Silabus Pelatihan)
Menyimpan silabus per hari untuk setiap pelatihan.

| Field | Type | Constraint | Description |
|-------|------|------------|-------------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT | ID unik silabus |
| training_id | INT | NOT NULL, FOREIGN KEY | Referensi ke tabel trainings |
| day | VARCHAR(20) | NOT NULL | Hari (contoh: "Hari 1") |
| title | VARCHAR(255) | NOT NULL | Judul materi hari tersebut |
| order_number | INT | NOT NULL | Urutan hari |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Waktu pembuatan data |

**Relasi: One-to-Many**
- Satu training dapat memiliki banyak syllabus (per hari)
- `trainings(id) -> training_syllabus(training_id)`

### 13. **training_syllabus_topics** (Tabel Topik Silabus)
Menyimpan topik detail untuk setiap hari dalam silabus.

| Field | Type | Constraint | Description |
|-------|------|------------|-------------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT | ID unik topik |
| syllabus_id | INT | NOT NULL, FOREIGN KEY | Referensi ke training_syllabus |
| topic | VARCHAR(255) | NOT NULL | Topik pembahasan |
| order_number | INT | NOT NULL | Urutan topik |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Waktu pembuatan data |

**Relasi: One-to-Many**
- Satu syllabus dapat memiliki banyak topics
- `training_syllabus(id) -> training_syllabus_topics(syllabus_id)`

### 14. **instructor_courses** (Tabel Relasi Pengajar - Pelatihan)
Menyimpan relasi many-to-many antara pengajar dan pelatihan yang mereka ampu.

| Field | Type | Constraint | Description |
|-------|------|------------|-------------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT | ID unik relasi |
| instructor_id | INT | NOT NULL, FOREIGN KEY | Referensi ke instructors |
| training_id | INT | NOT NULL, FOREIGN KEY | Referensi ke trainings |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Waktu pembuatan relasi |

**Relasi: Many-to-Many**
- Satu instructor dapat mengajar banyak trainings
- Satu training dapat diajar oleh banyak instructors (meskipun ada instructor utama)
- `instructors(id) -> instructor_courses(instructor_id)`
- `trainings(id) -> instructor_courses(training_id)`

### 15. **contact_messages** (Tabel Pesan Kontak)
Menyimpan pesan yang dikirim melalui form kontak.

| Field | Type | Constraint | Description |
|-------|------|------------|-------------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT | ID unik pesan |
| name | VARCHAR(255) | NOT NULL | Nama pengirim |
| email | VARCHAR(255) | NOT NULL | Email pengirim |
| phone | VARCHAR(20) | NULL | Nomor telepon |
| company | VARCHAR(255) | NULL | Nama perusahaan |
| subject | VARCHAR(255) | NOT NULL | Subjek pesan |
| message | TEXT | NOT NULL | Isi pesan |
| status | ENUM('unread', 'read', 'replied') | DEFAULT 'unread' | Status pesan |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Waktu pengiriman |
| updated_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | Waktu update status |

### 16. **user_training_registrations** (Tabel Pendaftaran Pelatihan)
Menyimpan data pendaftaran pengguna ke pelatihan tertentu.

| Field | Type | Constraint | Description |
|-------|------|------------|-------------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT | ID unik pendaftaran |
| user_id | INT | NOT NULL, FOREIGN KEY | Referensi ke users |
| training_schedule_id | INT | NOT NULL, FOREIGN KEY | Referensi ke training_schedules |
| registration_date | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Tanggal pendaftaran |
| status | ENUM('pending', 'confirmed', 'cancelled', 'completed') | DEFAULT 'pending' | Status pendaftaran |
| payment_status | ENUM('unpaid', 'paid', 'refunded') | DEFAULT 'unpaid' | Status pembayaran |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Waktu pembuatan data |
| updated_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | Waktu update terakhir |

**Relasi: Many-to-Many melalui junction table**
- Satu user dapat mendaftar ke banyak training schedules
- Satu training schedule dapat diikuti oleh banyak users
- `users(id) -> user_training_registrations(user_id)`
- `training_schedules(id) -> user_training_registrations(training_schedule_id)`

### 17. **training_reviews** (Tabel Review Pelatihan)
Menyimpan review dan rating dari peserta pelatihan.

| Field | Type | Constraint | Description |
|-------|------|------------|-------------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT | ID unik review |
| user_id | INT | NOT NULL, FOREIGN KEY | Referensi ke users |
| training_id | INT | NOT NULL, FOREIGN KEY | Referensi ke trainings |
| rating | INT | CHECK (rating >= 1 AND rating <= 5) | Rating 1-5 |
| review_text | TEXT | NULL | Teks review |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Waktu pembuatan review |

**Relasi: Many-to-One**
- Banyak reviews dapat dibuat oleh satu user
- Banyak reviews dapat diberikan untuk satu training
- `users(id) -> training_reviews(user_id)`
- `trainings(id) -> training_reviews(training_id)`

## Ringkasan Relasi Database

### One-to-One (1:1)
Tidak ada relasi one-to-one dalam struktur database ini.

### One-to-Many (1:N)
1. **instructors -> instructor_certifications**
   - Satu pengajar dapat memiliki banyak sertifikasi

2. **training_categories -> trainings**
   - Satu kategori dapat memiliki banyak pelatihan

3. **instructors -> trainings**
   - Satu pengajar (utama) dapat mengampu banyak pelatihan

4. **trainings -> training_learning_objectives**
   - Satu pelatihan dapat memiliki banyak tujuan pembelajaran

5. **trainings -> training_prerequisites**
   - Satu pelatihan dapat memiliki banyak prasyarat

6. **trainings -> training_materials**
   - Satu pelatihan dapat memiliki banyak materi

7. **trainings -> training_target_audience**
   - Satu pelatihan dapat memiliki banyak target audiens

8. **trainings -> training_evaluation_methods**
   - Satu pelatihan dapat memiliki banyak metode evaluasi

9. **trainings -> training_schedules**
   - Satu pelatihan dapat memiliki banyak jadwal

10. **trainings -> training_syllabus**
    - Satu pelatihan dapat memiliki banyak silabus (per hari)

11. **training_syllabus -> training_syllabus_topics**
    - Satu silabus dapat memiliki banyak topik

12. **users -> training_reviews**
    - Satu user dapat memberikan banyak review

13. **trainings -> training_reviews**
    - Satu pelatihan dapat menerima banyak review

### Many-to-Many (M:N)
1. **instructors <-> trainings (melalui instructor_courses)**
   - Satu pengajar dapat mengajar banyak pelatihan
   - Satu pelatihan dapat diajar oleh banyak pengajar

2. **users <-> training_schedules (melalui user_training_registrations)**
   - Satu user dapat mendaftar ke banyak jadwal pelatihan
   - Satu jadwal pelatihan dapat diikuti oleh banyak user

## Indeks yang Direkomendasikan

```sql
-- Indeks untuk performa query
CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_trainings_category ON trainings(category_id);
CREATE INDEX idx_trainings_instructor ON trainings(instructor_id);
CREATE INDEX idx_training_schedules_training ON training_schedules(training_id);
CREATE INDEX idx_training_schedules_date ON training_schedules(start_date, end_date);
CREATE INDEX idx_user_registrations_user ON user_training_registrations(user_id);
CREATE INDEX idx_user_registrations_schedule ON user_training_registrations(training_schedule_id);
CREATE INDEX idx_contact_messages_status ON contact_messages(status);
CREATE INDEX idx_training_reviews_training ON training_reviews(training_id);
CREATE INDEX idx_training_reviews_user ON training_reviews(user_id);
```

## Catatan Implementasi

1. **Password Security**: Password dalam tabel users harus selalu dienkripsi menggunakan bcrypt atau algoritma hashing yang aman.

2. **Email Verification**: Sistem verifikasi email diperlukan untuk keamanan akun pengguna.

3. **Soft Delete**: Pertimbangkan implementasi soft delete untuk data penting seperti users dan trainings.

4. **Audit Trail**: Untuk tabel penting, pertimbangkan menambahkan kolom audit seperti created_by dan updated_by.

5. **Data Validation**: Implementasikan validasi data baik di level aplikasi maupun database constraint.

6. **Backup Strategy**: Karena data pelatihan dan registrasi sangat penting, implementasikan strategi backup yang robust.

Struktur database ini dirancang untuk mendukung semua fitur yang terlihat dalam aplikasi JTLC Learning Center, mulai dari manajemen pengguna, katalog pelatihan, penjadwalan, hingga sistem review dan rating.