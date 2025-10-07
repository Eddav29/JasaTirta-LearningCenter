# Remaining APIs Documentation

Dokumentasi lengkap untuk API endpoints remaining: TrainingCategory, User, Auth, dan TrainingDetail dalam sistem JTLC Learning Center.

## Base URL
```
http://127.0.0.1:8000/api
```

## Authentication
Sebagian besar endpoint memerlukan authentication menggunakan Bearer Token (kecuali Auth endpoints).
```
Authorization: Bearer {your-token}
```

---

# Training Category API

API untuk mengelola kategori training.

## Endpoints

### 1. List Training Categories
**Endpoint:** `GET /training-categories`

**Query Parameters:**
- `search` (optional) - Pencarian berdasarkan nama kategori
- `sort_by` (optional) - Field sorting: `name`, `created_at`, `updated_at` (default: `name`)
- `sort_direction` (optional) - Arah sorting: `asc`, `desc` (default: `asc`)
- `per_page` (optional) - Jumlah data per halaman (default: 15)
- `page` (optional) - Nomor halaman (default: 1)

**Request Example:**
```http
GET /api/training-categories?search=programming&sort_by=name&per_page=10
Authorization: Bearer {your-token}
```

**Response Example:**
```json
{
    "status": "success",
    "message": "Training categories retrieved successfully",
    "data": [
        {
            "id": 1,
            "name": "Programming",
            "description": "Software programming and development courses including various languages and frameworks",
            "trainings_count": 15,
            "active_trainings_count": 12,
            "created_at": "2025-10-07 10:00:00",
            "updated_at": "2025-10-07 10:00:00"
        }
    ],
    "meta": {
        "current_page": 1,
        "per_page": 10,
        "total": 8,
        "last_page": 1
    }
}
```

### 2. Create Training Category
**Endpoint:** `POST /training-categories`

**Request Body:**
```json
{
    "name": "Data Science",
    "description": "Data analysis, machine learning, and data visualization courses"
}
```

**Validation Rules:**
- `name`: required, string, max 100 characters, unique
- `description`: optional, string, max 1000 characters

**Response Example:**
```json
{
    "status": "success",
    "message": "Training category created successfully",
    "data": {
        "id": 9,
        "name": "Data Science",
        "description": "Data analysis, machine learning, and data visualization courses",
        "trainings_count": null,
        "active_trainings_count": null,
        "created_at": "2025-10-07 17:00:00",
        "updated_at": "2025-10-07 17:00:00"
    }
}
```

### 3. Get Category Details
**Endpoint:** `GET /training-categories/{id}`

**Response Example:**
```json
{
    "status": "success",
    "message": "Training category retrieved successfully",
    "data": {
        "id": 1,
        "name": "Programming",
        "description": "Software programming and development courses",
        "trainings_count": 15,
        "active_trainings_count": 12,
        "created_at": "2025-10-07 10:00:00",
        "updated_at": "2025-10-07 10:00:00"
    }
}
```

### 4. Update Training Category
**Endpoint:** `PUT /training-categories/{id}`

**Request Body:**
```json
{
    "name": "Programming & Development",
    "description": "Comprehensive software programming and development courses including web, mobile, and desktop development"
}
```

### 5. Delete Training Category
**Endpoint:** `DELETE /training-categories/{id}`

**Response Example:**
```json
{
    "status": "success",
    "message": "Training category deleted successfully"
}
```

---

# Authentication API

API untuk autentikasi pengguna (register, login, logout).

## Endpoints

### 1. Register
**Endpoint:** `POST /auth/register`

**Request Body:**
```json
{
    "name": "John Doe",
    "email": "john.doe@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "role": "user"
}
```

**Available Roles:**
- `user` (default) - Regular user
- `admin` - Administrator

**Response Example:**
```json
{
    "data": {
        "id": 5,
        "name": "John Doe",
        "email": "john.doe@example.com",
        "roles": ["user"]
    }
}
```

### 2. Login
**Endpoint:** `POST /auth/login`

**Request Body:**
```json
{
    "email": "john.doe@example.com",
    "password": "password123"
}
```

**Response Example:**
```json
{
    "token": "5|abc123def456ghi789..."
}
```

**Error Response:**
```json
{
    "message": "Credentials invalid"
}
```

### 3. Get Current User
**Endpoint:** `GET /auth/me`

**Headers:** `Authorization: Bearer {token}`

**Response Example:**
```json
{
    "data": {
        "id": 5,
        "name": "John Doe",
        "email": "john.doe@example.com",
        "roles": ["user"]
    }
}
```

### 4. Logout
**Endpoint:** `POST /auth/logout`

**Headers:** `Authorization: Bearer {token}`

**Response Example:**
```json
{
    "message": "Logged out"
}
```

