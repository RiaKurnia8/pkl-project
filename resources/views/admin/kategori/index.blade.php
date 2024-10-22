@extends('layouts.admin')

@section('title','Kategori')

@section('content')

<h1>Kategori</h1>

<!-- Bagian Search di atas, PDF dan Excel di bawahnya di sebelah kanan -->
<div class="d-flex justify-content-end mb-3">
    <div class="input-group" style="width: 300px;">
        <input type="text" class="form-control" placeholder="Search kategori..." aria-label="Search" aria-describedby="button-addon2">
        <button class="btn btn-outline-secondary" type="button" id="button-addon2">
            <i class="fas fa-search"></i>
        </button>
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
    @foreach($kategoris as $kategori)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $kategori->nama_kategori }}</td>
        <td>
            <!-- Dropdown Aksi -->
            <div class="dropdown">
                <button class="btn btn-warning dropdown-toggle" type="button" id="aksiDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Aksi
                </button>
                <div class="dropdown-menu" aria-labelledby="aksiDropdown">
                    <!-- Edit dengan Ikon -->
                    <a class="dropdown-item" href="{{ route('kategori.edit', $kategori->id) }}">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <!-- Hapus dengan Ikon -->
                    <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

<!-- Tombol Add Kategori dan Pagination -->
<div class="d-flex justify-content-between mt-3">
    <button class="btn btn-primary" onclick="window.location.href='{{ route('kategori.create') }}'">Add Kategori</button>
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
