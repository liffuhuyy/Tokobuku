<?php

namespace App\Http\Middleware; // HARUS sama persis

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }
        // Jika tidak sesuai role, redirect ke halaman login dengan error
        return redirect('/login')->withErrors([
            'role' => 'Anda tidak memiliki akses ke halaman ini.',
        ]);
    }
}
