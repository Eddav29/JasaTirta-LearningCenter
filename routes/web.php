<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

// Welcome page - Landing Home
Route::get('/', function () {
    return view('pages.landing.home.index');
})->name('home');

// Katalog Pelatihan
Route::get('/katalog', function () {
    return view('pages.landing.catalog.index');
})->name('katalog');

Route::get('/catalog', function () {
    return view('pages.landing.catalog.index');
})->name('catalog');

// Pengajar
Route::get('/pengajar', function () {
    return view('pages.landing.instructor.index');
})->name('pengajar');

// Jadwal
Route::get('/jadwal', function () {
    return view('pages.landing.schedule.index');
})->name('jadwal');

// Kontak
Route::get('/kontak', function () {
    return view('pages.landing.contact.index');
})->name('kontak');

Route::get('/contact', function () {
    return view('pages.landing.contact.index');
})->name('contact');

// Guest routes (Login, Register, Password Reset)
Route::middleware('guest')->group(function () {
    // Login routes
    Route::get('/login', function () {
        return view('pages.auth.login');
    })->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->name('login.store');

    // Register routes
    Route::get('/register', function () {
        return view('pages.auth.register');
    })->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->name('register.store');

    // Forgot password routes
    Route::get('/forgot-password', function () {
        return view('pages.auth.forgot-password');
    })->name('password.request');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    // Reset password routes
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    // User Dashboard
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('pages.admin.dashboard.index');
    })->name('dashboard');

    // Trainings routes
    Route::get('/trainings', function () {
        return view('pages.admin.trainings.index');
    })->name('trainings.index');
    Route::get('/trainings/create', fn () => 'Create Training Page')->name('trainings.create');

    // Schedules routes
    Route::get('/schedules', function () {
        return view('pages.admin.schedules.index');
    })->name('schedules.index');
    Route::get('/schedules/create', fn () => 'Create Schedule Page')->name('schedules.create');

    // Instructors routes
    Route::get('/instructors', function () {
        return view('pages.admin.instructors.index');
    })->name('instructors.index');
    Route::get('/instructors/create', fn () => 'Create Instructor Page')->name('instructors.create');

    // Participants routes
    Route::get('/participants', function () {
        return view('pages.admin.participants.index');
    })->name('participants.index');
    Route::get('/participants/create', fn () => 'Create Participant Page')->name('participants.create');

    // Categories routes
    Route::get('/categories', function () {
        return view('pages.admin.categories.index');
    })->name('categories.index');
    Route::get('/categories/create', fn () => 'Create Category Page')->name('categories.create');

    // Notifications routes
    Route::get('/notifications', function () {
        return view('pages.admin.notifications.index');
    })->name('notifications.index');
    Route::get('/notifications/create', fn () => 'Create Notification Page')->name('notifications.create');

    // Messages routes
    Route::get('/messages', fn () => 'Messages Page')->name('messages.index');

    // Reports routes
    Route::get('/reports', fn () => 'Reports Page')->name('reports');

    // Profile routes
    Route::get('/profile', fn () => 'Profile Page')->name('profile');
});

// API status endpoint
Route::get('/api-status', function () {
    return response()->json([
        'message' => 'JTLC Learning Center API',
        'version' => '1.0.0',
        'status' => 'active',
    ]);
});
