<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
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
use App\Http\Controllers\Api\Admin\ProfileController;

// Authentication endpoints (using web middleware for session support)
Route::middleware('web')->prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
    });
});

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

Route::middleware('auth')->group(function () {
    // Removed conflicting inline job routes - using resource controller instead
});

// Admin endpoints (protected with admin auth middleware, using web middleware for sessions)
Route::middleware(['web', 'admin.auth'])->prefix('admin')->group(function () {
    // Dashboard stats
    Route::get('/dashboard/overview', [DashboardController::class, 'overview']);
    Route::get('/dashboard/recent-activity', [DashboardController::class, 'recentActivity']);
    Route::get('/dashboard/world-map', [DashboardController::class, 'worldMap']);
    Route::get('/dashboard/analytics', [DashboardController::class, 'analytics']);

    // Analytics
    Route::get('/analytics', [DashboardController::class, 'analytics']);
    Route::get('/analytics/export', [DashboardController::class, 'exportAnalytics']);

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
    Route::get('/job-applications/export', [JobApplicationController::class, 'export']);
    Route::get('/job-applications/stats', [JobApplicationController::class, 'stats']);
    Route::get('/job-applications/{id}', [JobApplicationController::class, 'show']);
    Route::patch('/job-applications/{id}/status', [JobApplicationController::class, 'updateStatus']);
    Route::delete('/job-applications/{id}', [JobApplicationController::class, 'destroy']);
    Route::get('/job-applications/{id}/download-cv', [JobApplicationController::class, 'downloadCv']);

    // Profile management (available to all authenticated admins)
    Route::post('/profile/update', [ProfileController::class, 'update']);
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword']);
    Route::get('/profile/preferences', [ProfileController::class, 'getPreferences']);
    Route::post('/profile/preferences', [ProfileController::class, 'updatePreferences']);
});

// Owner-only endpoints
Route::middleware(['web', 'auth', 'role:owner'])->prefix('admin')->group(function () {
    // User management
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::post('/users/{id}/approve', [UserController::class, 'approve']);
    Route::post('/users/{id}/deny', [UserController::class, 'deny']);
    Route::patch('/users/{id}/permissions', [UserController::class, 'updatePermissions']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});