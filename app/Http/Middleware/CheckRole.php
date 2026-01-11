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
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Cek apakah role user sesuai dengan yang diminta route
        // Contoh pemanggilan: checkRole:admin
        if (Auth::user()->role !== $role) {
            // Jika role tidak cocok, lempar error 403 (Forbidden) atau redirect
            abort(403, 'AKSES DITOLAK: Anda bukan ' . ucfirst($role));
        }

        return $next($request);
    }
}
