<?php

namespace App\Exports;

use App\Models\DataBarang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Events\AfterSheet;

class DataBarangExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
{
    private $nomor = 0;
    
    protected $databarang;

    public function __construct($databarang)
    {
        $this->databarang = $databarang;
    }

    public function collection()
    {
        return $this->databarang;
    }



    public function headings(): array
    {
        // return [
        //     'No',
        //     'Lokasi',
        //     'Barang',
        //     'No.Asset',
        //     'No.Equipment',
        //     'Kategori',
        //     'Merk',
        //     'Tipe',
        //     'Sn',
        //     'Kelayakan',
        //     'Foto',
        //     'Status',
        //     'Tanggal Tambah',
            
        // ];
        // Tanggal saat ini dalam format d-m-Y
    $currentDate = now()->format('d-m-Y');
    $userName = auth()->user()->name;

    return [
        ['Tanggal Export: ' . $currentDate], // Baris pertama berisi tanggal ekspor
        ['Dieksport Oleh: ' . $userName], // Baris kedua berisi nama pengguna
        [
            'No',
            'Lokasi',
            'Barang',
            'No.Asset',
            'No.Equipment',
            'Kategori',
            'Merk',
            'Tipe',
            'Sn',
            'Kelayakan',
            'Foto',
            // 'Status',
            'Tanggal Tambah',
        ]
    ];
    }

    // Pemetaan
    public function map($databarangs): array
    {
        return [
            ++$this->nomor,
            $databarangs->lokasi,
            $databarangs->barang,
            $databarangs->no_asset,
            $databarangs->no_equipment,
            $databarangs->kategori->nama_kategori ?? 'Kategori tidak tersedia', // Mengambil nama kategori
            $databarangs->merk,
            $databarangs->tipe,
            $databarangs->sn,
            $databarangs->kelayakan,
            '', // Kosongkan foto dari pemetaan
            // $databarangs->status,
            $databarangs->created_at->format('d-m-Y'),
           
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            // Tambahkan pendengar acara untuk menyematkan gambar
            AfterSheet::class => function (AfterSheet $event) {
                $dataBarangs = $this->collection();
                $row = 4; // Mulai dari baris kedua (baris pertama adalah heading)
                 // Menggabungkan dan memusatkan kolom A (Tanggal Export) dan kolom B (Nama Pengguna)
            $event->sheet->getDelegate()->mergeCells('A1:M1'); // Menggabungkan baris pertama untuk tanggal export
            $event->sheet->getDelegate()->mergeCells('A2:M2'); // Menggabungkan baris kedua untuk nama pengguna
            $event->sheet->getDelegate()->getStyle('A1:M2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            $event->sheet->getDelegate()->getStyle('A1:M2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            $event->sheet->getDelegate()->getStyle('A2')->getFont()->setBold(true);
            $event->sheet->getDelegate()->getStyle('A3:M3')->getFont()->setBold(true);

                foreach ($dataBarangs as $dataBarang) {
                    if ($dataBarang->foto) {
                        $drawing = new Drawing();
                        $drawing->setName('Foto');
                        $drawing->setDescription('Foto');
                        $drawing->setPath(public_path('img/' . $dataBarang->foto)); // Atur path ke gambar
                        $drawing->setWidth(100);
                        $drawing->setHeight(100); // Atur tinggi (sesuaikan jika perlu)
                        $drawing->setCoordinates('K' . $row); // Kolom K untuk foto
                        $drawing->setOffsetX(5);
                        $drawing->setOffsetY(5);

                        $drawing->setWorksheet($event->sheet->getDelegate());

                        // Mengatur lebar kolom K untuk foto
                        $event->sheet->getDelegate()->getColumnDimension('K')->setWidth(30); // Sesuaikan lebar kolom
                        $event->sheet->getDelegate()->getRowDimension($row)->setRowHeight(100); // Mengatur tinggi baris
                    }
                    $row++;
                }

                // Mengatur gaya untuk memusatkan teks
                $event->sheet->getDelegate()->getStyle('A3:M' . ($row - 1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A3:M' . ($row - 1))->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            },
        ];
    }
}

