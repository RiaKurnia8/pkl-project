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

class DataDisposalExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
{
    private $nomor = 0;

    public function collection()
    {
        return DataBarang::where('kelayakan', 'tidaklayak')->get();
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
            'Tanggal Disposal',
            'Foto',
            
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
            // Hapus $databarangs->foto dari sini
            $databarangs->updated_at->format('d-m-Y'),
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
                $row = 2; // Mulai dari baris kedua (baris pertama adalah heading)

                foreach ($dataBarangs as $dataBarang) {
                    if ($dataBarang->foto) {
                        $drawing = new Drawing();
                        $drawing->setName('Foto');
                        $drawing->setDescription('Foto');
                        $drawing->setPath(public_path('img/' . $dataBarang->foto)); // Atur path ke gambar
                        $drawing->setWidth(100);
                        $drawing->setHeight(100); // Atur tinggi (sesuaikan jika perlu)
                        $drawing->setCoordinates('K' . $row); // Kolom J untuk foto
                        $drawing->setOffsetX(15);
                        $drawing->setOffsetY(15);

                        $drawing->setWorksheet($event->sheet->getDelegate());

                        
                        // Mengatur lebar kolom J untuk foto
                        $event->sheet->getDelegate()->getColumnDimension('K')->setWidth(30); // Sesuaikan lebar kolom
                        $event->sheet->getDelegate()->getRowDimension($row)->setRowHeight(100); // Mengatur tinggi baris
                    }
                    $row++;
                }

                // Mengatur gaya untuk memusatkan teks
                $event->sheet->getDelegate()->getStyle('A1:K' . ($row - 1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A1:K' . ($row - 1))->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            },
        ];
    }
}

