<?php

use App\Http\Controllers\Api\InstructorController;
use App\Http\Controllers\Api\TrainingCategoryController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::prefix('auth')->group(function () {
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy']);
        Route::get('me', function (Request $request) {
            return response()->json([
                'user' => $request->user(),
            ]);
        });
    });
});

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);

    // Instructor management routes
    Route::apiResource('instructors', InstructorController::class);

    // Training category management routes
    Route::apiResource('training-categories', TrainingCategoryController::class);
});

// API status endpoint
Route::get('status', function () {
    return response()->json([
        'message' => 'JTLC Learning Center API',
        'version' => '1.0.0',
        'status' => 'active',
    ]);
});
