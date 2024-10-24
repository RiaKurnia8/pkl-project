@extends('layouts.admin')

@section('title', 'Edit Data pengembalian')

@section('content')

<h1>Edit Data pengembalian</h1>

<!-- Pesan error jika data pengembalian tidak ditemukan -->
@if (!$pengembalian)
    <div class="alert alert-danger">
        Data pengembalian tidak ditemukan.
    </div>
@else
    <!-- Form untuk edit data pengembalian -->
    <form action="{{ route('admin.pengembalian.update', $pengembalian->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Input untuk NIK -->
        <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" name="nik" class="form-control" id="nik" value="{{ old('nik', $pengembalian->nik) }}" required>
        </div>

        <!-- Input untuk Username -->
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" id="username" value="{{ old('username', $pengembalian->username) }}" required>
        </div>

        <!-- Input untuk Plant -->
        <div class="form-group">
            <label for="plant">Plant</label>
            <input type="text" name="plant" class="form-control" id="plant" value="{{ old('plant', $pengembalian->plant) }}" required>
        </div>

        <!-- Input untuk Barang yang dikembalikan -->
        <div class="form-group">
            <label for="barang_dipinjam">Barang yang dikembalikan</label>
            <input type="text" name="barang_dipinjam" class="form-control" id="barang_dipinjam" value="{{ old('barang_dipinjam', $pengembalian->barang_dipinjam) }}" required>
        </div>

        <!-- Input untuk Tanggal Pengembalian -->
        <div class="form-group">
            <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
            <input type="date" name="tanggal_pengembalian" class="form-control" id="tanggal_pengembalian" value="{{ old('tanggal_pengembalian', $pengembalian->tanggal_pengembalian) }}" required>
        </div>

        <!-- Input untuk Status -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control @error('status') is-invalid @enderror" name="status"
                id="status">
                <option value="">-- Pilih Status --</option>
                <option value="diterima" {{ $pengembalian->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="ditolak" {{ $pengembalian->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            @error('status')
                <p style="color: red">{{ $message }}</p>
            @enderror
        </div>

       <!-- Tombol Submit -->
       <form action="{{ route('admin.pengembalian.update', $pengembalian->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Input fields here -->
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('admin.pengembalian.index') }}" class="btn btn-danger">Batal</a>
    </form>
</form>
@endif

@endsection