---

# User Management API

API untuk mengelola data pengguna (CRUD operations dengan role management).

## Endpoints

### 1. List Users
**Endpoint:** `GET /users`

**Query Parameters:**
- `per_page` (optional) - Jumlah data per halaman (default: 15)

**Response Example:**
```json
{
    "data": [
        {
            "id": 1,
            "name": "Admin User",
            "email": "admin@jtlc.com",
            "roles": ["admin"],
            "created_at": "2025-10-07 10:00:00",
            "updated_at": "2025-10-07 10:00:00"
        },
        {
            "id": 2,
            "name": "Regular User",
            "email": "user@jtlc.com",
            "roles": ["user"],
            "created_at": "2025-10-07 10:00:00",
            "updated_at": "2025-10-07 10:00:00"
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/users?page=1",
        "last": "http://127.0.0.1:8000/api/users?page=3",
        "prev": null,
        "next": "http://127.0.0.1:8000/api/users?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 3,
        "per_page": 15,
        "to": 15,
        "total": 35
    }
}
```

### 2. Create User
**Endpoint:** `POST /users`

**Request Body:**
```json
{
    "name": "Jane Smith",
    "email": "jane.smith@example.com",
    "password": "password123",
    "roles": ["user"]
}
```

**Response Example:**
```json
{
    "data": {
        "id": 6,
        "name": "Jane Smith",
        "email": "jane.smith@example.com",
        "roles": ["user"],
        "created_at": "2025-10-07 17:30:00",
        "updated_at": "2025-10-07 17:30:00"
    }
}
```

### 3. Get User Details
**Endpoint:** `GET /users/{id}`

**Response Example:**
```json
{
    "data": {
        "id": 6,
        "name": "Jane Smith",
        "email": "jane.smith@example.com",
        "roles": ["user"],
        "created_at": "2025-10-07 17:30:00",
        "updated_at": "2025-10-07 17:30:00"
    }
}
```

**Error Response:**
```json
{
    "message": "Not found"
}
```

### 4. Update User
**Endpoint:** `PUT /users/{id}`

**Request Body:**
```json
{
    "name": "Jane Smith Updated",
    "email": "jane.smith.updated@example.com",
    "password": "newpassword123",
    "roles": ["admin"]
}
```

**Note:** Password field is optional - only include if changing password.

### 5. Delete User
**Endpoint:** `DELETE /users/{id}`

**Response Example:**
```json
{
    "message": "Deleted"
}
```

---

# Training Detail API

API untuk mengelola detail training: Learning Objectives, Prerequisites, Materials, dan Syllabus.

## Learning Objectives

### 1. Get Learning Objectives
**Endpoint:** `GET /trainings/{trainingId}/learning-objectives`

**Response Example:**
```json
{
    "status": "success",
    "message": "Learning objectives retrieved successfully",
    "data": [
        {
            "id": 1,
            "training_id": 1,
            "objective": "Understand core Java programming concepts including OOP principles",
            "order_number": 1,
            "created_at": "2025-10-07 10:00:00",
            "updated_at": "2025-10-07 10:00:00"
        },
        {
            "id": 2,
            "training_id": 1,
            "objective": "Master Java collections framework and exception handling",
            "order_number": 2,
            "created_at": "2025-10-07 10:00:00",
            "updated_at": "2025-10-07 10:00:00"
        }
    ]
}
```

### 2. Create Learning Objective
**Endpoint:** `POST /trainings/learning-objectives`

**Request Body:**
```json
{
    "training_id": 1,
    "objective": "Apply design patterns in Java applications",
    "order_number": 3
}
```

### 3. Update Learning Objective
**Endpoint:** `PUT /trainings/learning-objectives/{id}`

### 4. Delete Learning Objective
**Endpoint:** `DELETE /trainings/learning-objectives/{id}`

### 5. Reorder Learning Objectives
**Endpoint:** `PUT /trainings/{trainingId}/learning-objectives/reorder`

**Request Body:**
```json
{
    "objectives": [
        {"id": 2, "order_number": 1},
        {"id": 1, "order_number": 2},
        {"id": 3, "order_number": 3}
    ]
}
```

## Prerequisites

### 1. Get Prerequisites
**Endpoint:** `GET /trainings/{trainingId}/prerequisites`

**Response Example:**
```json
{
    "status": "success",
    "message": "Prerequisites retrieved successfully",
    "data": [
        {
            "id": 1,
            "training_id": 1,
            "prerequisite": "Basic understanding of programming concepts",
            "is_mandatory": true,
            "order_number": 1,
            "created_at": "2025-10-07 10:00:00",
            "updated_at": "2025-10-07 10:00:00"
        },
        {
            "id": 2,
            "training_id": 1,
            "prerequisite": "Familiarity with any object-oriented programming language",
            "is_mandatory": false,
            "order_number": 2,
            "created_at": "2025-10-07 10:00:00",
            "updated_at": "2025-10-07 10:00:00"
        }
    ]
}
```

