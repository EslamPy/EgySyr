<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DashboardController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Dashboard API Routes
Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/stats', [DashboardController::class, 'stats']);
    Route::get('/recent-activity', [DashboardController::class, 'recentActivity']);
    Route::get('/chart-data', [DashboardController::class, 'chartData']);
    Route::get('/notifications', [DashboardController::class, 'notifications']);
    Route::post('/mark-as-read', [DashboardController::class, 'markAsRead']);
    Route::get('/search', [DashboardController::class, 'search']);
});