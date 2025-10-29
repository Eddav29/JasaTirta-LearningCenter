# Quick Start Guide - Vite Development

## 🚀 Start Development (Dua Terminal)

### Terminal 1: Laravel Server
```bash
php artisan serve
```
✅ Berjalan di: http://localhost:8000

### Terminal 2: Vite Dev Server  
```bash
npm run dev
```
✅ Hot reload aktif! Edit file langsung terlihat perubahannya.

## 📝 File Locations

| File | Path | Purpose |
|------|------|---------|
| CSS | `resources/css/app.css` | Tailwind CSS v4 |
| JavaScript | `resources/js/app.js` | Main JS entry |
| Vite Config | `vite.config.js` | Vite configuration |
| Blade Layout | `resources/views/layouts/app.blade.php` | Main layout |

## 🎨 Using Vite in Blade

```blade
<!DOCTYPE html>
<html>
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Your content -->
</body>
</html>
```

## 🏗️ Build for Production

```bash
npm run build
```

Files akan di-compile ke `public/build/`

## 🎯 Tailwind CSS v4 Syntax

### ✅ Correct (v4)
```css
/* resources/css/app.css */
@import "tailwindcss";
```

### ❌ Wrong (v3 - Don't use!)
```css
@tailwind base;
@tailwind components;
@tailwind utilities;
```

## 🐛 Common Issues

### "Vite manifest not found"
```bash
npm run build  # Build first
# OR
npm run dev    # Start dev server
```

### Assets not updating
- Hard refresh browser: `Ctrl + Shift + R` (Windows) or `Cmd + Shift + R` (Mac)
- Restart Vite: `Ctrl + C` then `npm run dev`

### Port 5173 in use
```bash
# Windows
netstat -ano | findstr :5173
taskkill /PID <PID> /F

# Linux/Mac
lsof -ti:5173 | xargs kill -9
```

## 📚 Full Documentation

➡️ [docs/VITE_SETUP.md](VITE_SETUP.md) - Complete setup guide
➡️ [Vite Docs](https://vitejs.dev/) - Official Vite documentation
➡️ [Tailwind v4 Docs](https://tailwindcss.com/docs) - Tailwind CSS v4 docs

---

**Happy Coding! 🎉**
