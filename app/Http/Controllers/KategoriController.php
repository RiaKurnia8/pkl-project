<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
{
    // Mengambil semua kategori dari database
    $kategoris = Kategori::all();
    
    // Mengarahkan ke view yang benar 'admin.kategori.index'
    return view('admin.kategori.index', compact('kategoris'));
}


    public function create()
{
    return view('admin.kategori.create');
}
    
    
    public function store(Request $request)
{
    // Validasi
    $request->validate([
    'nama_kategori' => 'required|string|max:255',
]);

    // Simpan ke database
    Kategori::create([
    'nama_kategori' => $request->nama_kategori,
]);

    // Redirect ke halaman yang diinginkan, misalnya daftar kategori
    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
}
    
    
    public function edit($id)
{
    // Cari kategori berdasarkan id
    $kategori = Kategori::find($id);

    // Jika kategori tidak ditemukan, redirect ke halaman kategori dengan pesan error
    if (!$kategori) {
        return redirect()->route('kategori.index')->with('error', 'Kategori tidak ditemukan');
}

    // Jika ditemukan, tampilkan halaman edit
    return view('admin.kategori.edit', compact('kategori'));
}

    
    public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'nama_kategori' => 'required|string|max:255',
]);

    // Cari kategori berdasarkan id
    $kategori = Kategori::find($id);

    // Jika kategori tidak ditemukan, redirect dengan pesan error
    if (!$kategori) {
        return redirect()->route('kategori.index')->with('error', 'Kategori tidak ditemukan');
    }

    // Update data kategori
    $kategori->nama_kategori = $request->nama_kategori;
    $kategori->save();

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui');
}

    
    public function destroy($id)
{
    // Cari kategori berdasarkan id
    $kategori = Kategori::find($id);

    // Jika kategori tidak ditemukan, redirect ke halaman kategori dengan pesan error
    if (!$kategori) {
        return redirect()->route('kategori.index')->with('error', 'Kategori tidak ditemukan');
    }

    // Hapus kategori
    $kategori->delete();

    // Redirect ke halaman kategori dengan pesan sukses
    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
}
}
