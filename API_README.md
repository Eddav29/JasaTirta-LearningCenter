# JTLC Learning Center API

Comprehensive REST API untuk sistem learning center Jasa Tirta dengan fitur lengkap untuk mengelola training, instruktur, jadwal, dan user management.

## 🚀 Quick Start

### Prerequisites
- PHP 8.3+
- Composer
- SQLite/MySQL/PostgreSQL

### Installation
```bash
# Clone repository
git clone <repository-url>
cd jtlc

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Start server
php artisan serve
```

## 📊 Complete API Overview

### Base URL
```
http://127.0.0.1:8000/api
```

### Total Endpoints: **54 Endpoints**
- **Authentication**: 4 endpoints
- **Instructor Management**: 5 endpoints
- **Training Management**: 5 endpoints
- **Training Schedule**: 12 endpoints (with special features)
- **Training Categories**: 5 endpoints
- **User Management**: 5 endpoints
- **Training Details**: 20 endpoints (4 sub-modules)

---

## 🔐 Authentication System

### Core Auth Endpoints
| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/auth/register` | Register new user with role |
| POST | `/auth/login` | Login and get JWT token |
| GET | `/auth/me` | Get current user info |
| POST | `/auth/logout` | Logout and invalidate token |

### Quick Auth Example
```bash
# Register
curl -X POST "http://127.0.0.1:8000/api/auth/register" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "role": "user"
  }'

# Login & Get Token
curl -X POST "http://127.0.0.1:8000/api/auth/login" \
  -H "Content-Type: application/json" \
  -d '{
    "email": "john@example.com",
    "password": "password123"
  }'

# Response: {"token": "1|abc123..."}
```

---

## 👨‍🏫 Instructor Management

Complete CRUD operations untuk instruktur dengan management sertifikasi.

### Key Features
- ✅ **Advanced Filtering**: Tipe, spesialisasi, search global
- ✅ **Certification Management**: Auto-handle create/update/delete sertifikasi
- ✅ **Instructor Types**: Internal vs Vendor
- ✅ **Comprehensive Validation**: Email uniqueness, experience limits

### Main Endpoints
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/instructors` | List dengan filtering & pagination |
| POST | `/instructors` | Create instructor + certifications |
| GET | `/instructors/{id}` | Detail instructor |
| PUT | `/instructors/{id}` | Update dengan certification management |
| DELETE | `/instructors/{id}` | Delete instructor + related data |

### Quick Example
```bash
# Create Instructor
curl -X POST "http://127.0.0.1:8000/api/instructors" \
  -H "Authorization: Bearer {token}" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Dr. Budi Santoso",
    "specialization": "Java Programming",
    "education": "S3 Teknik Informatika",
    "experience": 10,
    "bio": "Experienced Java developer...",
    "email": "budi@jtlc.com",
    "phone": "081234567890",
    "instructor_type": "internal",
    "certifications": [
      "Oracle Certified Professional Java SE",
      "Spring Framework Certified Developer"
    ]
  }'
```

📖 **[Complete Instructor API Documentation](docs/api/INSTRUCTOR_API.md)**

---

## 📚 Training Management

Advanced CRUD untuk training dengan filtering kompleks dan relasi.

### Key Features
- ✅ **Advanced Filtering**: Kategori, instruktur, tipe, price range
- ✅ **Smart Search**: Global search di title dan description
- ✅ **Flexible Sorting**: 6 opsi sorting termasuk "popularity"
- ✅ **Dynamic Relationships**: Include/exclude relasi
- ✅ **Rich Validation**: 16 validation rules

### Main Endpoints
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/trainings` | List dengan filtering advanced |
| POST | `/trainings` | Create training dengan relasi |
| GET | `/trainings/{id}` | Detail training + relationships |
| PUT | `/trainings/{id}` | Update dengan partial support |
| DELETE | `/trainings/{id}` | Delete training |

### Advanced Filtering Example
```bash
# Complex Query
curl -X GET "http://127.0.0.1:8000/api/trainings?category_id=1&training_type=online&min_price=100000&max_price=500000&search=java&sort_by=popularity&include=category,instructor" \
  -H "Authorization: Bearer {token}"
