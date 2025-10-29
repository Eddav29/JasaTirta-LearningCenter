# Vite Setup Guide

## 📦 Instalasi

Project ini menggunakan **Vite** sebagai bundler untuk asset frontend dengan **Tailwind CSS v4**.

### Prerequisites

- Node.js >= 18.x
- npm atau yarn
- PHP >= 8.3
- Composer

## 🚀 Setup Development

### 1. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 2. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 3. Database Setup

```bash
# Run migrations
php artisan migrate

# Seed database (optional)
php artisan db:seed
```

### 4. Run Development Server

Anda memerlukan **2 terminal** yang berjalan bersamaan:

#### Terminal 1: Laravel Server
```bash
php artisan serve
```
Server akan berjalan di `http://localhost:8000`

#### Terminal 2: Vite Development Server
```bash
npm run dev
```
Vite akan berjalan dengan hot module replacement (HMR)

## 🏗️ Build untuk Production

### Build Assets

```bash
npm run build
```

Ini akan mengcompile dan minify semua assets ke folder `public/build/`

### Optimize Laravel

```bash
# Cache config
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev
```

## 📁 Struktur File

```
├── resources/
│   ├── css/
│   │   └── app.css          # Tailwind CSS v4 (menggunakan @import)
│   ├── js/
│   │   └── app.js           # Main JavaScript entry point
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php    # Main layout template
│       └── welcome.blade.php     # Welcome page
├── public/
│   ├── build/               # Compiled assets (generated, git-ignored)
│   └── hot                  # Vite dev server info (generated)
├── vite.config.js           # Vite configuration
└── package.json             # Node dependencies & scripts
```

## 🎨 Tailwind CSS v4

Project ini menggunakan **Tailwind CSS v4** dengan syntax baru:

### app.css
```css
@import "tailwindcss";
```

Tidak lagi menggunakan directives `@tailwind` seperti di v3:
```css
/* ❌ OLD (v3) - Jangan gunakan ini */
@tailwind base;
@tailwind components;
@tailwind utilities;

/* ✅ NEW (v4) - Gunakan ini */
@import "tailwindcss";
```

### Dark Mode Support

Tailwind v4 sudah include dark mode by default. Gunakan prefix `dark:`:

```html
<div class="bg-white dark:bg-gray-800">
    <h1 class="text-gray-900 dark:text-white">Hello</h1>
</div>
```

## 🔧 Vite Configuration

File `vite.config.js`:

```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
```

### Fitur Vite:

- ⚡ **Hot Module Replacement (HMR)** - Update instan tanpa refresh
- 🎯 **Fast Build** - Build super cepat
- 📦 **Code Splitting** - Automatic chunk splitting
- 🔄 **Auto Refresh** - Blade files auto-refresh on change

## 📝 Menggunakan Vite di Blade

### Di Layout (`app.blade.php`):

```blade
<!DOCTYPE html>
<html>
<head>
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @yield('content')
</body>
</html>
```

### Multiple Entry Points:

Jika Anda perlu entry point tambahan:

```js
// vite.config.js
laravel({
    input: [
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/admin.js',      // Additional entry
        'resources/css/admin.css',     // Additional entry
    ],
    refresh: true,
})
```

```blade
<!-- Di blade file -->
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
```

## 🐛 Troubleshooting

### Error: Vite manifest not found

**Problem:** File manifest tidak ditemukan

**Solution:**
```bash
# Build assets terlebih dahulu
npm run build

# Atau jalankan dev server
npm run dev
```

### Error: Cannot find module

**Problem:** Dependencies tidak terinstall

**Solution:**
```bash
# Clear cache dan reinstall
rm -rf node_modules
rm package-lock.json
npm install
```

### Assets tidak ter-update

**Problem:** Browser cache

**Solution:**
```bash
# Clear browser cache atau hard refresh
# Windows/Linux: Ctrl + Shift + R
# Mac: Cmd + Shift + R

# Atau rebuild
npm run build
```

### Port 5173 already in use

**Problem:** Vite dev server port bentrok

**Solution:**
```bash
# Kill process di port 5173
# Windows
netstat -ano | findstr :5173
taskkill /PID <PID> /F

# Linux/Mac
lsof -ti:5173 | xargs kill -9

# Atau gunakan port lain di vite.config.js
export default defineConfig({
    server: {
        port: 5174,
    },
    // ...
})
```

## 📚 Scripts NPM

```json
{
  "scripts": {
    "dev": "vite",              // Development server with HMR
    "build": "vite build"       // Production build
  }
}
```

### Menjalankan Scripts:

```bash
# Development (dengan HMR)
npm run dev

# Production build
npm run build
```

## 🌐 URL Development

- **Laravel:** http://localhost:8000
- **Vite Dev Server:** http://localhost:5173 (internal, tidak perlu diakses langsung)

Akses aplikasi melalui Laravel server (`localhost:8000`), Vite akan serve assets secara otomatis.

## 🚀 Deployment ke Production

### 1. Build Assets

```bash
npm run build
```

### 2. Upload Files

Upload semua files **KECUALI**:
- `node_modules/`
- `.env` (buat baru di server)
- `storage/` (preserve existing)
- `public/hot`

### 3. Install Dependencies di Server

```bash
composer install --optimize-autoloader --no-dev
```

### 4. Optimize Laravel

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 5. Set Permissions

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## 📖 Resources

- [Vite Documentation](https://vitejs.dev/)
- [Laravel Vite Documentation](https://laravel.com/docs/vite)
- [Tailwind CSS v4 Documentation](https://tailwindcss.com/docs)
- [Tailwind CSS v4 Upgrade Guide](https://tailwindcss.com/docs/upgrade-guide)

## ✅ Checklist Setup

- [ ] `composer install` - PHP dependencies installed
- [ ] `npm install` - Node dependencies installed
- [ ] `.env` file configured
- [ ] Database created and migrated
- [ ] `php artisan serve` running
- [ ] `npm run dev` running
- [ ] Browser opened at `http://localhost:8000`
- [ ] Hot reload working (try editing CSS/JS)

## 🎉 Happy Coding!

Jika ada pertanyaan atau issue, silakan buat issue di repository atau hubungi tim development.
