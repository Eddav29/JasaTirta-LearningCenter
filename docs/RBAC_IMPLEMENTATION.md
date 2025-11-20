# Role-Based Access Control (RBAC) Implementation

## Overview
Sistem RBAC telah diimplementasikan untuk mengatur akses pengguna berdasarkan role mereka di JasaTirta Learning Center.

## Roles

### 1. **Admin / Super Admin**
- **Route Prefix**: `/admin`
- **Dashboard**: `admin.dashboard`
- **Access**: Penuh ke semua fitur admin (trainings, schedules, instructors, participants, categories, messages, reports)
- **Middleware**: `['auth', 'role:admin,super-admin']`

### 2. **User / Participant**
- **Route Prefix**: `/user`
- **Dashboard**: `user.dashboard`
- **Access**: 
  - My Courses (kursus yang diikuti)
  - Course Catalog (katalog kursus)
  - Schedules (jadwal kelas)
  - Certificates (sertifikat)
  - Achievements (pencapaian)
  - Forum Discussion
  - Settings & Profile
- **Middleware**: `['auth', 'role:user,participant']`

### 3. **Instructor**
- **Route Prefix**: `/instructor`
- **Dashboard**: `instructor.dashboard`
- **Access**:
  - My Courses (kursus yang diajar)
  - Schedules (jadwal mengajar)
  - Students (daftar siswa)
  - Profile
- **Middleware**: `['auth', 'role:instructor']`

## Login Flow

1. User login melalui `/login`
2. `AuthenticatedSessionController@store` memvalidasi kredensial
3. Setelah berhasil, sistem memeriksa role user
4. Redirect otomatis ke dashboard yang sesuai:
   - Admin/Super Admin → `/admin/dashboard`
   - Instructor → `/instructor/dashboard`
   - User/Participant → `/user/dashboard`

## Middleware

### RoleMiddleware
**Location**: `app/Http/Middleware/RoleMiddleware.php`

**Fungsi**:
- Memeriksa apakah user memiliki role yang diizinkan
- Jika tidak, redirect ke dashboard sesuai role user
- Menampilkan pesan error jika akses ditolak

**Usage**:
```php
Route::middleware(['auth', 'role:admin,super-admin'])->group(function () {
    // Admin routes
});
```

## Protected Routes

### Admin Routes
```php
/admin/dashboard          - Dashboard admin
/admin/trainings          - Manajemen pelatihan
/admin/schedules          - Manajemen jadwal
/admin/instructors        - Manajemen pengajar
/admin/participants       - Manajemen peserta
/admin/categories         - Manajemen kategori
/admin/messages           - Pesan masuk
/admin/notifications      - Notifikasi
/admin/reports            - Laporan
/admin/profile            - Profil admin
```

### User Routes
```php
/user/dashboard           - Dashboard user
/user/courses             - Kursus saya
/user/catalog             - Katalog kursus
/user/schedules           - Jadwal kelas
/user/certificates        - Sertifikat saya
/user/achievements        - Pencapaian
/user/forum               - Forum diskusi
/user/settings            - Pengaturan
/user/profile             - Profil user
```

### Instructor Routes
```php
/instructor/dashboard     - Dashboard instructor
/instructor/courses       - Kursus yang diajar
/instructor/schedules     - Jadwal mengajar
/instructor/students      - Daftar siswa
/instructor/profile       - Profil instructor
```

## Database Setup

### Roles Table (Spatie Permission)
Roles yang tersedia:
- `super-admin` - Full access
- `admin` - Administrative access
- `instructor` - Teaching access
- `user` atau `participant` - Student access

### Assigning Roles

```php
// Assign role to user
$user->assignRole('admin');

// Check if user has role
$user->hasRole('admin'); // returns boolean

// Get user roles
$user->roles->pluck('name')->toArray();
```

## Controllers

### Admin
- **DashboardController**: `App\Http\Controllers\Admin\DashboardController`
- **TrainingController**: `App\Http\Controllers\Admin\TrainingController`
- **ScheduleController**: `App\Http\Controllers\Admin\ScheduleController`
- **InstructorController**: `App\Http\Controllers\Admin\InstructorController`
- **ParticipantController**: `App\Http\Controllers\Admin\ParticipantController`
- **CategoryController**: `App\Http\Controllers\Admin\CategoryController`

### User
- **DashboardController**: `App\Http\Controllers\User\DashboardController`

### Instructor
- (To be created)

## Layouts

### Admin Layout
**File**: `resources/views/layouts/admin.blade.php`
- Includes: `_sidebar.blade.php`, `_navbar.blade.php`
- Features: Responsive sidebar, profile menu, notifications

### User Layout
**File**: `resources/views/layouts/user.blade.php`
- Includes: `user/_sidebar.blade.php`, `user/_navbar.blade.php`
- Features: Learning streak badge, course navigation

### Instructor Layout
- (To be created)

## Security Features

1. **Authentication Required**: Semua dashboard memerlukan login
2. **Role Verification**: Middleware memeriksa role sebelum akses
3. **Auto Redirect**: User redirect ke dashboard yang sesuai dengan role
4. **Session Management**: Laravel session untuk tracking user state
5. **CSRF Protection**: Built-in Laravel CSRF protection

## Testing RBAC

### Test Admin Login
1. Login dengan user role `admin` atau `super-admin`
2. Harus redirect ke `/admin/dashboard`
3. Dapat akses semua admin routes
4. Tidak dapat akses `/user/*` atau `/instructor/*`

### Test User Login
1. Login dengan user role `user` atau `participant`
2. Harus redirect ke `/user/dashboard`
3. Dapat akses semua user routes
4. Tidak dapat akses `/admin/*` atau `/instructor/*`

### Test Instructor Login
1. Login dengan user role `instructor`
2. Harus redirect ke `/instructor/dashboard`
3. Dapat akses semua instructor routes
4. Tidak dapat akses `/admin/*` atau `/user/*` (kecuali diberi akses)

## Future Enhancements

1. **Permissions**: Tambahkan granular permissions untuk kontrol lebih detail
2. **Multi-Role Support**: User bisa memiliki multiple roles
3. **Role Switching**: Admin bisa switch ke view user/instructor
4. **Activity Logging**: Track user activities berdasarkan role
5. **API RBAC**: Extend RBAC ke API endpoints

## Configuration

### Bootstrap App
**File**: `bootstrap/app.php`

Middleware alias telah dikonfigurasi:
```php
'role' => \App\Http\Middleware\RoleMiddleware::class,
'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
```

### Route Registration
**File**: `routes/web.php`

Routes diorganisir berdasarkan prefix dan middleware:
- Admin: `prefix('admin')` + `middleware(['auth', 'role:admin,super-admin'])`
- User: `prefix('user')` + `middleware(['auth', 'role:user,participant'])`
- Instructor: `prefix('instructor')` + `middleware(['auth', 'role:instructor'])`

## Error Handling

Jika user mencoba akses route yang tidak diizinkan:
1. Middleware mendeteksi role mismatch
2. Redirect ke dashboard sesuai role user
3. Flash message: "Anda tidak memiliki akses ke halaman tersebut."
4. User tetap logged in, hanya diarahkan ke halaman yang sesuai

## Notes

- Pastikan Spatie Permission package sudah terinstall
- Run migration untuk permission tables
- Seed roles di database
- Assign role saat user registration atau dari admin panel
