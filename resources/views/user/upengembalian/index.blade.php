@extends('userlay.user')

@section('title','pengembalian')

@section('content')

<!-- Tampilkan Notifikasi Jika Data Berhasil Disimpan -->
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="container">
    <h1 class="text-danger">Pengembalian Barang</h1>

    <!-- Form pengembalian -->
    <form action="upengembalian" method="POST">
        @csrf

        <!-- NIK Input -->
        <div class="form-group">
            <label for="nik">NIK :</label>
            <input type="text" class="form-control" id="nik" name="nik" value="{{ Auth::user()->nik }}" readonly>
        </div>

        <!-- Username Input -->
        <div class="form-group">
            <label for="username">Username :</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ Auth::user()->username }}" readonly>
        </div>

        <!-- Plant Input -->
        <div class="form-group">
            <label for="plant">Plant :</label>
            <input type="text" class="form-control" id="plant" name="plant" value="{{ Auth::user()->plant }}" readonly>
        </div>

        <!-- Barang Pengembalian Input -->
        <div class="form-group">
            <label for="barang">Barang pengembalian :</label>
            <input type="text" class="form-control" id="barang" name="barang" placeholder="Masukkan Barang Pengembalian" required>
        </div>

        <!-- Tanggal Pinjam Input -->
        <div class="form-group">
            <label for="tanggal_pengembalian">Tanggal Pengembalian :</label>
            <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" required>
        </div>

        <!-- Tombol Back dan Save -->
        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-success">SAVE</button>
        </div>
    </form>
</div>

@endsection
