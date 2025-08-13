<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\Admin\ContactMessageController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\SiteVisitController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\Admin\FeedbackController as AdminFeedbackController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\Admin\JobController as AdminJobController;
use App\Http\Controllers\Api\Admin\JobApplicationController;
use App\Http\Controllers\Api\Admin\UserController;

// Public endpoints
Route::post('/contact', [ContactController::class, 'store']);
Route::post('/track-visit', [SiteVisitController::class, 'track']);

// Public feedback endpoints
Route::get('/feedback/{token}', [FeedbackController::class, 'show']);
Route::post('/feedback/{token}', [FeedbackController::class, 'submit']);
Route::get('/feedback-approved', [FeedbackController::class, 'approved']);

// Public job endpoints
Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/{slug}', [JobController::class, 'show']);
Route::post('/jobs/{slug}/apply', [JobController::class, 'apply']);

// Admin endpoints (protected with auth middleware)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Dashboard stats
    Route::get('/dashboard/stats', [DashboardController::class, 'stats']);
    Route::get('/dashboard/visits-chart', [DashboardController::class, 'visitsChart']);
    Route::get('/dashboard/world-map', [DashboardController::class, 'worldMapData']);

    // Contact messages
    Route::get('/messages', [ContactMessageController::class, 'index']);
    Route::get('/messages/export', [ContactMessageController::class, 'export']);
    Route::delete('/messages/{id}', [ContactMessageController::class, 'destroy']);

    // Feedback management
    Route::get('/feedback', [AdminFeedbackController::class, 'index']);
    Route::post('/feedback/generate-link', [AdminFeedbackController::class, 'generateLink']);
    Route::post('/feedback/{id}/approve', [AdminFeedbackController::class, 'approve']);
    Route::post('/feedback/{id}/deny', [AdminFeedbackController::class, 'deny']);
    Route::delete('/feedback/{id}', [AdminFeedbackController::class, 'destroy']);
    Route::get('/feedback/stats', [AdminFeedbackController::class, 'stats']);

    // Job management
    Route::apiResource('jobs', AdminJobController::class);
    Route::post('/jobs/{id}/toggle-status', [AdminJobController::class, 'toggleStatus']);

    // Job applications
    Route::get('/job-applications', [JobApplicationController::class, 'index']);
    Route::get('/job-applications/{id}', [JobApplicationController::class, 'show']);
    Route::patch('/job-applications/{id}/status', [JobApplicationController::class, 'updateStatus']);
    Route::delete('/job-applications/{id}', [JobApplicationController::class, 'destroy']);
    Route::get('/job-applications/{id}/download-cv', [JobApplicationController::class, 'downloadCv']);
    Route::get('/job-applications/export', [JobApplicationController::class, 'export']);
    Route::get('/job-applications/stats', [JobApplicationController::class, 'stats']);
});

// Owner-only endpoints
Route::middleware(['auth', 'role:owner'])->prefix('admin')->group(function () {
    // User management
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::post('/users/{id}/approve', [UserController::class, 'approve']);
    Route::post('/users/{id}/deny', [UserController::class, 'deny']);
    Route::patch('/users/{id}/permissions', [UserController::class, 'updatePermissions']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});