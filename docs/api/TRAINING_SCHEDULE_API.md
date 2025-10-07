# Training Schedule API Documentation

## Overview
API untuk mengelola jadwal training dalam sistem JTLC Learning Center. Mencakup operasi CRUD lengkap dengan fitur khusus seperti statistics, duplicate, filtering berdasarkan jadwal, dan management status. API ini adalah yang paling kompleks dengan banyak endpoint spesial untuk kebutuhan scheduling.

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

### 1. List Training Schedules
Mengambil daftar jadwal training dengan filtering komprehensif dan pilihan paginasi.

**Endpoint:** `GET /training-schedules`

**Query Parameters:**
- `training_id` (optional) - Filter berdasarkan ID training
- `status` (optional) - Filter berdasarkan status: `buka_pendaftaran`, `penuh`, `berlangsung`, `selesai`, `dibatalkan`
- `method` (optional) - Filter berdasarkan metode: `offline`, `online`, `hybrid`
- `month` (optional) - Filter berdasarkan bulan (format: YYYY-MM)
- `start_date` (optional) - Filter jadwal mulai dari tanggal (format: YYYY-MM-DD)
- `end_date` (optional) - Filter jadwal sampai tanggal (format: YYYY-MM-DD)
- `available_only` (optional) - Hanya jadwal yang tersedia: `true` atau `false`
- `paginate` (optional) - Aktifkan paginasi: `true` atau `false`
- `per_page` (optional) - Jumlah data per halaman jika paginate=true (default: 15)
- `page` (optional) - Nomor halaman jika paginate=true (default: 1)

**Request Example:**
```http
GET /api/training-schedules?status=buka_pendaftaran&method=online&month=2025-11&paginate=true&per_page=10
Authorization: Bearer {your-token}
```

**Response Example (With Pagination):**
```json
{
    "status": "success",
    "message": "Training schedules retrieved successfully",
    "data": [
        {
            "id": 1,
            "training_id": 1,
            "training": {
                "id": 1,
                "title": "Java Programming Fundamentals",
                "description": "Comprehensive Java programming course",
                "category_id": 1,
                "instructor_id": 1,
                "duration": "40 jam",
                "price": 299000.0,
                "training_type": "hybrid"
            },
            "start_date": "2025-11-15",
            "end_date": "2025-11-19",
            "start_time": "09:00",
            "end_time": "17:00",
            "location": "JTLC Learning Center - Room A1",
            "method": "offline",
            "total_slots": 25,
            "available_slots": 18,
            "registered_count": 7,
            "month": "2025-11",
            "status": "buka_pendaftaran",
            "is_full": false,
            "can_register": true,
            "formatted_date_range": "15 - 19 November 2025",
            "formatted_time_range": "09:00 - 17:00",
            "created_at": "2025-10-07 10:00:00",
            "updated_at": "2025-10-07 10:00:00"
        }
    ],
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 3,
        "per_page": 10,
        "to": 10,
        "total": 28
    }
}
```

**Response Example (Without Pagination):**
```json
{
    "status": "success",
    "message": "Training schedules retrieved successfully",
    "data": [
        // Array of training schedule objects (same structure as above)
    ]
}
```

---

### 2. Create Training Schedule
Membuat jadwal training baru dengan validasi komprehensif.

**Endpoint:** `POST /training-schedules`

**Request Body:**
```json
{
    "training_id": 1,
    "start_date": "2025-12-01",
    "end_date": "2025-12-05",
    "start_time": "09:00",
    "end_time": "17:00",
    "location": "JTLC Learning Center - Room B2",
    "method": "hybrid",
    "total_slots": 30,
    "available_slots": 30,
    "registered_count": 0,
    "status": "buka_pendaftaran"
}
```

**Auto-Generated Fields:**
Jika tidak disediakan, sistem akan otomatis mengisi:
- `available_slots`: Sama dengan `total_slots`
- `registered_count`: Default 0
- `month`: Auto-generated dari `start_date` (format: YYYY-MM)
- `status`: Default `buka_pendaftaran`

