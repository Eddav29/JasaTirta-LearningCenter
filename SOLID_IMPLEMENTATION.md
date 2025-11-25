# SOLID Principles Implementation - Training Module

## Overview
Implementasi SOLID principles pada modul Training untuk meningkatkan maintainability, testability, dan scalability kode.

## SOLID Principles Applied

### 1. **Single Responsibility Principle (SRP)**
Setiap class memiliki satu tanggung jawab spesifik:

- **TrainingController**: Hanya menangani HTTP requests/responses
- **TrainingService**: Menangani business logic dan orchestration
- **TrainingRepository**: Menangani data access dan query database
- **DTOs (CreateTrainingData, UpdateTrainingData)**: Menangani data transfer antar layers

### 2. **Open/Closed Principle (OCP)**
Class terbuka untuk extension tapi tertutup untuk modification:

- Interface `TrainingServiceInterface` dan `TrainingRepositoryInterface` memungkinkan implementasi baru tanpa mengubah kode yang sudah ada
- Mudah menambahkan fitur baru dengan extends/implements tanpa merusak existing code

### 3. **Liskov Substitution Principle (LSP)**
Implementasi dapat diganti dengan interface-nya tanpa breaking functionality:

- `TrainingRepository` dapat diganti dengan implementasi lain (e.g., `CachedTrainingRepository`)
- `TrainingService` dapat diganti dengan implementasi berbeda tanpa mengubah controller

### 4. **Interface Segregation Principle (ISP)**
Interface yang fokus dan tidak memaksa implementasi method yang tidak dibutuhkan:

- `TrainingRepositoryInterface`: Hanya method yang berkaitan dengan data access
- `TrainingServiceInterface`: Hanya method yang berkaitan dengan business logic

### 5. **Dependency Inversion Principle (DIP)**
Depend on abstractions, not concretions:

- Controller depends on `TrainingServiceInterface`, bukan concrete `TrainingService`
- Service depends on `TrainingRepositoryInterface`, bukan concrete `TrainingRepository`
- Dependency injection via constructor

## Architecture Layers

```
┌─────────────────────────────────────────┐
│         HTTP Layer (Controller)          │
│  - Handle HTTP requests/responses        │
│  - Validation                            │
│  - Redirect/View rendering               │
└──────────────┬──────────────────────────┘
               │ depends on
               ▼
┌─────────────────────────────────────────┐
│      Business Logic Layer (Service)      │
│  - Business rules                        │
│  - Orchestration                         │
│  - File handling                         │
└──────────────┬──────────────────────────┘
               │ depends on
               ▼
┌─────────────────────────────────────────┐
│     Data Access Layer (Repository)       │
│  - Database queries                      │
│  - Eloquent operations                   │
│  - Data filtering                        │
└─────────────────────────────────────────┘
```

## File Structure

```
app/
├── Data/
│   └── Training/
│       ├── CreateTrainingData.php      # DTO for creating training
│       └── UpdateTrainingData.php      # DTO for updating training
│
├── Http/
│   └── Controllers/
│       └── Admin/
│           └── TrainingController.php  # HTTP layer (thin controller)
│
├── Repositories/
│   ├── Contracts/
│   │   └── TrainingRepositoryInterface.php  # Repository contract
│   └── Eloquent/
│       └── TrainingRepository.php           # Repository implementation
│
├── Services/
│   ├── Contracts/
│   │   └── TrainingServiceInterface.php     # Service contract
│   └── TrainingService.php                  # Service implementation
│
└── Providers/
    └── AppServiceProvider.php               # Service binding
```

## Benefits of This Architecture

### 1. **Maintainability**
- Clear separation of concerns
- Easy to locate and fix bugs
- Each class has single, well-defined purpose

### 2. **Testability**
- Easy to mock dependencies
- Can test each layer independently
- Example:
```php
// Testing service without database
$mockRepository = Mockery::mock(TrainingRepositoryInterface::class);
$service = new TrainingService($mockRepository);
```

### 3. **Flexibility**
- Easy to swap implementations
- Can add caching layer without changing controller
- Example:
```php
// Add caching without changing controller
class CachedTrainingRepository implements TrainingRepositoryInterface {
    public function __construct(
        protected TrainingRepositoryInterface $repository,
        protected CacheManager $cache
    ) {}
    // ... cache implementation
}
```

### 4. **Scalability**
- Easy to add new features
- Can extract to microservices later
- Clear boundaries between layers

## Usage Examples

### Creating a Training

**Controller (HTTP Layer)**
```php
public function store(Request $request): RedirectResponse
{
    $validated = $request->validate([...]);
    $data = CreateTrainingData::fromRequest($validated);
    $this->trainingService->createTraining($data);
    return redirect()->route('admin.trainings.index')
        ->with('success', 'Pelatihan berhasil ditambahkan');
}
```

