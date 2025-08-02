<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');
});

// User Authentication Routes
Route::middleware('auth')->group(function () {
    // General user routes
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', function () {
        $unreadCount = App\Models\Contact::where('status', 'unread')->count();
        $ReviewUnreadCount = App\Models\Review::where('status', 'unread')->count();
        return view('Admin.dashboard.index', compact('unreadCount', 'ReviewUnreadCount'));
    })->name('dashboard');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    
    // Admin Routes
    Route::prefix('admin')->middleware(['auth'])->group(function () {
        // Admin Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        
        // Analytics Routes
        Route::get('/analytics', [AdminController::class, 'analytics'])->name('admin.analytics');
        Route::get('/api/dashboard-stats', [AdminController::class, 'getDashboardStats'])->name('admin.api.stats');
        Route::get('/api/system-health', [AdminController::class, 'systemHealth'])->name('admin.api.health');
        Route::get('/export/analytics', [AdminController::class, 'exportAnalytics'])->name('admin.export.analytics');
        
        // Blog Management
        Route::prefix('blogs')->group(function () {
            Route::get('/', [AdminController::class, 'listBlogs'])->name('admin.blogs.index');
            Route::get('/create', [AdminController::class, 'createBlog'])->name('admin.blogs.create');
            Route::post('/', [AdminController::class, 'storeBlog'])->name('admin.blogs.store');
            Route::get('/{id}', [AdminController::class, 'showBlog'])->name('admin.blogs.show');
            Route::get('/{id}/edit', [AdminController::class, 'editBlog'])->name('admin.blogs.edit');
            Route::put('/{id}', [AdminController::class, 'updateBlog'])->name('admin.blogs.update');
            Route::delete('/{id}', [AdminController::class, 'destroyBlog'])->name('admin.blogs.destroy');
        });
        
        // Category Management
        Route::prefix('categories')->group(function () {
            Route::get('/', [AdminController::class, 'listCategories'])->name('admin.categories.index');
            Route::post('/', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
            Route::put('/{id}', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
            Route::delete('/{id}', [AdminController::class, 'destroyCategory'])->name('admin.categories.destroy');
        });
        
        // Messages Management
        Route::prefix('messages')->group(function () {
            Route::get('/', [AdminController::class, 'listMessages'])->name('admin.messages.index');
            Route::get('/{id}', [AdminController::class, 'showMessage'])->name('admin.messages.show');
            Route::put('/{id}/read', [AdminController::class, 'markAsRead'])->name('admin.messages.read');
            Route::delete('/{id}', [AdminController::class, 'destroyMessage'])->name('admin.messages.destroy');
            Route::post('/reply', [AdminController::class, 'replyToMessage'])->name('admin.messages.reply');
        });
        
        // Reviews Management
        Route::prefix('reviews')->group(function () {
            Route::get('/', [AdminController::class, 'listReviews'])->name('admin.reviews.index');
            Route::get('/{id}', [AdminController::class, 'showReview'])->name('admin.reviews.show');
            Route::put('/{id}/status', [AdminController::class, 'updateReviewStatus'])->name('admin.reviews.status');
            Route::delete('/{id}', [AdminController::class, 'destroyReview'])->name('admin.reviews.destroy');
        });
        
        // Settings Management
        Route::prefix('settings')->group(function () {
            Route::get('/', [AdminController::class, 'showSettings'])->name('admin.settings.index');
            Route::post('/update', [AdminController::class, 'updateSettings'])->name('admin.settings.update');
        });
    });
});

// Main pages with caching
Route::middleware(['cache.response:3600'])->group(function () {
    Route::get('/', [PageController::class, 'welcome'])->name('welcome');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/blog', [PageController::class, 'blog'])->name('blog');
    Route::get('/blog/{id}', [PageController::class, 'blogDetails'])->name('blog.details');
    Route::get('/custom', [PageController::class, 'custom'])->name('custom');
    Route::get('/services', [PageController::class, 'services'])->name('services');
    Route::get('/services/application', [PageController::class, 'serviceApplication'])->name('services.application');
    Route::get('/services/graphic', [PageController::class, 'serviceGraphic'])->name('services.graphic');
    Route::get('/services/hosting', [PageController::class, 'serviceHosting'])->name('services.hosting');
    Route::get('/services/marketing', [PageController::class, 'serviceMarketing'])->name('services.marketing');
    Route::get('/services/protection-systems', [PageController::class, 'serviceProtectionSystems'])->name('services.protection');
    Route::get('/services/system', [PageController::class, 'serviceSystem'])->name('services.system');
    Route::get('/services/web', [PageController::class, 'serviceWeb'])->name('services.web');
    Route::get('/data-security', [PageController::class, 'dataSecurity'])->name('data.security');
    Route::get('/maintenance-policy', [PageController::class, 'maintenancePolicy'])->name('maintenance.policy');
    Route::get('/policy', [PageController::class, 'policy'])->name('policy');
});

// Non-cached routes
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'storeContact'])->name('contact.store');

// Blog search
Route::get('/articles/search', [PageController::class, 'searchArticles'])->name('articles.search');

// Policy pages
Route::get('/data-security', [PageController::class, 'dataSecurity'])->name('data.security');
Route::get('/maintenance-policy', [PageController::class, 'maintenancePolicy'])->name('maintenance.policy');
Route::get('/policy', [PageController::class, 'policy'])->name('policy');

// Services pages
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/services/application', [PageController::class, 'serviceApplication'])->name('services.application');
Route::get('/services/graphic', [PageController::class, 'serviceGraphic'])->name('services.graphic');
Route::get('/services/hosting', [PageController::class, 'serviceHosting'])->name('services.hosting');
Route::get('/services/marketing', [PageController::class, 'serviceMarketing'])->name('services.marketing');
Route::get('/services/protection-systems', [PageController::class, 'serviceProtectionSystems'])->name('services.protection');
Route::get('/services/system', [PageController::class, 'serviceSystem'])->name('services.system');
Route::get('/services/web', [PageController::class, 'serviceWeb'])->name('services.web');
Route::get('/services/search', [PageController::class, 'searchResults'])->name('services.search');

// Additional features
Route::get('/add-comment', [PageController::class, 'addComment'])->name('add.comment');