**Validation Rules:**
- `training_id`: required, integer, must exist in trainings table
- `start_date`: required, date, must be today or later
- `end_date`: required, date, must be >= start_date
- `start_time`: required, format HH:MM
- `end_time`: required, format HH:MM, must be after start_time
- `location`: required, string, max 255 characters
- `method`: required, must be 'offline', 'online', or 'hybrid'
- `total_slots`: required, integer, min 1, max 1000
- `available_slots`: optional, integer, min 0, must be <= total_slots
- `registered_count`: optional, integer, min 0, must be <= total_slots
- `month`: optional, format YYYY-MM
- `status`: optional, must be one of allowed status values

**Response Example:**
```json
{
    "status": "success",
    "message": "Training schedule created successfully",
    "data": {
        "id": 29,
        "training_id": 1,
        "training": {
            "id": 1,
            "title": "Java Programming Fundamentals",
            "description": "Comprehensive Java programming course",
            "category_id": 1,
            "instructor_id": 1,
            "duration": "40 jam",
            "price": 299000.0
        },
        "start_date": "2025-12-01",
        "end_date": "2025-12-05",
        "start_time": "09:00",
        "end_time": "17:00",
        "location": "JTLC Learning Center - Room B2",
        "method": "hybrid",
        "total_slots": 30,
        "available_slots": 30,
        "registered_count": 0,
        "month": "2025-12",
        "status": "buka_pendaftaran",
        "is_full": false,
        "can_register": true,
        "formatted_date_range": "01 - 05 December 2025",
        "formatted_time_range": "09:00 - 17:00",
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
        "training_id": ["Training yang dipilih tidak valid."],
        "start_date": ["Tanggal mulai tidak boleh kurang dari hari ini."],
        "end_time": ["Waktu selesai harus lebih dari waktu mulai."],
        "total_slots": ["Jumlah slot minimal 1."]
    }
}
```

---

### 3. Get Schedule Details
Mengambil detail jadwal training berdasarkan ID.

**Endpoint:** `GET /training-schedules/{id}`

**Request Example:**
```http
GET /api/training-schedules/1
Authorization: Bearer {your-token}
```

**Response Example:**
```json
{
    "status": "success",
    "message": "Training schedule retrieved successfully",
    "data": {
        "id": 1,
        "training_id": 1,
        "training": {
            "id": 1,
            "title": "Java Programming Fundamentals",
            "description": "Comprehensive Java programming course",
            "category": {
                "id": 1,
                "name": "Programming"
            },
            "instructor": {
                "id": 1,
                "name": "Dr. Budi Santoso",
                "specialization": "Java Programming"
            }
        },
        "start_date": "2025-11-15",
        "end_date": "2025-11-19",
        "start_time": "09:00",
        "end_time": "17:00",
        "location": "JTLC Learning Center - Room A1",
        "method": "offline",
        "total_slots": 25,
        "available_slots": 18,
        "registered_count": 7,
        "month": "2025-11",
        "status": "buka_pendaftaran",
        "is_full": false,
        "can_register": true,
        "formatted_date_range": "15 - 19 November 2025",
        "formatted_time_range": "09:00 - 17:00",
        "created_at": "2025-10-07 10:00:00",
        "updated_at": "2025-10-07 10:00:00"
    }
}
```

---

### 4. Update Training Schedule
Mengupdate jadwal training yang sudah ada.

**Endpoint:** `PUT /training-schedules/{id}`

**Request Body:**
```json
{
    "start_date": "2025-11-20",
    "end_date": "2025-11-24",
    "location": "JTLC Learning Center - Room A2 (Updated)",
    "total_slots": 35,
    "available_slots": 32,
    "registered_count": 3
}
```

