@extends('layouts.admin')
@section('title')
    Tambah Barang

@section('content')
    <div>
        <h2 style="text-align: center;">Edit Barang</h2>
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
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-control @error('kategori') is-invalid @enderror" name="kategori"
                                id="kategori" value="{{ $databarang->kategori }}">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="peripheral">Peripheral</option>
                                <option value="sparepart">Sparepart</option>
                                <option value="networkpart">Networkpart</option>
                                <option value="surveilance">Surveilance</option>
                            </select>
                            @error('kategori')
                                <p style="color: red">{{ $message }}</p>
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



                        <!-- Tombol Back -->
                        <div class="mb-3">
                            <a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
                        </div>
                    </div>

                    <!-- Kolom Kedua -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label for="tipe" class="form-label">Tipe</label>
                            <input type="text" class="form-control @error('tipe') is-invalid @enderror" name="tipe"
                                id="tipe" value="{{ $databarang->tipe }}">
                            @error('tipe')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

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
                            <select class="form-control @error('kelayakan') is-invalid @enderror" name="kelayakan"
                                id="kelayakan" value="{{ $databarang->kelayakan }}">
                                <option value="">-- Pilih Kelayakan --</option>
                                <option value="layak">Layak</option>
                                <option value="tidaklayak">Tidak Layak</option>
                            </select>
                            @error('kelayakan')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto"
                                id="foto" value="{{ $databarang->foto }}">
                            @error('foto')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" name="status"
                                id="status" value="{{ $databarang->status }}">
                                <option value="">-- Pilih status --</option>
                                <option value="dipinjam">dipinjam</option>
                                <option value="kembali">kembali</option>
                                <option value="dikantor">dikantor</option>
                            </select>
                            @error('status')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        </br>
                        </br> </br> </br>
                        <!-- Tombol Submit -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-danger">Submit</button>
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
