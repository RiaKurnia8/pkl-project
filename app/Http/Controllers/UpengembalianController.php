<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalians; // Pastikan ini menggunakan nama model yang benar

class UpengembalianController extends Controller
{
    public function index()
    {
        return view('user.upengembalian.index');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
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
            'nik' => $validated['nik'],
            // 'username' => $validated['username'],
            'name' => $validated['name'],
            'plant' => $validated['plant'],
            'barang_dipinjam' => $validated['barang'],
            'tanggal_pengembalian' => $validated['tanggal_pengembalian'],
            'status' => '',// status default
            'keperluan' => $validated['keperluan'],
            // 'notes' => $validated['notes']
        ]);

        // Kirim notifikasi melalui session
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }
}