**Response Example:**
```json
{
    "status": "success",
    "message": "Training schedule updated successfully",
    "data": {
        "id": 1,
        "training_id": 1,
        "start_date": "2025-11-20",
        "end_date": "2025-11-24",
        "start_time": "09:00",
        "end_time": "17:00",
        "location": "JTLC Learning Center - Room A2 (Updated)",
        "method": "offline",
        "total_slots": 35,
        "available_slots": 32,
        "registered_count": 3,
        "month": "2025-11",
        "status": "buka_pendaftaran",
        "is_full": false,
        "can_register": true,
        "formatted_date_range": "20 - 24 November 2025",
        "formatted_time_range": "09:00 - 17:00",
        "created_at": "2025-10-07 10:00:00",
        "updated_at": "2025-10-07 16:30:00"
    }
}
```

---

### 5. Delete Training Schedule
Menghapus jadwal training (dengan pembatasan jika ada registrasi).

**Endpoint:** `DELETE /training-schedules/{id}`

**Request Example:**
```http
DELETE /api/training-schedules/29
Authorization: Bearer {your-token}
```

**Response Example:**
```json
{
    "status": "success",
    "message": "Training schedule deleted successfully"
}
```

**Error Response (Has Registrations):**
```json
{
    "status": "error",
    "message": "Failed to delete training schedule",
    "error": "Cannot delete schedule with existing registrations"
}
```

---

## Special Endpoints

### 6. Get Schedules by Training
Mengambil semua jadwal untuk training tertentu.

**Endpoint:** `GET /training-schedules/training/{trainingId}`

**Request Example:**
```http
GET /api/training-schedules/training/1
Authorization: Bearer {your-token}
```

**Response Example:**
```json
{
    "status": "success",
    "message": "Training schedules retrieved successfully",
    "data": [
        {
            "id": 1,
            "training_id": 1,
            "start_date": "2025-11-15",
            "end_date": "2025-11-19",
            "status": "buka_pendaftaran",
            "available_slots": 18,
            "total_slots": 25
        },
        {
            "id": 15,
            "training_id": 1,
            "start_date": "2025-12-01",
            "end_date": "2025-12-05",
            "status": "buka_pendaftaran",
            "available_slots": 30,
            "total_slots": 30
        }
    ]
}
```

---

### 7. Get Available Schedules
Mengambil semua jadwal yang tersedia untuk registrasi.

**Endpoint:** `GET /training-schedules/available`

**Request Example:**
```http
GET /api/training-schedules/available
Authorization: Bearer {your-token}
```

**Response Example:**
```json
{
    "status": "success",
    "message": "Available training schedules retrieved successfully",
    "data": [
        {
            "id": 1,
            "training_id": 1,
            "training": {
                "title": "Java Programming Fundamentals",
                "price": 299000.0
            },
            "start_date": "2025-11-15",
            "end_date": "2025-11-19",
            "status": "buka_pendaftaran",
            "available_slots": 18,
            "total_slots": 25,
            "can_register": true
        }
    ]
}
```

---

### 8. Get Upcoming Schedules
Mengambil jadwal training yang akan datang (dengan limit).

**Endpoint:** `GET /training-schedules/upcoming`

**Query Parameters:**
- `limit` (optional) - Jumlah maksimal schedule yang dikembalikan (default: 10)

**Request Example:**
```http
GET /api/training-schedules/upcoming?limit=5
Authorization: Bearer {your-token}
```

**Response Example:**
```json
{
    "status": "success",
    "message": "Upcoming training schedules retrieved successfully",
    "data": [
        {
            "id": 1,
            "training_id": 1,
            "training": {
                "title": "Java Programming Fundamentals",
                "instructor": {
                    "name": "Dr. Budi Santoso"
                }
            },
            "start_date": "2025-11-15",
            "end_date": "2025-11-19",
            "start_time": "09:00",
            "location": "JTLC Learning Center - Room A1",
            "status": "buka_pendaftaran",
            "available_slots": 18,
            "formatted_date_range": "15 - 19 November 2025"
        }
    ]
}
```

