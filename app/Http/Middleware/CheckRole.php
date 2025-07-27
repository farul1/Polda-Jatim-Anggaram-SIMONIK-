<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            abort(403);
        }

        $userRole = Auth::user()->role;

        // Superadmin bisa akses semua
        if ($userRole === 'superadmin') {
            return $next($request);
        }

        // Hanya izinkan role tertentu
        if (!in_array($userRole, $roles)) {
            abort(403);
        }

        return $next($request);
    }

}
