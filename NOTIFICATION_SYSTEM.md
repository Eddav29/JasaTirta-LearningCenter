# Notification System Implementation

## Overview
Sistem notifikasi otomatis untuk training baru dan jadwal training baru dengan fitur auto-delete setelah 30 hari.

## Features Implemented

### 1. Database Notification Channel
- ✅ Tabel `notifications` untuk menyimpan notifikasi
- ✅ Migration berhasil dijalankan

### 2. Notification Classes
**Location:** `app/Notifications/`

#### NewTrainingNotification
Notifikasi yang dikirim ketika training baru ditambahkan.
```php
// Data yang disimpan:
- type: 'new_training'
- training_id
- title: 'Training Baru: [Title]'
- message
- training_title
- category
- instructor
- duration, price
- url: link ke detail training
- icon: 'book-open'
- color: 'blue'
```

#### NewScheduleNotification
Notifikasi yang dikirim ketika jadwal training baru dibuat.
```php
// Data yang disimpan:
- type: 'new_schedule'
- schedule_id, training_id
- title: 'Jadwal Baru: [Training Title]'
- message
- training_title
- start_date, end_date
- location, method
- available_slots
- url: link ke detail jadwal
- icon: 'calendar'
- color: 'green'
```

### 3. Model Observers
**Location:** `app/Observers/`

#### TrainingObserver
- Mengirim notifikasi ke semua users dengan role `user`, `participant`, `admin`, dan `super-admin`
- Trigger: ketika training baru dibuat (`created` event)

#### ScheduleObserver
- Mengirim notifikasi ke semua users dengan role `user`, `participant`, `admin`, dan `super-admin`
- Trigger: ketika jadwal training baru dibuat (`created` event)

**Registered in:** `app/Providers/AppServiceProvider.php`

### 4. NotificationController
**Location:** `app/Http/Controllers/Admin/NotificationController.php`

**Methods:**
- `index()` - Menampilkan halaman notifikasi dengan pagination
- `getNotifications(Request)` - API endpoint untuk fetch notifikasi (JSON)
- `markAsRead($id)` - Tandai satu notifikasi sebagai dibaca
- `markAllAsRead()` - Tandai semua notifikasi sebagai dibaca
- `destroy($id)` - Hapus notifikasi (via form)
- `delete($id)` - Hapus notifikasi (via AJAX)

### 5. Routes
**Location:** `routes/web.php`

#### Admin Routes
```php
GET  /admin/notifications              -> index
GET  /admin/notifications/data         -> getNotifications (AJAX)
POST /admin/notifications/{id}/read    -> markAsRead
POST /admin/notifications/read-all     -> markAllAsRead
DELETE /admin/notifications/{id}       -> destroy
POST /admin/notifications/{id}/delete  -> delete (AJAX)
```

#### User Routes
```php
GET  /user/notifications              -> index
GET  /user/notifications/data         -> getNotifications (AJAX)
POST /user/notifications/{id}/read    -> markAsRead
POST /user/notifications/read-all     -> markAllAsRead
```

### 6. Auto-Delete Command
**Location:** `app/Console/Commands/DeleteOldNotifications.php`

**Command:** `php artisan notifications:cleanup`

**Options:**
- `--days=30` - Jumlah hari untuk menyimpan notifikasi (default: 30)

**Contoh:**
```bash
# Delete notifikasi lebih dari 30 hari
php artisan notifications:cleanup

# Delete notifikasi lebih dari 7 hari
php artisan notifications:cleanup --days=7
```

### 7. Scheduled Task
**Location:** `routes/console.php`

```php
Schedule::command('notifications:cleanup')->dailyAt('02:00');
```

Cleanup command akan berjalan otomatis setiap hari pukul 02:00 AM.

**Cara menjalankan scheduler:**

**Development:**
```bash
php artisan schedule:work
```

**Production (Cron Job):**
Tambahkan ke crontab:
```
* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
```

### 8. Frontend Integration

#### Admin Navbar
**Location:** `resources/views/layouts/admin/_navbar.blade.php`
- Bell icon dengan unread count badge
- Dropdown dengan daftar notifikasi (10 terbaru)
- Real-time fetch dari API endpoint
- Mark as read / delete functionality
- Link ke halaman notifikasi lengkap

#### Admin Notifications Page
**Location:** `resources/views/pages/admin/notifications/index.blade.php`
- Statistics cards (Total, Unread, Training Baru, Jadwal Baru)
- List semua notifikasi dengan pagination
- Mark all as read button
- Individual delete buttons
- Responsive design dengan Tailwind CSS

#### Alpine.js Integration
**Location:** `resources/views/layouts/admin.blade.php`

Component: `notificationsManager()`
- Fetch notifikasi via AJAX
- Auto-refresh unread count
- Mark as read functionality
- Delete notification
- Error handling

