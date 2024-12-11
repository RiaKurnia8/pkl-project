<?php

namespace App\Http\Controllers;

use App\Exports\PeminjamanExport;
use App\Models\Peminjamans;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\File;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjamans::all();
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    public function edit($id)
    {
        $peminjaman = Peminjamans::find($id);

        if (!$peminjaman) {
            return redirect()->route('admin.peminjaman.index')->with('error', 'Data peminjaman tidak ditemukan.');
        }

        return view('admin.peminjaman.edit', compact('peminjaman'));
    }

    public function destroy($id)
    {
        $peminjaman = Peminjamans::find($id);

        if (!$peminjaman) {
            return redirect()->route('admin.peminjaman.index')->with('error', 'Data peminjaman tidak ditemukan.');
        }

        $peminjaman->delete();

        return redirect()->route('admin.peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|string|max:255',
            //'username' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'plant' => 'required|string|max:255',
            'barang_dipinjam' => 'required|string|max:255',
            'tanggal_pinjam' => 'required|date',
            'status' => 'required|string|max:255',
            'keperluan' => 'required|string',
            //'notes' => 'required|string',
        ]);

        $peminjaman = Peminjamans::find($id);

        if (!$peminjaman) {
            return redirect()->route('admin.peminjaman.index')->with('error', 'Data peminjaman tidak ditemukan.');
        }

        $peminjaman->update($request->all());

        return redirect()->route('admin.peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function search(Request $request)
    {
        // Validasi input pencarian
        $request->validate([
            'cari' => 'nullable|string|max:255',
        ]);

        $keyword = $request->input('cari');

        // Memulai query untuk model Peminjamans
        $peminjamanQuery = Peminjamans::query();

        // Jika ada kata kunci pencarian, tambahkan kondisi pencarian
        if ($keyword) {
            $peminjamanQuery->where(function ($query) use ($keyword) {
                $query->where('nik', 'like', "%" . $keyword . "%")
                    ->orWhere('username', 'like', "%" . $keyword . "%")
                    ->orWhere('plant', 'like', "%" . $keyword . "%")
                    ->orWhere('barang_dipinjam', 'like', "%" . $keyword . "%")
                    ->orWhere('tanggal_pinjam', 'like', "%" . $keyword . "%")
                    ->orWhere('status', 'like', "%" . $keyword . "%");
            });
        }

        // Mendapatkan hasil pencarian dan paginasi
        $peminjamans = $peminjamanQuery->get();

        // Mengembalikan view dengan data peminjaman
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    //export xls
    public function export()
    {
        return Excel::download(new PeminjamanExport, 'laporan-data-peminjaman-' . date('d-m-Y') . '.xlsx');
    }


    public function exportPdf()
    {
        // Ambil data peminjaman
        $peminjamans = Peminjamans::all();

        // Loop untuk menambahkan tanggal_pengembalian dari tabel Pengembalian
        foreach ($peminjamans as $peminjaman) {
            $pengembalian = DB::table('pengembalians')
                ->where('nik', $peminjaman->nik) // Mencocokkan NIK
                ->where('barang_dipinjam', $peminjaman->barang_dipinjam) // Mencocokkan barang
                ->first(); // Ambil satu data saja

            // Set tanggal_pengembalian jika ditemukan, jika tidak biarkan null
            $peminjaman->tanggal_pengembalian = $pengembalian->tanggal_pengembalian ?? null;
        }

        // Mengirim data ke view PDF
        $pdf = Pdf::loadView('admin.peminjaman.index_pdf', ['peminjaman' => $peminjamans]);

        // Atur ukuran kertas dan orientasi menjadi landscape
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('laporan-data-peminjaman-' . date('d-m-Y') . '.pdf');
    }
}
