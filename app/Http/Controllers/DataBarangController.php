<?php

namespace App\Http\Controllers;

use App\Exports\DataBarangExport;
use App\Models\DataBarang;
use App\Models\Kategori;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
// use File;
use Illuminate\Support\Facades\File;

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
        $kategoris = Kategori::all();
        return view('admin.databarang.from', compact('kategoris'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'lokasi' => 'required',
            'barang' => 'required',
            'no_asset' => 'required',
            'no_equipment' => 'required',
            'kategori_id' => 'nullable|exists:kategoris,id', // kategori_id harus ada di tabel kategoris,
            'merk' => 'required',
            'tipe' => 'required',
            'sn' => 'required',
            'kelayakan' => ['nullable', 'in:layak,tidaklayak'],
            'fotos' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'status' => ['nullable', 'in:dipinjam,kembali,dikantor'],
        ], [
            'lokasi.required' => 'Lokasi wajib diisi!!',
            'barang.required' => 'Barang wajib diisi!!',
            'no_asset.required' => 'No.Asset wajib diisi!!',
            'no_equipment.required' => 'No.Equipment wajib diisi!!',
            'kategori_id.required' => 'Kategori wajib diisi!!',
            'merk.required' => 'Merk wajib diisi!!',
            'tipe.required' => 'Tipe wajib diisi!!',
            'sn.required' => 'SN wajib diisi!!',
            'kelayakan.required' => 'Kelayakan wajib diisi!!',
            'fotos.required' => 'Foto wajib diisi!!',
            'status.required' => 'Status wajib diisi!!',
        ]);

        //foto
        $filename = null;

    // Proses upload foto
    if ($request->hasFile('fotos')) {
        $file = $request->file('fotos');
        $filename = time() . '_' . $file->getClientOriginalName(); // Membuat nama file yang unik
        $file->move(public_path('img'), $filename); // Simpan di folder 'public/img'
    }

    // Merge nama file ke dalam request agar bisa disimpan ke database
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

       
    }

    //edit
    public function edit($id)
    {
        $databarang = DataBarang::find($id);
        $kategoris = Kategori::all(); // Juga kirim kategori saat edit data
        return view('admin.databarang.edit', compact('databarang', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validated = $request->validate([
            'lokasi' => 'required',
            'barang' => 'required',
            'no_asset' => 'required',
            'no_equipment' => 'required',
            'kategori_id' => 'nullable|exists:kategoris,id', // Simpan ID kategori
            'merk' => 'required',
            'tipe' => 'required',
            'sn' => 'required',
            // 'kelayakan' => ['required', 'in:layak,tidaklayak'],
            'kelayakan' => ['nullable', 'in:layak,tidaklayak'],
            'fotos' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'status' => ['nullable', 'in:dipinjam,kembali,dikantor'],
        ], [
            'lokasi.required' => 'Lokasi wajib diisi!!',
            'barang.required' => 'Barang wajib diisi!!',
            'no_asset.required' => 'No.Asset wajib diisi!!',
            'no_equipment.required' => 'No.Equipment wajib diisi!!',
            'kategori_id.required' => 'Kategori wajib diisi!!',
            'merk.required' => 'Merk wajib diisi!!',
            'tipe.required' => 'Tipe wajib diisi!!',
            'sn.required' => 'SN wajib diisi!!',
            // 'kelayakan.required' => 'Kelayakan wajib diisi!!',
            // 'fotos.required' => 'Foto wajib diisi!!',
            // 'status.required' => 'Status wajib diisi!!',
        ]);

        $databarang = DataBarang::find($id);

    // Cek jika ada file foto yang diupload
    if ($request->hasFile('fotos')) {
        // Hapus gambar lama jika ada
        $imagepath = public_path('img/' . $databarang->foto);
        if (File::exists($imagepath)) {
            File::delete($imagepath);
        }

        // Upload gambar baru
        $file = $request->file('fotos');
        $filename = time() . '_' . $file->getClientOriginalName(); // Membuat nama file yang unik
        $file->move(public_path('img'), $filename); // Simpan di folder 'public/img'

        // Update nama foto ke dalam request untuk disimpan ke database
        $request->merge(['foto' => $filename]);
    } else {
        // Jika tidak ada file foto yang diupload, gunakan foto lama
        $request->merge(['foto' => $databarang->foto]);
    }

    // Cek jika kelayakan kosong, ambil nilai lama dari database
    $kelayakan = $request->input('kelayakan') ?? $databarang->kelayakan;

    //status
    $status= $request->input('status') ?? $databarang->status;
    // Update data kecuali token dan file foto asli
    $databarang->update($request->except('_token', 'fotos', 'kelayakan', 'status'));


        $databarang->lokasi = $request->lokasi;
        $databarang->barang = $request->barang;
        $databarang->no_asset = $request->no_asset;
        $databarang->no_equipment = $request->no_equipment;
        $databarang->kategori_id = $request->kategori_id;
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

    // public function search(Request $request)
    // {
    //     $keyword = $request->input('cari');
    //     $databarang = DataBarang::where('barang', 'like', "%" . $keyword . "%")
    //         ->orWhere('lokasi', 'like', "%" . $keyword . "%")
    //         ->orWhere('no_asset', 'like', "%" . $keyword . "%")
    //         ->orWhere('no_equipment', 'like', "%" . $keyword . "%")
    //         // ->orWhere('kategori', 'like', "%" . $keyword . "%")
    //         ->orWhere('merk', 'like', "%" . $keyword . "%")
    //         ->orWhere('tipe', 'like', "%" . $keyword . "%")
    //         ->orWhere('sn', 'like', "%" . $keyword . "%")
    //         ->orWhere('kelayakan', 'like', "%" . $keyword . "%")
    //         ->orWhere('status', 'like', "%" . $keyword . "%")
    //         ->orWhereHas('kategori', function ($query) use ($keyword) {
    //             $query->where('nama_kategori', 'like', "%" . $keyword . "%");
    //         })
    //         ->paginate(10);

    //     return view('admin.databarang.index', compact('databarang'));
    // }
    public function search(Request $request)
{
    $keyword = $request->input('cari');
    $bulan = $request->input('bulan');

    $databarang = DataBarang::where(function ($query) use ($keyword) {
            $query->where('barang', 'like', "%" . $keyword . "%")
                  ->orWhere('lokasi', 'like', "%" . $keyword . "%")
                  ->orWhere('no_asset', 'like', "%" . $keyword . "%")
                  ->orWhere('no_equipment', 'like', "%" . $keyword . "%")
                  ->orWhere('merk', 'like', "%" . $keyword . "%")
                  ->orWhere('tipe', 'like', "%" . $keyword . "%")
                  ->orWhere('sn', 'like', "%" . $keyword . "%")
                  ->orWhere('kelayakan', 'like', "%" . $keyword . "%")
                  ->orWhere('status', 'like', "%" . $keyword . "%")
                  ->orWhereHas('kategori', function ($query) use ($keyword) {
                      $query->where('nama_kategori', 'like', "%" . $keyword . "%");
                  });
        })
        ->when($bulan, function ($query, $bulan) {
            return $query->whereMonth('created_at', $bulan);
        })
        ->paginate(10);

    return view('admin.databarang.index', compact('databarang'));
}


    //export xls
    public function export()
    {
        return Excel::download(new DataBarangExport, 'laporan-data-barang.xlsx');
    }
    // Ekspor berdasarkan lokasi
    public function exportByLocation(Request $request)
    {
        $lokasi = $request->input('lokasi'); // Ambil lokasi dari input request

        return Excel::download(new DataBarangExport($lokasi), "data_barang_{$lokasi}.xlsx");
    }

    // // Ekspor semua data tanpa filter lokasi
    // public function exportAll()
    // {
    //     return Excel::download(new DataBarangExport(), 'data_barang_all.xlsx');
    // }

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

//export pdf berdasarkan lokasi
public function exportPdfByLocation(Request $request)
{
    // Ambil input lokasi dari request
    $lokasi = $request->input('lokasi');
    
    // Query data barang berdasarkan lokasi
    $databarang = DataBarang::where('lokasi', $lokasi)->get();

    // Load view dan kirim data ke PDF
    $pdf = Pdf::loadView('admin.databarang.indexlokasi_pdf', compact('databarang', 'lokasi'))
        ->setPaper('A4', 'landscape');

    // Kembalikan file PDF untuk diunduh dengan nama file sesuai lokasi
    return $pdf->download("data_barang_{$lokasi}.pdf");
}

}