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
        //$peminjamans = Peminjamans::where('nik', $nik)->get();
        $peminjamans = Peminjamans::where('nik', $nik)->get();

        

        // Mengirim data peminjaman ke view
        return view('user.hpeminjaman.index', compact('peminjamans'));
    }

    public function search(Request $request)
    {
        // Mengambil nik pengguna yang sedang login
        $nik = Auth::user()->nik;

        // Mendapatkan kata kunci pencarian
        $keyword = $request->input('cari');

        // Mencari data peminjaman berdasarkan kata kunci dan nik pengguna
        $peminjamans = Peminjamans::where('nik', $nik)
            ->where(function ($query) use ($keyword) {
                $query->where('plant', 'like', "%" . $keyword . "%")
                    ->orWhere('barang_dipinjam', 'like', "%" . $keyword . "%")
                    ->orWhere('tanggal_pinjam', 'like', "%" . $keyword . "%")
                    ->orWhere('status', 'like', "%" . $keyword . "%");
            })
            ->paginate(10);

        // Mengirim data peminjaman ke view
        return view('user.hpeminjaman.index', compact('peminjamans'));
    }
}
