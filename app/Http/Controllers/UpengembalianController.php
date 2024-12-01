<?php

namespace App\Http\Controllers;

use App\Models\Peminjamans;
use Illuminate\Http\Request;
use App\Models\Pengembalians; // Pastikan ini menggunakan nama model yang benar

class UpengembalianController extends Controller
{
    public function index(Request $request)
    {
        $idBarang = $request->input('id'); // ID Barang
        $barang = $request->input('barang'); // Nama Barang
        return view('user.upengembalian.index', compact('idBarang', 'barang'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'id' => 'required|integer',
            'nik' => 'required',
            // 'username' => 'required',
            'name' => 'required',
            'plant' => 'required',
            'barang' => 'required',
            'tanggal_pengembalian' => 'required|date',
            'keperluan' => 'required',
            // 'notes' => 'required',
        ]);

        // Simpan data ke database
        Pengembalians::create([ // Pastikan ini menggunakan model yang benar
            'id' => $validated['id'],
            'nik' => $validated['nik'],
            // 'username' => $validated['username'],
            'name' => $validated['name'],
            'plant' => $validated['plant'],
            'barang_dipinjam' => $validated['barang'],
            'tanggal_pengembalian' => $validated['tanggal_pengembalian'],
            'status' => '', // status default
            'keperluan' => $validated['keperluan'],
            // 'notes' => $validated['notes']
        ]);

        // Update kolom keterangan pada tabel peminjamans
    $peminjaman = Peminjamans::find($validated['id']);
    if ($peminjaman) {
        $peminjaman->update(['keterangan' => 'Sudah Kembali']);
    }

        // Kirim notifikasi melalui session
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }
}
