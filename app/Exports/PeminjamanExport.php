<?php

namespace App\Exports;

use App\Models\Peminjamans;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;

use Maatwebsite\Excel\Concerns\WithEvents; // Tambahkan ini
use Maatwebsite\Excel\Events\BeforeExport; // Tambahkan ini
use Maatwebsite\Excel\Events\AfterExport;
use Maatwebsite\Excel\Events\AfterWriting;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing as WorksheetDrawing;

class PeminjamanExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $nomor = 0;


    // public function collection()
    // {
    //     return Peminjamans::all();
    // }
    public function collection()
    {
        $peminjamans = Peminjamans::all();

        // Menambahkan tanggal_pengembalian dari tabel pengembalians
        foreach ($peminjamans as $peminjaman) {
            $pengembalian = DB::table('pengembalians')
                ->where('nik', $peminjaman->nik)
                ->where('barang_dipinjam', $peminjaman->barang_dipinjam)
                ->first();

            // Set tanggal_pengembalian jika ditemukan
            $peminjaman->tanggal_pengembalian = $pengembalian->tanggal_pengembalian ?? null;
              // Debugging: menampilkan tanggal_pengembalian
        logger($peminjaman->tanggal_pengembalian);
        }

        return $peminjamans;
    }

    public function headings(): array
    {
        $currentDate = now()->format('d-m-Y');
        $userName = auth()->user()->name;
        return [
            ['Tanggal Export: ' . $currentDate], // Baris pertama berisi tanggal ekspor
            ['Dieksport Oleh: ' . $userName],
            [
            'No',
            'ID',
            'nik',
            'name',
            'plant',
            'barang_dipinjam',
            'tanggal_pinjam',
            'keperluan',
            'notes',
            'status',
            'keterangan',
            'tanggal pengembalian'
            ]
        ];
    }

    //mapping
    public function map($peminjaman): array
    {
        return [
            ++$this->nomor,
            $peminjaman->id,
            $peminjaman->nik,
            $peminjaman->name,
            $peminjaman->plant,
            $peminjaman->barang_dipinjam,
            $peminjaman->tanggal_pinjam,
            $peminjaman->keperluan,
            $peminjaman->notes,
            $peminjaman->status,
            $peminjaman->keterangan,
            $peminjaman->tanggal_pengembalian ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return[
            1 => ['font' => ['bold' => true], ],
            2 => ['font' => ['bold' => true], ],
            3 => ['font' => ['bold' => true], ],
        ];
    }

}
