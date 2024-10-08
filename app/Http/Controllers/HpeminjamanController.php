<?php

// Peminjaman User

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HpeminjamanController extends Controller
{
    public function index()
    {
        return view('user.hpeminjaman.index');
    }
}
