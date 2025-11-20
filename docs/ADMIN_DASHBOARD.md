# Admin Dashboard

## Overview
Dashboard admin untuk Jasa Tirta Learning Center yang telah disesuaikan dari desain React menjadi Laravel Blade dengan Tailwind CSS v4.

## Struktur File

### Layout
- `resources/views/layouts/admin.blade.php` - Main layout dengan Alpine.js untuk sidebar toggle
- `resources/views/layouts/admin/_sidebar.blade.php` - Sidebar navigasi dengan collapse/expand functionality
- `resources/views/layouts/admin/_navbar.blade.php` - Top navigation bar dengan search, notifications, dan profile dropdown

### Dashboard Sections
- `resources/views/pages/admin/dashboard/index.blade.php` - Main orchestrator
- `resources/views/pages/admin/dashboard/_header.blade.php` - Header dengan tombol aksi
- `resources/views/pages/admin/dashboard/_stats.blade.php` - 4 kartu statistik utama
- `resources/views/pages/admin/dashboard/_activities-and-popular.blade.php` - Recent activities & popular trainings
- `resources/views/pages/admin/dashboard/_upcoming-schedules.blade.php` - Tabel jadwal mendatang

## Fitur

### 1. Statistics Cards (4 Cards)
- **Total Pengguna**: 1,247 (+12% dari bulan lalu)
- **Pelatihan Aktif**: 23 (+3 program berjalan)
- **Jadwal Bulan Ini**: 18 (+5 sesi terjadwal)
- **Pendapatan**: Rp 125M (+8.5% dari target)

### 2. Recent Activities
5 aktivitas terbaru dengan icon berwarna:
- Pendaftaran Baru (green)
- Jadwal Ditambahkan (blue)
- Pelatihan Selesai (purple)
- Pesan Kontak Baru (orange)
- Program Baru (indigo)

### 3. Popular Trainings
4 pelatihan terpopuler dengan:
- Progress bar peserta
- Status badge (Aktif/Penuh)
- Growth percentage
- Revenue data

### 4. Upcoming Schedules
Tabel jadwal mendatang dengan kolom:
- Pelatihan
- Tanggal & Waktu
- Peserta (dengan mini progress bar)
- Pengajar
- Status (Terkonfirmasi/Penuh/Terbuka)
- Aksi

### 5. Sidebar Navigation
Menu navigasi dengan 3 kelompok:
- **Main**: Dashboard, Pelatihan, Jadwal, Pengajar, Peserta
- **Manajemen**: Kategori, Pesan, Laporan
- **Pengaturan**: Pengguna, Pengaturan

Fitur sidebar:
- Collapse/Expand dengan animasi
- Active state highlighting
- Icons untuk setiap menu
- Responsive untuk mobile

### 6. Top Navbar
- Search bar (desktop only)
- Notification bell dengan badge
- Profile dropdown dengan:
  - Profil Saya
  - Pengaturan
  - Lihat Website
  - Keluar

## Routes

```php
/admin/dashboard              -> Dashboard utama
/admin/trainings              -> Daftar pelatihan (placeholder)
/admin/trainings/create       -> Buat pelatihan baru (placeholder)
/admin/schedules              -> Daftar jadwal (placeholder)
/admin/instructors            -> Daftar pengajar (placeholder)
/admin/participants           -> Daftar peserta (placeholder)
/admin/categories             -> Daftar kategori (placeholder)
/admin/messages               -> Daftar pesan (placeholder)
/admin/reports                -> Laporan (placeholder)
/admin/users                  -> Daftar pengguna (placeholder)
/admin/settings               -> Pengaturan (placeholder)
/admin/profile                -> Profil admin (placeholder)
```

## Teknologi

- **Laravel 12**: Backend framework
- **Blade**: Templating engine
- **Alpine.js**: JavaScript reactivity untuk sidebar toggle dan dropdowns
- **Tailwind CSS v4**: Styling dengan utility classes
- **Modular Architecture**: Setiap section dipisah ke file partial

## Alpine.js State Management

```javascript
x-data="{
  sidebarOpen: true,      // Sidebar collapse/expand state
  profileOpen: false      // Profile dropdown state
}"
```

## Responsive Design

- **Mobile**: Sidebar sebagai drawer dengan overlay
- **Tablet**: Sidebar tetap visible dengan collapse
- **Desktop**: Full sidebar dengan smooth transitions

## Color Scheme

- **Primary**: Blue-600 (#2563eb)
- **Success**: Green-600
- **Danger**: Red-600
- **Warning**: Yellow-600
- **Info**: Purple-600, Indigo-600, Orange-600

## Status Badges

### Training Status
- `active` → Hijau (Aktif)
- `full` → Merah (Penuh)

### Schedule Status
- `confirmed` → Biru (Terkonfirmasi)
- `full` → Merah (Penuh)
- `open` → Kuning (Terbuka)

## Next Steps

Untuk melanjutkan development:

1. **Backend Integration**: Hubungkan dengan database dan Eloquent models
2. **Authentication**: Implementasi middleware untuk proteksi routes
3. **CRUD Operations**: Buat halaman untuk create, read, update, delete
4. **Real-time Updates**: Implementasi notifications dengan broadcasting
5. **Charts & Analytics**: Tambahkan visualisasi data dengan Chart.js/ApexCharts
6. **Export Features**: Implementasi export laporan ke PDF/Excel
7. **Search & Filter**: Implementasi search functionality di navbar
8. **Pagination**: Tambahkan pagination untuk tabel dan list

## Catatan

- Semua data saat ini adalah **dummy data** untuk demonstrasi UI
- Routes selain `/admin/dashboard` masih **placeholder**
- Logout functionality memerlukan authentication system yang aktif
- Notification badge di navbar masih **static**
