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
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Mengecek apakah role user ada di dalam daftar $roles yang dikirim dari route
        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, 'AKSES DITOLAK: Anda tidak memiliki izin untuk halaman ini.');
        }

        return $next($request);
    }
}
