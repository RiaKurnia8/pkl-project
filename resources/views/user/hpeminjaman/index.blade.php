@extends('userlay.user')

@section('title','Home Peminjaman')

@section('content')

<h1 class="mt-4">Peminjaman Barang</h1>

<!-- Form Pencarian -->
<div class="d-flex justify-content-end mb-3">
    <div class="input-group" style="max-width: 200px;"> <!-- Membatasi lebar input menjadi lebih pendek -->
        <input type="text" class="form-control" placeholder="Search:" id="searchInput" style="border-radius: 25px 0 0 25px; height: 38px;"> <!-- Mengatur sudut oval dan tinggi input -->
        <div class="input-group-append">
            <span class="input-group-text" id="search-addon" style="border-radius: 0 25px 25px 0; background-color: #e9ecef; height: 38px;"> <!-- Penyesuaian tinggi -->
                <i class="fas fa-search" style="font-size: 16px;"></i> <!-- Ukuran ikon pencarian -->
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

<!-- Show Entries -->
<div class="d-flex justify-content-between align-items-center mb-3"> <!-- Menempatkan Show Entries di atas tabel -->
    <div>
        <label for="entries">Show</label>
        <select id="entries" class="form-control form-control-sm d-inline-block" style="width: auto; margin-left: 5px;">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="-1">All</option>
        </select>
        <span class="ml-2">entries</span>
    </div>
</div>

<!-- Tabel Data Peminjaman -->
<div style="padding: 20px; border-radius: 10px;"> <!-- Padding dan border-radius -->
    <table class="table table-striped">
        <thead style="background-color: #dc3545; color: white;"> <!-- Mengatur background merah hanya untuk thead -->
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Barang</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>08072</td>
                <td>Printer</td>
                <td>28-05-2024</td>
                <td>Diterima</td>
                <td><button class="btn btn-danger"><i class="fas fa-trash"></i></button></td>
            </tr>
            <tr>
                <td>2</td>
                <td>08090</td>
                <td>Hard Disk</td>
                <td>17-05-2024</td>
                <td>Diterima</td>
                <td><button class="btn btn-danger"><i class="fas fa-trash"></i></button></td>
            </tr>
            <!-- Tambahkan data lainnya sesuai kebutuhan -->
        </tbody>
    </table>
</div>

<!-- Teks Showing Entries -->
<div class="mb-3 text-right"> <!-- Menempatkan teks showing entries di bawah tabel dan merapikan posisi -->
    <span>Showing 1 to 2 of 2 entries</span> <!-- Teks showing entries -->
</div>

@endsection
