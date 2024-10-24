@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Tambah Kategori</h1> <!-- Menambahkan margin bawah pada judul -->
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <div class="form-group mb-4"> <!-- Menambahkan margin bawah pada form group -->
                <label for="nama_kategori" class="mb-2">Nama Kategori</label> <!-- Menambahkan margin bawah pada label -->
                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Masukkan nama kategori" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