```

📖 **[Complete Training API Documentation](docs/api/TRAINING_API.md)**

---

## 📅 Training Schedule Management

The most sophisticated API dengan 12 endpoints dan fitur khusus.

### Key Features
- ✅ **12 Unique Endpoints**: 5 CRUD + 7 special endpoints
- ✅ **Smart Features**: Duplicate, Statistics, Status Management
- ✅ **Calendar Integration**: Month view, upcoming, available
- ✅ **Business Logic**: Auto-calculations, status workflow
- ✅ **Dashboard Analytics**: Utilization rate, comprehensive stats

### All Endpoints
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/training-schedules` | List dengan pagination opsional |
| POST | `/training-schedules` | Create schedule dengan auto-populate |
| GET | `/training-schedules/{id}` | Detail schedule |
| PUT | `/training-schedules/{id}` | Update schedule |
| DELETE | `/training-schedules/{id}` | Delete dengan business rules |
| GET | `/training-schedules/training/{id}` | Schedules by training |
| GET | `/training-schedules/available` | Available schedules |
| GET | `/training-schedules/upcoming` | Upcoming schedules |
| GET | `/training-schedules/by-month` | Calendar view |
| PATCH | `/training-schedules/{id}/status` | Change status |
| POST | `/training-schedules/{id}/duplicate` | Smart duplicate |
| GET | `/training-schedules/statistics` | Dashboard analytics |

### Special Features Examples
```bash
# Duplicate Schedule
curl -X POST "http://127.0.0.1:8000/api/training-schedules/1/duplicate" \
  -H "Authorization: Bearer {token}" \
  -H "Content-Type: application/json" \
  -d '{
    "start_date": "2025-12-15",
    "location": "Online Platform",
    "total_slots": 50
  }'

# Get Statistics
curl -X GET "http://127.0.0.1:8000/api/training-schedules/statistics?month=2025-11" \
  -H "Authorization: Bearer {token}"

# Response: {"utilization_rate": 67.5, "total_schedules": 25, ...}
```

📖 **[Complete Training Schedule API Documentation](docs/api/TRAINING_SCHEDULE_API.md)**

---

## 📂 Supporting APIs

### Training Categories (5 endpoints)
Simple CRUD untuk kategori dengan search dan sorting.
```bash
# Create Category
curl -X POST "http://127.0.0.1:8000/api/training-categories" \
  -H "Authorization: Bearer {token}" \
  -H "Content-Type: application/json" \
  -d '{"name": "Data Science", "description": "AI/ML courses"}'
```

### User Management (5 endpoints)
Complete user CRUD dengan role management.
```bash
# List Users
curl -X GET "http://127.0.0.1:8000/api/users?per_page=10" \
  -H "Authorization: Bearer {token}"
```

### Training Details (20 endpoints)
4 sub-modules untuk detail training:
- **Learning Objectives** (5 endpoints)
- **Prerequisites** (5 endpoints) 
- **Training Materials** (5 endpoints)
- **Syllabus** (5 endpoints)

```bash
# Add Learning Objective
curl -X POST "http://127.0.0.1:8000/api/trainings/learning-objectives" \
  -H "Authorization: Bearer {token}" \
  -H "Content-Type: application/json" \
  -d '{
    "training_id": 1,
    "objective": "Master advanced Java concepts",
    "order_number": 1
  }'
```

📖 **[Complete Supporting APIs Documentation](docs/api/REMAINING_APIS.md)**

## 🔐 Authentication

API ini menggunakan Laravel Sanctum untuk autentikasi token-based. 

1. Register atau login untuk mendapatkan token
2. Sertakan token di header untuk protected endpoints:
   ```
   Authorization: Bearer {your-token}
   ```

## 📝 Error Responses

### Validation Error (422)
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": ["The email field is required."]
    }
}
```

### Unauthorized (401)
```json
{
    "message": "Unauthenticated."
}
```

### Not Found (404)
```json
{
    "message": "Route not found."
}
```

## 🛠️ Development

### Testing API
Gunakan tools seperti:
- Postman
- Insomnia
- cURL
- HTTPie

### Example dengan cURL:
```bash
# Register
curl -X POST http://127.0.0.1:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{
    "first_name": "Test",
    "last_name": "User",
    "email": "test@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }'

# Login
curl -X POST http://127.0.0.1:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "test@example.com",
    "password": "password123"
  }'

# Access protected endpoint
curl -X GET http://127.0.0.1:8000/api/dashboard \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

## 📦 Tech Stack

- **Framework:** Laravel 12
- **Authentication:** Laravel Sanctum  
- **Database:** SQLite (default), supports MySQL/PostgreSQL
- **PHP Version:** 8.3+

## 📄 License

Open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).