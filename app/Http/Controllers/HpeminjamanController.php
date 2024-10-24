<?php

// Peminjaman User

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjamans; // Model Peminjaman
use Illuminate\Support\Facades\Auth; // Import Auth untuk mendapatkan data pengguna yang login

class HpeminjamanController extends Controller
{
    public function index()
    {
        // Mengambil nik pengguna yang sedang login
        $nik = Auth::user()->nik;

        // Mengambil data peminjaman yang sesuai dengan nik pengguna
        $peminjamans = Peminjamans::where('nik', $nik)->get();

        // Mengirim data peminjaman ke view
        return view('user.hpeminjaman.index', compact('peminjamans'));
    }
}

