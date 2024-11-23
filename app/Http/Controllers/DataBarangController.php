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
use Yajra\DataTables\DataTables;

class DataBarangController extends Controller
{
    public function index()
    {
        $databarang = DataBarang::all();
        $kategoris = Kategori::all();
        // dd($databarang);
        return view('admin.databarang.index', compact('databarang','kategoris'));
    }

    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = DataBarang::all();
    //         return DataTables::of($data)
    //         ->addIndexColumn()
            
    //         ->addColumn('foto', function($data){
    //             $img = asset('img/' . $data->foto);
    //             return '<img src="'.$img.'" alt="Foto Barang" width="130" height="130">';         
    //         })

    //         ->addColumn('kategori', function ($data) {
    //             return $data->kategori ? $data->kategori->nama_kategori : 'Kategori tidak ada';
    //         })

    //         // ->addColumn('action', function($row){
    //         //     $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
    //         //     return $btn;
    //         // })
    //         ->addColumn('action', function($row){
    //             $editUrl = route('admin.databarang.edit', $row->id);
    //             $deleteUrl = route('admin.databarang.destroy', $row->id);
    //             $btn = '
    //                 <a href="'.$editUrl.'" class="btn btn-warning btn-sm">
    //                 <i class="fas fa-edit"></i>
    //                 </a>
    //                 <button type="button" class="btn btn-danger btn-sm delete-button" data-id="'.$row->id.'">
    //                 <i class="fas fa-trash-alt"></i>
    //                 </button>
    //             ';
    //             return $btn;
    //         })
    //         ->rawColumns(['action', 'foto'])
    //         ->make(true);
    //     }
        
    //     $kategoris = Kategori::all();
    //     return view('admin.databarang.index', compact('kategoris'));

    // }

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
            'kategori_id' => 'required|exists:kategoris,id', // kategori_id harus ada di tabel kategoris,
            'merk' => 'required',
            'tipe' => 'required',
            'sn' => 'required',
            'kelayakan' => ['required', 'in:layak,tidaklayak'],
            'fotos' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'status' => ['required', 'in:dipinjam,kembali,dikantor'],
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
    // public function destroy(string $id)
    // {
    //     try {
    //         $databarang = DataBarang::findOrFail($id); // Mencari data berdasarkan ID
    //         $databarang->delete(); // Menghapus data plant
    
    //         return response()->json(['message' => 'Data Barang Berhasil dihapus'], 200); // Mengirimkan respons sukses
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => 'Data Barang Gagal dihapus'], 500); // Jika terjadi kesalahan
    //     }
    // }

//search
public function search(Request $request)
{
    $keyword = $request->input('cari');
    $bulan = $request->input('bulan');
    $tanggalAwal = $request->input('tanggal_awal');
    $tanggalAkhir = $request->input('tanggal_akhir');

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
        ->when($tanggalAwal && $tanggalAkhir, function ($query) use ($tanggalAwal, $tanggalAkhir) {
            return $query->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir]);
        })
        ->paginate(10);

    return view('admin.databarang.index', compact('databarang'));
}


    //export xls
    // public function export()
    // {
    //     return Excel::download(new DataBarangExport, 'laporan-data-barang.xlsx');
    // }
    // // Ekspor berdasarkan lokasi
    // public function exportByLocation(Request $request)
    // {
    //     $lokasi = $request->input('lokasi'); // Ambil lokasi dari input request

    //     return Excel::download(new DataBarangExport($lokasi), "data_barang_{$lokasi}.xlsx");
    // }


    //export pdf
//     public function exportPdf()
//     {
//         //dd('ada');
//         $databarang = DataBarang::all();
//         $pdf = Pdf::loadView('admin.databarang.index_pdf', ['databarang' =>$databarang]);

//          // Atur ukuran kertas dan orientasi menjadi landscape
//     $pdf->setPaper('A4', 'landscape');
//         return $pdf->download('laporan-data-barang.pdf');
// }


public function export(Request $request)
{
    $query = DataBarang::query();

    // Filter berdasarkan rentang tanggal
    if ($request->start_date && $request->end_date) {
        $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
    }

    // Filter berdasarkan pencarian umum (lokasi, barang, kategori, status)
    if ($request->search) {
        $searchTerm = '%' . $request->search . '%';
        $query->where(function($q) use ($searchTerm) {
            $q->where('lokasi', 'like', $searchTerm)
              ->orWhere('barang', 'like', $searchTerm)
              ->orWhereHas('kategori', function($q) use ($searchTerm) {
                  $q->where('nama_kategori', 'like', $searchTerm);
              })
              ->orWhere('status', 'like', $searchTerm);
        });
    }

    // Ambil data sesuai filter
    $databarang = $query->get();

    // Menentukan format tanggal untuk nama file
    $date = now()->format('d-m-Y');

    // Menentukan nama file berdasarkan filter
    $fileName = 'laporan-data-barang_' . $date;

    // Menambahkan filter ke dalam nama file jika ada
    // if ($request->start_date && $request->end_date) {
    //     $fileName .= '_from-' . $request->start_date . '_to-' . $request->end_date;
    // }
    //     // Menambahkan filter ke dalam nama file
    if ($request->start_date && $request->end_date) {
        $fileName .= '_from-' . $request->start_date . '_to-' . $request->end_date;
    }

    if ($request->start_date && $request->end_date) {
                $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
            }

    if ($request->search) {
        $fileName .= '_search-' . urlencode($request->search);
    }

    // Tentukan jenis file (PDF atau Excel)
    if ($request->type === 'pdf') {
        $pdf = Pdf::loadView('admin.databarang.index_pdf', ['databarang' => $databarang])
            ->setPaper('A4', 'landscape');
        return $pdf->download($fileName . '.pdf');
    }

    // Jika format file Excel
    return Excel::download(new DataBarangExport($databarang), $fileName . '.xlsx');
}

}