---

### 9. Get Schedules by Month (Calendar View)
Mengambil jadwal training untuk bulan tertentu (berguna untuk tampilan kalender).

**Endpoint:** `GET /training-schedules/by-month`

**Query Parameters:**
- `month` (optional) - Bulan dalam format YYYY-MM (default: bulan saat ini)

**Request Example:**
```http
GET /api/training-schedules/by-month?month=2025-11
Authorization: Bearer {your-token}
```

**Response Example:**
```json
{
    "status": "success",
    "message": "Training schedules for month retrieved successfully",
    "data": [
        {
            "id": 1,
            "training_id": 1,
            "training": {
                "title": "Java Programming Fundamentals",
                "category": {
                    "name": "Programming",
                    "color": "#3b82f6"
                }
            },
            "start_date": "2025-11-15",
            "end_date": "2025-11-19",
            "start_time": "09:00",
            "end_time": "17:00",
            "status": "buka_pendaftaran",
            "available_slots": 18,
            "total_slots": 25
        }
    ]
}
```

**Error Response (Invalid Month Format):**
```json
{
    "status": "error",
    "message": "Invalid month format. Use YYYY-MM format."
}
```

---

### 10. Change Schedule Status
Mengubah status jadwal training.

**Endpoint:** `PATCH /training-schedules/{id}/status`

**Request Body:**
```json
{
    "status": "berlangsung"
}
```

**Available Status Values:**
- `buka_pendaftaran` - Pendaftaran terbuka
- `penuh` - Jadwal penuh
- `berlangsung` - Sedang berlangsung
- `selesai` - Sudah selesai
- `dibatalkan` - Dibatalkan

**Response Example:**
```json
{
    "status": "success",
    "message": "Training schedule status updated successfully",
    "data": {
        "id": 1,
        "training_id": 1,
        "start_date": "2025-11-15",
        "status": "berlangsung",
        "available_slots": 18,
        "can_register": false,
        "updated_at": "2025-10-07 16:45:00"
    }
}
```

