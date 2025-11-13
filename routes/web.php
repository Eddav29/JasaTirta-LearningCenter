<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Landing Pages
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('pages.landing.home.index');
})->name('home');

Route::get('/katalog', [App\Http\Controllers\TrainingController::class, 'catalog'])->name('katalog');
Route::get('/catalog', [App\Http\Controllers\TrainingController::class, 'catalog'])->name('catalog');

// Detail Pelatihan
Route::get('/training/{training}', [App\Http\Controllers\TrainingController::class, 'show'])->name('training.show');

// Pengajar
Route::get('/pengajar', [App\Http\Controllers\InstructorController::class, 'index'])->name('pengajar');

Route::get('/jadwal', [App\Http\Controllers\ScheduleController::class, 'index'])->name('jadwal');

// Contact / Kontak
Route::get('/kontak', [App\Http\Controllers\ContactController::class, 'index'])->name('kontak');
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

// Public certificate verification
Route::get('/verify-certificate/{code}', [App\Http\Controllers\User\CertificateController::class, 'verify'])->name('certificates.verify');

/*
|--------------------------------------------------------------------------
| Guest Routes (Authentication)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', function () {
        return view('pages.auth.login');
    })->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

    // Register
    Route::get('/register', function () {
        return view('pages.auth.register');
    })->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

    // Forgot Password
    Route::get('/forgot-password', function () {
        return view('pages.auth.forgot-password');
    })->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    // Reset Password
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.store');

    // Google OAuth Routes
    Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
    Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Dashboard - redirect based on role
    Route::get('/dashboard', function () {
        $user = Auth::user();
        $userRoles = $user->roles->pluck('name')->toArray();

        if (in_array('admin', $userRoles) || in_array('super-admin', $userRoles)) {
            return redirect()->route('admin.dashboard');
        }

        if (in_array('instructor', $userRoles)) {
            return redirect()->route('instructor.dashboard');
        }

        return redirect()->route('user.dashboard');
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin,super-admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Trainings
    Route::get('/trainings', [App\Http\Controllers\Admin\TrainingController::class, 'index'])->name('trainings.index');
    Route::get('/trainings/create', [App\Http\Controllers\Admin\TrainingController::class, 'create'])->name('trainings.create');
    Route::post('/trainings', [App\Http\Controllers\Admin\TrainingController::class, 'store'])->name('trainings.store');
    Route::get('/trainings/{training}', [App\Http\Controllers\Admin\TrainingController::class, 'show'])->name('trainings.show');
    Route::get('/trainings/{training}/edit', [App\Http\Controllers\Admin\TrainingController::class, 'edit'])->name('trainings.edit');
    Route::put('/trainings/{training}', [App\Http\Controllers\Admin\TrainingController::class, 'update'])->name('trainings.update');
    Route::delete('/trainings/{training}', [App\Http\Controllers\Admin\TrainingController::class, 'destroy'])->name('trainings.destroy');
    Route::post('/trainings/bulk-delete', [App\Http\Controllers\Admin\TrainingController::class, 'bulkDelete'])->name('trainings.bulk-delete');
    Route::post('/trainings/bulk-status', [App\Http\Controllers\Admin\TrainingController::class, 'bulkUpdateStatus'])->name('trainings.bulk-status');

    // Training Syllabus (nested resource)
    Route::prefix('trainings/{training}/syllabus')->name('trainings.syllabus.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\SyllabusController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\SyllabusController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Admin\SyllabusController::class, 'store'])->name('store');
        Route::get('/{syllabus}/edit', [App\Http\Controllers\Admin\SyllabusController::class, 'edit'])->name('edit');
        Route::put('/{syllabus}', [App\Http\Controllers\Admin\SyllabusController::class, 'update'])->name('update');
        Route::delete('/{syllabus}', [App\Http\Controllers\Admin\SyllabusController::class, 'destroy'])->name('destroy');
    });

    // Schedules
    Route::resource('schedules', App\Http\Controllers\Admin\ScheduleController::class);
    Route::post('/schedules/bulk-destroy', [App\Http\Controllers\Admin\ScheduleController::class, 'bulkDestroy'])->name('schedules.bulk-destroy');
    Route::post('/schedules/bulk-status', [App\Http\Controllers\Admin\ScheduleController::class, 'bulkUpdateStatus'])->name('schedules.bulk-status');
    Route::post('/schedules/{schedule}/duplicate', [App\Http\Controllers\Admin\ScheduleController::class, 'duplicate'])->name('schedules.duplicate');

    // Instructors
    Route::resource('instructors', App\Http\Controllers\Admin\InstructorController::class);
    Route::post('/instructors/bulk-destroy', [App\Http\Controllers\Admin\InstructorController::class, 'bulkDestroy'])->name('instructors.bulk-destroy');
    Route::post('/instructors/{instructor}/duplicate', [App\Http\Controllers\Admin\InstructorController::class, 'duplicate'])->name('instructors.duplicate');

    // Participants
    Route::get('/participants', [App\Http\Controllers\Admin\ParticipantController::class, 'index'])->name('participants.index');
    Route::get('/participants/create', [App\Http\Controllers\Admin\ParticipantController::class, 'create'])->name('participants.create');
    Route::post('/participants', [App\Http\Controllers\Admin\ParticipantController::class, 'store'])->name('participants.store');
    Route::get('/participants/{user}', [App\Http\Controllers\Admin\ParticipantController::class, 'show'])->name('participants.show');
    Route::get('/participants/{user}/edit', [App\Http\Controllers\Admin\ParticipantController::class, 'edit'])->name('participants.edit');
    Route::put('/participants/{user}', [App\Http\Controllers\Admin\ParticipantController::class, 'update'])->name('participants.update');
    Route::delete('/participants/{user}', [App\Http\Controllers\Admin\ParticipantController::class, 'destroy'])->name('participants.destroy');
    Route::post('/participants/bulk-delete', [App\Http\Controllers\Admin\ParticipantController::class, 'bulkDelete'])->name('participants.bulk-delete');
    Route::post('/participants/bulk-status', [App\Http\Controllers\Admin\ParticipantController::class, 'bulkUpdateStatus'])->name('participants.bulk-status');

    // Categories
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::post('/categories/bulk-delete', [App\Http\Controllers\Admin\CategoryController::class, 'bulkDelete'])->name('categories.bulk-delete');

    // Notifications
    Route::get('/notifications', function () {
        return view('pages.admin.notifications.index');
    })->name('notifications.index');
    Route::get('/notifications/create', fn () => 'Create Notification Page')->name('notifications.create');

    // Messages (Contact Messages from Landing Page)
    Route::get('/messages', [App\Http\Controllers\Admin\MessagesController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [App\Http\Controllers\Admin\MessagesController::class, 'show'])->name('messages.show');
    Route::patch('/messages/{message}/status', [App\Http\Controllers\Admin\MessagesController::class, 'updateStatus'])->name('messages.updateStatus');
    Route::delete('/messages/{message}', [App\Http\Controllers\Admin\MessagesController::class, 'destroy'])->name('messages.destroy');

    // Reports
    Route::get('/reports', [App\Http\Controllers\Admin\ReportsController::class, 'index'])->name('reports');

    // Profile
    Route::get('/profile', function () {
        return view('pages.admin.profile.index');
    })->name('profile');
});

/*
|--------------------------------------------------------------------------
| User Routes (Participants)
|--------------------------------------------------------------------------
*/

