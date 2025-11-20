# JTLC - Laravel API Application

<p align="center">
<img src="https://img.shields.io/badge/Laravel-12.x-red" alt="Laravel Version">
<img src="https://img.shields.io/badge/PHP-8.3+-blue" alt="PHP Version">
<img src="https://img.shields.io/badge/License-MIT-green" alt="License">
</p>

## Tentang Proyek

JTLC adalah aplikasi backend Laravel yang dibangun dengan arsitektur yang bersih dan terstruktur menggunakan Repository-Service pattern. Aplikasi ini menyediakan sistem autentikasi dan manajemen pengguna dengan kontrol akses berbasis role dan permission menggunakan Laravel Sanctum dan Spatie Laravel Permission.

## Fitur Utama

- 🔐 **Autentikasi & Otorisasi**
  - Registrasi dan login pengguna
  - Token-based authentication menggunakan Laravel Sanctum
  - Role-based access control (RBAC) dengan Spatie Laravel Permission
  - Middleware untuk kontrol akses endpoint

- 👥 **Manajemen Pengguna**
  - CRUD operations untuk pengguna
  - Sistem role dan permission yang fleksibel
  - Data Transfer Objects (DTOs) untuk transfer data yang aman

- 🏗️ **Arsitektur Bersih**
  - Repository Pattern untuk abstraksi data access
  - Service Layer untuk business logic
  - Dependency Injection dengan Contracts/Interfaces
  - Form Request untuk validasi input

- 🧪 **Testing**
  - Feature tests untuk endpoint API
  - Unit tests untuk komponen individual
  - Test coverage untuk autentikasi dan CRUD operations

## Teknologi yang Digunakan

- **Backend Framework**: Laravel 12.x
- **PHP Version**: 8.3+
- **Database**: MySQL (production), SQLite (testing)
- **Authentication**: Laravel Sanctum
- **Authorization**: Spatie Laravel Permission
- **Frontend Bundler**: Vite
- **CSS Framework**: Tailwind CSS v4
- **Code Quality**: Laravel Pint
- **Testing**: PHPUnit
- **Development Tools**: Laravel Boost

## Persyaratan Sistem

- PHP 8.3 atau lebih tinggi
- Composer
- Node.js 18+ & NPM (untuk Vite asset bundling)
- MySQL 8.0+ (production) atau SQLite (development/testing)

## Instalasi

1. **Clone repository**
   ```bash
   git clone <repository-url>
   cd jtlc
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Setup database**
   ```bash
   # Untuk SQLite (default)
   touch database/database.sqlite
   
   # Atau konfigurasi MySQL/PostgreSQL di .env
   ```

5. **Run migrations dan seeders**
   ```bash
   php artisan migrate --seed
   ```

6. **Build assets (Production)**
   ```bash
   npm run build
   ```
   
   **Atau untuk development dengan Hot Module Replacement:**
   ```bash
   # Terminal 1: Laravel Server
   php artisan serve
   
   # Terminal 2: Vite Dev Server
   npm run dev
   ```

7. **Akses aplikasi**
   ```
   http://localhost:8000
   ```

> 📖 **Dokumentasi lengkap Vite setup**: Lihat [docs/VITE_SETUP.md](docs/VITE_SETUP.md)

## API Endpoints

### Authentication

| Method | Endpoint | Description | Middleware |
|--------|----------|-------------|------------|
| POST | `/api/auth/register` | Registrasi pengguna baru | - |
| POST | `/api/auth/login` | Login pengguna | - |
| GET | `/api/auth/me` | Informasi pengguna yang login | `auth:sanctum` |
| POST | `/api/auth/logout` | Logout pengguna | `auth:sanctum` |

### User Management

| Method | Endpoint | Description | Permission Required |
|--------|----------|-------------|-------------------|
| GET | `/api/users` | List semua pengguna | `users.view` |
| POST | `/api/users` | Buat pengguna baru | `users.create` |
| GET | `/api/users/{id}` | Detail pengguna | `users.view` |
| PUT | `/api/users/{id}` | Update pengguna | `users.update` |
| DELETE | `/api/users/{id}` | Hapus pengguna | `users.delete` |

### Admin Routes

| Method | Endpoint | Description | Role Required |
|--------|----------|-------------|---------------|
| GET | `/api/admin/dashboard` | Dashboard admin | `admin` |

## Roles dan Permissions

### Default Roles
- **admin**: Memiliki akses penuh ke semua fitur
- **user**: Akses terbatas sesuai permission yang diberikan

### Available Permissions
- `users.view`: Melihat daftar dan detail pengguna
- `users.create`: Membuat pengguna baru
- `users.update`: Mengupdate data pengguna
- `users.delete`: Menghapus pengguna

## Arsitektur Aplikasi

### Repository Pattern
```
app/Repositories/
├── Contracts/          # Interface definitions
│   └── UserRepository.php
└── Eloquent/          # Eloquent implementations
    └── EloquentUserRepository.php
```

### Service Layer
```
app/Services/
├── Contracts/          # Service interfaces
│   └── AuthService.php
├── AuthService.php     # Authentication business logic
└── UserManagementService.php  # User management logic
```

### Data Transfer Objects
```
app/Data/
├── UserCreationData.php    # Data untuk membuat user
└── UserUpdateData.php      # Data untuk update user
```

## Testing

### Menjalankan Tests
```bash
# Semua tests
php artisan test

# Feature tests saja
php artisan test --testsuite=Feature

# Unit tests saja
php artisan test --testsuite=Unit

# Test dengan coverage
php artisan test --coverage
```

### Test Structure
- **Feature Tests**: Testing endpoint API dan integrasi
- **Unit Tests**: Testing komponen individual seperti services dan repositories

## Development

### Code Quality
```bash
# Format code dengan Pint
vendor/bin/pint

# Check code style
vendor/bin/pint --test
```

### Database
```bash
# Fresh migration dengan seeder
php artisan migrate:fresh --seed

# Rollback migration
php artisan migrate:rollback

# Create new migration
php artisan make:migration create_table_name
```

### Artisan Commands
```bash
# Generate new controller
php artisan make:controller Api/ExampleController --api

# Generate new model dengan factory dan migration
php artisan make:model Example -mf

# Generate new service
php artisan make:class Services/ExampleService

# Generate new repository
php artisan make:class Repositories/Contracts/ExampleRepository
php artisan make:class Repositories/Eloquent/EloquentExampleRepository
```

## Deployment

1. **Setup production environment**
   ```bash
   composer install --optimize-autoloader --no-dev
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

2. **Setup database**
   ```bash
   php artisan migrate --force
   php artisan db:seed --class=RoleSeeder --force
   ```

3. **Setup file permissions**
   ```bash
   chmod -R 755 storage bootstrap/cache
   ```

## Contributing

1. Fork repository
2. Buat feature branch (`git checkout -b feature/amazing-feature`)
3. Commit perubahan (`git commit -m 'Add amazing feature'`)
4. Push ke branch (`git push origin feature/amazing-feature`)
5. Buat Pull Request

## License

Proyek ini menggunakan lisensi MIT. Lihat file [LICENSE](LICENSE) untuk detail lebih lanjut.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
