<?php

use Illuminate\Support\Facades\Route;

// Simple welcome route for API status
Route::get('/', function () {
    return response()->json([
        'message' => 'JTLC Learning Center API',
        'version' => '1.0.0',
        'status' => 'active'
    ]);
});
