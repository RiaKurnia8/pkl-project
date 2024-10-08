<?php

// Peminjaman User

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpeminjamanController extends Controller
{
    public function index()
    {
        return view('user.upeminjaman.index');
    }
}
