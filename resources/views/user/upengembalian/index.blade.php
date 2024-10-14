@extends('userlay.user')

@section('title','Peminjaman')


@section('content')

<div class="container">
    <h1 class="text-danger">Pengembalian Barang</h1>
    
    <!-- Form Peminjaman -->
    <form action="/pinjaman" method="POST">
        @csrf

        <!-- NIK Input -->
        <div class="form-group">
            <label for="nik">NIK :</label>
            <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK">
        </div>

        <!-- Plant Input -->
        <div class="form-group">
            <label for="plant">Plant :</label>
            <input type="text" class="form-control" id="plant" name="plant" placeholder="Masukkan Plant">
        </div>

        <!-- Barang Dipinjam Input -->
        <div class="form-group">
            <label for="barang">Barang dipinjam :</label>
            <input type="text" class="form-control" id="barang" name="barang" placeholder="Masukkan Barang Dipinjam">
        </div>

        <!-- Tanggal Pinjam Input -->
        <div class="form-group">
            <label for="tanggal_pinjam">Tanggal Pengembalian :</label>
            <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam">
        </div>

        <!-- Tombol Back dan Save -->
        <div class="d-flex justify-content-between mt-4">
            <a href="/peminjaman" class="btn btn-danger">BACK</a>
            <button type="submit" class="btn btn-success">SAVE</button>
        </div>
    </form>
</div>


@endsection