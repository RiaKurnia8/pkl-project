<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use Illuminate\Http\Request;
use App\Models\Peminjamans;
use App\Models\Pengembalians;

class HomeController extends Controller
{
    public function index()
    {
        // Hitung jumlah data barang
        $jumlahBarang = DataBarang::count();

        // Ambil semua data peminjaman dengan join ke pengembalians
        $query = Peminjamans::leftJoin('pengembalians', function($join) {
                $join->on('peminjamans.username', '=', 'pengembalians.username')
                     ->on('peminjamans.barang_dipinjam', '=', 'pengembalians.barang_dipinjam');
            })
            ->select(
                'peminjamans.username',
                'peminjamans.barang_dipinjam as barang',
                'peminjamans.plant',
                'peminjamans.tanggal_pinjam',
                'pengembalians.tanggal_pengembalian'
            );

        // Ambil data peminjaman yang sudah dipaginate
        $PeminjamansWithPengembalian = $query->paginate(10); // 10 item per halaman

        // Kirim data ke view
        return view('admin.dashboard', [
            'jumlahBarang' => $jumlahBarang,
            'Peminjamans' => $PeminjamansWithPengembalian,
        ]);
    }
    public function search(Request $request)
{
    // Validasi input pencarian
    $search = $request->input('cari');

    // Hitung jumlah data barang
    $jumlahBarang = DataBarang::count();

    // Ambil data peminjaman dengan kondisi pencarian
    $query = Peminjamans::leftJoin('pengembalians', function($join) {
            $join->on('peminjamans.username', '=', 'pengembalians.username')
                 ->on('peminjamans.barang_dipinjam', '=', 'pengembalians.barang_dipinjam');
        })
        ->select(
            'peminjamans.username',
            'peminjamans.barang_dipinjam as barang',
            'peminjamans.plant',
            'peminjamans.tanggal_pinjam',
            'pengembalians.tanggal_pengembalian'
        );

    // Jika ada query pencarian, filter hasilnya
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('peminjamans.username', 'LIKE', "%{$search}%")
              ->orWhere('peminjamans.barang_dipinjam', 'LIKE', "%{$search}%");
        });
    }

    // Ambil data peminjaman yang sudah dipaginate
    $PeminjamansWithPengembalian = $query->paginate(10); // 10 item per halaman

    // Kirim data ke view
    return view('admin.dashboard', [
        'jumlahBarang' => $jumlahBarang,
        'Peminjamans' => $PeminjamansWithPengembalian,
    ]);
}

}
