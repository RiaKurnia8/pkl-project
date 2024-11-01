@extends('layouts.admin')

@section('title','Dashboard')

@section('content') 

<h1 class="mt-4">Dashboard</h1>

<div class="row">
    <!-- Jumlah Data Barang -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">
                <h2 class="mb-2">{{ $jumlahBarang }}</h2> <!-- Menampilkan jumlah barang dinamis -->
                <p>Jumlah Data Barang</p>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="{{ route('admin.databarang.index') }}">Baca Selengkapnya</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>
 
<!-- Bagian Search di atas, PDF dan Excel di bawahnya di sebelah kanan -->
<div class="d-flex justify-content-end mb-3">
    <!-- Bagian Search -->
    <div class="col-auto">
        <form action="#" method="GET">
            <div class="input-group">
                <input type="text" id="form1" name="cari" class="form-control" placeholder="Search" value="{{ request('cari') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        
        </form>
         <a href="#" class="btn btn-success mt-1"><i class="fas fa-file-excel"></i></a>
         <a href="#" class="btn btn-danger mt-1"><i class="fas fa-file-pdf"></i></a>

    </div>
</div>




<!-- Tabel Data Peminjaman -->
<div style="padding: 20px; border-radius: 10px;"> <!-- Padding dan border-radius -->
    <table class="table table-striped">
        <thead style="background-color: #dc3545; color: white;"> <!-- Mengatur background merah hanya untuk thead -->
            <tr>
            <th>No</th>
            <th>Username</th>
            <th>Barang</th>
            <th>Plant</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Pengembalian</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($Peminjamans as $index => $peminjaman)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $peminjaman->username }}</td>
                <td>{{ $peminjaman->barang }}</td>
                <td>{{ $peminjaman->plant }}</td>
                <td>{{ $peminjaman->tanggal_pinjam }}</td>
                <td>{{ $peminjaman->tanggal_pengembalian ?? '-' }}</td> <!-- Menampilkan '-' jika tanggal_pengembalian null -->
                <td>
                    <!-- Contoh tombol aksi, bisa diubah sesuai kebutuhan -->
                    <button class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i> Hapus
                    </button>
                </td>
                
            </tr>
        @endforeach
    </tbody>
</table>

</div>

@endsection