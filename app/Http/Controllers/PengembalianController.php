<?php

namespace App\Http\Controllers;

use App\Exports\PengembalianExport;
use App\Models\Pengembalians;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\File;

class PengembalianController extends Controller
{
    public function index() {
        $pengembalians = Pengembalians::all();
        
        return view('admin.pengembalian.index', compact('pengembalians'));
    }

    public function edit($id)
    {
        $pengembalian = Pengembalians::find($id);
    
        if (!$pengembalian) {
            return redirect()->route('admin.pengembalian.index')->with('error', 'Data pengembalian tidak ditemukan.');
        }
    
        return view('admin.pengembalian.edit', compact('pengembalian'));
    }
    
    public function destroy($id)
    {
        $pengembalian = Pengembalians::find($id);

        if (!$pengembalian ) {
            return redirect()->route('admin.pengembalian.index')->with('error', 'Data pengembalian tidak ditemukan.');
        }

        $pengembalian->delete();

        return redirect()->route('admin.pengembalian.index')->with('success', 'Data pengembalian berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'plant' => 'required|string|max:255',
            'barang_dipinjam' => 'required|string|max:255',
            'tanggal_pengembalian' => 'required|date',
            'status' => 'required|string|max:255',
        ]);
    
        $pengembalian = Pengembalians::find($id);
    
        if (!$pengembalian) {
            return redirect()->route('admin.pengembalian.index')->with('error', 'Data pengembalian tidak ditemukan.');
        }
    
        $pengembalian->update($request->all());
    
        return redirect()->route('admin.pengembalian.index')->with('success', 'Data pengembalian berhasil diperbarui.');
    }

    public function search(Request $request)
{
    // Validasi input pencarian
    $request->validate([
        'cari' => 'nullable|string|max:255',
    ]);

    $keyword = $request->input('cari');

    // Memulai query untuk model Pengembalians
    $pengembalianQuery = Pengembalians::query();

    // Jika ada kata kunci pencarian, tambahkan kondisi pencarian
    if ($keyword) {
        $pengembalianQuery->where(function($query) use ($keyword) {
            $query->where('nik', 'like', "%" . $keyword . "%")
                ->orWhere('username', 'like', "%" . $keyword . "%")
                ->orWhere('plant', 'like', "%" . $keyword . "%")
                ->orWhere('barang_dipinjam', 'like', "%" . $keyword . "%")
                ->orWhere('tanggal_pengembalian', 'like', "%" . $keyword . "%")
                ->orWhere('status', 'like', "%" . $keyword . "%");
        });
    }

    // Mendapatkan hasil pencarian dan paginasi
    $pengembalians = $pengembalianQuery->paginate(10);

    // Mengembalikan view dengan data pengembalian
    return view('admin.pengembalian.index', compact('pengembalians'));
}

    //export xls
    public function export()
    {
        return Excel::download(new PengembalianExport, 'laporan-data-pengembalian.xlsx');
    }

    //export pdf
    public function exportPdf()
    {
        //dd('ada');
        $pengembalian = Pengembalians::all();
        $pdf = Pdf::loadView('admin.pengembalian.index_pdf', ['pengembalian' =>$pengembalian]);

         // Atur ukuran kertas dan orientasi menjadi landscape
    $pdf->setPaper('A4', 'landscape');
        return $pdf->download('laporan-data-pengembalian.pdf');
    }
}
