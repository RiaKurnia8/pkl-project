@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Tambah Kategori</h1>
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <div class="form-group mb-4">
                <label for="nama_kategori" class="mb-2">Nama Kategori</label>
                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Masukkan nama kategori" required>
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

            <div class="d-flex gap-2">
                <a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
