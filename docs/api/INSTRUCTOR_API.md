# Instructor API Documentation

## Overview
API untuk mengelola data instruktur dalam sistem JTLC Learning Center. Mencakup operasi CRUD lengkap dengan filtering, searching, dan manajemen sertifikasi instruktur.

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

### 1. List All Instructors
Mengambil daftar semua instruktur dengan paginasi dan filtering.

**Endpoint:** `GET /instructors`

**Query Parameters:**
- `instructor_type` (optional) - Filter berdasarkan tipe: `internal` atau `vendor`
- `specialization` (optional) - Filter berdasarkan spesialisasi (partial match)
- `search` (optional) - Pencarian di nama, email, dan spesialisasi
- `per_page` (optional) - Jumlah data per halaman (default: 15)
- `page` (optional) - Nomor halaman (default: 1)

**Request Example:**
```http
GET /api/instructors?instructor_type=internal&search=java&per_page=10&page=1
Authorization: Bearer {your-token}
```

**Response Example:**
```json
{
    "status": "success",
    "message": "Instructors retrieved successfully",
    "data": [
        {
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
                    "instructor_id": 1,
                    "created_at": "2025-10-07 10:00:00",
                    "updated_at": "2025-10-07 10:00:00"
                },
                {
                    "id": 2,
                    "certification_name": "Spring Framework Certified Developer",
                    "instructor_id": 1,
                    "created_at": "2025-10-07 10:00:00",
                    "updated_at": "2025-10-07 10:00:00"
                }
            ],
            "created_at": "2025-10-07 10:00:00",
            "updated_at": "2025-10-07 10:00:00"
        }
    ],
    "meta": {
        "current_page": 1,
        "per_page": 10,
        "total": 25,
        "last_page": 3
    }
}
```

---

### 2. Create New Instructor
Membuat data instruktur baru beserta sertifikasinya.

**Endpoint:** `POST /instructors`

**Request Body:**
```json
{
    "name": "Dr. Sari Widiastuti",
    "specialization": "Data Science & Machine Learning",
    "education": "S3 Statistika",
    "experience": 8,
    "bio": "Data Science expert with extensive experience in machine learning and statistical analysis. Published researcher in AI applications.",
    "email": "sari.widiastuti@vendor.com",
    "phone": "081987654321",
    "instructor_type": "vendor",
    "company": "DataTech Solutions",
    "image": "https://example.com/photos/sari.jpg",
    "certifications": [
        "Certified Data Scientist (CDS)",
        "AWS Machine Learning Specialty",
        "Google Cloud Professional Data Engineer"
    ]
}
```

**Validation Rules:**
- `name`: required, string, max 255 characters
- `specialization`: required, string, max 255 characters  
- `education`: required, string, max 255 characters
- `experience`: required, integer, min 0, max 50
- `bio`: required, string
- `email`: required, email, max 255 characters, unique
- `phone`: required, string, max 20 characters
- `instructor_type`: required, must be 'internal' or 'vendor'
- `company`: optional, string, max 255 characters
- `image`: optional, string, max 255 characters
- `certifications`: optional, array of strings (max 255 characters each)

**Response Example:**
```json
{
    "status": "success",
    "message": "Instructor created successfully",
    "data": {
        "id": 26,
        "name": "Dr. Sari Widiastuti",
        "specialization": "Data Science & Machine Learning",
        "education": "S3 Statistika",
        "experience": 8,
        "bio": "Data Science expert with extensive experience in machine learning and statistical analysis. Published researcher in AI applications.",
        "email": "sari.widiastuti@vendor.com",
        "phone": "081987654321",
        "instructor_type": "vendor",
        "company": "DataTech Solutions",
        "certifications": [
            {
                "id": 78,
                "certification_name": "Certified Data Scientist (CDS)",
                "instructor_id": 26,
                "created_at": "2025-10-07 14:30:00",
                "updated_at": "2025-10-07 14:30:00"
            },
            {
                "id": 79,
                "certification_name": "AWS Machine Learning Specialty",
                "instructor_id": 26,
                "created_at": "2025-10-07 14:30:00",
                "updated_at": "2025-10-07 14:30:00"
            },
            {
                "id": 80,
                "certification_name": "Google Cloud Professional Data Engineer",
                "instructor_id": 26,
                "created_at": "2025-10-07 14:30:00",
                "updated_at": "2025-10-07 14:30:00"
            }
        ],
        "created_at": "2025-10-07 14:30:00",
        "updated_at": "2025-10-07 14:30:00"
    }
}
```

