# Schedule Page Database Implementation

## Overview
Halaman jadwal telah dikonversi dari menggunakan dummy data menjadi database-driven dengan live filtering menggunakan Alpine.js, mengikuti pola yang sama dengan halaman katalog.

## Changes Made

### 1. Backend Implementation

#### ScheduleController (app/Http/Controllers/ScheduleController.php)
- **Created**: New controller untuk menangani halaman jadwal
- **Method**: `index(Request $request): View`
  - Query `TrainingSchedule` dengan eager loading relationships: `training.category`, `training.instructor`
  - Filter by status: `buka_pendaftaran`
  - Default ordering: `start_date ASC`

**Filters Implemented**:
1. **Search**: Mencari berdasarkan judul pelatihan atau nama pengajar
2. **Category**: Filter berdasarkan kategori pelatihan
3. **Method**: Filter berdasarkan metode (online/offline/hybrid)
4. **Month**: Filter berdasarkan bulan pelaksanaan
5. **Availability**: Filter berdasarkan ketersediaan (available/full)

#### TrainingSchedule Model Updates (app/Models/TrainingSchedule.php)
**New Accessors**:
- `duration`: Menghitung durasi pelatihan dalam hari
- `max_participants`: Alias untuk `total_slots`
- `price`: Mengambil harga dari relasi training

**Appends Updated**:
```php
protected $appends = [
    'is_full',
    'can_register',
    'formatted_date_range',
    'formatted_time_range',
    'duration',
    'max_participants',
    'price',
];
```

#### Routes (routes/web.php)
**Updated**:
```php
// Old
Route::get('/jadwal', function () {
    return view('pages.landing.schedule.index');
});

// New
Route::get('/jadwal', [ScheduleController::class, 'index'])->name('jadwal');
```

### 2. Frontend Implementation

#### index.blade.php
**Alpine.js Wrapper Added**:
```blade
<div x-data="scheduleApp()" x-init="init()">
    {{-- Includes --}}
</div>

<script>
function scheduleApp() {
    return {
        allSchedules: @json($schedules),
        filteredSchedules: [],
        searchQuery: '',
        selectedCategory: 'semua',
        selectedMethod: 'semua',
        selectedMonth: 'semua',
        selectedAvailability: 'semua',
        
        init() { ... },
        filterSchedules() { ... },
        resetFilters() { ... },
        formatDate(startDate, endDate) { ... },
        formatPrice(price) { ... },
        getAvailabilityClass() { ... },
        getAvailabilityText() { ... }
    }
}
</script>
```

#### _filters.blade.php
**Live Filtering Features**:
- Search input dengan debounce 300ms: `@input.debounce.300ms="filterSchedules()"`
- Dropdown filters dengan instant update: `@change="filterSchedules()"`
- Reset button dengan conditional display
- Real-time counter: "Menampilkan X dari Y jadwal pelatihan"

**Filters Available**:
1. Search (debounced)
2. Category dropdown
3. Method dropdown (online/offline/hybrid)
4. Month dropdown (November/Desember/Januari)
5. Availability dropdown (Tersedia/Penuh)
6. Reset button

#### _table.blade.php
**Major Changes**:
- ❌ Removed: 370 lines of PHP dummy data array
- ✅ Added: Alpine.js template dengan `x-for` loop
- ✅ Added: Desktop table view dengan dynamic data binding
- ✅ Added: Mobile card view dengan responsive design
- ✅ Added: Empty state dengan reset button

**Desktop Table Features**:
```blade
<template x-for="schedule in filteredSchedules" :key="schedule.id">
    <tr>
        <td x-text="schedule.training.title"></td>
        <td x-text="formatDate(schedule.start_date, schedule.end_date)"></td>
        <td x-text="schedule.training.instructor?.name"></td>
        <!-- Dynamic badges, colors, etc -->
    </tr>
</template>
```

**Mobile Card Features**:
- Fully responsive card layout
- Same data binding as desktop
- Touch-friendly buttons
- Optimized spacing for mobile

**Empty State**:
```blade
<div x-show="filteredSchedules.length === 0">
    <!-- Empty state message -->
    <button @click="resetFilters()">Reset Filter</button>
</div>
```

## Client-Side Filtering Logic

### Filter Flow
1. User types in search → Debounced 300ms → `filterSchedules()`
2. User selects dropdown → Instant → `filterSchedules()`
3. `filterSchedules()` applies all filters sequentially:
   - Search filter (title + instructor name)
   - Category filter
   - Method filter
   - Month filter
   - Availability filter
