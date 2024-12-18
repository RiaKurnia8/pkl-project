@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="mb-3 mt-2">
        <a href="{{ url()->previous() }}" class="text-danger">
            <i class="fa-solid fa-arrow-left-long"></i></a>
    </div>

    <div class="container ">
        <h2 style="text-align: center;">Tambah Kategori</h2>


        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            {{-- <div class="form-group mb-4">
                <label for="nama_kategori" class="mb-2">Nama Kategori</label>
                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                    placeholder="Masukkan nama kategori" required>
                @error('nama_kategori')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div> --}}

            <div class="form-group mb-4">
                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">Kategori</label>
                    <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"
                        name="nama_kategori" id="nama_kategori" placeholder="Masukkan nama kategori">
                    @error('nama_kategori')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kolom Status -->
                <div class="form-group mb-4">
                    <label>Status</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="status_on" value="on" checked>
                        <label class="form-check-label" for="status_on">On</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="status_off" value="off">
                        <label class="form-check-label" for="status_off">Off</label>
                    </div>
                </div>
            
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-danger">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan</button>

            </div>
        </form>
    </div>
@endsection
