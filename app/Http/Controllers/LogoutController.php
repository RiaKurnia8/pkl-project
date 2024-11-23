<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
{
    // Logout pengguna dan hapus sesi
    Auth::logout();

    // Menghapus sesi dan token CSRF untuk keamanan
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login'); // Redirect ke halaman login
}
}
