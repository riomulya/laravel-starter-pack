<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Cek apakah pengguna telah login
        if (auth()->check()) {
            // Ambil role pengguna dari properti 'role'
            $userRole = auth()->user()->role;

            // Periksa apakah role pengguna terdapat dalam daftar roles yang diizinkan
            if (in_array($userRole, $roles)) {
                return $next($request);
            }
        }
    }
}
