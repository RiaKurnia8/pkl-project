<?php

namespace App\Http\Controllers;

use App\Exports\DashboardExport;
use App\Models\DataBarang;
use Illuminate\Http\Request;
use App\Models\Peminjamans;
use App\Models\Pengembalians;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        // Hitung jumlah data barang
        $jumlahBarang = DataBarang::count();

        // Hitung jumlah user
        $jumlahUser = User::count(); // Menghitung jumlah user

        // Ambil data peminjaman yang tidak dihapus
        $query = Peminjamans::leftJoin('pengembalians', function ($join) {
            $join->on('peminjamans.username', '=', 'pengembalians.username')
                ->on('peminjamans.barang_dipinjam', '=', 'pengembalians.barang_dipinjam');
        })
            ->where('peminjamans.is_deleted', false) // Hanya data yang tidak dihapus
            ->select(
                'peminjamans.id',
                'peminjamans.username',
                'peminjamans.barang_dipinjam as barang',
                'peminjamans.plant',
                'peminjamans.tanggal_pinjam',
                'pengembalians.tanggal_pengembalian'
            );

        // Filter pencarian
        if ($request->has('cari')) {
            $query->where(function ($q) use ($request) {
                $q->where('peminjamans.username', 'like', '%' . $request->cari . '%')
                    ->orWhere('peminjamans.barang_dipinjam', 'like', '%' . $request->cari . '%')
                    ->orWhere('peminjamans.plant', 'like', '%' . $request->cari . '%');
            });
        }

        $PeminjamansWithPengembalian = $query->paginate(10)->withQueryString();

        // Kirim data ke view
        return view('admin.dashboard', [
            'jumlahBarang' => $jumlahBarang,
            'Peminjamans' => $PeminjamansWithPengembalian,
            'jumlahUser' => $jumlahUser, // Menambahkan jumlah user ke view
        ]);
    }

    //delete

    public function delete($id)
    {
        $peminjaman = Peminjamans::findOrFail($id);
        $peminjaman->is_deleted = true;
        $peminjaman->save();

        return redirect()->route('admin.dashboard.index')->with('success', 'Data berhasil dihapus!');
    }

    //trash
    public function showTrash()
    {
        $trashedPeminjamans = Peminjamans::leftJoin('pengembalians', function ($join) {
            $join->on('peminjamans.username', '=', 'pengembalians.username')
                ->on('peminjamans.barang_dipinjam', '=', 'pengembalians.barang_dipinjam');
        })
            ->where('peminjamans.is_deleted', true)
            ->select(
                'peminjamans.id', // Tambahkan 'id' di sini
                'peminjamans.username',
                'peminjamans.barang_dipinjam as barang',
                'peminjamans.plant',
                'peminjamans.tanggal_pinjam',
                'pengembalians.tanggal_pengembalian'
            )
            ->get();

        return view('admin.riwayat_sampah', ['Peminjamans' => $trashedPeminjamans]);
    }

    //mengembalikan data
    public function restore($id)
    {
        // Cari data peminjaman berdasarkan ID
        $peminjaman = Peminjamans::findOrFail($id);

        // Ubah status is_deleted menjadi false untuk mengembalikan data
        $peminjaman->is_deleted = false;
        $peminjaman->save();

        // Redirect kembali ke halaman Riwayat Sampah dengan pesan sukses
        return redirect()->route('admin.riwayat_sampah')->with('success', 'Data berhasil dikembalikan dari Riwayat Sampah.');
    }

    //hapus permanen
    public function forceDelete($id)
    {
        // Cari data peminjaman berdasarkan ID
        $peminjaman = Peminjamans::findOrFail($id);

        // Hapus data secara permanen
        $peminjaman->delete();

        // Redirect kembali ke halaman Riwayat Sampah dengan pesan sukses
        return redirect()->route('admin.riwayat_sampah')->with('success', 'Data berhasil dihapus secara permanen.');
    }

    //export excel
    public function exportPeminjaman()
    {
        return Excel::download(new DashboardExport, 'data-dashboard.xlsx');
    }

    //export pdf
    
    public function exportPdf()
{
    $peminjamanData = Peminjamans::leftJoin('pengembalians', function ($join) {
            $join->on('peminjamans.username', '=', 'pengembalians.username')
                 ->on('peminjamans.barang_dipinjam', '=', 'pengembalians.barang_dipinjam');
        })
        ->where('peminjamans.is_deleted', false)
        ->select(
            'peminjamans.username',
            'peminjamans.barang_dipinjam as barang',
            'peminjamans.plant',
            'peminjamans.tanggal_pinjam',
            DB::raw('COALESCE(pengembalians.tanggal_pengembalian, "-") as tanggal_pengembalian')
        )
        ->get();
    
    $timestamp = now()->format('Ymd_His');
    $filename = "dashboard_data_{$timestamp}.pdf";
    $pdf = Pdf::loadView('admin.dashboard_pdf', compact('peminjamanData'));
    return $pdf->download($filename); 
}

public function search(Request $request)
    {
        $search = $request->input('search');

        $peminjamanData = Peminjamans::leftJoin('pengembalians', function ($join) {
            $join->on('peminjamans.username', '=', 'pengembalians.username')
                ->on('peminjamans.barang_dipinjam', '=', 'pengembalians.barang_dipinjam');
        })
            ->where('peminjamans.is_deleted', false)
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('peminjamans.username', 'like', "%{$search}%")
                        ->orWhere('peminjamans.barang_dipinjam', 'like', "%{$search}%")
                        ->orWhere('peminjamans.plant', 'like', "%{$search}%")
                        ->orWhere('peminjamans.tanggal_pinjam', 'like', "%{$search}%");
                });
            })
            ->select(
                'peminjamans.id',
                'peminjamans.username',
                'peminjamans.barang_dipinjam as barang',
                'peminjamans.plant',
                'peminjamans.tanggal_pinjam',
                DB::raw('COALESCE(pengembalians.tanggal_pengembalian, "-") as tanggal_pengembalian')
            )
            ->get();

        return response()->json(['data' => $peminjamanData]);
    }

}
