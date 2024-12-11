@extends('layouts.admin')

@section('title', 'Edit Data Peminjaman')

@section('content')

<a href="{{ url()->previous() }}" class="text-danger">
    <i class="fa-solid fa-arrow-left-long"></i></a>
    <h2 style="text-align: center;">Edit Data Peminjaman</h2>
   

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
<<<<<<< HEAD
            <!-- Input fields here -->
            <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-danger">Batal</a>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
=======

            <div class="form-group">
                <label for="id">ID</label>
                <input type="text" name="id" class="form-control" id="id"
                    value="{{ old('id', $peminjaman->id) }}" readonly>
            </div>

            <!-- Input untuk NIK -->
            <div class="form-group">
                <label for="nik">NIK</label>
                <input type="text" name="nik" class="form-control" id="nik"
                    value="{{ old('nik', $peminjaman->nik) }}" readonly>
            </div>


            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" id="name"
                    value="{{ old('name', $peminjaman->name) }}" readonly>
            </div>

            <!-- Input untuk Plant -->
            <div class="form-group">
                <label for="plant">Plant</label>
                <input type="text" name="plant" class="form-control" id="plant"
                    value="{{ old('plant', $peminjaman->plant) }}" readonly>
            </div>

            <!-- Input untuk Barang yang dipinjam -->
            <div class="form-group">
                <label for="barang_dipinjam">Barang yang dipinjam</label>
                <input type="text" name="barang_dipinjam" class="form-control" id="barang_dipinjam"
                    value="{{ old('barang_dipinjam', $peminjaman->barang_dipinjam) }}" readonly>
            </div>

            <!-- Input untuk Tanggal Pinjam -->
            <div class="form-group">
                <label for="tanggal_pinjam">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" class="form-control" id="tanggal_pinjam"
                    value="{{ old('tanggal_pinjam', $peminjaman->tanggal_pinjam) }}" readonly>
            </div>


            <!-- Input untuk Status -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                    <option value="">-- Pilih Status --</option>
                    <option value="diterima" {{ $peminjaman->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="ditolak" {{ $peminjaman->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
                @error('status')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input untuk Keperluan --}}
            <div class="mb-3">
                <label for="keperluan" class="form-label">Keperluan</label>
                <textarea class="form-control @error('keperluan') is-invalid @enderror" name="keperluan" id="keperluan" rows="5"
                    readonly>{{ old('keperluan', $peminjaman->keperluan) }}</textarea>
                @error('keperluan')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input untuk Notes --}}
            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" id="notes" rows="5">{{ old('notes', $peminjaman->notes) }}</textarea>
                @error('notes')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>


            <!-- Tombol Submit -->
            <form action="{{ route('admin.peminjaman.update', $peminjaman->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Input fields here -->
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-danger">Batal</a>
            </form>
>>>>>>> 72542b368a5eec9c79c1746c48f934aec671fc55
        </form>
    @endif

@endsection
