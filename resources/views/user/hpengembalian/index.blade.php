@extends('userlay.user')

@section('title','Home pengembalian')

@section('content')

<h1 class="mt-4">pengembalian Barang</h1>

<!-- Form Pencarian -->
<div class="d-flex justify-content-end mb-3">
    <div class="input-group" style="max-width: 200px;">
        <input type="text" class="form-control" placeholder="Search:" id="searchInput" style="border-radius: 25px 0 0 25px; height: 38px;">
        <div class="input-group-append">
            <span class="input-group-text" id="search-addon" style="border-radius: 0 25px 25px 0; background-color: #e9ecef; height: 38px;">
                <i class="fas fa-search" style="font-size: 16px;"></i>
            </span>
        </div>
    </div>
</div>

<!-- Tombol Ekspor PDF dan Excel -->
<div class="d-flex justify-content-end mb-3">
    <button class="btn btn-danger btn-sm mr-2">
        <i class="fas fa-file-pdf"></i> PDF
    </button>
    <button class="btn btn-success btn-sm">
        <i class="fas fa-file-excel"></i> XLS
    </button>
</div>

<!-- Tabel Data pengembalian -->
<div style="padding: 20px; border-radius: 10px;">
    <table class="table table-striped">
        <thead style="background-color: #dc3545; color: white;">
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Plant</th>
                <th>Barang</th>
                <th>Tanggal Pengembalian</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengembalians as $index => $pengembalian)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pengembalian->nik }}</td>
                    <td>{{ $pengembalian->plant }}</td>
                    <td>{{ $pengembalian->barang_dipinjam  }}</td>
                    <td>{{ $pengembalian->tanggal_pengembalian }}</td>
                    <td>{{ $pengembalian->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Teks Showing Entries -->
<div class="mb-3 text-right">
    <span>Showing {{ $pengembalians->count() }} of {{ $pengembalians->count() }} entries</span>
</div>

@endsection
