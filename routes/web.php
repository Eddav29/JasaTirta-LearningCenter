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
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('pages.admin.dashboard.index');
    })->name('dashboard');

    // Placeholder routes for sidebar links
    Route::get('/trainings', fn () => 'Trainings Page')->name('trainings.index');
    Route::get('/trainings/create', fn () => 'Create Training Page')->name('trainings.create');
    Route::get('/schedules', fn () => 'Schedules Page')->name('schedules.index');
    Route::get('/instructors', fn () => 'Instructors Page')->name('instructors.index');
    Route::get('/participants', fn () => 'Participants Page')->name('participants.index');
    Route::get('/categories', fn () => 'Categories Page')->name('categories.index');
    Route::get('/messages', fn () => 'Messages Page')->name('messages.index');
    Route::get('/reports', fn () => 'Reports Page')->name('reports');
    Route::get('/users', fn () => 'Users Page')->name('users.index');
    Route::get('/settings', fn () => 'Settings Page')->name('settings');
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
