<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjamans; // Pastikan ini menggunakan nama model yang benar

class UpeminjamanController extends Controller
{
    public function index()
    {
        return view('user.upeminjaman.index');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nik' => 'required',
            'username' => 'required',
            'plant' => 'required',
            'barang' => 'required',
            'tanggal_pinjam' => 'required|date',
        ]);

        // Simpan data ke database
        Peminjamans::create([ // Pastikan ini menggunakan model yang benar
            'nik' => $validated['nik'],
            'username' => $validated['username'],
            'plant' => $validated['plant'],
            'barang_dipinjam' => $validated['barang'],
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'status' => ''// status default
        ]);

        // Kirim notifikasi melalui session
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }
}
