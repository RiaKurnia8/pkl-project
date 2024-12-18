@extends('layouts.admin')
@section('title')
    Tambah Barang

@section('content')
    <div>
        <div class="mb-3">
            <a href="{{ url()->previous() }}" class="text-danger">
                <i class="fa-solid fa-arrow-left-long"></i></a>
             <h2 style="text-align: center;">Edit Barang</h2>
        </div>
       
        {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
        
    @endif --}}
        <form action="{{ route('admin.databarang.update', $databarang->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="row">
                    <!-- Kolom Pertama -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi"
                                id="lokasi" value="{{ $databarang->lokasi }}">
                            @error('lokasi')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="barang" class="form-label">Barang</label>
                            <input type="text" class="form-control @error('barang') is-invalid @enderror" name="barang"
                                id="barang" value="{{ $databarang->barang }}">
                            @error('barang')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="asset" class="form-label">No.Asset</label>
                            <input type="text" class="form-control @error('no_asset') is-invalid @enderror"
                                name="no_asset" id="no_asset" value="{{ $databarang->no_asset }}">
                            @error('no_asset')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="equipment" class="form-label">No.Equipment</label>
                            <input type="text" class="form-control @error('no_equipment') is-invalid @enderror"
                                name="no_equipment" id="no_equipment" value="{{ $databarang->no_equipment }}">
                            @error('no_equipment')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kategori_id" class="form-label">Kategori</label>
                            <select name="kategori_id" id="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $kategori)
                                    @if($kategori->status === 'on') <!-- Memeriksa apakah status adalah 'on' -->
                                        <option value="{{ $kategori->id }}" 
                                            {{ old('kategori_id', isset($databarang) ? $databarang->kategori_id : '') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="merk" class="form-label">Merk</label>
                            <input type="text" class="form-control @error('merk') is-invalid @enderror" name="merk"
                                id="merk" value="{{ $databarang->merk }}">
                            @error('merk')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tipe" class="form-label">Tipe</label>
                            <input type="text" class="form-control @error('tipe') is-invalid @enderror" name="tipe"
                                id="tipe" value="{{ $databarang->tipe }}">
                            @error('tipe')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>


                        <!-- Tombol Back -->
                        <div class="mb-3">
                            <a href="{{ url()->previous() }}" class="btn btn-danger">Batal</a>
                        </div>
                    </div>

                    <!-- Kolom Kedua -->
                    <div class="col-md-6">

                        

                        <div class="mb-3">
                            <label for="sn" class="form-label">SN</label>
                            <input type="text" class="form-control @error('sn') is-invalid @enderror" name="sn"
                                id="sn" value="{{ $databarang->sn }}">
                            @error('sn')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kelayakan" class="form-label">Kelayakan</label>
                            <select class="form-control @error('kelayakan') is-invalid @enderror" name="kelayakan" id="kelayakan">
                                <option value="">-- Pilih Kelayakan --</option>
                                <option value="layak" {{ $databarang->kelayakan == 'layak' ? 'selected' : '' }}>Layak</option>
                                <option value="tidaklayak" {{ $databarang->kelayakan == 'tidaklayak' ? 'selected' : '' }}>Tidak Layak</option>
                            </select>
                            @error('kelayakan')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="fotos" class="form-label">Foto</label>
                        
                            <!-- Tampilkan gambar yang ada -->
                            @if(isset($databarang->foto) && $databarang->foto)
                                <div class="mb-2">
                                    <img src="{{ asset('img/' . $databarang->foto) }}" alt="Foto Barang" width="150" height="150">
                                </div>
                            @endif
                        
                            <!-- Opsi untuk mengunggah gambar baru -->
                            <input type="file" class="form-control @error('fotos') is-invalid @enderror" name="fotos" id="fotos">
                        
                        </div>


                        
                        <!-- Tombol Submit -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection


@section('scripts')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">


@endsection