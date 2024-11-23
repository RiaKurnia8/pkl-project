@extends('layouts.admin')

@section('title','Kategori')

@section('content')
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session()->get('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<h1>Kategori</h1>

    <!-- Tombol Add Kategori lebih ke bawah -->
    <div class="d-flex justify-content mt-4">
        <button class="btn btn-primary" onclick="window.location.href='{{ route('kategori.create') }}'">Add Kategori</button>
    </div>
</div>

<div style="padding: 20px; border-radius: 10px;">
    <table class="table table-striped">
        <thead style="background-color: #dc3545; color: white;">
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Status</th> <!-- Tambah kolom Status -->
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kategoris as $kategori)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $kategori->nama_kategori }}</td>
                <td>{{ $kategori->status }}</td> <!-- Tampilkan status -->
                <td>
                    <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> 
                    </a>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{  $kategori->id }}">
                        <i class="fas fa-trash"></i> 
                    </button>
                    
                    <div class="modal fade" id="deleteModal{{ $kategori->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $kategori->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $kategori->id }}">Konfirmasi Penghapusan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus data ini? <p><strong>{{ $kategori->nama_kategori }}</strong></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection
