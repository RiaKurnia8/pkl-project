@extends('layouts.admin')

@section('title','Kategori')

@section('content')

<h1>Kategori</h1>


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
            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> <!-- Ikon Edit -->
            </a>
            <button type="submit" class="btn btn-danger"> <i class="fas fa-trash"></i></button>

            </form>
        </td>
        {{-- <td>
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
        </td> --}}
    </tr>
    @endforeach
    </tbody>
</table>

<!-- Tombol Add Kategori dan Pagination -->
<div class="d-flex justify-content-between mt-3">
    <button class="btn btn-primary" onclick="window.location.href='{{ route('kategori.create') }}'">Add Kategori</button>

</div>

@endsection
