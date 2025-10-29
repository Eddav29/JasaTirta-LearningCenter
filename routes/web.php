<?php

use Illuminate\Support\Facades\Route;

// Welcome page - Landing Home
Route::get('/', function () {
    return view('pages.landing.home.index');
});

// API status endpoint
Route::get('/api-status', function () {
    return response()->json([
        'message' => 'JTLC Learning Center API',
        'version' => '1.0.0',
        'status' => 'active',
    ]);
});
