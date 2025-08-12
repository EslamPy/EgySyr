<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApproveStatusGate
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if ($user && property_exists($user, 'status') && $user->status !== 'approved') {
            return redirect('/')->with('status', $user->status === 'denied' ? 'Your access request has been denied.' : 'Your request is under review by the admin.');
        }
        return $next($request);
    }
} 