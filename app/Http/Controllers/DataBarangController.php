<?php

namespace App\Http\Controllers;

use App\Exports\DataBarangExport;
use App\Models\DataBarang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use File;

class DataBarangController extends Controller
{
    public function index()
    {
        $databarang = DataBarang::paginate(10);
        // dd($databarang);
        return view('admin.databarang.index', compact('databarang'));
    }

    public function create()
    {
        return view('admin.databarang.from');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'lokasi' => 'required',
            'barang' => 'required',
            'no_asset' => 'required',
            'no_equipment' => 'required',
            'kategori' => ['required', 'in:peripheral,sparepart,networkpart,surveilance'],
            'merk' => 'required',
            'tipe' => 'required',
            'sn' => 'required',
            'kelayakan' => ['required', 'in:layak,tidaklayak'],
            'foto' => 'required',
            'status' => ['required', 'in:dipinjam,kembali,dikantor'],
        ], [
            'lokasi.required' => 'Lokasi wajib diisi!!',
            'barang.required' => 'Barang wajib diisi!!',
            'no_asset.required' => 'No.Asset wajib diisi!!',
            'no_equipment.required' => 'No.Equipment wajib diisi!!',
            'kategori.required' => 'Kategori wajib diisi!!',
            'merk.required' => 'Merk wajib diisi!!',
            'tipe.required' => 'Tipe wajib diisi!!',
            'sn.required' => 'SN wajib diisi!!',
            'kelayakan.required' => 'Kelayakan wajib diisi!!',
            'foto.required' => 'Foto wajib diisi!!',
            'status.required' => 'Status wajib diisi!!',
        ]);

        //foto
        if ($request->file('foto')) {
            $file = $request->foto;
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
        }

        $request->merge([
            'foto' => $filename,
        ]);

        //end

        $data = $request->except('_token');
        // dd($data);
        //pesan error
        $databarang = DataBarang::create($data);

        if ($databarang) {
            return redirect()->route('admin.databarang.index')->with('success', 'Data Barang Berhasil dibuat');
        } else {
            return redirect()->route('admin.databarang.index')->with('failed', 'Data Barang Gagal dibuat');
        }

        //return redirect()->route('admin.databarang.index')->with('success', 'Data Barang Berhasil dibuat');
    }

    //edit
    public function edit($id)
    {
        $databarang = DataBarang::find($id);
        return view('admin.databarang.edit', compact('databarang'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validated = $request->validate([
            'lokasi' => 'required',
            'barang' => 'required',
            'no_asset' => 'required',
            'no_equipment' => 'required',
            'kategori' => ['required', 'in:peripheral,sparepart,networkpart,surveilance'],
            'merk' => 'required',
            'tipe' => 'required',
            'sn' => 'required',
            'kelayakan' => ['required', 'in:layak,tidaklayak'],
            'foto' => 'required',
            'status' => ['required', 'in:dipinjam,kembali,dikantor'],
        ], [
            'lokasi.required' => 'Lokasi wajib diisi!!',
            'barang.required' => 'Barang wajib diisi!!',
            'no_asset.required' => 'No.Asset wajib diisi!!',
            'no_equipment.required' => 'No.Equipment wajib diisi!!',
            'kategori.required' => 'Kategori wajib diisi!!',
            'merk.required' => 'Merk wajib diisi!!',
            'tipe.required' => 'Tipe wajib diisi!!',
            'sn.required' => 'SN wajib diisi!!',
            'kelayakan.required' => 'Kelayakan wajib diisi!!',
            'foto.required' => 'Foto wajib diisi!!',
            'status.required' => 'Status wajib diisi!!',
        ]);

        // update foto
        //     $databarang = DataBarang::find($id);

        //    if ($request->foto != null && $request->foto != "") {
        //     $imagepath = public_path('img/'.$databarang->foto);
        //     if (File::exists($imagepath)) {
        //         File::delete($imagepath);
        //     }

        //         $file = $request->foto;
        //         $filename = time() . '_' . $file->getClientOriginalName();
        //         $file->move(public_path('img'), $filename);

        //         $request->merge([
        //             'foto' => $filename,
        //         ]);

        //         $databarang->update($request->except('_token', 'foto'));
        //    }
        //end



        $databarang = DataBarang::find($id);
        $databarang->lokasi = $request->lokasi;
        $databarang->barang = $request->barang;
        $databarang->no_asset = $request->no_asset;
        $databarang->no_equipment = $request->no_equipment;
        $databarang->kategori = $request->kategori;
        $databarang->merk = $request->merk;
        $databarang->tipe = $request->tipe;
        $databarang->sn = $request->sn;
        $databarang->kelayakan = $request->kelayakan;
        $databarang->foto = $request->foto;
        $databarang->status = $request->status;
        $databarang->save();

        if ($databarang) {
            return redirect()->route('admin.databarang.index')->with('success', 'Data Barang Berhasil diedit');
        } else {
            return redirect()->route('admin.databarang.index')->with('failed', 'Data Barang Gagal diedit');
        }

        //return redirect()->route('admin.databarang.index')->with('success', 'Data Barang Berhasil dibuat');
    }

    //hapus data
    public function destroy($id)
    {
        $databarang = DataBarang::find($id);
        $databarang->delete();

        if ($databarang) {
            return redirect()->route('admin.databarang.index')->with('success', 'Data Barang Berhasil dihapus');
        } else {
            return redirect()->route('admin.databarang.index')->with('failed', 'Data Barang Gagal dihapus');
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->input('cari');
        $databarang = DataBarang::where('barang', 'like', "%" . $keyword . "%")
            ->orWhere('lokasi', 'like', "%" . $keyword . "%")
            ->orWhere('no_asset', 'like', "%" . $keyword . "%")
            ->orWhere('no_equipment', 'like', "%" . $keyword . "%")
            ->orWhere('kategori', 'like', "%" . $keyword . "%")
            ->orWhere('merk', 'like', "%" . $keyword . "%")
            ->orWhere('tipe', 'like', "%" . $keyword . "%")
            ->orWhere('sn', 'like', "%" . $keyword . "%")
            ->orWhere('kelayakan', 'like', "%" . $keyword . "%")
            ->orWhere('status', 'like', "%" . $keyword . "%")
            ->paginate(10);

        return view('admin.databarang.index', compact('databarang'));
    }

    //export xls
    public function export()
    {
        return Excel::download(new DataBarangExport, 'laporan-data-barang.xlsx');
    }

    //export pdf
    public function exportPdf()
    {
        //dd('ada');
        $databarang = DataBarang::all();
        $pdf = Pdf::loadView('admin.databarang.index_pdf', ['databarang' =>$databarang]);

         // Atur ukuran kertas dan orientasi menjadi landscape
    $pdf->setPaper('A4', 'landscape');
        return $pdf->download('laporan-data-barang.pdf');
    }
}
