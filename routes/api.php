<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function (): void {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function (): void {
        Route::get('me', [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
});

// Contoh route hanya untuk admin
Route::middleware(['auth:sanctum', 'role:admin'])->get('/admin/dashboard', function (): array {
    return ['message' => 'Admin only content'];
});

Route::prefix('users')->group(function (): void {
    Route::middleware(['auth:sanctum', 'permission:users.view'])->get('/', [UserController::class, 'index']);
    Route::middleware(['auth:sanctum', 'permission:users.create'])->post('/', [UserController::class, 'store']);
    Route::middleware(['auth:sanctum', 'permission:users.view'])->get('{user}', [UserController::class, 'show']);
    Route::middleware(['auth:sanctum', 'permission:users.update'])->put('{user}', [UserController::class, 'update']);
    Route::middleware(['auth:sanctum', 'permission:users.delete'])->delete('{user}', [UserController::class, 'destroy']);
});
