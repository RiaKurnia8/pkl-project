@extends('layouts.admin')
@section('title')
    Tambah Barang

@section('content')
    <div>
        <div class="mb-3">
            {{-- <a href="{{ url()->previous() }}" class="btn btn-danger">Back</a> --}}
            <a href="{{ url()->previous() }}" class="text-danger">
                <i class="fa-solid fa-arrow-left-long"></i></a>
        <h2 style="text-align: center;">Tambah Barang</h2>
        </div>
        <form action="{{ route('admin.databarang.store') }}" method="POST" enctype="multipart/form-data" >
            @csrf
            <div class="container">
                <div class="row">
                    <!-- Kolom Pertama -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" 
                                id="lokasi" value="{{ old('lokasi') }}">
                            @error('lokasi')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="barang" class="form-label">Barang</label>
                            <input type="text" class="form-control @error('barang') is-invalid @enderror" name="barang"
                                id="barang" value="{{ old('barang') }}">
                            @error('barang')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="asset" class="form-label">No.Asset</label>
                            <input type="text" class="form-control @error('no_asset') is-invalid @enderror"
                                name="no_asset" id="no_asset" value="{{ old('no_asset') }}">
                            @error('no_asset')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="equipment" class="form-label">No.Equipment</label>
                            <input type="text" class="form-control @error('no_equipment') is-invalid @enderror"
                                name="no_equipment" id="no_equipment" value="{{ old('no_equipment') }}">
                            @error('no_equipment')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="kategori_id" class="form-label">Kategori</label>
                            <select name="kategori_id" id="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" value="{{ old('kategori') }}">
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
                                id="merk" value="{{ old('merk') }}">
                            @error('merk')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>



                        <!-- Tombol Back -->
<<<<<<< HEAD
                        <div class="mb-3">
                            <a href="{{ url()->previous() }}" class="btn btn-danger">Kembali</a>
                        </div>
=======
                        {{-- <div class="mb-3">
                            <a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
                        </div> --}}
>>>>>>> 72542b368a5eec9c79c1746c48f934aec671fc55
                    </div>

                    <!-- Kolom Kedua -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label for="tipe" class="form-label">Tipe</label>
                            <input type="text" class="form-control @error('tipe') is-invalid @enderror" name="tipe"
                                id="tipe" value="{{ old('tipe') }}">
                            @error('tipe')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sn" class="form-label">SN</label>
                            <input type="text" class="form-control @error('sn') is-invalid @enderror" name="sn"
                                id="sn" value="{{ old('sn') }}">
                            @error('sn')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kelayakan" class="form-label">Kelayakan</label>
                            <select class="form-control @error('kelayakan') is-invalid @enderror" name="kelayakan"
                                id="kelayakan" value="{{ old('kelayakan') }}">
                                <option value="">-- Pilih Kelayakan --</option>
                                <option value="layak">Layak</option>
                                <option value="tidaklayak">Tidak Layak</option>
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
                            <input type="file" class="form-control @error('fotos') is-invalid @enderror" name="fotos" id="fotos" value="{{ old('fotos') }}">
                            @error('fotos')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        

                        </div>

                        {{-- <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" name="status"
                                id="status" value="{{ old('status') }}">
                                <option value="">-- Pilih status --</option>
                                <option value="dipinjam">dipinjam</option>
                                <option value="kembali">kembali</option>
                                <option value="dikantor">dikantor</option>
                            </select>
                            @error('status')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div> --}}

                        </br>
                        </br> </br> </br>
                        <!-- Tombol Submit -->
<<<<<<< HEAD
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">Simpan</button>
=======
                        <div class="mb-3 mt-4">
                            <button type="submit" class="btn btn-danger">Submit</button>
>>>>>>> 72542b368a5eec9c79c1746c48f934aec671fc55
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