**Error Response (Validation):**
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": ["Email sudah digunakan oleh instruktur lain."],
        "instructor_type": ["Tipe instruktur harus internal atau vendor."],
        "experience": ["Pengalaman instruktur wajib diisi."]
    }
}
```

---

### 3. Get Instructor Details
Mengambil detail instruktur berdasarkan ID.

**Endpoint:** `GET /instructors/{id}`

**Request Example:**
```http
GET /api/instructors/1
Authorization: Bearer {your-token}
```

**Response Example:**
```json
{
    "status": "success",
    "message": "Instructor retrieved successfully",
    "data": {
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
                "instructor_id": 1,
                "created_at": "2025-10-07 10:00:00",
                "updated_at": "2025-10-07 10:00:00"
            }
        ],
        "created_at": "2025-10-07 10:00:00",
        "updated_at": "2025-10-07 10:00:00"
    }
}
```

**Error Response (Not Found):**
```json
{
    "status": "error",
    "message": "Instructor not found"
}
```

---

### 4. Update Instructor
Mengupdate data instruktur yang sudah ada.

**Endpoint:** `PUT /instructors/{id}`

**Request Body:**
```json
{
    "name": "Dr. Budi Santoso",
    "specialization": "Java Programming & Spring Framework",
    "education": "S3 Teknik Informatika",
    "experience": 12,
    "bio": "Senior Java developer and instructor with 12+ years in enterprise development. Specialized in Spring ecosystem and microservices architecture.",
    "email": "budi.santoso@jtlc.com",
    "phone": "081234567890",
    "instructor_type": "internal",
    "company": "JTLC",
    "image": "https://example.com/photos/budi-updated.jpg",
    "certifications": [
        "Oracle Certified Professional Java SE",
        "Spring Framework Certified Developer",
        "Kubernetes Application Developer"
    ]
}
```

**Response Example:**
```json
{
    "status": "success",
    "message": "Instructor updated successfully",
    "data": {
        "id": 1,
        "name": "Dr. Budi Santoso",
        "specialization": "Java Programming & Spring Framework",
        "education": "S3 Teknik Informatika",
        "experience": 12,
        "bio": "Senior Java developer and instructor with 12+ years in enterprise development. Specialized in Spring ecosystem and microservices architecture.",
        "email": "budi.santoso@jtlc.com",
        "phone": "081234567890",
        "instructor_type": "internal",
        "company": "JTLC",
        "certifications": [
            {
                "id": 81,
                "certification_name": "Oracle Certified Professional Java SE",
                "instructor_id": 1,
                "created_at": "2025-10-07 15:00:00",
                "updated_at": "2025-10-07 15:00:00"
            },
            {
                "id": 82,
                "certification_name": "Spring Framework Certified Developer",
                "instructor_id": 1,
                "created_at": "2025-10-07 15:00:00",
                "updated_at": "2025-10-07 15:00:00"
            },
            {
                "id": 83,
                "certification_name": "Kubernetes Application Developer",
                "instructor_id": 1,
                "created_at": "2025-10-07 15:00:00",
                "updated_at": "2025-10-07 15:00:00"
            }
        ],
        "created_at": "2025-10-07 10:00:00",
        "updated_at": "2025-10-07 15:00:00"
    }
}
```

**Notes:**
- Jika `certifications` disertakan dalam request, semua sertifikasi lama akan dihapus dan diganti dengan yang baru
- Jika `certifications` tidak disertakan, sertifikasi yang ada tidak akan berubah
- Update menggunakan same validation rules seperti create, kecuali email unique dikecualikan untuk record yang sama

---

### 5. Delete Instructor
Menghapus data instruktur dan semua sertifikasinya.

**Endpoint:** `DELETE /instructors/{id}`

**Request Example:**
```http
DELETE /api/instructors/26
Authorization: Bearer {your-token}
```

**Response Example:**
```json
{
    "status": "success",
    "message": "Instructor deleted successfully"
}
```

**Error Response (Not Found):**
```json
{
    "status": "error",
    "message": "Instructor not found"
}
```

---

## Usage Examples

### Using cURL

**1. List Instructors with Filtering:**
```bash
curl -X GET "http://127.0.0.1:8000/api/instructors?instructor_type=internal&search=java" \
  -H "Authorization: Bearer your-token-here" \
  -H "Accept: application/json"
