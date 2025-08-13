<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission, string $action = 'view'): Response
    {
        if (!Auth::check()) {
            return redirect('/admin/login');
        }

        $user = Auth::user();

        // Check if user is approved
        if (!$user->isApproved()) {
            Auth::logout();
            return redirect('/admin/login')->with('error', 'Your account is not approved yet.');
        }

        // Check permission
        if (!$user->hasPermission($permission, $action)) {
            abort(403, 'Access denied. You do not have permission to ' . $action . ' ' . $permission . '.');
        }

        return $next($request);
    }
}
