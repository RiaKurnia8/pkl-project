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
        //$pengembalians = Pengembalians::where('nik', $nik)->get();
        $pengembalians = Pengembalians::where('nik', $nik)->paginate(10);

        // Mengirim data pengembalian ke view
        return view('user.hpengembalian.index', compact('pengembalians'));
    }

    public function search(Request $request)
    {
        // Mengambil nik pengguna yang sedang login
        $nik = Auth::user()->nik;

        // Mendapatkan kata kunci pencarian
        $keyword = $request->input('cari');

        // Mencari data pengembalian berdasarkan kata kunci dan nik pengguna
        $pengembalians = Pengembalians::where('nik', $nik)
            ->where(function ($query) use ($keyword) {
                $query->where('username', 'like', "%" . $keyword . "%")
                    ->orWhere('plant', 'like', "%" . $keyword . "%")
                    ->orWhere('barang_dipinjam', 'like', "%" . $keyword . "%")
                    ->orWhere('tanggal_pengembalian', 'like', "%" . $keyword . "%")
                    ->orWhere('status', 'like', "%" . $keyword . "%");
            })
            ->paginate(10);

        // Mengirim data pencarian ke view
        return view('user.hpengembalian.index', compact('pengembalians'));
    }
}
