<?php

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

// Authentication Routes
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
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