```

**2. Create New Instructor:**
```bash
curl -X POST "http://127.0.0.1:8000/api/instructors" \
  -H "Authorization: Bearer your-token-here" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "name": "Ahmad Fauzi",
    "specialization": "React & Node.js",
    "education": "S2 Teknik Informatika",
    "experience": 5,
    "bio": "Full-stack JavaScript developer with expertise in React and Node.js ecosystem.",
    "email": "ahmad.fauzi@freelance.com",
    "phone": "082345678901",
    "instructor_type": "vendor",
    "company": "Freelance",
    "certifications": ["React Developer Certification", "Node.js Certified Developer"]
  }'
```

**3. Update Instructor:**
```bash
curl -X PUT "http://127.0.0.1:8000/api/instructors/1" \
  -H "Authorization: Bearer your-token-here" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "name": "Dr. Budi Santoso",
    "experience": 13,
    "certifications": ["Oracle Certified Master Java SE", "Spring Professional"]
  }'
```

**4. Delete Instructor:**
```bash
curl -X DELETE "http://127.0.0.1:8000/api/instructors/26" \
  -H "Authorization: Bearer your-token-here" \
  -H "Accept: application/json"
```

---

## Error Handling

### Common HTTP Status Codes:
- **200 OK** - Request berhasil
- **201 Created** - Resource berhasil dibuat
- **404 Not Found** - Resource tidak ditemukan
- **422 Unprocessable Entity** - Validation error
- **401 Unauthorized** - Token tidak valid atau tidak ada

### Error Response Format:
```json
{
    "status": "error",
    "message": "Error description",
    "errors": {
        "field_name": ["Specific validation error message"]
    }
}
```

---

## Data Types & Constraints

### Instructor Fields:
| Field | Type | Required | Constraints |
|-------|------|----------|-------------|
| name | string | Yes | Max 255 characters |
| specialization | string | Yes | Max 255 characters |
| education | string | Yes | Max 255 characters |
| experience | integer | Yes | Min 0, Max 50 years |
| bio | text | Yes | No specific limit |
| email | string | Yes | Valid email, unique, max 255 |
| phone | string | Yes | Max 20 characters |
| instructor_type | enum | Yes | 'internal' or 'vendor' |
| company | string | No | Max 255 characters |
| image | string | No | Max 255 characters (URL) |

### Certification Fields:
| Field | Type | Required | Constraints |
|-------|------|----------|-------------|
| certification_name | string | Yes | Max 255 characters |

---

## Business Rules

1. **Email Uniqueness**: Setiap instruktur harus memiliki email yang unik
2. **Certification Management**: Sertifikasi terikat pada instruktur dan akan terhapus jika instruktur dihapus
3. **Instructor Types**: Hanya menerima 'internal' (instruktur JTLC) atau 'vendor' (instruktur eksternal)
4. **Company Field**: Wajib untuk vendor, opsional untuk internal
5. **Experience Limit**: Maksimal 50 tahun pengalaman (validasi logis)

---

## Rate Limiting
API menggunakan rate limiting standar Laravel. Default: 60 requests per minute per user.

## Versioning
Current API version: v1. Semua endpoint menggunakan prefix `/api/`.