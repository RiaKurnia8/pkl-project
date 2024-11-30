<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Yajra\DataTables\DataTables;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori.index', compact('kategoris'));
    }
    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'status' => 'required|in:on,off', // Validasi status
        ], [
            'nama_kategori.required' => 'Kategori wajib diisi!!',
            'status.required' => 'Status wajib dipilih!!',
            'status.in' => 'Status harus on atau off!!',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'status' => $request->status, // Menyimpan status
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'status' => 'required|in:on,off', // Validasi status
        ]);

        $kategori = Kategori::find($id);

        if (!$kategori) {
            return redirect()->route('kategori.index')->with('error', 'Kategori tidak ditemukan');
        }

        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->status = $request->status; // Menyimpan status
        $kategori->save();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        if ($kategori) {
            $kategori->delete();
            return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
        }
        return redirect()->route('kategori.index')->with('error', 'Kategori tidak ditemukan');
    }


}