**Error Response (Invalid Status):**
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "status": ["The selected status is invalid."]
    }
}
```

---

### 11. Duplicate Schedule
Membuat salinan jadwal dengan kemungkinan override beberapa field.

**Endpoint:** `POST /training-schedules/{id}/duplicate`

**Request Body (Optional Overrides):**
```json
{
    "start_date": "2025-12-15",
    "end_date": "2025-12-19",
    "start_time": "10:00",
    "end_time": "18:00",
    "location": "JTLC Learning Center - Room C1",
    "total_slots": 40
}
```

**Available Override Fields:**
- `start_date` - Tanggal mulai baru
- `end_date` - Tanggal selesai baru
- `start_time` - Waktu mulai baru
- `end_time` - Waktu selesai baru
- `location` - Lokasi baru
- `total_slots` - Total slot baru

**Response Example:**
```json
{
    "status": "success",
    "message": "Training schedule duplicated successfully",
    "data": {
        "id": 30,
        "training_id": 1,
        "training": {
            "id": 1,
            "title": "Java Programming Fundamentals"
        },
        "start_date": "2025-12-15",
        "end_date": "2025-12-19",
        "start_time": "10:00",
        "end_time": "18:00",
        "location": "JTLC Learning Center - Room C1",
        "method": "offline",
        "total_slots": 40,
        "available_slots": 40,
        "registered_count": 0,
        "month": "2025-12",
        "status": "buka_pendaftaran",
        "is_full": false,
        "can_register": true,
        "created_at": "2025-10-07 17:00:00",
        "updated_at": "2025-10-07 17:00:00"
    }
}
```

**Auto-Reset Fields in Duplicate:**
- `available_slots`: Reset to `total_slots`
- `registered_count`: Reset to 0
- `status`: Reset to `buka_pendaftaran`
- `month`: Auto-calculated from new `start_date`

---

### 12. Get Schedule Statistics
Mendapatkan statistik jadwal training (dashboard analytics).

**Endpoint:** `GET /training-schedules/statistics`

**Query Parameters:**
- `training_id` (optional) - Filter statistik untuk training tertentu
- `month` (optional) - Filter statistik untuk bulan tertentu (format: YYYY-MM)

**Request Example:**
```http
GET /api/training-schedules/statistics?month=2025-11
Authorization: Bearer {your-token}
```

**Response Example:**
```json
{
    "status": "success",
    "message": "Training schedule statistics retrieved successfully",
    "data": {
        "total_schedules": 25,
        "available_schedules": 15,
        "full_schedules": 5,
        "ongoing_schedules": 3,
        "completed_schedules": 2,
        "total_slots": 625,
        "total_registered": 387,
        "total_available_slots": 238,
        "utilization_rate": 61.9
    }
}
```

**Response with Training Filter:**
```http
GET /api/training-schedules/statistics?training_id=1&month=2025-11
```

```json
{
    "status": "success",
    "message": "Training schedule statistics retrieved successfully",
    "data": {
        "total_schedules": 3,
        "available_schedules": 2,
        "full_schedules": 0,
        "ongoing_schedules": 1,
        "completed_schedules": 0,
        "total_slots": 85,
        "total_registered": 32,
        "total_available_slots": 53,
        "utilization_rate": 37.6
    }
}
```

---

## Advanced Filtering Examples

### 1. Complex Multi-Filter Query
```http
GET /api/training-schedules?training_id=1&status=buka_pendaftaran&method=hybrid&month=2025-11&available_only=true&paginate=true&per_page=5
```

### 2. Date Range Filter
```http
GET /api/training-schedules?start_date=2025-11-01&end_date=2025-11-30&status=buka_pendaftaran
```

### 3. Available Slots Only
```http
GET /api/training-schedules?available_only=true&method=online
```

---

## Usage Examples

### Using cURL

**1. Create New Schedule:**
```bash
curl -X POST "http://127.0.0.1:8000/api/training-schedules" \
  -H "Authorization: Bearer your-token-here" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "training_id": 1,
    "start_date": "2025-12-01",
    "end_date": "2025-12-05",
    "start_time": "09:00",
    "end_time": "17:00",
    "location": "JTLC Learning Center - Room A1",
    "method": "offline",
    "total_slots": 25
  }'
```

**2. Duplicate Schedule with Overrides:**
```bash
curl -X POST "http://127.0.0.1:8000/api/training-schedules/1/duplicate" \
  -H "Authorization: Bearer your-token-here" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "start_date": "2025-12-15",
    "end_date": "2025-12-19",
    "location": "Online Platform",
    "method": "online",
    "total_slots": 50
  }'
```

**3. Change Schedule Status:**
```bash
curl -X PATCH "http://127.0.0.1:8000/api/training-schedules/1/status" \
  -H "Authorization: Bearer your-token-here" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "status": "berlangsung"
  }'
```

**4. Get Statistics:**
```bash
curl -X GET "http://127.0.0.1:8000/api/training-schedules/statistics?month=2025-11" \
  -H "Authorization: Bearer your-token-here" \
  -H "Accept: application/json"
```

**5. Filter Available Schedules:**
```bash
curl -X GET "http://127.0.0.1:8000/api/training-schedules?available_only=true&method=online&paginate=true&per_page=10" \
  -H "Authorization: Bearer your-token-here" \
  -H "Accept: application/json"
