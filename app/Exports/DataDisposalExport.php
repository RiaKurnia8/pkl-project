<?php

namespace App\Exports;

use App\Models\DataBarang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataDisposalExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    private $nomor = 0;
    public function collection()
    {
        return DataBarang::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'Lokasi',
            'Barang',
            'No.Asset',
            'No.Equipment',
            'Kategori',
            'Merk',
            'Tipe',
            'Sn',
            'Foto',
            
        ];
    }

        //mapping
        public function map($databarangs): array
        {
            return [
                ++$this->nomor,
                $databarangs->lokasi,
                $databarangs->barang,
                $databarangs->no_asset,
                $databarangs->no_equipment,
                $databarangs->kategori,
                $databarangs->merk,
                $databarangs->tipe,
                $databarangs->sn,
                $databarangs->foto,
            ];
        }
    
        public function styles(Worksheet $sheet)
        {
            return[
                1 => ['font' => ['bold' => true], ],
    
            ];
        }
}
