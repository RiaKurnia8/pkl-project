<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // Mengambil semua data plants dari database
    $plants = Plant::all();

    // Mengirimkan variabel plants ke view
    return view('admin.plant.index', compact('plants'));
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.plant.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'plant' => 'required|string|max:255',
            'status' => 'required|in:on,off', // Validasi status
        ], [
            'plant.required' => 'Plant wajib diisi!!',
            'status.required' => 'Status wajib dipilih!!',
            'status.in' => 'Status harus on atau off!!',
        ]);

        // Simpan data dengan variabel $data
        $data = $request->only(['plant', 'status']); // Ambil hanya field plant dan status

        // Simpan data ke database
        Plant::create($data);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.plant.index')->with('success', 'Plant berhasil ditambahkan!');
    }


    public function edit(string $id)
    {
        $plant = Plant::find($id);
        return view('admin.plant.edit', compact('plant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'plant' => 'required|string|max:255',
            'status' => 'required|in:on,off',
        ], [
            'plant.required' => 'Plant wajib diisi!!',
            'status.required' => 'Status wajib dipilih!!',
            'status.in' => 'Status harus on atau off!!',
        ]);

        // Cari plant berdasarkan ID
        $plant = Plant::findOrFail($id); // Jika tidak ditemukan, akan melempar error 404

        // Update data plant
        $plant->update($request->only(['plant', 'status']));

        // Redirect dengan pesan sukses
        return redirect()->route('admin.plant.index')->with('success', 'Plant berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plant = Plant::find($id);
        $plant->delete();

        if ($plant) {
            return redirect()->route('admin.plant.index')->with('success', 'Data Barang Berhasil dihapus');
        } else {
            return redirect()->route('admin.plant.index')->with('failed', 'Data Barang Gagal dihapus');
        }
    }

    // public function destroy(string $id)
    // {
    //     try {
    //         $plant = Plant::findOrFail($id); // Mencari data berdasarkan ID
    //         $plant->delete(); // Menghapus data plant

    //         return response()->json(['message' => 'Data Barang Berhasil dihapus'], 200); // Mengirimkan respons sukses
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => 'Data Barang Gagal dihapus'], 500); // Jika terjadi kesalahan
    //     }
    // }
}
