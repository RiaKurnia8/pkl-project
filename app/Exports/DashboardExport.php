<?php

namespace App\Exports;

use App\Models\Peminjamans;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB; // Tambahkan ini
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles; // Pastikan namespace ini ada
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DashboardExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    private $nomor = 0;

    /**
     * Mengambil data untuk diexport
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Peminjamans::leftJoin('pengembalians', function ($join) {
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
    }

    /**
     * Mengatur heading untuk file Excel
     */
    public function headings(): array
    {
        return [
            'No',
            'Username',
            'Barang Dipinjam',
            'Plant',
            'Tanggal Pinjam',
            'Tanggal Pengembalian',
        ];
    }

    /**
     * Mapping data pada setiap kolom di baris Excel
     */
    public function map($peminjaman): array
    {
        return [
            ++$this->nomor,
            $peminjaman->username,
            $peminjaman->barang,
            $peminjaman->plant,
            $peminjaman->tanggal_pinjam,
            $peminjaman->tanggal_pengembalian,
        ];
    }

    /**
     * Menambahkan style untuk header
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Menebalkan header pada baris pertama
        ];
    }
}
