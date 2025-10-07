# Training API Documentation

## Overview
API untuk mengelola data training dalam sistem JTLC Learning Center. Mencakup operasi CRUD lengkap dengan filtering advanced, searching, sorting, dan relasi dengan kategori dan instruktur.

## Base URL
```
http://127.0.0.1:8000/api
```

## Authentication
Semua endpoint memerlukan authentication menggunakan Bearer Token.
```
Authorization: Bearer {your-token}
```

---

## Endpoints

### 1. List All Trainings
Mengambil daftar semua training dengan filtering, searching, sorting, dan paginasi yang sangat fleksibel.

**Endpoint:** `GET /trainings`

**Query Parameters:**
- `is_active` (optional) - Filter berdasarkan status aktif: `true` atau `false`
- `category_id` (optional) - Filter berdasarkan ID kategori
- `instructor_id` (optional) - Filter berdasarkan ID instruktur
- `training_type` (optional) - Filter berdasarkan tipe: `offline`, `online`, atau `hybrid`
- `min_price` (optional) - Filter harga minimum
- `max_price` (optional) - Filter harga maksimum
- `search` (optional) - Pencarian di title dan description
- `sort_by` (optional) - Sorting field: `title`, `price`, `rating`, `created_at`, `updated_at`, `popularity` (default: `created_at`)
- `sort_direction` (optional) - Arah sorting: `asc` atau `desc` (default: `desc`)
- `include` (optional) - Include relationships: `category`, `instructor` (comma-separated)
- `per_page` (optional) - Jumlah data per halaman (default: 15)
- `page` (optional) - Nomor halaman (default: 1)

**Request Example:**
```http
GET /api/trainings?category_id=1&training_type=online&min_price=100000&max_price=500000&search=java&sort_by=popularity&include=category,instructor&per_page=10
Authorization: Bearer {your-token}
```

**Response Example:**
```json
{
    "status": "success",
    "message": "Trainings retrieved successfully",
    "data": [
        {
            "id": 1,
            "title": "Java Programming Fundamentals",
            "description": "Comprehensive Java programming course covering OOP, collections, and best practices.",
            "category_id": 1,
            "category": {
                "id": 1,
                "name": "Programming",
                "description": "Software programming and development courses",
                "icon": "code",
                "color": "#3b82f6",
                "is_active": true,
                "created_at": "2025-10-07 10:00:00",
                "updated_at": "2025-10-07 10:00:00"
            },
            "instructor_id": 1,
            "instructor": {
                "id": 1,
                "name": "Dr. Budi Santoso",
                "specialization": "Java Programming",
                "education": "S3 Teknik Informatika",
                "experience": 10,
                "instructor_type": "internal",
                "email": "budi.santoso@jtlc.com",
                "phone": "081234567890"
            },
            "long_description": "This comprehensive Java programming course is designed for beginners who want to master the fundamentals of Java development. Students will learn object-oriented programming concepts, work with Java collections framework, understand exception handling, and explore best practices for writing clean, maintainable code.",
            "duration": "40 jam",
            "price": 299000.0,
            "capacity": 25,
            "image": "https://example.com/images/java-fundamentals.jpg",
            "training_type": "hybrid",
            "rating": 4.8,
            "review_count": 142,
            "learning_hours": "40",
            "training_methods": "Lecture, Hands-on Lab, Project-based Learning",
            "certification_note": "Certificate of completion provided upon successful finish",
            "is_active": true,
            "created_at": "2025-10-07 10:00:00",
            "updated_at": "2025-10-07 10:00:00"
        }
    ],
    "meta": {
        "current_page": 1,
        "per_page": 10,
        "total": 45,
        "last_page": 5
    }
}
```

---

### 2. Create New Training
Membuat training baru dengan data lengkap dan relasi ke kategori dan instruktur.

**Endpoint:** `POST /trainings`

