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

// API status endpoint
Route::get('/api-status', function () {
    return response()->json([
        'message' => 'JTLC Learning Center API',
        'version' => '1.0.0',
        'status' => 'active',
    ]);
});
