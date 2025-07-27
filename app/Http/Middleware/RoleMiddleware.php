<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // pastikan user sudah login
        $user = auth()->user();
        if (!$user) {
            abort(403, 'Unauthorized');
        }

        // cek apakah role user termasuk dalam daftar role yang diperbolehkan
        if (!in_array($user->role, $roles)) {
            abort(403, 'Access Denied');
        }

        return $next($request);
    }
}