## Testing

### 1. Manual Testing

#### Test Notification Creation:
```bash
# Buka tinker
php artisan tinker

# Buat training baru (akan trigger notifikasi)
$training = App\Models\Training::factory()->create();

# Buat jadwal baru (akan trigger notifikasi)
$schedule = App\Models\TrainingSchedule::factory()->create();

# Cek notifikasi
App\Models\User::first()->notifications;
```

#### Test Cleanup Command:
```bash
# Jalankan cleanup
php artisan notifications:cleanup

# Dengan custom days
php artisan notifications:cleanup --days=7
```

### 2. Verify in Browser

1. **Login sebagai Admin**
2. **Buat Training Baru:** `/admin/trainings/create`
3. **Cek Bell Icon:** Harus muncul badge unread count
4. **Klik Bell:** Harus muncul notifikasi "Training Baru"
5. **Buat Jadwal Baru:** `/admin/schedules/create`
6. **Cek Notifikasi:** Harus ada notifikasi "Jadwal Baru"
7. **Buka Page Notifikasi:** `/admin/notifications`
8. **Test Mark as Read**
9. **Test Delete**
10. **Test Mark All as Read**

### 3. Database Check
```sql
-- Cek notifikasi
SELECT * FROM notifications ORDER BY created_at DESC;

-- Cek unread notifikasi
SELECT * FROM notifications WHERE read_at IS NULL;

-- Cek notifikasi lebih dari 30 hari
SELECT * FROM notifications WHERE created_at < DATE_SUB(NOW(), INTERVAL 30 DAY);
```

## Queue Configuration

Notifikasi menggunakan `ShouldQueue` interface, jadi akan diproses secara asynchronous jika queue worker berjalan.

**Start Queue Worker:**
```bash
php artisan queue:work
```

**Or background (production):**
```bash
php artisan queue:work --daemon
```

## Files Modified/Created

### Created:
1. `database/migrations/2025_11_19_020241_create_notifications_table.php`
2. `app/Notifications/NewTrainingNotification.php`
3. `app/Notifications/NewScheduleNotification.php`
4. `app/Observers/TrainingObserver.php`
5. `app/Observers/ScheduleObserver.php`
6. `app/Http/Controllers/Admin/NotificationController.php`
7. `app/Console/Commands/DeleteOldNotifications.php`

### Modified:
1. `app/Providers/AppServiceProvider.php` - Register observers
2. `routes/web.php` - Add notification routes
3. `routes/console.php` - Add scheduled cleanup
4. `resources/views/layouts/admin.blade.php` - Update Alpine.js component
5. `resources/views/layouts/admin/_navbar.blade.php` - Update UI to use real data
6. `resources/views/pages/admin/notifications/index.blade.php` - Complete rewrite

## Environment Variables

No additional environment variables required. Uses existing:
- `QUEUE_CONNECTION=database` (untuk async notifications)
- Database connection settings

## Security

- ✅ CSRF protection pada semua POST requests
- ✅ Authentication required (middleware: `auth`)
- ✅ Role-based access (admin/user routes)
- ✅ User can only see/manage their own notifications

## Performance Considerations

1. **Pagination** - Notifikasi di-paginate (15 per page)
2. **Queue** - Notifikasi dikirim via queue untuk performa
3. **Auto-cleanup** - Menghapus notifikasi lama otomatis
4. **AJAX Loading** - Navbar fetch hanya 10 notifikasi terbaru
5. **Database Index** - Laravel otomatis index `notifiable_id`, `read_at`, `created_at`

## Future Enhancements

Possible improvements:
1. **Real-time Notifications** - Implement Laravel Echo + Pusher/WebSockets
2. **Email Notifications** - Tambah channel `mail` untuk notifikasi penting
3. **Notification Preferences** - User bisa pilih jenis notifikasi
4. **Push Notifications** - Browser push notifications
5. **Notification Groups** - Group by type/date
6. **Search & Filter** - Search notifikasi di index page
7. **Notification Templates** - Admin bisa custom message templates

## Troubleshooting

### Notifikasi tidak muncul?
1. Cek apakah migration sudah jalan: `php artisan migrate:status`
2. Cek observer terdaftar di AppServiceProvider
3. Cek queue worker berjalan (jika menggunakan queue)
4. Cek log error: `storage/logs/laravel.log`

### Cleanup tidak jalan otomatis?
1. Pastikan scheduler berjalan: `php artisan schedule:work` (dev)
2. Pastikan cron job sudah disetup (production)
3. Cek schedule list: `php artisan schedule:list`

### Unread count tidak update?
1. Refresh page atau klik bell icon
2. Cek network tab untuk errors
3. Pastikan CSRF token valid

## Support

Untuk bantuan lebih lanjut, hubungi tim development atau buka issue di repository.
