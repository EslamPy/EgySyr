<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\User;
use Illuminate\Http\Request;

// Serve the React SPA for the root path
Route::get('/', function () {
    return view('app');
})->name('home');

// Example: protect dashboard route
Route::middleware(['auth', 'approved'])->group(function () {
    Route::get('/dashboard', function () {
        return view('app');
    })->name('dashboard');
});

// Simple admin endpoints to approve/deny (replace with proper controllers/inertia pages as needed)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/pending-users', function () {
        $users = User::where('status', 'pending')->select('id','name','email','created_at')->paginate(20);
        return response()->json($users);
    });

    Route::post('/admin/users/{user}/approve', function (Request $request, User $user) {
        $user->update(['status' => 'approved', 'denial_reason' => null]);
        return response()->json(['approved' => true]);
    });

    Route::post('/admin/users/{user}/deny', function (Request $request, User $user) {
        $reason = (string) $request->input('reason');
        $user->update(['status' => 'denied', 'denial_reason' => $reason]);
        return response()->json(['denied' => true]);
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

// Catch-all route to support client-side routing (exclude known backend prefixes)
Route::get('/{any}', function () {
    return view('app');
})->where('any', '^(?!api\/|login$|register$|password\/|logout$|settings\/|admin\/).*$');