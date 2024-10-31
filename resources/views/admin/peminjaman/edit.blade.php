@extends('layouts.admin')

@section('title', 'Edit Data Peminjaman')

@section('content')

<h1>Edit Data Peminjaman</h1>

<!-- Pesan error jika data peminjaman tidak ditemukan -->
@if (!$peminjaman)
    <div class="alert alert-danger">
        Data peminjaman tidak ditemukan.
    </div>
@else
    <!-- Form untuk edit data peminjaman -->
    <form action="{{ route('admin.peminjaman.update', $peminjaman->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Input untuk NIK -->
        <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" name="nik" class="form-control" id="nik" value="{{ old('nik', $peminjaman->nik) }}" required>
        </div>

        <!-- Input untuk Username -->
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" id="username" value="{{ old('username', $peminjaman->username) }}" required>
        </div>

        <!-- Input untuk Plant -->
        <div class="form-group">
            <label for="plant">Plant</label>
            <input type="text" name="plant" class="form-control" id="plant" value="{{ old('plant', $peminjaman->plant) }}" required>
        </div>

        <!-- Input untuk Barang yang dipinjam -->
        <div class="form-group">
            <label for="barang_dipinjam">Barang yang dipinjam</label>
            <input type="text" name="barang_dipinjam" class="form-control" id="barang_dipinjam" value="{{ old('barang_dipinjam', $peminjaman->barang_dipinjam) }}" required>
        </div>

        <!-- Input untuk Tanggal Pinjam -->
        <div class="form-group">
            <label for="tanggal_pinjam">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" class="form-control" id="tanggal_pinjam" value="{{ old('tanggal_pinjam', $peminjaman->tanggal_pinjam) }}" required>
        </div>

        <!-- Input untuk Status -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control @error('status') is-invalid @enderror" name="status"
                id="status">
                <option value="">-- Pilih Status --</option>
                <option value="diterima" {{ $peminjaman->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="ditolak" {{ $peminjaman->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            @error('status')
                <p style="color: red">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tombol Submit -->
        <form action="{{ route('admin.peminjaman.update', $peminjaman->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Input fields here -->
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-danger">Batal</a>
        </form>
    </form>
@endif

@endsection