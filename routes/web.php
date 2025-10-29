<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

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

// Authentication Routes
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
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');
    
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

// API status endpoint
Route::get('/api-status', function () {
    return response()->json([
        'message' => 'JTLC Learning Center API',
        'version' => '1.0.0',
        'status' => 'active',
    ]);
});
