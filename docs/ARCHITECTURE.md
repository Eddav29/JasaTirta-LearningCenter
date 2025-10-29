# Arsitektur Aplikasi & Prinsip SOLID

Dokumentasi ini menjelaskan struktur arsitektur aplikasi Learning Center berdasarkan prinsip SOLID dan clean architecture.

## 📚 Table of Contents

- [Prinsip SOLID](#prinsip-solid)
- [Struktur Layer Aplikasi](#struktur-layer-aplikasi)
- [Data Transfer Objects (DTOs)](#data-transfer-objects-dtos)
- [Domain Layer](#domain-layer)
- [Repository Pattern](#repository-pattern)
- [Service Provider](#service-provider)
- [Alur Data Flow](#alur-data-flow)

---

## 🎯 Prinsip SOLID

### S - Single Responsibility Principle (SRP)
**"Setiap class hanya memiliki satu tanggung jawab"**

#### Contoh dalam Aplikasi:
```php
// ✅ GOOD - UserRepository hanya bertanggung jawab untuk data access
class EloquentUserRepository implements UserRepository
{
    public function create(UserCreationData $data): User { }
    public function findByEmail(string $email): ?User { }
}

// ✅ GOOD - UserManagementService hanya bertanggung jawab untuk business logic
class UserManagementService
{
    public function createUser(UserCreationData $data): User { }
    public function assignRole(User $user, string $role): void { }
}

// ❌ BAD - Satu class melakukan terlalu banyak hal
class UserController
{
    public function store() {
        // Validasi, hash password, create user, assign role, send email
        // Terlalu banyak tanggung jawab!
    }
}
```

---

### O - Open/Closed Principle (OCP)
**"Terbuka untuk extension, tertutup untuk modification"**

#### Contoh dalam Aplikasi:
```php
// Interface sebagai kontrak (tidak perlu diubah)
interface UserRepository
{
    public function create(UserCreationData $data): User;
    public function findByEmail(string $email): ?User;
}

// ✅ GOOD - Bisa extend dengan implementasi baru tanpa mengubah interface
class EloquentUserRepository implements UserRepository { }

// Jika suatu saat ingin pakai MongoDB, tinggal buat implementasi baru
class MongoUserRepository implements UserRepository { }

// Jika ingin tambah caching, buat decorator
class CachedUserRepository implements UserRepository
{
    public function __construct(private UserRepository $repository) {}
    
    public function findByEmail(string $email): ?User
    {
        return Cache::remember("user.{$email}", 3600, fn() => 
            $this->repository->findByEmail($email)
        );
    }
}
```

---

### L - Liskov Substitution Principle (LSP)
**"Subclass harus bisa menggantikan parent class tanpa merusak fungsionalitas"**

#### Contoh dalam Aplikasi:
```php
// ✅ GOOD - Semua implementasi UserRepository bisa saling menggantikan
function processUser(UserRepository $repo) {
    $user = $repo->findByEmail('test@example.com');
    // Bisa menggunakan EloquentUserRepository atau MongoUserRepository
}

// Bisa menggunakan implementasi mana saja
processUser(new EloquentUserRepository());
processUser(new MongoUserRepository());
processUser(new CachedUserRepository(new EloquentUserRepository()));
```

---

### I - Interface Segregation Principle (ISP)
**"Interface harus spesifik, jangan terlalu besar"**

#### Contoh dalam Aplikasi:
```php
// ❌ BAD - Interface terlalu besar
interface MassiveUserRepository
{
    public function create();
    public function update();
    public function delete();
    public function sendEmail();
    public function generateReport();
    public function exportToCsv();
    public function sendNotification();
    // Terlalu banyak method tidak terkait!
}

// ✅ GOOD - Pisahkan berdasarkan concern
interface UserRepository
{
    public function create(UserCreationData $data): User;
    public function update(User $user, UserUpdateData $data): User;
    public function delete(User $user): void;
    public function findByEmail(string $email): ?User;
}

interface UserNotificationService
{
    public function sendWelcomeEmail(User $user): void;
    public function sendPasswordReset(User $user): void;
}

interface UserReportService
{
    public function generateUserReport(): Report;
    public function exportToCsv(): string;
}
```

---

### D - Dependency Inversion Principle (DIP)
**"Bergantung pada abstraksi (interface), bukan implementasi konkret"**

#### Contoh dalam Aplikasi:
```php
// ❌ BAD - Depend on concrete class
class UserManagementService
{
    private EloquentUserRepository $repository;
    
    public function __construct()
    {
        $this->repository = new EloquentUserRepository(); // Hard-coded!
    }
}

// ✅ GOOD - Depend on abstraction (interface)
class UserManagementService
{
    public function __construct(
        private UserRepository $repository // Interface, bukan class konkret
    ) {}
    
    public function createUser(UserCreationData $data): User
    {
        return $this->repository->create($data);
    }
}
```

---

## 🏗️ Struktur Layer Aplikasi

```
app/
├── Data/                    # Data Transfer Objects (DTOs)
│   ├── UserCreationData.php
│   └── UserUpdateData.php
│
├── Domain/                  # Business Domain Logic
│   ├── Enums/              # Enumerations
│   │   └── RoleEnum.php
│   └── Exceptions/         # Domain Exceptions
│       └── UserNotFoundException.php
│
├── Repositories/            # Data Access Layer
│   ├── Contracts/          # Repository Interfaces
│   │   └── UserRepository.php
│   └── Eloquent/           # Eloquent Implementations
│       └── EloquentUserRepository.php
│
├── Services/                # Business Logic Layer
│   ├── Contracts/          # Service Interfaces
│   │   └── UserManagementService.php
│   └── UserManagementService.php
│
├── Http/                    # Presentation Layer
│   ├── Controllers/
│   ├── Requests/           # Form Validation
│   └── Resources/          # API Resources
│
├── Models/                  # Eloquent Models
│   └── User.php
│
└── Providers/               # Service Providers
    └── AppServiceProvider.php
```

---

## 📦 Data Transfer Objects (DTOs)

### Apa itu DTO?
DTO adalah objek sederhana yang digunakan untuk mentransfer data antar layer aplikasi tanpa business logic.

### Keuntungan Menggunakan DTO:

1. **Type Safety** - Data tervalidasi dengan tipe yang jelas
2. **Immutability** - Menggunakan `readonly` untuk mencegah perubahan
3. **Single Source of Truth** - Struktur data terpusat
4. **Refactoring Friendly** - Mudah menemukan penggunaan

### Contoh Implementasi:

```php
<?php

namespace App\Data;

class UserCreationData
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $email,
        public readonly string $phone,
        public readonly string $password,
        public readonly bool $emailVerified = false,
    ) {}
    
    /**
     * Create from array (misalnya dari request)
     */
    public static function fromArray(array $data): self
    {
        return new self(
            firstName: $data['first_name'],
            lastName: $data['last_name'],
            email: $data['email'],
            phone: $data['phone'],
            password: bcrypt($data['password']),
            emailVerified: $data['email_verified'] ?? false,
        );
    }
    
    /**
     * Convert to array untuk database
     */
    public function toArray(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => $this->password,
            'email_verified' => $this->emailVerified,
        ];
    }
}
```

### Penggunaan DTO:

```php
// Di Controller
public function store(StoreUserRequest $request)
{
    $data = UserCreationData::fromArray($request->validated());
    $user = $this->userService->createUser($data);
    
    return new UserResource($user);
}

// Di Service
public function createUser(UserCreationData $data): User
{
    return $this->repository->create($data);
}

// Di Repository
public function create(UserCreationData $data): User
{
    return User::create($data->toArray());
}
```

---

## 🎯 Domain Layer

### Apa itu Domain Layer?
Layer yang berisi business rules, enumerations, dan exceptions spesifik untuk domain bisnis aplikasi.

### Struktur Domain:

#### 1. Enums (Enumerations)
Mendefinisikan nilai-nilai yang valid untuk suatu domain concept.

```php
<?php

namespace App\Domain\Enums;

enum RoleEnum: string
{
    case Admin = 'admin';
    case User = 'user';
    case Instructor = 'instructor';
    
    /**
     * Get all role values
     */
    public static function values(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
    
    /**
     * Check if value is valid
     */
    public static function isValid(string $value): bool
    {
        return in_array($value, self::values());
    }
    
    /**
     * Get role label for display
     */
    public function label(): string
    {
        return match($this) {
            self::Admin => 'Administrator',
            self::User => 'Regular User',
            self::Instructor => 'Instructor/Teacher',
        };
    }
}
```

#### 2. Domain Exceptions
Exception khusus yang merepresentasikan error dalam business logic.

```php
<?php

namespace App\Domain\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    public function __construct(int $userId)
    {
        parent::__construct("User with ID {$userId} not found");
    }
}

class InvalidRoleException extends Exception
{
    public function __construct(string $role)
    {
        parent::__construct("Invalid role: {$role}");
    }
}

class EmailAlreadyExistsException extends Exception
{
    public function __construct(string $email)
    {
        parent::__construct("Email {$email} already exists");
    }
}
```

### Keuntungan Domain Layer:

1. **Business Rules Centralized** - Semua aturan bisnis di satu tempat
2. **Type Safety** - Enum memastikan hanya nilai valid yang digunakan
3. **Better Error Handling** - Exception yang jelas dan spesifik
4. **Self-Documenting Code** - Mudah dipahami tanpa dokumentasi eksternal

---

## 🗄️ Repository Pattern

### Apa itu Repository Pattern?
Pattern yang memisahkan business logic dari data access logic. Repository bertindak sebagai "collection" dalam memory untuk domain objects.

### Keuntungan Repository Pattern:

1. **Separation of Concerns** - Pisahkan data access dari business logic
2. **Testability** - Mudah di-mock untuk testing
3. **Flexibility** - Mudah mengganti data source (Eloquent, API, Cache, dll)
4. **Centralized Data Access** - Query kompleks terpusat di satu tempat

### Struktur Repository:

#### 1. Repository Interface (Contract)

```php
<?php

namespace App\Repositories\Contracts;

use App\Data\UserCreationData;
use App\Data\UserUpdateData;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface UserRepository
{
    /**
     * Create a new user
     */
    public function create(UserCreationData $data): User;
    
    /**
     * Find user by email
     */
    public function findByEmail(string $email): ?User;
    
    /**
     * Find user by ID
     */
    public function findById(int $id): ?User;
    
    /**
     * Get paginated users
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator;
    
    /**
     * Get all users
     */
    public function all(): Collection;
    
    /**
     * Update user
     */
    public function update(User $user, UserUpdateData $data): User;
    
    /**
     * Delete user
     */
    public function delete(User $user): void;
    
    /**
     * Find users by role
     */
    public function findByRole(string $role): Collection;
    
    /**
     * Search users
     */
    public function search(string $query): Collection;
}
```

#### 2. Repository Implementation

```php
<?php

namespace App\Repositories\Eloquent;

use App\Data\UserCreationData;
use App\Data\UserUpdateData;
use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class EloquentUserRepository implements UserRepository
{
    public function create(UserCreationData $data): User
    {
        return User::create($data->toArray());
    }
    
    public function findByEmail(string $email): ?User
    {
        return User::query()
            ->where('email', $email)
            ->first();
    }
    
    public function findById(int $id): ?User
    {
        return User::query()
            ->with('roles')
            ->find($id);
    }
    
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return User::query()
            ->with('roles')
            ->latest()
            ->paginate($perPage);
    }
    
    public function all(): Collection
    {
        return User::query()
            ->with('roles')
            ->get();
    }
    
    public function update(User $user, UserUpdateData $data): User
    {
        $user->update($data->toArray());
        return $user->refresh();
    }
    
    public function delete(User $user): void
    {
        $user->delete();
    }
    
    public function findByRole(string $role): Collection
    {
        return User::query()
            ->role($role)
            ->get();
    }
    
    public function search(string $query): Collection
    {
        return User::query()
            ->where('first_name', 'like', "%{$query}%")
            ->orWhere('last_name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->get();
    }
}
```

### Best Practices Repository:

1. **Kembalikan Domain Objects** - Return Model/Collection, bukan Query Builder
2. **Eager Loading** - Load relasi yang sering dipakai
3. **Jangan Return Query Builder** - Hindari method yang return query builder
4. **Pisahkan Complex Queries** - Buat method terpisah untuk query kompleks

```php
// ❌ BAD - Return query builder
public function query()
{
    return User::query(); // Jangan expose query builder
}

// ✅ GOOD - Return domain objects
public function findActiveUsers(): Collection
{
    return User::query()
        ->where('is_active', true)
        ->with('roles')
        ->get();
}
```

---

## 🔧 Service Provider

### Apa itu Service Provider?
Service Provider adalah tempat untuk melakukan dependency binding dalam Laravel service container.

### Implementasi AppServiceProvider:

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Binding Repository
        $this->app->scoped(
            \App\Repositories\Contracts\UserRepository::class,
            \App\Repositories\Eloquent\EloquentUserRepository::class
        );
        
        // Binding Service
        $this->app->scoped(
            \App\Services\Contracts\UserManagementService::class,
            \App\Services\UserManagementService::class
        );
        
        $this->app->scoped(
            \App\Services\Contracts\AuthService::class,
            \App\Services\AuthService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
```

### Lifecycle Binding:

1. **singleton** - Satu instance untuk seluruh aplikasi
2. **scoped** - Satu instance per request (recommended untuk repository)
3. **bind** - Instance baru setiap kali di-resolve

```php
// Singleton - satu instance untuk semua
$this->app->singleton(Cache::class, RedisCache::class);

// Scoped - satu instance per HTTP request
$this->app->scoped(UserRepository::class, EloquentUserRepository::class);

// Bind - instance baru setiap kali
$this->app->bind(PaymentGateway::class, StripeGateway::class);
```

### Dependency Injection dengan Provider:

```php
// Setelah di-register di AppServiceProvider, bisa langsung inject

class UserController extends Controller
{
    public function __construct(
        private UserRepository $repository,
        private UserManagementService $userService
    ) {}
    
    public function index()
    {
        // Otomatis mendapat EloquentUserRepository
        $users = $this->repository->all();
        return view('users.index', compact('users'));
    }
}
```

---

## 🔄 Alur Data Flow

### Request Flow Architecture:

```
┌─────────────┐
│   Browser   │
└──────┬──────┘
       │ HTTP Request
       ▼
┌─────────────────────────────┐
│    Route (web.php/api.php)  │
└──────────┬──────────────────┘
           │
           ▼
┌─────────────────────────────┐
│   Controller                │ ◄─── Form Request (Validation)
│   - Terima request          │
│   - Validasi (FormRequest)  │
│   - Convert to DTO          │
└──────────┬──────────────────┘
           │ DTO
           ▼
┌─────────────────────────────┐
│   Service Layer             │
│   - Business Logic          │ ◄─── Domain Enums
│   - Orchestrate operations  │ ◄─── Domain Exceptions
│   - Transaction handling    │
└──────────┬──────────────────┘
           │ DTO
           ▼
┌─────────────────────────────┐
│   Repository Layer          │
│   - Data Access             │
│   - Query Database          │
│   - Return Models           │
└──────────┬──────────────────┘
           │ Model
           ▼
┌─────────────────────────────┐
│   Database (MySQL)          │
└──────────┬──────────────────┘
           │ Model
           ▼
┌─────────────────────────────┐
│   Service Layer             │
│   - Process result          │
│   - Apply business rules    │
└──────────┬──────────────────┘
           │ Model/Collection
           ▼
┌─────────────────────────────┐
│   Controller                │
│   - Format response         │
│   - Return Resource/View    │
└──────────┬──────────────────┘
           │ JSON/HTML
           ▼
┌─────────────────────────────┐
│   Browser                   │
└─────────────────────────────┘
```

### Contoh Konkret: Create User Flow

```php
// 1. Request masuk ke Route
Route::post('/users', [UserController::class, 'store']);

// 2. Controller menerima dan validasi
class UserController extends Controller
{
    public function __construct(
        private UserManagementService $userService
    ) {}
    
    public function store(StoreUserRequest $request)
    {
        // 3. Convert validated data to DTO
        $data = UserCreationData::fromArray($request->validated());
        
        // 4. Kirim ke Service Layer
        $user = $this->userService->createUser($data);
        
        // 5. Return Resource (API) atau View
        return new UserResource($user);
    }
}

// 6. Service Layer - Business Logic
class UserManagementService
{
    public function __construct(
        private UserRepository $repository
    ) {}
    
    public function createUser(UserCreationData $data): User
    {
        // Check if email exists (business rule)
        if ($this->repository->findByEmail($data->email)) {
            throw new EmailAlreadyExistsException($data->email);
        }
        
        // 7. Kirim ke Repository
        DB::beginTransaction();
        try {
            $user = $this->repository->create($data);
            
            // Assign default role (business logic)
            $user->assignRole(RoleEnum::User->value);
            
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}

// 8. Repository Layer - Data Access
class EloquentUserRepository implements UserRepository
{
    public function create(UserCreationData $data): User
    {
        // 9. Save to database
        return User::create($data->toArray());
    }
    
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}
```

---

## 🎓 Summary & Best Practices

### Key Takeaways:

1. **Data (DTOs)**
   - ✅ Gunakan untuk transfer data antar layer
   - ✅ Buat immutable dengan `readonly`
   - ✅ Tambahkan helper method (`fromArray`, `toArray`)

2. **Domain**
   - ✅ Gunakan Enum untuk nilai-nilai yang terbatas
   - ✅ Buat custom exception untuk business errors
   - ✅ Simpan business constants di domain layer

3. **Repository**
   - ✅ Selalu buat interface terlebih dahulu
   - ✅ Return domain objects, bukan query builder
   - ✅ Pisahkan query kompleks ke method terpisah
   - ✅ Eager load relasi yang sering dipakai

4. **Provider**
   - ✅ Register binding di `AppServiceProvider`
   - ✅ Gunakan `scoped` untuk repository
   - ✅ Bind interface ke implementasi konkret

5. **SOLID Principles**
   - ✅ **S** - Satu class, satu tanggung jawab
   - ✅ **O** - Extend dengan interface, jangan modifikasi
   - ✅ **L** - Implementasi bisa saling menggantikan
   - ✅ **I** - Interface kecil dan spesifik
   - ✅ **D** - Depend on abstraction, bukan concrete class

### Testing Benefits:

```php
// Mudah di-test dengan mock repository
class UserManagementServiceTest extends TestCase
{
    public function test_create_user()
    {
        // Mock repository
        $mockRepo = Mockery::mock(UserRepository::class);
        $mockRepo->shouldReceive('findByEmail')
            ->once()
            ->andReturn(null);
        $mockRepo->shouldReceive('create')
            ->once()
            ->andReturn(new User());
        
        // Test service dengan mock
        $service = new UserManagementService($mockRepo);
        $data = new UserCreationData(...);
        
        $user = $service->createUser($data);
        
        $this->assertInstanceOf(User::class, $user);
    }
}
```

---

## 📝 Kesimpulan

Arsitektur aplikasi ini mengikuti prinsip SOLID dan clean architecture untuk:
- **Maintainability** - Mudah di-maintain dan di-extend
- **Testability** - Mudah di-test dengan unit test
- **Flexibility** - Mudah mengganti implementasi
- **Scalability** - Struktur yang jelas untuk project besar
- **Team Collaboration** - Developer mudah memahami code structure

Dengan mengikuti pattern ini, aplikasi akan lebih robust, maintainable, dan professional.
