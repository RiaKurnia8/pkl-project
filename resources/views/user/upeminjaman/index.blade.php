@extends('userlay.user')

@section('title','Peminjaman')

@section('content')

<!-- Tampilkan Notifikasi Jika Data Berhasil Disimpan -->
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="container">
    <h1 class="text-danger">Peminjaman Barang</h1>

    <!-- Form Peminjaman -->
    <form action="upeminjaman" method="POST">
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

        <!-- Barang Dipinjam Input -->
        <div class="form-group">
            <label for="barang">Barang dipinjam :</label>
            <input type="text" class="form-control" id="barang" name="barang" placeholder="Masukkan Barang Dipinjam" required>
        </div>

        <!-- Tanggal Pinjam Input -->
        <div class="form-group">
            <label for="tanggal_pinjam">Tanggal Pinjam :</label>
            <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" required>
        </div>

        <!-- Tombol Back dan Save -->
        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-success">SAVE</button>
        </div>
    </form>
</div>

@endsection
