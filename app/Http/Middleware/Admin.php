<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     if(Auth::user()->usertype != 'admin')
    //     {
    //         return redirect('dashboard');
    //     }


    //     return $next($request);
    // }
    

    public function handle(Request $request, Closure $next): Response
    {
        // Jika pengguna tidak terautentikasi atau bukan admin
        if (!Auth::check() || Auth::user()->usertype != 'admin') {
            // Hapus sesi dan logout pengguna jika sesi kedaluwarsa atau tidak terautentikasi
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Redirect ke halaman login
            return redirect()->route('login');
        }

        return $next($request);
    }
}
