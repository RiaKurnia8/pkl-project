@extends('layouts.admin')

@section('title','Data User')

@section('content')

<h1>Data User</h1>

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

    

<!-- Tabel Data User -->
<div style="padding: 20px; border-radius: 10px;"> <!-- Padding dan border-radius -->
    <table class="table table-striped">
        <thead style="background-color: #dc3545; color: white;"> <!-- Mengatur background merah hanya untuk thead -->
            <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Username</th>
            <th>No. Hp</th>
            <th>Plant</th>
            <th>Jenis Kelamin</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <!-- Contoh data user (ini bisa diganti dengan data dari database) -->
        <tr>
            <td>1</td>
            <td>3576014403910098</td>
            <td>SL AM</td>
            <td>0823456729</td>
            <td>IT</td>
            <td>Laki-laki</td>
            <td>
                <!-- Tombol Aksi -->
                <button class="btn btn-danger btn-sm">
                    <i class="fas fa-trash-alt"></i>
                </button>
                <button class="btn btn-success btn-sm">
                    <i class="fas fa-edit"></i>
                </button>
            </td>
        </tr>
        <!-- Tambahkan data lainnya sesuai kebutuhan -->
    </tbody>
</table>

<!-- Tombol Add User dan Pagination -->
<div class="d-flex justify-content-between mt-3">
    <button class="btn btn-primary">Add User</button>
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
