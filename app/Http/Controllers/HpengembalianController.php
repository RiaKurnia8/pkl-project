<?php

// Pengembalian User

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalians; // Model pengembalian
use Illuminate\Support\Facades\Auth; // Import Auth untuk mendapatkan data pengguna yang login

class HpengembalianController extends Controller
{
    public function index()
    {
        // Mengambil nik pengguna yang sedang login
        $nik = Auth::user()->nik;

        // Mengambil data pengembalian yang sesuai dengan nik pengguna
        $pengembalians = Pengembalians::where('nik', $nik)->get();

        // Mengirim data pengembalian ke view
        return view('user.hpengembalian.index', compact('pengembalians'));
    }
}

