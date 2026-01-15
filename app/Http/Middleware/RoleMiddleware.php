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
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // 2. Cek apakah role user ada di dalam daftar role yang diizinkan
        // $roles adalah parameter yang dikirim dari route (misal: 'wali', 'admin', dll)
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // 3. Jika role tidak cocok, tampilkan error 403 (Forbidden)
        abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk halaman ini.');
    }
}
