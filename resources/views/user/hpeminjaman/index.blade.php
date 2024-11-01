@extends('userlay.user')

@section('title','Home Peminjaman')

@section('content')

<h1 class="mt-4">Peminjaman Barang</h1>

<!-- Form Pencarian -->
<div class="d-flex justify-content-end mb-3">
    <!-- Bagian Search -->
    <div class="col-auto">
        <form action="{{ route('user.hpeminjaman.search') }}" method="GET">
            <div class="input-group">
                <input type="text" id="form1" name="cari" class="form-control" placeholder="Search" value="{{ request('cari') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
    </div>
</div>

<!-- Tabel Data Peminjaman -->
<div style="padding: 20px; border-radius: 10px;">
    <table class="table table-striped">
        <thead style="background-color: #dc3545; color: white;">
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Plant</th>
                <th>Barang</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjamans as $index => $peminjaman)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $peminjaman->nik }}</td>
                    <td>{{ $peminjaman->plant }}</td>
                    <td>{{ $peminjaman->barang_dipinjam }}</td>
                    <td>{{ $peminjaman->tanggal_pinjam }}</td>
                    <td>{{ $peminjaman->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Teks Showing Entries -->
<div class="mb-3 text-right">
    <span>Showing {{ $peminjamans->count() }} of {{ $peminjamans->count() }} entries</span>
</div>

@endsection
