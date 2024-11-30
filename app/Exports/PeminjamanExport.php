<?php

namespace App\Exports;

use App\Models\Peminjamans;
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


    public function collection()
    {
        return Peminjamans::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'nik',
            'name',
            'plant',
            'barang_dipinjam',
            'tanggal_pinjam',
            'keperluan',
            'notes',
            'status',
        ];
    }

    //mapping
    public function map($peminjaman): array
    {
        return [
            ++$this->nomor,
            $peminjaman->nik,
            $peminjaman->name,
            $peminjaman->plant,
            $peminjaman->barang_dipinjam,
            $peminjaman->tanggal_pinjam,
            $peminjaman->keperluan,
            $peminjaman->notes,
            $peminjaman->status,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return[
            1 => ['font' => ['bold' => true], ],

        ];
    }

}
