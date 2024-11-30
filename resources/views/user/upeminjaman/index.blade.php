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

        {{-- <div class="form-group">
            <label for="username">userNama :</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ Auth::user()->username }}" readonly>
        </div> --}}

        <!-- Name Input -->
        <div class="form-group">
            <label for="name">Nama :</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" readonly>
        </div>

        <!-- Plant Input -->
        <div class="form-group">
            <label for="plant">Plant :</label>
            <input type="text" class="form-control" id="plant" name="plant" 
                   value="{{ Auth::user()->plant->plant ?? 'Plant tidak ditemukan' }}" readonly>
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

        <!-- Notes Input -->
        {{-- <div class="form-group">
            <label for="notes">Notes :</label>
            <textarea class="form-control" id="notes" name="notes" rows="5" readonly></textarea>
        </div> --}}

        {{-- keperluan --}}
        <div class="form-group">
            <label for="keperluan">Keperluan :</label>
            <textarea class="form-control" id="keperluan" name="keperluan" rows="5" required></textarea>
        </div>


        <!-- Tombol Back dan Save -->
        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-success">SAVE</button>
        </div>
    </form>
</div>

@endsection