4. Results stored in `filteredSchedules`
5. View updates automatically via Alpine reactivity

### Data Flow
```
Database (TrainingSchedule) 
    → Controller (filter + eager load)
    → Blade (@json($schedules))
    → Alpine.js (allSchedules)
    → filterSchedules()
    → filteredSchedules
    → View (x-for template)
```

## Features Implemented

### ✅ Live Search
- Debounced search (300ms delay)
- Searches in: training title, instructor name
- Case-insensitive matching
- No page reloads

### ✅ Live Filters
- Category filtering
- Method filtering (online/offline/hybrid)
- Month filtering
- Availability filtering (available/full)
- Instant updates without page reload

### ✅ Reset Functionality
- Clears all filters at once
- Conditional display (only shown when filters active)
- Returns to showing all schedules

### ✅ Dynamic Counter
- Shows: "Menampilkan X dari Y jadwal pelatihan"
- Updates in real-time as filters change

### ✅ Responsive Design
- Desktop: Table layout
- Mobile: Card layout
- Seamless transition between breakpoints

### ✅ Empty State Handling
- Shows when no results match filters
- Helpful message
- Reset button for quick recovery

## Data Structure

### Schedule Data (from Controller)
```json
{
    "id": 1,
    "training_id": 3,
    "start_date": "2024-11-15",
    "end_date": "2024-11-17",
    "location": "Jakarta",
    "method": "offline",
    "total_slots": 20,
    "available_slots": 5,
    "registered_count": 15,
    "month": "November",
    "status": "buka_pendaftaran",
    "duration": 3,
    "max_participants": 20,
    "price": 2500000,
    "training": {
        "id": 3,
        "title": "Teknik Sampling Air Sungai Sesuai SNI",
        "slug": "teknik-sampling-air-sungai-sesuai-sni",
        "category": {
            "id": 3,
            "name": "Sampling Air"
        },
        "instructor": {
            "id": 3,
            "name": "Dr. Ahmad Hidayat",
            "specialization": "Teknik Sampling Air"
        }
    }
}
```

## Testing Checklist

- [ ] Visit `/jadwal` - page loads without errors
- [ ] Type in search box - results filter after 300ms
- [ ] Select category - results filter instantly
- [ ] Select method - results filter instantly
- [ ] Select month - results filter instantly
- [ ] Select availability - results filter instantly
- [ ] Click reset button - all filters cleared
- [ ] Counter shows correct numbers
- [ ] Empty state appears when no results
- [ ] Mobile view works correctly
- [ ] Desktop view works correctly

## Performance Considerations

### Client-Side Filtering Benefits
✅ No server round trips after initial load
✅ Instant filter updates
✅ Better user experience
✅ Reduced server load

### Trade-offs
⚠️ All data loaded initially (currently 11 schedules - minimal impact)
⚠️ For large datasets (100+ schedules), consider pagination or server-side filtering

### Current Dataset
- **Schedules**: 11 (manageable for client-side)
- **Categories**: 7
- **Load Time**: Fast (small dataset)

## Future Enhancements

### Potential Improvements
1. **Pagination**: Add if schedule count grows > 50
2. **Date Range Filter**: Allow filtering by custom date range
3. **Price Range Filter**: Add price slider
4. **Sort Options**: Add sorting by date, price, popularity
5. **URL Query Params**: Preserve filters in URL for sharing
6. **Calendar View**: Add calendar visualization option
7. **Export**: Add export to PDF/CSV functionality

### Code Quality
- ✅ Laravel Pint formatting passed
- ✅ No errors or warnings
- ✅ Follows Laravel 12 conventions
- ✅ Consistent with catalog implementation
- ✅ Alpine.js best practices followed
- ✅ Responsive design implemented

## Files Modified

1. **app/Http/Controllers/ScheduleController.php** - Created
2. **app/Models/TrainingSchedule.php** - Updated (added accessors)
3. **routes/web.php** - Updated (route to controller)
4. **resources/views/pages/landing/schedule/index.blade.php** - Updated (Alpine wrapper)
5. **resources/views/pages/landing/schedule/_filters.blade.php** - Updated (live filters)
6. **resources/views/pages/landing/schedule/_table.blade.php** - Updated (removed dummy data, added Alpine templates)

## Database Seeding

Ensure database is seeded with:
```bash
php artisan migrate:fresh --seed
```

This will create:
- 11 training schedules
- 11 trainings
- 11 instructors
- 7 categories

All with realistic environmental/water quality training data.
