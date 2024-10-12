@extends('layouts.admin')

@section('title','Kategori')

@section('content')

<h1>Kategori</h1>

<!-- Bagian Search di atas, PDF dan Excel di bawahnya di sebelah kanan -->
<div class="d-flex justify-content-end mb-3">
    <div class="d-flex flex-column">
        <!-- Form Pencarian -->
        <div class="mb-2">
            <input type="text" class="form-control-sm" placeholder="Search...">
        </div>
    </div>
</div>


<!-- Tabel Kategori -->
<div style="padding: 20px; border-radius: 10px;"> <!-- Padding dan border-radius -->
    <table class="table table-striped">
        <thead style="background-color: #dc3545; color: white;"> <!-- Mengatur background merah hanya untuk thead -->
            <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <!-- Contoh Kategori (ini akan diganti dengan data dari database) -->
        <tr>
            <td>1</td>
            <td>Peripheral</td>
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

<!-- Tombol Add User dan Pagination -->
<div class="d-flex justify-content-between mt-3">
    <button class="btn btn-primary">Add Kategori</button>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item">
                <button class="btn btn-light" aria-label="Previous">
                    Previous
                </button>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item">
                <button class="btn btn-light" aria-label="Next">
                    Next
                </button>
            </li>
        </ul>
    </nav>
</div>

@endsection
