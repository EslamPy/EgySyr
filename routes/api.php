<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\Admin\ContactMessageController;

Route::post('/contact', [ContactController::class, 'store']);

// Admin endpoints (consider protecting with auth in production)
Route::get('/admin/messages', [ContactMessageController::class, 'index']);
Route::get('/admin/messages/export', [ContactMessageController::class, 'export']);
Route::delete('/admin/messages/{id}', [ContactMessageController::class, 'destroy']); 