```

---

## Error Handling

### Common HTTP Status Codes:
- **200 OK** - Request berhasil
- **201 Created** - Schedule berhasil dibuat/diduplicate
- **404 Not Found** - Schedule tidak ditemukan
- **422 Unprocessable Entity** - Validation error
- **400 Bad Request** - Format parameter tidak valid
- **500 Internal Server Error** - Server error (misalnya, constraint violation)

### Validation Error Example:
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "start_date": ["Tanggal mulai tidak boleh kurang dari hari ini."],
        "end_time": ["Waktu selesai harus lebih dari waktu mulai."],
        "total_slots": ["Jumlah slot minimal 1."],
        "status": ["Status harus salah satu dari: buka_pendaftaran, penuh, berlangsung, selesai, dibatalkan."]
    }
}
```

---

## Data Types & Constraints

### Training Schedule Fields:
| Field | Type | Required | Constraints |
|-------|------|----------|-------------|
| training_id | integer | Yes | Must exist in trainings table |
| start_date | date | Yes | Must be today or later |
| end_date | date | Yes | Must be >= start_date |
| start_time | time | Yes | Format HH:MM |
| end_time | time | Yes | Format HH:MM, > start_time |
| location | string | Yes | Max 255 characters |
| method | enum | Yes | 'offline', 'online', 'hybrid' |
| total_slots | integer | Yes | Min 1, Max 1000 |
| available_slots | integer | No | Min 0, <= total_slots |
| registered_count | integer | No | Min 0, <= total_slots |
| month | string | No | Format YYYY-MM |
| status | enum | No | See status values below |

### Status Values:
| Status | Description | Can Register |
|--------|-------------|--------------|
| buka_pendaftaran | Pendaftaran terbuka | ✅ Yes |
| penuh | Jadwal penuh | ❌ No |
| berlangsung | Sedang berlangsung | ❌ No |
| selesai | Sudah selesai | ❌ No |
| dibatalkan | Dibatalkan | ❌ No |

### Computed Fields (Read-Only):
- `is_full`: Boolean, true jika available_slots = 0
- `can_register`: Boolean, true jika status = 'buka_pendaftaran' dan !is_full
- `formatted_date_range`: String, format human-readable date range
- `formatted_time_range`: String, format human-readable time range

---

## Business Rules

1. **Date Validation**: Start date tidak boleh di masa lalu, end date >= start date
2. **Time Validation**: End time harus lebih dari start time
3. **Slot Management**: available_slots + registered_count = total_slots
4. **Status Workflow**: Status changes mengikuti logical workflow
5. **Registration Rules**: Hanya bisa register jika status = 'buka_pendaftaran' dan !is_full
6. **Deletion Rules**: Tidak bisa hapus jadwal jika ada registrasi aktif
7. **Auto-calculations**: Month auto-generated dari start_date
8. **Duplicate Logic**: Reset counter fields dan status ke default

---

## Special Features

### 1. Smart Auto-Population
- Month otomatis dari start_date
- Available_slots default = total_slots
- Registered_count default = 0
- Status default = 'buka_pendaftaran'

### 2. Flexible Pagination
- Support dengan dan tanpa paginasi dalam endpoint yang sama
- Parameter `paginate=true` untuk mengaktifkan

### 3. Calendar Integration
- Endpoint `by-month` optimized untuk calendar views
- Formatted date/time fields untuk display

### 4. Dashboard Analytics
- Statistics endpoint dengan metrics lengkap
- Utilization rate calculation
- Filter by training atau month

### 5. Duplicate Functionality
- Smart duplication dengan selective override
- Auto-reset counter fields
- Preserve training relationship

---

## Performance Notes

1. **Indexing**: Database indexes pada training_id, start_date, status, month
2. **Eager Loading**: Training relationship di-load otomatis untuk efficiency
3. **Computed Fields**: Calculated real-time untuk accuracy
4. **Filtering**: Multiple indexes untuk query performance
5. **Statistics**: Optimized aggregation queries

---

## Rate Limiting
API menggunakan rate limiting standar Laravel. Default: 60 requests per minute per user.

## Versioning
Current API version: v1. Semua endpoint menggunakan prefix `/api/training-schedules/`.