Route::prefix('user')->name('user.')->middleware(['auth', 'role:user,participant'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');

    // My Courses
    Route::get('/courses', [App\Http\Controllers\User\CourseController::class, 'index'])->name('courses');
    Route::get('/courses/{id}', [App\Http\Controllers\User\CourseController::class, 'show'])->name('courses.show');

    // Course Catalog
    Route::get('/catalog', [App\Http\Controllers\User\CatalogController::class, 'index'])->name('catalog');

    // Schedules
    Route::get('/schedules', [App\Http\Controllers\ScheduleController::class, 'index'])->name('schedules');

    // Certificates
    Route::get('/certificates', [App\Http\Controllers\User\CertificateController::class, 'index'])->name('certificates');
    Route::get('/certificates/{id}', [App\Http\Controllers\User\CertificateController::class, 'show'])->name('certificates.show');
    Route::get('/certificates/{id}/download', [App\Http\Controllers\User\CertificateController::class, 'download'])->name('certificates.download');
    Route::post('/certificates/{id}/share', [App\Http\Controllers\User\CertificateController::class, 'share'])->name('certificates.share');
    Route::get('/certificates/statistics', [App\Http\Controllers\User\CertificateController::class, 'statistics'])->name('certificates.statistics');
    Route::get('/certificates/portfolio/export', [App\Http\Controllers\User\CertificateController::class, 'exportPortfolio'])->name('certificates.portfolio');

    // Achievements
    Route::get('/achievements', function () {
        return view('pages.user.achievements.index');
    })->name('achievements');

    // Forum
    Route::get('/forum', function () {
        return view('pages.user.forum.index');
    })->name('forum');

    // Settings
    Route::get('/settings', function () {
        return view('pages.user.settings.index');
    })->name('settings');

    // Profile
    Route::get('/profile', [App\Http\Controllers\User\ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [App\Http\Controllers\User\ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [App\Http\Controllers\User\ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::put('/profile/preferences', [App\Http\Controllers\User\ProfileController::class, 'updatePreferences'])->name('profile.preferences.update');
    Route::post('/profile/avatar', [App\Http\Controllers\User\ProfileController::class, 'uploadAvatar'])->name('profile.avatar.upload');
});

/*
|--------------------------------------------------------------------------
| Instructor Routes
|--------------------------------------------------------------------------
*/

Route::prefix('instructor')->name('instructor.')->middleware(['auth', 'role:instructor'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('pages.instructor.dashboard.index');
    })->name('dashboard');

    // My Courses
    Route::get('/courses', function () {
        return view('pages.instructor.courses.index');
    })->name('courses');

    // Schedules
    Route::get('/schedules', function () {
        return view('pages.instructor.schedules.index');
    })->name('schedules');

    // Students
    Route::get('/students', function () {
        return view('pages.instructor.students.index');
    })->name('students');

    // Profile
    Route::get('/profile', function () {
        return view('pages.instructor.profile.index');
    })->name('profile');
});

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('/api-status', function () {
    return response()->json([
        'message' => 'JTLC Learning Center API',
        'version' => '1.0.0',
        'status' => 'active',
    ]);
});