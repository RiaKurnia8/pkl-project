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
//     public function index(Request $request)
// {
//     if ($request->ajax()) {
//         $kategoris = Kategori::select(['id', 'nama_kategori', 'status']); // Pilih kolom sesuai kebutuhan
//         return DataTables::of($kategoris)
//             ->addIndexColumn() // Menambahkan kolom nomor otomatis
//             ->addColumn('aksi', function ($row) {
//                 $editUrl = route('kategori.edit', $row->id);
//                 $deleteUrl = route('kategori.destroy', $row->id);
//                 return '
//                     <a href="' . $editUrl . '" class="btn btn-sm btn-warning">
//                         <i class="fas fa-edit"></i> 
//                     </a>
//                     <button type="button" class="btn btn-sm btn-danger" onclick="hapusData(' . $row->id . ')">
//                         <i class="fas fa-trash-alt"></i>
//                     </button>
//                 ';
//             })
//             ->rawColumns(['aksi']) // Agar HTML pada kolom "aksi" tidak di-*escape*
//             ->make(true);
//     }
//     return view('admin.kategori.index');
// }
    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'status' => 'required|in:on,off', // Validasi status
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

    // public function destroy(string $id)
    // {
    //     try {
    //         $kategoris = Kategori::findOrFail($id); // Mencari data berdasarkan ID
    //         $kategoris->delete(); // Menghapus data plant
    
    //         return response()->json(['message' => 'Data Barang Berhasil dihapus'], 200); // Mengirimkan respons sukses
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => 'Data Barang Gagal dihapus'], 500); // Jika terjadi kesalahan
    //     }
    // }
}