**Request Body:**
```json
{
    "title": "Advanced React Development",
    "category_id": 1,
    "instructor_id": 3,
    "description": "Master advanced React concepts including hooks, context, performance optimization, and modern patterns.",
    "long_description": "This advanced React course is designed for developers who already have basic React knowledge and want to dive deep into advanced concepts. You'll learn about custom hooks, context API, performance optimization techniques, testing strategies, and modern development patterns. The course includes practical projects and real-world scenarios to solidify your understanding.",
    "duration": "32 jam",
    "price": 450000,
    "capacity": 20,
    "image": "https://example.com/images/react-advanced.jpg",
    "training_type": "online",
    "learning_hours": "32",
    "training_methods": "Interactive Coding Sessions, Live Projects, Peer Reviews",
    "certification_note": "React Advanced Developer Certificate upon completion",
    "is_active": true
}
```

**Validation Rules:**
- `title`: required, string, max 255 characters
- `category_id`: required, integer, must exist in training_categories table
- `instructor_id`: required, integer, must exist in instructors table
- `description`: required, string
- `long_description`: optional, string
- `duration`: required, string, max 50 characters
- `price`: required, numeric, min 0, max 999999.99
- `capacity`: required, integer, min 1, max 1000
- `image`: optional, string, max 255 characters
- `training_type`: required, must be 'offline', 'online', or 'hybrid'
- `rating`: optional, numeric, min 0, max 5
- `review_count`: optional, integer, min 0
- `learning_hours`: optional, string, max 10 characters
- `training_methods`: optional, string
- `certification_note`: optional, string
- `is_active`: optional, boolean (default: true)

**Response Example:**
```json
{
    "status": "success",
    "message": "Training created successfully",
    "data": {
        "id": 46,
        "title": "Advanced React Development",
        "description": "Master advanced React concepts including hooks, context, performance optimization, and modern patterns.",
        "category_id": 1,
        "category": {
            "id": 1,
            "name": "Programming",
            "description": "Software programming and development courses",
            "icon": "code",
            "color": "#3b82f6",
            "is_active": true
        },
        "instructor_id": 3,
        "instructor": {
            "id": 3,
            "name": "Sarah Johnson",
            "specialization": "Frontend Development",
            "education": "S2 Computer Science",
            "experience": 7,
            "instructor_type": "vendor"
        },
        "long_description": "This advanced React course is designed for developers who already have basic React knowledge...",
        "duration": "32 jam",
        "price": 450000.0,
        "capacity": 20,
        "image": "https://example.com/images/react-advanced.jpg",
        "training_type": "online",
        "rating": 0.0,
        "review_count": 0,
        "learning_hours": "32",
        "training_methods": "Interactive Coding Sessions, Live Projects, Peer Reviews",
        "certification_note": "React Advanced Developer Certificate upon completion",
        "is_active": true,
        "created_at": "2025-10-07 16:00:00",
        "updated_at": "2025-10-07 16:00:00"
    }
}
```