**Service (Business Logic Layer)**
```php
public function createTraining(CreateTrainingData $data): Training
{
    $trainingData = $data->toArray();
    
    if ($data->image instanceof UploadedFile) {
        $trainingData['image'] = $this->uploadImage($data->image);
    }
    
    return $this->repository->create($trainingData);
}
```

**Repository (Data Access Layer)**
```php
public function create(array $data): Training
{
    return $this->model->create($data);
}
```

## Testing Strategy

### Unit Tests
```php
// Test Service Layer
class TrainingServiceTest extends TestCase
{
    public function test_create_training_with_image()
    {
        $mockRepo = Mockery::mock(TrainingRepositoryInterface::class);
        $service = new TrainingService($mockRepo);
        
        $data = CreateTrainingData::fromRequest([...]);
        $mockRepo->shouldReceive('create')->once()->andReturn(new Training);
        
        $result = $service->createTraining($data);
        $this->assertInstanceOf(Training::class, $result);
    }
}

// Test Repository Layer
class TrainingRepositoryTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_get_all_with_filters()
    {
        $repo = new TrainingRepository(new Training, new TrainingCategory, new Instructor);
        $result = $repo->getAllWithFilters(['search' => 'test'], 10);
        
        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
    }
}
```

### Feature Tests
```php
class TrainingControllerTest extends TestCase
{
    public function test_admin_can_create_training()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        
        $response = $this->actingAs($admin)
            ->post(route('admin.trainings.store'), [
                'title' => 'Test Training',
                // ... other data
            ]);
        
        $response->assertRedirect(route('admin.trainings.index'));
        $this->assertDatabaseHas('trainings', ['title' => 'Test Training']);
    }
}
```

## Migration Guide

### Before (Fat Controller)
```php
class TrainingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([...]);
        
        // Image handling in controller (bad)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $imagePath = $image->storeAs('trainings', $imageName, 'public');
            $validated['image'] = $imagePath;
        }
        
        // Direct model access (bad)
        Training::create($validated);
        
        return redirect()->route('admin.trainings.index');
    }
}
```

### After (SOLID Principles)
```php
class TrainingController extends Controller
{
    public function __construct(
        protected TrainingServiceInterface $trainingService
    ) {}
    
    public function store(Request $request)
    {
        $validated = $request->validate([...]);
        $data = CreateTrainingData::fromRequest($validated);
        
        // Delegate to service (good)
        $this->trainingService->createTraining($data);
        
        return redirect()->route('admin.trainings.index');
    }
}
```

## Future Enhancements

### 1. Caching Layer
```php
class CachedTrainingRepository implements TrainingRepositoryInterface
{
    public function __construct(
        protected TrainingRepositoryInterface $repository,
        protected CacheManager $cache
    ) {}
    
    public function findWithRelations(int $id, array $relations = []): ?Training
    {
        return $this->cache->remember(
            "training.{$id}",
            3600,
            fn() => $this->repository->findWithRelations($id, $relations)
        );
    }
}
```

### 2. Event-Driven Architecture
```php
class TrainingService implements TrainingServiceInterface
{
    public function createTraining(CreateTrainingData $data): Training
    {
        $training = $this->repository->create($data->toArray());
        
        // Dispatch event
        event(new TrainingCreated($training));
        
        return $training;
    }
}
```

### 3. Query Object Pattern
```php
class TrainingQuery
{
    public function __construct(
        protected Builder $query
    ) {}
    
    public function search(string $term): self
    {
        $this->query->where('title', 'like', "%{$term}%");
        return $this;
    }
    
    public function active(): self
    {
        $this->query->where('is_active', true);
        return $this;
    }
    
    public function get(): Collection
    {
        return $this->query->get();
    }
}
```

## Conclusion

Implementasi SOLID principles pada modul Training telah berhasil:

✅ **Single Responsibility** - Setiap class punya satu tugas jelas
✅ **Open/Closed** - Mudah extend tanpa modify existing code  
✅ **Liskov Substitution** - Interface bisa diganti implementasinya
✅ **Interface Segregation** - Interface fokus dan tidak bloated
✅ **Dependency Inversion** - Depend on abstraction, bukan concrete class

Kode sekarang lebih:
- 📦 **Modular**: Easy to maintain and extend
- 🧪 **Testable**: Each layer can be tested independently  
- 🔄 **Flexible**: Easy to swap implementations
- 📈 **Scalable**: Ready for growth and complexity

## Next Steps

1. Apply same pattern to other modules (Instructor, Schedule, etc.)
2. Add comprehensive unit and feature tests
3. Implement caching layer for performance
4. Add event-driven features for notifications
5. Consider moving to API-first architecture with API Resources
