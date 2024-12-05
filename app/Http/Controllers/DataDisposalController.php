<?php

namespace App\Http\Controllers;

use App\Exports\DataBarangExport;
use App\Exports\DataDisposalExport;
use App\Models\DataBarang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DataDisposalController extends Controller
{
    public function index()
    {
        $datadisposal = DataBarang::where('kelayakan', 'tidaklayak')->get();
        return view('admin.datadisposal.index', compact('datadisposal'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('cari');
        $bulan = $request->input('bulan');
        
        // Hanya mencari di data dengan kelayakan 'tidak layak'
        $datadisposal = DataBarang::where('kelayakan', 'tidaklayak')
            ->where(function($query) use ($keyword) {
                $query->where('barang', 'like', "%" . $keyword . "%")
                    ->orWhere('lokasi', 'like', "%" . $keyword . "%")
                    ->orWhere('no_asset', 'like', "%" . $keyword . "%")
                    ->orWhere('no_equipment', 'like', "%" . $keyword . "%")
                    //->orWhere('kategori', 'like', "%" . $keyword . "%")
                    ->orWhere('merk', 'like', "%" . $keyword . "%")
                    ->orWhere('tipe', 'like', "%" . $keyword . "%")
                    ->orWhere('sn', 'like', "%" . $keyword . "%")
                    ->orWhereHas('kategori', function ($query) use ($keyword) {
                        $query->where('nama_kategori', 'like', "%" . $keyword . "%");
                    });
            })
            ->when($bulan, function ($query, $bulan) {
                return $query->whereMonth('created_at', $bulan);
            })
            ->get();

        return view('admin.datadisposal.index', compact('datadisposal'));
    }

    public function export()
    {
        return Excel::download(new DataDisposalExport, 'laporan-data-disposal-' . date('d-m-Y') . '.xlsx');

    }

    public function exportPdf()
    {
        //dd('ada');
        $datadisposal = DataBarang::where('kelayakan', 'tidaklayak')->get();
        $pdf = Pdf::loadView('admin.datadisposal.index_pdf', ['datadisposal' =>$datadisposal]);

         // Atur ukuran kertas dan orientasi menjadi landscape
    $pdf->setPaper('A4', 'landscape');
        return $pdf->download('laporan-data-disposal-' . date('d-m-Y') . '.pdf');
    }

    

    
}
