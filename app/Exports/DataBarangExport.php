<?php

namespace App\Exports;

use App\Models\DataBarang;
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

class DataBarangExport implements FromCollection, WithHeadings, WithMapping, WithStyles
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
            'Kelayakan',
            'Foto',
            'Status',
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
            $databarangs->kelayakan,
            $databarangs->foto,
            $databarangs->status,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return[
            1 => ['font' => ['bold' => true], ],

        ];
    }

  // Menambahkan gambar ke dalam worksheet
  public function setImages(Worksheet $sheet)
  {
      $row = 2; // Baris awal untuk data (sesuaikan dengan baris header)
      foreach ($this->collection() as $dataBarang) {
          if ($dataBarang->foto) {
              // Mendapatkan path file gambar
              $path = public_path('img/' . $dataBarang->foto);
              
              if (file_exists($path)) {
                  $drawing = new WorksheetDrawing;
                  $drawing->setName('Foto ' . $dataBarang->barang);
                  $drawing->setDescription('Foto ' . $dataBarang->barang);
                  $drawing->setPath($path); // Path ke file gambar
                  $drawing->setHeight(80); // Tinggi gambar dalam pixels
                  $drawing->setCoordinates('K' . $row); // Kolom untuk menyimpan gambar
                  $drawing->setWorksheet($sheet); // Menambahkan gambar ke worksheet
              }
          }
          $row++;
      }
  }

  public function registerEvents(): array
  {
      return [
          BeforeExport::class => function(BeforeExport $event) {
              $sheet = $event->getWriter()->getDelegate()->getActiveSheet();
              $this->setImages($sheet); // Panggil setImages pada objek worksheet
          },
      ];
  }

}
