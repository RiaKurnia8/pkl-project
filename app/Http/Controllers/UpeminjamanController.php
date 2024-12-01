<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjamans; // Pastikan ini menggunakan nama model yang benar

class UpeminjamanController extends Controller
{
    public function index()
    {
        $lastId = Peminjamans::max('id') ?? 0;
        return view('user.upeminjaman.index', ['nextId' => $lastId + 1]);
    }

    // Method untuk menampilkan form peminjaman
    public function create()
    {
        // Ambil ID terakhir dari tabel peminjamans
        $lastId = Peminjamans::max('id') ?? 0;

        // Kirim ID berikutnya ke view
        return view('peminjaman.index', ['nextId' => $lastId + 1]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'id' => 'required|integer',
            'nik' => 'required',
            //'username' => 'required',
            'name' => 'required',
            'plant' => 'required',
            'barang' => 'required',
            'tanggal_pinjam' => 'required|date',
            'keperluan' => 'required',
            //'notes' => 'required',
        ]);

        // Simpan data ke database
        Peminjamans::create([ // Pastikan ini menggunakan model yang benar
            'id' => $validated['id'],
            'nik' => $validated['nik'],
            //'username' => $validated['username'],
            'name' => $validated['name'],
            'plant' => $validated['plant'],
            'barang_dipinjam' => $validated['barang'],
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'status' => '',// status default
            'keperluan' => $validated['keperluan'],
           // 'notes' => $validated['notes']
        ]);

        // Kirim notifikasi melalui session
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }
}
