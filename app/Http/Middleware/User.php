<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {

    //      // Jika user type adalah 'user', arahkan ke dashboard user
    // if (Auth::user()->usertype == 'user') {
    //     return redirect()->route('user.dashboard');
    // }

    // // Jika user type bukan 'user', biarkan permintaan diteruskan
    // return $next($request);
    // }


    public function handle(Request $request, Closure $next): Response
    {
        // Jika pengguna tidak terautentikasi atau sesi telah kedaluwarsa
        if (!Auth::check() || Auth::user()->usertype == 'user') {
            // Logout dan hapus sesi
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login'); // Redirect ke halaman login
        }

        return $next($request);
    }
}
