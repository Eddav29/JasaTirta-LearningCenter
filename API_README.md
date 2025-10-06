# JTLC Learning Center API

Backend REST API untuk sistem learning center Jasa Tirta.

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

## 📊 API Endpoints

### Base URL
```
http://127.0.0.1:8000
```

### Authentication Endpoints

#### Register User
```http
POST /api/auth/register
Content-Type: application/json

{
    "first_name": "John",
    "last_name": "Doe", 
    "email": "john@example.com",
    "phone": "081234567890",
    "password": "password123",
    "password_confirmation": "password123"
}
```

**Response:**
```json
{
    "message": "Registrasi berhasil",
    "user": {
        "id": 1,
        "first_name": "John",
        "last_name": "Doe",
        "email": "john@example.com",
        "phone": "081234567890"
    },
    "token": "1|abc123token..."
}
```

#### Login
```http
POST /api/auth/login
Content-Type: application/json

{
    "email": "john@example.com",
    "password": "password123",
    "remember": false
}
```

**Response:**
```json
{
    "message": "Login berhasil",
    "user": {
        "id": 1,
        "first_name": "John",
        "last_name": "Doe",
        "email": "john@example.com"
    },
    "token": "2|def456token..."
}
```

#### Get Current User
```http
GET /api/auth/me
Authorization: Bearer {token}
```

**Response:**
```json
{
    "user": {
        "id": 1,
        "first_name": "John",
        "last_name": "Doe",
        "email": "john@example.com"
    }
}
```

#### Logout
```http
POST /api/auth/logout
Authorization: Bearer {token}
```

**Response:**
```json
{
    "message": "Logout berhasil"
}
```

### Protected Endpoints

#### Dashboard
```http
GET /api/dashboard
Authorization: Bearer {token}
```

**Response:**
```json
{
    "message": "Dashboard data retrieved successfully",
    "user": {
        "id": 1,
        "first_name": "John",
        "last_name": "Doe",
        "email": "john@example.com"
    },
    "data": {
        "welcome_message": "Selamat datang di JTLC Learning Center",
        "dashboard_info": "Ini adalah API dashboard"
    }
}
```

### API Status
```http
GET /api/status
```

**Response:**
```json
{
    "message": "JTLC Learning Center API",
    "version": "1.0.0",
    "status": "active"
}
```

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