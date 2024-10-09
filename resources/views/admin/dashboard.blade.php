@extends('layouts.admin')

@section('content')

<h1 class="mt-4">Dashboard</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Dashboard</li>
</ol>

<div class="row">
    <!-- Jumlah Data Barang -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">
                <h2 class="mb-2">133</h2>
                <p>Jumlah Data Barang</p>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">Baca Selengkapnya</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>

<!-- Data Peminjam -->
<h4>Data Peminjam</h4>

<!-- Form Pilih Bulan dan Filter dalam satu baris -->
<div class="d-flex align-items-center mb-4">
    <label for="bulan" class="mr-3" style="margin-right: 20px;">Pilih Bulan:</label> <!-- Menambah jarak antara label dan dropdown -->
    <select class="form-control form-control-sm" id="bulan" style="width: 200px; margin-right: 20px;"> <!-- Jarak antara dropdown dan tombol -->
        <option value="semua">Semua Bulan</option>
        <option value="januari">Januari</option>
        <option value="februari">Februari</option>
        <option value="maret">Maret</option>
        <option value="april">April</option>
        <option value="mey">Mei</option>
        <option value="juni">Juni</option>
        <option value="juli">Juli</option>
        <option value="agustus">Agustus</option>
        <option value="september">September</option>
        <option value="oktober">Oktober</option>
        <option value="november">November</option>
        <option value="desember">Desember</option>
    </select>
    <button class="btn btn-primary btn-sm">Filter</button>
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

<table class="table table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Barang</th>
            <th>Plant</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>SL. Siswanto</td>
            <td>Printer</td>
            <td>K3</td>
            <td>28-05-2024</td>
            <td>04-06-2024</td>
            <td><button class="btn btn-danger"><i class="fas fa-trash"></i></button></td>
        </tr>
        <tr>
            <td>2</td>
            <td>SL. Yulinda</td>
            <td>Hard Disk</td>
            <td>PMR-1</td>
            <td>17-05-2024</td>
            <td>19-05-2024</td>
            <td><button class="btn btn-danger"><i class="fas fa-trash"></i></button></td>
        </tr>
        <!-- Tambahkan data lainnya sesuai kebutuhan -->
    </tbody>
</table>

@endsection