### 2. Create Prerequisite
**Endpoint:** `POST /trainings/prerequisites`

**Request Body:**
```json
{
    "training_id": 1,
    "prerequisite": "Completed Introduction to Programming course",
    "is_mandatory": true,
    "order_number": 3
}
```

### 3. Update Prerequisite
**Endpoint:** `PUT /trainings/prerequisites/{id}`

### 4. Delete Prerequisite
**Endpoint:** `DELETE /trainings/prerequisites/{id}`

### 5. Reorder Prerequisites
**Endpoint:** `PUT /trainings/{trainingId}/prerequisites/reorder`

## Training Materials

### 1. Get Materials
**Endpoint:** `GET /trainings/{trainingId}/materials`

**Response Example:**
```json
{
    "status": "success",
    "message": "Training materials retrieved successfully",
    "data": [
        {
            "id": 1,
            "training_id": 1,
            "title": "Java Programming Handbook",
            "description": "Comprehensive guide to Java programming",
            "material_type": "book",
            "url": "https://example.com/materials/java-handbook.pdf",
            "is_downloadable": true,
            "order_number": 1,
            "created_at": "2025-10-07 10:00:00",
            "updated_at": "2025-10-07 10:00:00"
        },
        {
            "id": 2,
            "training_id": 1,
            "title": "Java Coding Exercises",
            "description": "Practice exercises and solutions",
            "material_type": "exercise",
            "url": "https://github.com/jtlc/java-exercises",
            "is_downloadable": false,
            "order_number": 2,
            "created_at": "2025-10-07 10:00:00",
            "updated_at": "2025-10-07 10:00:00"
        }
    ]
}
```

### 2. Create Material
**Endpoint:** `POST /trainings/materials`

**Request Body:**
```json
{
    "training_id": 1,
    "title": "Java Best Practices Video",
    "description": "Video tutorial on Java best practices and coding standards",
    "material_type": "video",
    "url": "https://youtube.com/watch?v=example",
    "is_downloadable": false,
    "order_number": 3
}
```

**Available Material Types:**
- `book` - Digital books/PDFs
- `video` - Video tutorials
- `exercise` - Coding exercises
- `reference` - Reference materials
- `tool` - Software tools
- `other` - Other materials

### 3. Update Material
**Endpoint:** `PUT /trainings/materials/{id}`

### 4. Delete Material
**Endpoint:** `DELETE /trainings/materials/{id}`

### 5. Reorder Materials
**Endpoint:** `PUT /trainings/{trainingId}/materials/reorder`

## Training Syllabus

### 1. Get Syllabus
**Endpoint:** `GET /trainings/{trainingId}/syllabus`

**Response Example:**
```json
{
    "status": "success",
    "message": "Training syllabus retrieved successfully",
    "data": [
        {
            "id": 1,
            "training_id": 1,
            "title": "Introduction to Java",
            "description": "Overview of Java language, history, and ecosystem",
            "duration": "2 hours",
            "topics": [
                "Java history and evolution",
                "JVM, JRE, and JDK",
                "Setting up development environment"
            ],
            "order_number": 1,
            "created_at": "2025-10-07 10:00:00",
            "updated_at": "2025-10-07 10:00:00"
        },
        {
            "id": 2,
            "training_id": 1,
            "title": "Object-Oriented Programming in Java",
            "description": "Core OOP concepts: classes, objects, inheritance, polymorphism",
            "duration": "4 hours",
            "topics": [
                "Classes and objects",
                "Inheritance and polymorphism",
                "Encapsulation and abstraction",
                "Interface and abstract classes"
            ],
            "order_number": 2,
            "created_at": "2025-10-07 10:00:00",
            "updated_at": "2025-10-07 10:00:00"
        }
    ]
}
```

### 2. Create Syllabus Item
**Endpoint:** `POST /trainings/syllabus`

**Request Body:**
```json
{
    "training_id": 1,
    "title": "Java Collections Framework",
    "description": "Understanding and using Java collections effectively",
    "duration": "3 hours",
    "topics": [
        "List, Set, and Map interfaces",
        "ArrayList, LinkedList, HashMap",
        "Iterators and enhanced for loops",
        "Collections utility class"
    ],
    "order_number": 3
}
```

### 3. Update Syllabus Item
**Endpoint:** `PUT /trainings/syllabus/{id}`

### 4. Delete Syllabus Item
**Endpoint:** `DELETE /trainings/syllabus/{id}`

### 5. Reorder Syllabus
**Endpoint:** `PUT /trainings/{trainingId}/syllabus/reorder`

