<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use Illuminate\Http\Request;
use App\Models\Peminjamans;
use App\Models\Pengembalians;
//use App\Models\DataBarang;


class HomeController extends Controller
{
    // public function index()
    // {
    //     return view('admin.dashboard');
    // }
    public function index()
    {
        //Hitung jumlah data barang
        $jumlahBarang = DataBarang::count();


        // Ambil semua data peminjaman dengan join ke pengembalians
        $PeminjamansWithPengembalian = Peminjamans::leftJoin('pengembalians', function($join) {
                $join->on('peminjamans.username', '=', 'pengembalians.username')
                     ->on('peminjamans.barang_dipinjam', '=', 'pengembalians.barang_dipinjam');
            })
            ->select(
                'peminjamans.username',
                'peminjamans.barang_dipinjam as barang',
                'peminjamans.plant',
                'peminjamans.tanggal_pinjam',
                'pengembalians.tanggal_pengembalian' // Ambil tanggal_pengembalian dari tabel pengembalians
            )
            ->get();

        // Kirim data ke view
        return view('admin.dashboard', [
            'jumlahBarang' =>$jumlahBarang, 
            'Peminjamans' => $PeminjamansWithPengembalian]);
    }
}
