<?php

use Illuminate\Support\Facades\Route;

// Welcome page with Vite + Tailwind
Route::get('/', function () {
    return view('welcome');
});

// API status endpoint
Route::get('/api-status', function () {
    return response()->json([
        'message' => 'JTLC Learning Center API',
        'version' => '1.0.0',
        'status' => 'active',
    ]);
});