---

# Usage Examples

## Training Category Examples
```bash
# Create category
curl -X POST "http://127.0.0.1:8000/api/training-categories" \
  -H "Authorization: Bearer your-token" \
  -H "Content-Type: application/json" \
  -d '{"name": "Cloud Computing", "description": "AWS, Azure, GCP courses"}'

# Search categories
curl -X GET "http://127.0.0.1:8000/api/training-categories?search=programming" \
  -H "Authorization: Bearer your-token"
```

## Authentication Examples
```bash
# Register new user
curl -X POST "http://127.0.0.1:8000/api/auth/register" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Test User",
    "email": "test@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "role": "user"
  }'

# Login
curl -X POST "http://127.0.0.1:8000/api/auth/login" \
  -H "Content-Type: application/json" \
  -d '{
    "email": "test@example.com",
    "password": "password123"
  }'

# Get current user
curl -X GET "http://127.0.0.1:8000/api/auth/me" \
  -H "Authorization: Bearer your-token"
```

## Training Detail Examples
```bash
# Add learning objective
curl -X POST "http://127.0.0.1:8000/api/trainings/learning-objectives" \
  -H "Authorization: Bearer your-token" \
  -H "Content-Type: application/json" \
  -d '{
    "training_id": 1,
    "objective": "Master advanced Java concepts",
    "order_number": 1
  }'

# Add training material
curl -X POST "http://127.0.0.1:8000/api/trainings/materials" \
  -H "Authorization: Bearer your-token" \
  -H "Content-Type: application/json" \
  -d '{
    "training_id": 1,
    "title": "Java Reference Guide",
    "description": "Complete reference for Java programming",
    "material_type": "book",
    "url": "https://example.com/java-guide.pdf",
    "is_downloadable": true
  }'
```

---

# Data Types & Constraints

## Training Category
| Field | Type | Required | Constraints |
|-------|------|----------|-------------|
| name | string | Yes | Max 100 chars, unique |
| description | string | No | Max 1000 chars |

## User
| Field | Type | Required | Constraints |
|-------|------|----------|-------------|
| name | string | Yes | Max 255 chars |
| email | string | Yes | Valid email, unique |
| password | string | Yes (create) | Min 8 chars |
| roles | array | No | Valid role names |

## Learning Objective
| Field | Type | Required | Constraints |
|-------|------|----------|-------------|
| training_id | integer | Yes | Must exist |
| objective | text | Yes | No limit |
| order_number | integer | Yes | Min 1 |

## Prerequisite
| Field | Type | Required | Constraints |
|-------|------|----------|-------------|
| training_id | integer | Yes | Must exist |
| prerequisite | text | Yes | No limit |
| is_mandatory | boolean | No | Default false |
| order_number | integer | Yes | Min 1 |

## Training Material
| Field | Type | Required | Constraints |
|-------|------|----------|-------------|
| training_id | integer | Yes | Must exist |
| title | string | Yes | Max 255 chars |
| description | text | No | No limit |
| material_type | enum | Yes | See types above |
| url | string | No | Valid URL |
| is_downloadable | boolean | No | Default false |
| order_number | integer | Yes | Min 1 |

## Syllabus
| Field | Type | Required | Constraints |
|-------|------|----------|-------------|
| training_id | integer | Yes | Must exist |
| title | string | Yes | Max 255 chars |
| description | text | No | No limit |
| duration | string | No | Max 50 chars |
| topics | array | No | Array of strings |
| order_number | integer | Yes | Min 1 |

---

# Error Handling

## Common HTTP Status Codes
- **200 OK** - Request successful
- **201 Created** - Resource created successfully
- **401 Unauthorized** - Authentication failed
- **404 Not Found** - Resource not found
- **422 Unprocessable Entity** - Validation error
- **500 Internal Server Error** - Server error

## Authentication Errors
```json
{
    "message": "Unauthenticated."
}
```

## Validation Errors
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "name": ["Nama kategori training wajib diisi."],
        "email": ["The email field is required."]
    }
}
```

---

# Business Rules

1. **Category Uniqueness**: Category names must be unique
2. **Role Management**: Users can have multiple roles
3. **Order Management**: All detail items (objectives, prerequisites, materials, syllabus) have order_number for sorting
4. **Reorder Operations**: Bulk reorder operations for better UX
5. **Mandatory Prerequisites**: Some prerequisites can be marked as mandatory
6. **Material Types**: Structured material types for better organization
7. **Authentication**: JWT-based authentication with role-based access
8. **Cascade Operations**: Proper handling of dependent data relationships

---

## Rate Limiting
Standard Laravel rate limiting: 60 requests per minute per user.

## Versioning
Current API version: v1. All endpoints use prefix `/api/`.