**Error Response (Validation):**
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "category_id": ["Kategori training tidak valid."],
        "instructor_id": ["Instruktur tidak valid."],
        "price": ["Harga training harus berupa angka."],
        "training_type": ["Tipe training harus offline, online, atau hybrid."]
    }
}
```

---

### 3. Get Training Details
Mengambil detail training berdasarkan ID dengan relasi yang bisa dikustomisasi.

**Endpoint:** `GET /trainings/{id}`

**Query Parameters:**
- `include` (optional) - Include relationships: `category`, `instructor` (comma-separated, default: both included)

**Request Example:**
```http
GET /api/trainings/1?include=category,instructor
Authorization: Bearer {your-token}
```

**Response Example:**
```json
{
    "status": "success",
    "message": "Training retrieved successfully",
    "data": {
        "id": 1,
        "title": "Java Programming Fundamentals",
        "description": "Comprehensive Java programming course covering OOP, collections, and best practices.",
        "category_id": 1,
        "category": {
            "id": 1,
            "name": "Programming",
            "description": "Software programming and development courses",
            "icon": "code",
            "color": "#3b82f6",
            "is_active": true,
            "created_at": "2025-10-07 10:00:00",
            "updated_at": "2025-10-07 10:00:00"
        },
        "instructor_id": 1,
        "instructor": {
            "id": 1,
            "name": "Dr. Budi Santoso",
            "specialization": "Java Programming",
            "education": "S3 Teknik Informatika",
            "experience": 10,
            "bio": "Experienced Java developer and instructor with 10+ years in enterprise development.",
            "email": "budi.santoso@jtlc.com",
            "phone": "081234567890",
            "instructor_type": "internal",
            "company": "JTLC",
            "certifications": [
                {
                    "id": 1,
                    "certification_name": "Oracle Certified Professional Java SE",
                    "instructor_id": 1
                }
            ]
        },
        "long_description": "This comprehensive Java programming course is designed for beginners who want to master the fundamentals of Java development...",
        "duration": "40 jam",
        "price": 299000.0,
        "capacity": 25,
        "image": "https://example.com/images/java-fundamentals.jpg",
        "training_type": "hybrid",
        "rating": 4.8,
        "review_count": 142,
        "learning_hours": "40",
        "training_methods": "Lecture, Hands-on Lab, Project-based Learning",
        "certification_note": "Certificate of completion provided upon successful finish",
        "is_active": true,
        "created_at": "2025-10-07 10:00:00",
        "updated_at": "2025-10-07 10:00:00"
    }
}
```

**Error Response (Not Found):**
```json
{
    "status": "error",
    "message": "Training not found"
}
```

---

### 4. Update Training
Mengupdate data training yang sudah ada dengan partial update support.

**Endpoint:** `PUT /trainings/{id}`

**Request Body (Partial Update Example):**
```json
{
    "title": "Java Programming Fundamentals - Updated Edition",
    "price": 350000,
    "capacity": 30,
    "rating": 4.9,
    "review_count": 156,
    "long_description": "Updated comprehensive Java programming course with latest Java 21 features..."
}
```

**Response Example:**
```json
{
    "status": "success",
    "message": "Training updated successfully",
    "data": {
        "id": 1,
        "title": "Java Programming Fundamentals - Updated Edition",
        "description": "Comprehensive Java programming course covering OOP, collections, and best practices.",
        "category_id": 1,
        "category": {
            "id": 1,
            "name": "Programming"
        },
        "instructor_id": 1,
        "instructor": {
            "id": 1,
            "name": "Dr. Budi Santoso"
        },
        "long_description": "Updated comprehensive Java programming course with latest Java 21 features...",
        "duration": "40 jam",
        "price": 350000.0,
        "capacity": 30,
        "image": "https://example.com/images/java-fundamentals.jpg",
        "training_type": "hybrid",
        "rating": 4.9,
        "review_count": 156,
        "learning_hours": "40",
        "training_methods": "Lecture, Hands-on Lab, Project-based Learning",
        "certification_note": "Certificate of completion provided upon successful finish",
        "is_active": true,
        "created_at": "2025-10-07 10:00:00",
        "updated_at": "2025-10-07 16:30:00"
    }
}
```

**Notes:**
- Update menggunakan validation rules yang sama seperti create
- Partial updates didukung - hanya field yang dikirim yang akan diupdate
- Foreign key validation tetap berlaku untuk `category_id` dan `instructor_id`

---

### 5. Delete Training
Menghapus training dari sistem.

**Endpoint:** `DELETE /trainings/{id}`

**Request Example:**
```http
DELETE /api/trainings/46
Authorization: Bearer {your-token}
```

**Response Example:**
```json
{
    "status": "success",
    "message": "Training deleted successfully"
}
```

**Error Response (Not Found):**
```json
{
    "status": "error",
    "message": "Training not found"
}
```

---

## Advanced Filtering Examples

### 1. Filter by Price Range
```http
GET /api/trainings?min_price=200000&max_price=500000
```

### 2. Filter by Multiple Criteria
```http
GET /api/trainings?category_id=1&training_type=online&is_active=true&sort_by=rating&sort_direction=desc
```

### 3. Search with Sorting
```http
GET /api/trainings?search=programming&sort_by=popularity
```

### 4. Complex Query
```http
GET /api/trainings?category_id=1&instructor_id=2&training_type=hybrid&min_price=100000&search=advanced&sort_by=price&sort_direction=asc&per_page=5&include=category,instructor
```

---

## Usage Examples

### Using cURL

**1. List Trainings with Advanced Filter:**
```bash
curl -X GET "http://127.0.0.1:8000/api/trainings?category_id=1&training_type=online&sort_by=rating&include=category,instructor" \
  -H "Authorization: Bearer your-token-here" \
  -H "Accept: application/json"
