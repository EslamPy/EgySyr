<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
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

        // Check role
        if ($role === 'owner' && !$user->isOwner()) {
            abort(403, 'Access denied. Owner role required.');
        }

        if ($role === 'admin' && !($user->isAdmin() || $user->isOwner())) {
            abort(403, 'Access denied. Admin role required.');
        }

        return $next($request);
    }
}
