<?php

namespace App\Exports;

use App\Models\Pengembalians;
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

class PengembalianExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $nomor = 0;


    public function collection()
    {
        return Pengembalians::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'nik',
            'name',
            'plant',
            'barang_dipinjam',
            'tanggal_pengembalian',
            'keperluan',
            'notes',
            'status',

        ];
    }

    //mapping
    public function map($pengembalian): array
    {
        return [
            ++$this->nomor,
            $pengembalian->nik,
            $pengembalian->name,
            $pengembalian->plant,
            $pengembalian->barang_dipinjam,
            $pengembalian->tanggal_pengembalian,
            $pengembalian->keperluan,
            $pengembalian->notes,
            $pengembalian->status,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return[
            1 => ['font' => ['bold' => true], ],

        ];
    }

}