```

**2. Create New Training:**
```bash
curl -X POST "http://127.0.0.1:8000/api/trainings" \
  -H "Authorization: Bearer your-token-here" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "title": "Python Data Science Bootcamp",
    "category_id": 2,
    "instructor_id": 4,
    "description": "Intensive Python data science course covering pandas, numpy, matplotlib, and machine learning basics.",
    "duration": "60 jam",
    "price": 750000,
    "capacity": 15,
    "training_type": "hybrid",
    "learning_hours": "60",
    "training_methods": "Interactive Sessions, Real Projects, Mentoring",
    "certification_note": "Data Science Certificate with portfolio projects"
  }'
```

**3. Update Training Price:**
```bash
curl -X PUT "http://127.0.0.1:8000/api/trainings/1" \
  -H "Authorization: Bearer your-token-here" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "price": 399000,
    "capacity": 35
  }'
```

**4. Search Trainings:**
```bash
curl -X GET "http://127.0.0.1:8000/api/trainings?search=java&sort_by=rating&sort_direction=desc" \
  -H "Authorization: Bearer your-token-here" \
  -H "Accept: application/json"
```

---

## Error Handling

### Common HTTP Status Codes:
- **200 OK** - Request berhasil
- **201 Created** - Training berhasil dibuat
- **404 Not Found** - Training tidak ditemukan
- **422 Unprocessable Entity** - Validation error
- **401 Unauthorized** - Token tidak valid atau tidak ada

### Validation Error Example:
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "title": ["Judul training wajib diisi."],
        "category_id": ["Kategori training tidak valid."],
        "price": ["Harga training harus berupa angka."],
        "capacity": ["Kapasitas training minimal 1 orang."],
        "training_type": ["Tipe training harus offline, online, atau hybrid."]
    }
}
```

---

## Data Types & Constraints

### Training Fields:
| Field | Type | Required | Constraints |
|-------|------|----------|-------------|
| title | string | Yes | Max 255 characters |
| category_id | integer | Yes | Must exist in training_categories |
| instructor_id | integer | Yes | Must exist in instructors |
| description | text | Yes | No specific limit |
| long_description | text | No | No specific limit |
| duration | string | Yes | Max 50 characters |
| price | decimal | Yes | Min 0, Max 999999.99 |
| capacity | integer | Yes | Min 1, Max 1000 |
| image | string | No | Max 255 characters (URL) |
| training_type | enum | Yes | 'offline', 'online', 'hybrid' |
| rating | decimal | No | Min 0, Max 5 |
| review_count | integer | No | Min 0 |
| learning_hours | string | No | Max 10 characters |
| training_methods | text | No | No specific limit |
| certification_note | text | No | No specific limit |
| is_active | boolean | No | Default: true |

---

## Sorting Options

### Available Sort Fields:
- `title` - Alphabetical sorting
- `price` - Price sorting (lowest/highest)
- `rating` - Rating sorting (lowest/highest)
- `created_at` - Creation date (newest/oldest)
- `updated_at` - Last update date
- `popularity` - Special sorting by algorithm (rating + review_count)

### Sort Directions:
- `asc` - Ascending order
- `desc` - Descending order (default)

---

## Business Rules

1. **Foreign Key Integrity**: Category dan Instructor harus valid dan aktif
2. **Price Validation**: Harga tidak boleh negatif dan ada batas maksimum
3. **Capacity Limits**: Kapasitas minimum 1 orang, maksimum 1000 orang
4. **Training Types**: Hanya menerima 'offline', 'online', atau 'hybrid'
5. **Rating System**: Rating 0-5 dengan review count yang konsisten
6. **Active Status**: Default aktif untuk training baru
7. **Search Functionality**: Mencari di title dan description secara case-insensitive

---

## Performance Notes

1. **Eager Loading**: Gunakan `include` parameter untuk menghindari N+1 queries
2. **Pagination**: Gunakan pagination untuk dataset besar (max 100 per page)
3. **Indexing**: Database diindeks pada fields yang sering difilter
4. **Caching**: Response dapat di-cache untuk performa yang lebih baik

---

## Rate Limiting
API menggunakan rate limiting standar Laravel. Default: 60 requests per minute per user.

## Versioning
Current API version: v1. Semua endpoint menggunakan prefix `/api/`.