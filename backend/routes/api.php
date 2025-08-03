<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public API Routes
Route::prefix('v1')->group(function () {
    
    // Contact Routes
    Route::post('/contact', [ContactController::class, 'store']);
    Route::get('/contact/success', [ContactController::class, 'success']);
    
    // Quote Calculator
    Route::post('/quote/calculate', [QuoteController::class, 'calculate']);
    Route::post('/quote/save', [QuoteController::class, 'store']);
    
    // Projects (Public)
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/featured', [ProjectController::class, 'featured']);
    Route::get('/projects/{slug}', [ProjectController::class, 'show']);
    
    // Testimonials (Public)
    Route::get('/testimonials', [TestimonialController::class, 'published']);
    Route::get('/testimonials/random', [TestimonialController::class, 'random']);
    
    // Health Check
    Route::get('/health', function () {
        return response()->json([
            'status' => 'healthy',
            'timestamp' => now(),
            'version' => '1.0.0',
            'service' => 'EgySyr API'
        ]);
    });
    
    // System Info
    Route::get('/info', function () {
        return response()->json([
            'app_name' => config('app.name'),
            'version' => '1.0.0',
            'environment' => config('app.env'),
            'features' => [
                'contact_form' => true,
                'quote_calculator' => true,
                'project_showcase' => true,
                'testimonials' => true,
                'admin_panel' => true,
            ]
        ]);
    });
});

// Protected Admin Routes
Route::prefix('v1/admin')->middleware(['auth:sanctum', 'admin'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/stats', [AdminController::class, 'stats']);
    
    // Contact Management
    Route::get('/contacts', [ContactController::class, 'admin_index']);
    Route::get('/contacts/{id}', [ContactController::class, 'admin_show']);
    Route::patch('/contacts/{id}/read', [ContactController::class, 'markAsRead']);
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy']);
    
    // Project Management
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::patch('/projects/{id}', [ProjectController::class, 'update']);
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);
    Route::patch('/projects/{id}/toggle-featured', [ProjectController::class, 'toggleFeatured']);
    
    // Testimonial Management
    Route::get('/testimonials', [TestimonialController::class, 'admin_index']);
    Route::post('/testimonials', [TestimonialController::class, 'store']);
    Route::patch('/testimonials/{id}', [TestimonialController::class, 'update']);
    Route::delete('/testimonials/{id}', [TestimonialController::class, 'destroy']);
    Route::patch('/testimonials/{id}/toggle-published', [TestimonialController::class, 'togglePublished']);
    
    // Quote Management
    Route::get('/quotes', [QuoteController::class, 'admin_index']);
    Route::get('/quotes/{id}', [QuoteController::class, 'admin_show']);
    Route::patch('/quotes/{id}/status', [QuoteController::class, 'updateStatus']);
    
    // Analytics
    Route::get('/analytics/contacts', [AdminController::class, 'contactAnalytics']);
    Route::get('/analytics/quotes', [AdminController::class, 'quoteAnalytics']);
    Route::get('/analytics/projects', [AdminController::class, 'projectAnalytics']);
});

// Authentication Routes (if needed for admin)
Route::prefix('v1/auth')->group(function () {
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/logout', [AdminController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('/user', [AdminController::class, 'user'])->middleware('auth:sanctum');
});

// Catch-all route for API versioning
Route::fallback(function () {
    return response()->json([
        'error' => 'API endpoint not found',
        'message' => 'The requested API endpoint does not exist.',
        'available_versions' => ['v1'],
        'documentation' => config('app.url') . '/api/docs'
    ], 404);
});