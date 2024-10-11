@extends('layouts.admin')

@section('title','Pengembalian Barang')

@section('content')

<div class="container">
    <h1 class="text-danger">Pengembalian Barang</h1>
    
    <!-- Form Pengembalian -->
    <form action="/pengembalian" method="POST">
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

        <!-- Barang Dikembalikan Input -->
        <div class="form-group">
            <label for="barang">Barang dikembalikan :</label>
            <input type="text" class="form-control" id="barang" name="barang" placeholder="Masukkan Barang Dikembalikan">
        </div>

        <!-- Tanggal Pengembalian Input -->
        <div class="form-group">
            <label for="tanggal_pengembalian">Tanggal Pengembalian :</label>
            <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian">
        </div>

        <!-- Status Select -->
        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status">
                <option value="Diterima">Diterima</option>
                <option value="Ditolak">Ditolak</option>
            </select>
        </div>

        <!-- Tombol Back dan Save -->
        <div class="d-flex justify-content-between mt-4">
            <a href="/pengembalian" class="btn btn-danger">BACK</a>
            <button type="submit" class="btn btn-success">SAVE</button>
        </div>
    </form>
</div>

@endsection
