<?php

namespace App\Exports;

use App\Models\Peminjamans;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB; // Tambahkan ini
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles; // Pastikan namespace ini ada
use Maatwebsite\Excel\Events\AfterSheet;
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
                $join->on('peminjamans.name', '=', 'pengembalians.name')
                     ->on('peminjamans.barang_dipinjam', '=', 'pengembalians.barang_dipinjam');
            })
            ->where('peminjamans.is_deleted', false)
            ->select(
                'peminjamans.id',
                'peminjamans.name',
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
        $currentDate = now()->format('d-m-Y');
    $userName = auth()->user()->name;
        return [
            ['Tanggal Export: ' . $currentDate], // Baris pertama berisi tanggal ekspor
        ['Dieksport Oleh: ' . $userName],
        [
            'No',
            'ID',
            'Nama',
            'Barang Dipinjam',
            'Plant',
            'Tanggal Pinjam',
            'Tanggal Pengembalian',
        ]
        ];
    }

    /**
     * Mapping data pada setiap kolom di baris Excel
     */
    public function map($peminjaman): array
    {
        return [
            ++$this->nomor,
            $peminjaman->id,
            $peminjaman->name,
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
            2 => ['font' => ['bold' => true]],
            3 => ['font' => ['bold' => true]],
        ];
    }

    public function registerEvents(): array
    {
        return [
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
            }
        ];
    }

}
