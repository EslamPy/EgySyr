<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            // For API requests, return JSON response
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => 'Unauthenticated',
                    'redirect' => '/admin/login'
                ], 401);
            }
            
            // For web requests, redirect to login
            return redirect('/admin/login');
        }

        $user = Auth::user();

        // Check if user has admin role
        if (!in_array($user->role, ['admin', 'owner'])) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => 'Unauthorized. Admin access required.',
                ], 403);
            }
            
            return redirect('/')->with('error', 'Unauthorized access');
        }

        // Check if user is approved
        if ($user->status !== 'approved') {
            $message = match($user->status) {
                'pending' => 'Your account is pending approval',
                'denied' => 'Your account has been denied access',
                default => 'Your account status does not allow access'
            };

            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => $message,
                    'status' => $user->status
                ], 403);
            }
            
            return redirect('/admin/login')->with('error', $message);
        }

        return $next($request);
    }
}
