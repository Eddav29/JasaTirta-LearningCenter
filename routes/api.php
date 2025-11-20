<?php

use App\Http\Controllers\Api\InstructorController;
use App\Http\Controllers\Api\TrainingCategoryController;
use App\Http\Controllers\Api\TrainingController;
use App\Http\Controllers\Api\TrainingDetailController;
use App\Http\Controllers\Api\TrainingScheduleController;
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

    // Training management routes
    Route::apiResource('trainings', TrainingController::class);

    // Training schedule management routes
    Route::prefix('training-schedules')->group(function () {
        Route::get('/', [TrainingScheduleController::class, 'index']);
        Route::post('/', [TrainingScheduleController::class, 'store']);
        Route::get('training/{trainingId}', [TrainingScheduleController::class, 'byTraining']);
        Route::get('available', [TrainingScheduleController::class, 'available']);
        Route::get('upcoming', [TrainingScheduleController::class, 'upcoming']);
        Route::get('by-month', [TrainingScheduleController::class, 'byMonth']);
        Route::get('statistics', [TrainingScheduleController::class, 'statistics']);
        Route::get('{id}', [TrainingScheduleController::class, 'show']);
        Route::put('{id}', [TrainingScheduleController::class, 'update']);
        Route::delete('{id}', [TrainingScheduleController::class, 'destroy']);
        Route::post('{id}/duplicate', [TrainingScheduleController::class, 'duplicate']);
        Route::patch('{id}/status', [TrainingScheduleController::class, 'changeStatus']);
    });

    // Training detail management routes
    Route::prefix('trainings')->group(function () {
        // Learning Objectives
        Route::get('{training}/learning-objectives', [TrainingDetailController::class, 'getLearningObjectives']);
        Route::post('learning-objectives', [TrainingDetailController::class, 'storeLearningObjective']);
        Route::put('learning-objectives/{id}', [TrainingDetailController::class, 'updateLearningObjective']);
        Route::delete('learning-objectives/{id}', [TrainingDetailController::class, 'deleteLearningObjective']);
        Route::put('{training}/learning-objectives/reorder', [TrainingDetailController::class, 'reorderLearningObjectives']);

        // Prerequisites
        Route::get('{training}/prerequisites', [TrainingDetailController::class, 'getPrerequisites']);
        Route::post('prerequisites', [TrainingDetailController::class, 'storePrerequisite']);
        Route::put('prerequisites/{id}', [TrainingDetailController::class, 'updatePrerequisite']);
        Route::delete('prerequisites/{id}', [TrainingDetailController::class, 'deletePrerequisite']);
        Route::put('{training}/prerequisites/reorder', [TrainingDetailController::class, 'reorderPrerequisites']);

        // Materials
        Route::get('{training}/materials', [TrainingDetailController::class, 'getMaterials']);
        Route::post('materials', [TrainingDetailController::class, 'storeMaterial']);
        Route::put('materials/{id}', [TrainingDetailController::class, 'updateMaterial']);
        Route::delete('materials/{id}', [TrainingDetailController::class, 'deleteMaterial']);
        Route::put('{training}/materials/reorder', [TrainingDetailController::class, 'reorderMaterials']);

        // Syllabus
        Route::get('{training}/syllabus', [TrainingDetailController::class, 'getSyllabus']);
        Route::post('syllabus', [TrainingDetailController::class, 'storeSyllabus']);
        Route::put('syllabus/{id}', [TrainingDetailController::class, 'updateSyllabus']);
        Route::delete('syllabus/{id}', [TrainingDetailController::class, 'deleteSyllabus']);
        Route::put('{training}/syllabus/reorder', [TrainingDetailController::class, 'reorderSyllabus']);

        // Syllabus Topics
        Route::post('syllabus/{syllabus}/topics', [TrainingDetailController::class, 'storeSyllabusTopic']);
        Route::put('syllabus-topics/{id}', [TrainingDetailController::class, 'updateSyllabusTopic']);
        Route::delete('syllabus-topics/{id}', [TrainingDetailController::class, 'deleteSyllabusTopic']);
        Route::put('syllabus/{syllabus}/topics/reorder', [TrainingDetailController::class, 'reorderSyllabusTopics']);

        // Combined details endpoint
        Route::get('{training}/details', [TrainingDetailController::class, 'getTrainingDetails']);
    });
});

// API status endpoint
Route::get('status', function () {
    return response()->json([
        'message' => 'JTLC Learning Center API',
        'version' => '1.0.0',
        'status' => 'active',
    ]);
});
