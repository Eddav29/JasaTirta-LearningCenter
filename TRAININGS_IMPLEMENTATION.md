# Implementasi Halaman Trainings dengan Database

## Ringkasan Perubahan

Halaman trainings telah diupdate untuk membaca data dari database dengan fitur pagination, search, filter, dan bulk actions.

## Fitur yang Diimplementasikan

### 1. Controller (`TrainingController`)
- **Method `index()`**: Menampilkan daftar training dengan pagination
  - Search: berdasarkan title, description, category, dan instructor
  - Filter: category, level, status, instructor
  - Pagination: Laravel pagination dengan query string preserved
  - Statistics: total trainings, active trainings, total participants, average rating

- **Method `bulkDelete()`**: Menghapus multiple trainings sekaligus
- **Method `bulkUpdateStatus()`**: Mengaktifkan/menonaktifkan multiple trainings sekaligus

### 2. Views

#### `index.blade.php`
- Menampilkan flash messages (success/error)
- Mengintegrasikan semua komponen

#### `_search-filter.blade.php`
- Form pencarian dengan GET method
- Filter dropdown untuk category, level, status, dan instructor
- Button reset filter
- Auto-submit saat memilih filter

#### `_table.blade.php`
- Checkbox untuk select all/individual
- Bulk actions bar (muncul saat ada item terpilih):
  - Aktifkan pelatihan
  - Non-aktifkan pelatihan
  - Hapus pelatihan
- Display data dari database dengan relasi
- Laravel pagination links

#### `_statistics.blade.php`
- Statistik real-time dari database:
  - Total pelatihan
  - Pelatihan aktif
  - Total peserta
  - Rating rata-rata

### 3. Routes
```php
// Trainings routes
Route::get('/trainings', [TrainingController::class, 'index'])->name('trainings.index');
Route::post('/trainings/bulk-delete', [TrainingController::class, 'bulkDelete'])->name('trainings.bulk-delete');
Route::post('/trainings/bulk-status', [TrainingController::class, 'bulkUpdateStatus'])->name('trainings.bulk-status');
```

## Cara Menggunakan

### Search & Filter
1. Ketik kata kunci di search box untuk mencari trainings
2. Pilih category, level, status, atau instructor dari dropdown
3. Klik tombol "Cari" atau dropdown akan auto-submit
4. Klik tombol "Reset" untuk menghapus semua filter

### Bulk Actions
1. Centang checkbox di header untuk select all atau centang individual rows
2. Bulk actions bar akan muncul menampilkan jumlah item terpilih
3. Pilih aksi yang diinginkan:
   - **Aktifkan**: Set status semua training terpilih menjadi active
   - **Non-aktifkan**: Set status semua training terpilih menjadi inactive
   - **Hapus**: Hapus semua training terpilih (dengan konfirmasi)
4. Klik "Batal" untuk membatalkan seleksi

### Pagination
- Gunakan tombol "Previous" dan "Next" untuk navigasi
- Pagination otomatis mempertahankan filter yang sedang aktif

## Database Relations yang Digunakan

- `Training` belongsTo `TrainingCategory`
- `Training` belongsTo `Instructor`
- `Training` hasMany `TrainingSchedule`

## Validasi

### Bulk Delete
- `ids`: required, harus berupa JSON array

### Bulk Update Status
- `ids`: required, harus berupa JSON array
- `is_active`: required, boolean (0 atau 1)

## Flash Messages

Success dan error messages ditampilkan di bagian atas halaman dengan auto-hide setelah 5 detik.

## Technical Notes

- Menggunakan Alpine.js untuk interaktivitas checkbox dan bulk actions
- Data pagination menggunakan Laravel's built-in pagination
- Query string preserved untuk filter dan pagination
- CSRF protection untuk semua POST requests
- Soft delete tidak diimplementasikan (hard delete)
