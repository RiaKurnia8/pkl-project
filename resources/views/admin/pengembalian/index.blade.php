@extends('layouts.admin')

@section('title', 'pengembalian')

@section('content')

{{-- pesan sukses --}}
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session()->get('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<h1>Data pengembalian</h1>

<!-- Bagian Search di atas, PDF dan Excel di bawahnya di sebelah kanan -->
    
<div class="d-flex justify-content-end mb-3">
    <!-- Bagian Search -->
    <div class="col-auto">
        <form action="{{ route('admin.pengembalian.search') }}" method="GET">
            <div class="input-group">
                <input type="text" id="form1" name="cari" class="form-control" placeholder="Search" value="{{ request('cari') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        
        </form>
         <a href="{{ route('admin.pengembalian.xls') }}" class="btn btn-success mt-1"><i class="fas fa-file-excel"></i></a>
         <a href="{{ route('admin.pengembalian.exportPdf') }}" class="btn btn-danger mt-1"><i class="fas fa-file-pdf"></i></a>

    </div>
</div>

<!-- Tabel pengembalian -->
<div style="padding: 20px; border-radius: 10px;">
    <table class="table table-striped">
        <thead style="background-color: #dc3545; color: white;">
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Username</th>
                <th>Plant</th>
                <th>Barang dipinjam</th>
                <th>Tanggal pengembalian</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengembalians as $i => $data)
                @if ($data && $data->id) <!-- Pastikan $data dan $data->id tidak null -->
                    <tr>
                        <th scope="row">{{ $i + 1 + ($pengembalians->currentPage() - 1) * $pengembalians->perPage() }}</th>
                        <td>{{ $data->nik }}</td>
                        <td>{{ $data->username }}</td>
                        <td>{{ $data->plant }}</td>
                        <td>{{ $data->barang_dipinjam }}</td>
                        <td>{{ $data->tanggal_pengembalian }}</td>
                        <td>{{ $data->status}}</td>
                        
                        <td>
                            <a href="{{ route('admin.pengembalian.edit', $data->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> 
                            </a>
                            <!-- Tombol Hapus dengan Modal Konfirmasi -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $data->id }}">
                                <i class="fas fa-trash"></i> 
                            </button>
                            
                            <!-- Modal Konfirmasi Penghapusan -->
                            <div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $data->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $data->id }}">Konfirmasi Penghapusan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data ini? <p><strong>{{ $data->barang_dipinjam }}</strong></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('admin.pengembalian.destroy', $data->id) }}" method="POST" style="display:inline;">
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
                @endif
            @endforeach
        </tbody>
    </table>
    
    <!-- Pagination -->
    {{ $pengembalians->links() }}
</div>

@endsection
