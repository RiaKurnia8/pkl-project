@extends('layouts.admin')

@section('title','Data Barang')

@section('content')

<h1>Data Barang</h1>

<!-- Bagian Search di atas, PDF dan Excel di bawahnya di sebelah kanan -->
<div class="d-flex justify-content-end mb-3">
    <div class="d-flex flex-column">
        <!-- Form Pencarian -->
        <div class="mb-2">
            <input type="text" class="form-control-sm" placeholder="Search...">
        </div>
        <!-- Tombol Ekspor PDF dan Excel -->
        <div>
            <button class="btn btn-danger btn-sm mr-2">
                <i class="fas fa-file-pdf"></i> PDF
            </button>
            <button class="btn btn-success btn-sm">
                <i class="fas fa-file-excel"></i> XLS
            </button>
        </div>
    </div>
</div>

<!-- Tabel Data Barang -->
<table id="dataBarangTable" class="table table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Lokasi</th>
            <th>Barang</th>
            <th>No.Asset</th>
            <th>No.Equipment</th>
            <th>Kategori</th>
            <th>Merk</th>
            <th>Tipe</th>
            <th>S/N</th>
            <th>Kelayakan</th>
            <th>Foto</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <!-- Contoh data barang (ini akan diganti dengan data dari database) -->
        <tr>
            <td>1</td>
            <td>IT Lantai 1</td>
            <td>Switch</td>
            <td>300000456-0</td>
            <td>1200-ICT-0001420</td>
            <td>Network Part</td>
            <td>3COM</td>
            <td>-</td>
            <td>AA/932FC YR9883E</td>
            <td>Tidak Layak</td>
            <td><img src="/path/to/image.jpg" alt="Foto" width="50"></td>
            <td>Dipinjam</td>
            <td>
                <!-- Dropdown Aksi -->
                <div class="dropdown">
                    <button class="btn btn-warning dropdown-toggle" type="button" id="aksiDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Aksi
                    </button>
                    <div class="dropdown-menu" aria-labelledby="aksiDropdown">
                        <a class="dropdown-item" href="#">Edit</a>
                        <a class="dropdown-item" href="#">Status</a>
                        <a class="dropdown-item text-danger" href="#">Hapus</a>
                    </div>
                </div>
            </td>
        </tr>
        <!-- Tambahkan baris data lainnya di sini -->
    </tbody>
</table>

<!-- Tombol Add Data di bagian bawah -->
<div class="d-flex justify-content-between mt-3">
    <button class="btn btn-primary">Add Data</button>
    <!-- Pagination dengan nomor halaman di tengah -->
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <!-- Tombol Previous -->
            <li class="page-item">
                <button class="btn btn-light" aria-label="Previous">
                    Previous
                </button>
            </li>

            <!-- Nomor Halaman -->
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>

            <!-- Tombol Next -->
            <li class="page-item">
                <button class="btn btn-light" aria-label="Next">
                    Next
                </button>
            </li>
        </ul>
    </nav>
</div>

@endsection
